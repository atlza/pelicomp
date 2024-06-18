<?php

return [
    'email_from' => env('MAIL_FROM_ADDRESS'),

    //defines properties, name and authorized values
    'properties' => [
        'format' => [135, 120], //format can be a predefined array of values
        'iso' => 'number', //if format is a string, it's a type for html input
        'type' => ['Noir et blanc', 'couleur', 'couleur ciné', 'couleur reversible','panchromatique', 'panchromatique ciné', 'orthochromatique',
            'orthopanchromatique', 'superpanchromatique', 'hyperpanchromatique', 'monochrome'],
        'quantité' => 'number',
        'chimie' => ['E6', 'C41', 'E6 et C41'],
    ],
];
