<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use voku\helper\HtmlDomParser;

trait ParserTrait
{
    public function readFromUrl( $url, $withDebug = false )
    {
        $response = Http::withUserAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 14.4; rv:124.0) Gecko/20100101 Firefox/124.0") //todo place var in const or static or else
            ->withHeaders([
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.5',
                'Accept-Encoding' => 'gzip, deflate',
                'Connection' => 'keep-alive',
                'Upgrade-Insecure-Requests' => '1',
            ])
            ->withOptions(["verify"=>false])
            ->get( $url );

        $htmlContent = $response->body();
        $dom = HtmlDomParser::str_get_html($htmlContent);

        //$website = parse_url( $url, PHP_URL_HOST);
        $datasFound = false;
        $datasFromUrl = [];

        $elementsOrFalse = $dom->findMultiOrFalse('script');
        if( !empty($elementsOrFalse) ){
            foreach ( $elementsOrFalse as $anElement) {

                if( $anElement->hasAttribute('type') && $anElement->getAttribute('type') == 'application/ld+json' ){
                    $data = json_decode($anElement->text());

                    if( is_array($data) ){ //cas retrocamera.be
                        $data = $data[0];
                    }
                    elseif( !empty($data->{'@graph'}) && is_array($data->{'@graph'}) ){ //cas pellicule-photo.com
                        if( $withDebug ) dump($data->{'@graph'});
                        foreach( $data->{'@graph'} as $aSetOfData ){
                            if( !empty($aSetOfData->{'@type'}) && strtolower($aSetOfData->{'@type'}) == 'product' ){
                                $data = $aSetOfData;
                            }
                        }
                    }

                    if( !empty($data) && !empty($data->{'@type'}) ){
                        if( strtolower($data->{'@type'}) == 'product' ){
                            $datasFromUrl['name'] = $data->name;
                            if( !empty($data->gtin13) ) $datasFromUrl['gtin'] = $data->gtin13;

                            if( is_array($data->offers) ){ //cas de camerafilmphoto.com
                                $offer = $data->offers[0];
                                $datasFromUrl['price'] = $offer->price;
                                $datasFromUrl['url'] = $offer->url;
                            }
                            else{
                                $datasFromUrl['price'] = $data->offers->price;
                                if( !empty($offer->url) ) $datasFromUrl['url'] = $offer->url;
                                elseif( !empty($data->offers->url) ) $datasFromUrl['url'] = $data->offers->url;
                            }
                            $datasFound = true;
                        }
                        elseif( strtolower($data->{'@type'}) == 'webpage' && !empty($data->mainEntity) && strtolower($data->mainEntity->{'@type'}) == 'product' ){ //cas digit-photo
                            $datasFromUrl['name'] = $data->mainEntity->name;
                            $datasFromUrl['gtin'] = $data->mainEntity->gtin13;
                            $datasFromUrl['price'] = $data->mainEntity->offers->price;
                            $datasFromUrl['url'] = $data->mainEntity->offers->url;
                            $datasFound = true;
                        }

                        if( $withDebug ) dump($datasFound);
                        if( $withDebug ) echo "\n datasFromUrl";
                        if( $withDebug ) dump($datasFromUrl);

                    }
                }
            }
        }

        if($datasFound) return $datasFromUrl;
        else return false;
    }
}
