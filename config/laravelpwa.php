<?php

return [
    'name' => 'LaravelPWA',
    'manifest' => [
        'name' => env('APP_NAME', 'KSB Calendar'),
        'short_name' => 'KSB',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#ffffff',
        'display' => 'fullscreen',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '512x512' => [
                'path' => '/images/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '2048x2732' => '/images/icons/splash-2048x2732.png',
        ],
        'shortcuts' => [
//            [
//                'name' => 'Shortcut Link 1',
//                'description' => 'Shortcut Link 1 Description',
//                'url' => '/shortcutlink1',
//                'icons' => [
//                    "src" => "/images/icons/icon-72x72.png",
//                    "purpose" => "any"
//                ]
//            ],
        ],
        'custom' => []
    ]
];
