<?php

namespace App\Console\Commands;

use App\Traits\LogTrait;
use App\Traits\ParserTrait;
use App\Models\Offer;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateProductOffers extends Command
{
    use Logtrait;
    use ParserTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-product-offers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $offersToUpdate = Offer::whereDate('updated_at', '<=', Carbon::today())
            ->orderBy('updated_at', 'asc')
            ->limit(50)
            ->get();

        if( !empty($offersToUpdate) ) foreach ( $offersToUpdate as $anOffer ) {

            echo "\n".'-------------------------------';
            echo "\n".$anOffer->url;

            $response = $this->callOneUrl($anOffer->url, false);
            if( $offerDatas = $this->readHtmlResponse( $response, false ) ) {

                echo "\n price found: ".$offerDatas['price'];

                $anOffer->price = $offerDatas['price'];
                $anOffer->save();
                $anOffer->touch();

                echo "\n Offer updated: ".$anOffer->id;
                $this->log('update', 'offer', $anOffer->id);
            }
            else{
                $anOffer->price = null;
                $anOffer->save();
                $anOffer->touch();
                echo "\n Offer NOT updated: ".$anOffer->id;
                $this->log('cannot update', 'offer', $anOffer->id);
            }
            sleep(1);
        }

    }
}
