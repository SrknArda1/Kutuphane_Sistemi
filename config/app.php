<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Uygulama Adı
    |--------------------------------------------------------------------------
    |
    | Bu değer uygulamanızın adıdır; çerçeve bir bildirimde veya uygulama
    | adının gösterilmesi gereken arayüz öğelerinde kullanılır.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Ortamı
    |--------------------------------------------------------------------------
    |
    | Bu değer uygulamanızın şu anda hangi "ortamda" çalıştığını belirler.
    | Uygulamanın kullandığı çeşitli servislerin yapılandırmasını etkileyebilir.
    | Bu değeri ".env" dosyanızda ayarlayın.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Hata Ayıklama Modu
    |--------------------------------------------------------------------------
    |
    | Uygulama hata ayıklama modundayken, uygulama içinde oluşan her hata
    | için ayrıntılı hata mesajları ve yığın izleri gösterilir. Devre dışı
    | bırakıldığında basit bir genel hata sayfası gösterilir.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Uygulama URL'si
    |--------------------------------------------------------------------------
    |
    | Bu URL, Artisan komut satırı aracı kullanılırken URL'lerin doğru
    | üretilmesi için kullanılır. Uygulamanın kök dizinine ayarlanmalıdır.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Saat Dilimi
    |--------------------------------------------------------------------------
    |
    | Uygulamanız için varsayılan saat dilimini burada belirtebilirsiniz.
    | PHP tarih ve tarih-saat fonksiyonları tarafından kullanılır.
    | Çoğu kullanım senaryosu için varsayılan olarak "UTC" ayarlanmıştır.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Uygulama Yerel Ayar Yapılandırması
    |--------------------------------------------------------------------------
    |
    | Uygulama yerel ayarı, Laravel'in çeviri / yerelleştirme yöntemlerinin
    | kullanacağı varsayılan yerel ayarı belirler. Çeviri dizgileri
    | planladığınız herhangi bir yerel ayara ayarlanabilir.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Şifreleme Anahtarı
    |--------------------------------------------------------------------------
    |
    | Bu anahtar Laravel'in şifreleme servisleri tarafından kullanılır ve
    | tüm şifrelenmiş değerlerin güvenli olması için rastgele 32 karakterlik
    | bir dize olarak ayarlanmalıdır. Uygulamayı dağıtmadan önce yapın.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Bakım Modu Sürücüsü
    |--------------------------------------------------------------------------
    |
    | Bu yapılandırma seçenekleri, Laravel'in "bakım modu" durumunu
    | belirlemek ve yönetmek için kullanılan sürücüyü belirler.
    | "cache" sürücüsü bakım modunun birden fazla makinede kontrol edilmesine izin verir.
    |
    | Desteklenen sürücüler: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
