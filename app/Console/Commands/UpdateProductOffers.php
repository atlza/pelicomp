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

        dump($offersToUpdate);

        if( !empty($offersToUpdate) ) foreach ( $offersToUpdate as $anOffer ) {
            if( $offerDatas = $this->readProductUrl( $anOffer->url, true ) ) {
                $anOffer->price = $offerDatas['price'];
                $anOffer->save();

                $this->log('update', 'offer', $anOffer->id);
            }
        }

    }
}
