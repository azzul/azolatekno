<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => public_path('public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
        'public_main' => [
            'driver' => 'local',
            'root' => public_path(), // Path ke folder public
            'url' => env('APP_URL'), // URL dasar aplikasi
            'visibility' => 'public',
        ],
        'public_img' => [
            'driver' => 'local',
            'root' => public_path(), // Pastikan ini mengarah ke folder public
            'url' => env('APP_URL').'/img', // URL untuk mengakses file
            'visibility' => 'public',
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],
        'custom_category' => [
            'driver' => 'local',
            'root' => public_path('img/category'),  // Pastikan ini mengarah ke folder public/img
            'url' => env('APP_URL').'/img/category', // URL untuk mengakses file
            'visibility' => 'public',
        ],
        'custom_product' => [
            'driver' => 'local',
            'root' => public_path('img/product'),  // Pastikan ini mengarah ke folder public/img
            'url' => env('APP_URL').'/img/product', // URL untuk mengakses file
            'visibility' => 'public',
        ],
        'custom_productgallery' => [
            'driver' => 'local',
            'root' => public_path('img/product/gallery'),  // Pastikan ini mengarah ke folder public/img
            'url' => env('APP_URL').'/img/product/gallery', // URL untuk mengakses file
            'visibility' => 'public',
        ],
        'custom_etalase' => [
            'driver' => 'local',
            'root' => public_path('img/etalase'),  // Pastikan ini mengarah ke folder public/img
            'url' => env('APP_URL').'/img/etalase', // URL untuk mengakses file
            'visibility' => 'public',
        ],
        'custom_contentcategory' => [
            'driver' => 'local',
            'root' => public_path('img/category/content'),  // Pastikan ini mengarah ke folder public/img
            'url' => env('APP_URL').'/img/category/content', // URL untuk mengakses file
            'visibility' => 'public',
        ],
        'custom_contentetalase' => [
            'driver' => 'local',
            'root' => public_path('img/etalase/content'),  // Pastikan ini mengarah ke folder public/img
            'url' => env('APP_URL').'/img/etalase/content', // URL untuk mengakses file
            'visibility' => 'public',
        ],
        'custom_video' => [
            'driver' => 'local',
            'root' => public_path('video'),  // Pastikan ini mengarah ke folder public/img
            'url' => env('APP_URL').'/video', // URL untuk mengakses file
            'visibility' => 'public',
        ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
