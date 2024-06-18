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
        'https://www.missnumerique.com/ilford-film-noir-blanc-120-hp5-plus-p-15692.html',
        'https://labo-argentique.com/362-ilford-hp5-plus-400-iso-120.html',
        'https://www.nationphoto.com/fr/films-120/2410-ilford-hp5-120-019498629013.html',
        'https://www.photostock.fr/ilford-hp5-plus-120-a-l-unite-ilford-c2x34877138',
        'https://www.digit-photo.com/ILFORD-HP5-400asa-120-rFPNBI1629017.html',
        'https://www.photospecialist.fr/ilford-hp5-plus-400-120',
        'https://www.ateliers-marinette.fr/fr/pellicules-argentiques/ilford-hp5-plus-400-120.html',
        'https://arcanes-labo.photo/photographie-argentique-1/pellicules-films-recharges-argentiques-49/pellicules-films-120-72/pellicules-films-120-noir-et-blanc-53/pellicule-ilford-hp5-plus-120-86.html',
        'https://negatifplus.com/store/films-pellicules-et-jetables/ilford-hp5-plus-400-120',
        'https://www.retrocamera.be/fr/ilford-hp5-plus-120-rc0000000018',
        'https://fr.morifilmlab.com/collections/medium-format-film/products/ilford-hp5-plus-120-film',
        'https://reportage-image.com/pellicules/kodak120-tmax-400',
        'https://www.creapolis.photo/produit/ilford-film-hp5-plus-120/',
        'https://www.mbtech.fr/pellicule-photo/198-ilford-film-professionnel-noir-et-blanc-hp5-plus-400-format-120-l-unite.html',
        'https://camerafilmphoto.com/collections/120/products/ilford-hp5-plus-120',
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
        foreach( self::$testUrls as $url ){
            $this->readFromUrl($url);
        }
    }

}
