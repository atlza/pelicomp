<?php

namespace App\Console\Commands;

use App\Traits\ParserTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use voku\helper\HtmlDomParser;

class jsonLdFromUrl extends Command
{
    use ParserTrait;

    private static $testUrls = [
        'https://labo-argentique.com/349-ilford-delta-professional-3200-iso-1-rouleau-120.html',
        'https://www.nationphoto.com/fr/films-120/2417-ilford-delta-3200-120-019498921537.html',
        'https://www.photostock.fr/ilford-delta-3200-120-a-l-unite-ilford-c2x34876927',
        'https://www.digit-photo.com/ILFORD-Delta-3200asa-120-rFPNBI1921535.html',
        'https://reportage-image.com/pellicules/ilford-delta-3200-120',
        'https://www.mbtech.fr/pellicule-photo/8915-ilford-film-professionnel-noir-et-blanc-delta-3200-format-120-l-unite.html',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:read-url';

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
        $this->readProductUrl(self::$testUrls, true);
    }

}
