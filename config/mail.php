<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Posta Göndericisi
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, gönderim sırasında başka bir gönderici açıkça belirtilmedikçe
    | tüm e-posta mesajlarını göndermek için kullanılan varsayılan posta
    | göndericisini kontrol eder.
    |
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Posta Gönderici Yapılandırmaları
    |--------------------------------------------------------------------------
    |
    | Uygulamanız tarafından kullanılan tüm posta göndericilerini ve ilgili
    | ayarlarını burada yapılandırabilirsiniz. Laravel çeşitli posta
    | "transport" sürücülerini destekler.
    |
    | Desteklenen: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |              "postmark", "resend", "log", "array",
    |              "failover", "roundrobin"
    |
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Genel "Gönderen" Adresi
    |--------------------------------------------------------------------------
    |
    | Uygulamanız tarafından gönderilen tüm e-postaların aynı adresten
    | gönderilmesini isteyebilirsiniz. Burada global olarak kullanılacak
    | ad ve adresi belirtebilirsiniz.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', env('APP_NAME', 'Laravel')),
    ],

];
