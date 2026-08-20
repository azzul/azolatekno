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
        'root' => base_path('../public_html'), // ubah ke public_html
        'url' => env('APP_URL'),
        'visibility' => 'public',
        'throw' => false,
    ],

    'public_main' => [
        'driver' => 'local',
        'root' => base_path('../public_html'), // bukan public_path()
        'url' => env('APP_URL'),
        'visibility' => 'public',
    ],

    'public_img' => [
        'driver' => 'local',
        'root' => base_path('../public_html/img'),
        'url' => env('APP_URL').'/img',
        'visibility' => 'public',
    ],

    'custom_category' => [
        'driver' => 'local',
        'root' => base_path('../public_html/img/category'),
        'url' => env('APP_URL').'/img/category',
        'visibility' => 'public',
    ],

    'custom_product' => [
        'driver' => 'local',
        'root' => base_path('../public_html/img/product'),
        'url' => env('APP_URL').'/img/product',
        'visibility' => 'public',
    ],

    'custom_productgallery' => [
        'driver' => 'local',
        'root' => base_path('../public_html/img/product/gallery'),
        'url' => env('APP_URL').'/img/product/gallery',
        'visibility' => 'public',
    ],

    'custom_etalase' => [
        'driver' => 'local',
        'root' => base_path('../public_html/img/etalase'),
        'url' => env('APP_URL').'/img/etalase',
        'visibility' => 'public',
    ],

    'custom_contentcategory' => [
        'driver' => 'local',
        'root' => base_path('../public_html/img/category/content'),
        'url' => env('APP_URL').'/img/category/content',
        'visibility' => 'public',
    ],

    'custom_contentetalase' => [
        'driver' => 'local',
        'root' => base_path('../public_html/img/etalase/content'),
        'url' => env('APP_URL').'/img/etalase/content',
        'visibility' => 'public',
    ],

    'custom_video' => [
        'driver' => 'local',
        'root' => base_path('../public_html/video'),
        'url' => env('APP_URL').'/video',
        'visibility' => 'public',
    ],
    'public_invoice' => [
        'driver' => 'local',
        'root' => base_path('../public_html/img/invoice'), // folder tujuan
        'url' => env('APP_URL') . '/img/invoice',          // URL akses
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
