<?php

return [

    'paths' => [
        resource_path('views'),  // This tells Laravel to look for views in resources/views
    ],

    'compiled' => env('VIEW_COMPILED_PATH', realpath(storage_path('framework/views'))),  // Path for compiled views

];



