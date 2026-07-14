<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Dosya Sistemi Diski
    |--------------------------------------------------------------------------
    |
    | Çerçeve tarafından kullanılacak varsayılan dosya sistemi diskini
    | burada belirtebilirsiniz. "local" diski ve çeşitli bulut tabanlı
    | diskler dosya depolama için kullanılabilir.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Dosya Sistemi Diskleri
    |--------------------------------------------------------------------------
    |
    | Gerektiği kadar dosya sistemi diski yapılandırabilirsiniz. Aynı
    | sürücü için birden fazla disk de yapılandırılabilir.
    |
    | Desteklenen sürücüler: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
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
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Sembolik Bağlantılar
    |--------------------------------------------------------------------------
    |
    | `storage:link` Artisan komutu çalıştırıldığında oluşturulacak sembolik
    | bağlantıları burada yapılandırabilirsiniz. Dizi anahtarları bağlantı
    | konumları, değerler ise hedefleri olmalıdır.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
