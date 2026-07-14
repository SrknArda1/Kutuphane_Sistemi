<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Üçüncü Taraf Servisler
    |--------------------------------------------------------------------------
    |
    | Bu dosya Mailgun, Postmark, AWS ve benzeri üçüncü taraf servislerin
    | kimlik bilgilerini saklamak içindir. Paketlerin çeşitli servis
    | kimlik bilgilerini bulması için standart bir konum sağlar.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
