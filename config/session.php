<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Varsayılan Oturum Sürücüsü
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, gelen istekler için kullanılacak varsayılan oturum sürücüsünü
    | belirler. Laravel oturum verilerini kalıcı kılmak için çeşitli depolama
    | seçeneklerini destekler. Veritabanı depolama iyi bir varsayılan seçimdir.
    |
    | Desteklenen: "file", "cookie", "database", "memcached",
    |              "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Ömrü
    |--------------------------------------------------------------------------
    |
    | Oturumun süresi dolmadan önce boşta kalabileceği dakika sayısını
    | burada belirtebilirsiniz. Tarayıcı kapatıldığında hemen sona ermesini
    | istiyorsanız expire_on_close seçeneğini kullanabilirsiniz.
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Oturum Şifreleme
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, tüm oturum verilerinin depolanmadan önce şifrelenmesini
    | kolayca belirtmenizi sağlar. Tüm şifreleme Laravel tarafından otomatik
    | olarak gerçekleştirilir.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Oturum Dosya Konumu
    |--------------------------------------------------------------------------
    |
    | "file" oturum sürücüsü kullanılırken oturum dosyaları diske yerleştirilir.
    | Varsayılan depolama konumu burada tanımlanmıştır; gerekirse değiştirebilirsiniz.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Veritabanı Bağlantısı
    |--------------------------------------------------------------------------
    |
    | "database" veya "redis" oturum sürücüleri kullanılırken, oturumları
    | yönetmek için kullanılacak bağlantıyı belirtebilirsiniz. Bu, veritabanı
    | yapılandırma seçeneklerinizdeki bir bağlantıya karşılık gelmelidir.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Veritabanı Tablosu
    |--------------------------------------------------------------------------
    |
    | "database" oturum sürücüsü kullanılırken oturumların saklanacağı tabloyu
    | belirtebilirsiniz. Mantıklı bir varsayılan tanımlanmıştır.
    |
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Önbellek Deposu
    |--------------------------------------------------------------------------
    |
    | Çerçevenin önbellek tabanlı oturum arka uçlarından biri kullanılırken,
    | istekler arasında oturum verilerini saklamak için kullanılacak önbellek
    | deposunu tanımlayabilirsiniz.
    |
    | Etkiler: "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Temizleme Piyangosu
    |--------------------------------------------------------------------------
    |
    | Bazı oturum sürücüleri depolama konumlarını eski oturumları temizlemek
    | için manuel olarak taramalıdır. Belirli bir istekte bunun gerçekleşme
    | olasılığı burada belirtilir. Varsayılan olarak 100'de 2 şans vardır.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Oturum Çerez Adı
    |--------------------------------------------------------------------------
    |
    | Çerçeve tarafından oluşturulan oturum çerezinin adını burada
    | değiştirebilirsiniz. Genellikle bu değeri değiştirmenize gerek yoktur.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Oturum Çerez Yolu
    |--------------------------------------------------------------------------
    |
    | Oturum çerez yolu, çerezin hangi yol için kullanılabilir sayılacağını
    | belirler. Genellikle uygulamanızın kök yolu olur.
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Oturum Çerez Etki Alanı
    |--------------------------------------------------------------------------
    |
    | Bu değer oturum çerezinin hangi etki alanı ve alt etki alanları için
    | kullanılabilir olacağını belirler. Varsayılan olarak alt etki alanları
    | olmadan kök etki alanı için kullanılabilir.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Yalnızca HTTPS Çerezleri
    |--------------------------------------------------------------------------
    |
    | Bu seçenek true olarak ayarlandığında, oturum çerezleri yalnızca
    | tarayıcı HTTPS bağlantısına sahipse sunucuya geri gönderilir.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | Yalnızca HTTP Erişimi
    |--------------------------------------------------------------------------
    |
    | Bu değer true olarak ayarlandığında JavaScript'in çerez değerine
    | erişmesi engellenir; çereze yalnızca HTTP protokolü üzerinden
    | erişilebilir.
    |
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Same-Site Çerezleri
    |--------------------------------------------------------------------------
    |
    | Bu seçenek, siteler arası isteklerde çerezlerinizin nasıl davranacağını
    | belirler ve CSRF saldırılarını azaltmak için kullanılabilir. Varsayılan
    | olarak güvenli siteler arası isteklere izin vermek için "lax" ayarlanır.
    |
    | Bkz: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value
    |
    | Desteklenen: "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Bölümlenmiş Çerezler
    |--------------------------------------------------------------------------
    |
    | Bu değer true olarak ayarlandığında çerez, siteler arası bağlamda
    | üst düzey siteye bağlanır. Bölümlenmiş çerezler "secure" işaretlendiğinde
    | ve Same-Site özniteliği "none" olarak ayarlandığında tarayıcı tarafından kabul edilir.
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
