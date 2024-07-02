<?php

return [
    'email_from' => env('MAIL_FROM_ADDRESS'),

    //defines properties, name and authorized values
    'properties' => [
        'format' => [
            'values' => [120, 135], //format can be a predefined array of values
            'mandatory' => true, //format can be a predefined array of values
        ],
        'iso' => [
            'values' => 'number', //if values is a string, it's a type for html input
            'mandatory' => true,
            'default' => null
        ],
        'type' => [
            'values' => ['Noir et blanc', 'couleur', 'couleur ciné', 'couleur reversible','panchromatique', 'panchromatique ciné', 'orthochromatique',
                'orthopanchromatique', 'superpanchromatique', 'hyperpanchromatique', 'monochrome'],
            'mandatory' => true,
        ],
        'quantité' => [
            'values' => 'number', //if values is a string, it's a type for html input
            'mandatory' => true,
            'default' => 1
        ],
        'chimie' => [
            'values' => ['E6', 'C41', 'E6 et C41', 'n&b', 'ECN-2'],
            'mandatory' => false,
        ]
    ],
];
