<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Kimlik Doğrulama Varsayılanları
    |--------------------------------------------------------------------------
    |
    | Bu seçenek uygulamanız için varsayılan kimlik doğrulama "guard" ve
    | parola sıfırlama "broker" değerlerini tanımlar. Gerektiğinde bu
    | değerleri değiştirebilirsiniz.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Kimlik Doğrulama Guard'ları
    |--------------------------------------------------------------------------
    |
    | Uygulamanız için tüm kimlik doğrulama guard'larını burada tanımlayabilirsiniz.
    | Oturum depolama ve Eloquent kullanıcı sağlayıcısını kullanan varsayılan
    | bir yapılandırma tanımlanmıştır.
    |
    | Tüm kimlik doğrulama guard'larının, kullanıcıların veritabanından veya
    | uygulamanın kullandığı diğer depolama sisteminden nasıl alınacağını
    | tanımlayan bir kullanıcı sağlayıcısı vardır. Genellikle Eloquent kullanılır.
    |
    | Desteklenen: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Kullanıcı Sağlayıcıları
    |--------------------------------------------------------------------------
    |
    | Tüm kimlik doğrulama guard'larının bir kullanıcı sağlayıcısı vardır.
    | Birden fazla kullanıcı tablosu veya modeliniz varsa, modeli / tabloyu
    | temsil etmek için birden fazla sağlayıcı yapılandırabilirsiniz.
    |
    | Desteklenen: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Parola Sıfırlama
    |--------------------------------------------------------------------------
    |
    | Bu yapılandırma seçenekleri Laravel'in parola sıfırlama işlevinin
    | davranışını belirler; token depolama tablosu ve kullanıcıları
    | almak için çağrılan kullanıcı sağlayıcısı dahil.
    |
    | Süre sonu, her sıfırlama token'ının geçerli sayılacağı dakika
    | sayısıdır. Bu güvenlik özelliği token'ları kısa ömürlü tutar.
    |
    | Kısıtlama ayarı, kullanıcının daha fazla parola sıfırlama token'ı
    | oluşturmadan önce beklemesi gereken saniye sayısıdır.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Parola Onay Zaman Aşımı
    |--------------------------------------------------------------------------
    |
    | Parola onay penceresinin süresi dolmadan önce geçecek saniye sayısını
    | burada tanımlayabilirsiniz. Varsayılan olarak zaman aşımı üç saattir.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
