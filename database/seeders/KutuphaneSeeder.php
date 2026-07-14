<?php

namespace Database\Seeders;

use App\Models\Ceza;
use App\Models\Kategori;
use App\Models\Kitap;
use App\Models\Odunc;
use App\Models\Uye;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KutuphaneSeeder extends Seeder
{
    /**
     * Kütüphane test verilerini FK sırasına göre oluştur.
     */
    public function run(): void
    {
        // 1. Kategoriler
        $kategoriler = $this->kategorileriOlustur();

        // 2. Üyeler
        $uyeler = $this->uyeleriOlustur();

        // 3. Kitaplar
        $kitaplar = $this->kitaplariOlustur($kategoriler);

        // 4. Ödünçler
        $oduncler = $this->oduncleriOlustur($uyeler, $kitaplar);

        // 5. Cezalar (gecikmiş aktif ödünçlere)
        $this->cezalariOlustur($oduncler);
    }

    /**
     * Kategori kayıtlarını oluştur.
     *
     * @return array<string, Kategori>
     */
    private function kategorileriOlustur(): array
    {
        $veriler = [
            ['ad' => 'Roman', 'aciklama' => 'Roman ve kurgu eserler'],
            ['ad' => 'Bilim', 'aciklama' => 'Bilim ve teknoloji kitapları'],
            ['ad' => 'Tarih', 'aciklama' => 'Tarih ve biyografi eserleri'],
            ['ad' => 'Çocuk', 'aciklama' => 'Çocuk ve gençlik kitapları'],
        ];

        $kategoriler = [];

        foreach ($veriler as $veri) {
            $kategori = Kategori::create($veri);
            $kategoriler[$kategori->ad] = $kategori;
        }

        return $kategoriler;
    }

    /**
     * Üye kayıtlarını oluştur.
     *
     * @return array<int, Uye>
     */
    private function uyeleriOlustur(): array
    {
        $veriler = [
            [
                'ad' => 'Ayşe',
                'soyad' => 'Yılmaz',
                'email' => 'ayse.yilmaz@ornek.com',
                'telefon' => '05321234567',
                'kayit_tarihi' => '2024-01-15',
            ],
            [
                'ad' => 'Mehmet',
                'soyad' => 'Kaya',
                'email' => 'mehmet.kaya@ornek.com',
                'telefon' => '05339876543',
                'kayit_tarihi' => '2024-03-22',
            ],
            [
                'ad' => 'Zeynep',
                'soyad' => 'Demir',
                'email' => 'zeynep.demir@ornek.com',
                'telefon' => '05441122334',
                'kayit_tarihi' => '2024-06-10',
            ],
            [
                'ad' => 'Ali',
                'soyad' => 'Çelik',
                'email' => 'ali.celik@ornek.com',
                'telefon' => '05556677889',
                'kayit_tarihi' => '2024-09-05',
            ],
            [
                'ad' => 'Fatma',
                'soyad' => 'Arslan',
                'email' => 'fatma.arslan@ornek.com',
                'telefon' => '05001234567',
                'kayit_tarihi' => '2025-02-18',
            ],
        ];

        $uyeler = [];

        foreach ($veriler as $veri) {
            $uyeler[] = Uye::create($veri);
        }

        return $uyeler;
    }

    /**
     * Kitap kayıtlarını oluştur.
     *
     * @param  array<string, Kategori>  $kategoriler
     * @return array<int, Kitap>
     */
    private function kitaplariOlustur(array $kategoriler): array
    {
        $veriler = [
            [
                'kategori_id' => $kategoriler['Roman']->id,
                'baslik' => 'Suç ve Ceza',
                'yazar' => 'Fyodor Dostoyevski',
                'isbn' => '9789750719385',
                'yayin_yili' => 1866,
                'stok_adedi' => 3,
            ],
            [
                'kategori_id' => $kategoriler['Roman']->id,
                'baslik' => 'Tutunamayanlar',
                'yazar' => 'Oğuz Atay',
                'isbn' => '9789750719392',
                'yayin_yili' => 1972,
                'stok_adedi' => 2,
            ],
            [
                'kategori_id' => $kategoriler['Roman']->id,
                'baslik' => 'Saatleri Ayarlama Enstitüsü',
                'yazar' => 'Ahmet Hamdi Tanpınar',
                'isbn' => '9789750719408',
                'yayin_yili' => 1961,
                'stok_adedi' => 4,
            ],
            [
                'kategori_id' => $kategoriler['Bilim']->id,
                'baslik' => 'Kısa Zamanların Tarihi',
                'yazar' => 'Stephen Hawking',
                'isbn' => '9789750719415',
                'yayin_yili' => 1988,
                'stok_adedi' => 5,
            ],
            [
                'kategori_id' => $kategoriler['Bilim']->id,
                'baslik' => 'Türlerin Kökeni',
                'yazar' => 'Charles Darwin',
                'isbn' => '9789750719422',
                'yayin_yili' => 1859,
                'stok_adedi' => 2,
            ],
            [
                'kategori_id' => $kategoriler['Tarih']->id,
                'baslik' => 'Nutuk',
                'yazar' => 'Mustafa Kemal Atatürk',
                'isbn' => '9789750719439',
                'yayin_yili' => 1927,
                'stok_adedi' => 3,
            ],
            [
                'kategori_id' => $kategoriler['Tarih']->id,
                'baslik' => 'Osmanlı İmparatorluğu',
                'yazar' => 'Halil İnalcık',
                'isbn' => '9789750719446',
                'yayin_yili' => 2003,
                'stok_adedi' => 1,
            ],
            [
                'kategori_id' => $kategoriler['Çocuk']->id,
                'baslik' => 'Pinokyo',
                'yazar' => 'Carlo Collodi',
                'isbn' => '9789750719453',
                'yayin_yili' => 1883,
                'stok_adedi' => 4,
            ],
            [
                'kategori_id' => $kategoriler['Çocuk']->id,
                'baslik' => 'Küçük Prens',
                'yazar' => 'Antoine de Saint-Exupéry',
                'isbn' => '9789750719460',
                'yayin_yili' => 1943,
                'stok_adedi' => 5,
            ],
            [
                'kategori_id' => $kategoriler['Bilim']->id,
                'baslik' => 'Cosmos',
                'yazar' => 'Carl Sagan',
                'isbn' => '9789750719477',
                'yayin_yili' => 1980,
                'stok_adedi' => 2,
            ],
        ];

        $kitaplar = [];

        foreach ($veriler as $veri) {
            $kitaplar[] = Kitap::create($veri);
        }

        return $kitaplar;
    }

    /**
     * Ödünç kayıtlarını oluştur.
     * Ayşe (4) ve Mehmet (4) üyeleri 3'ten fazla kitap ödünç almış olur.
     *
     * @param  array<int, Uye>  $uyeler
     * @param  array<int, Kitap>  $kitaplar
     * @return array<int, Odunc>
     */
    private function oduncleriOlustur(array $uyeler, array $kitaplar): array
    {
        $bugun = Carbon::today();

        $veriler = [
            // Ayşe Yılmaz — 4 ödünç (rapor testi)
            [
                'uye_id' => $uyeler[0]->id,
                'kitap_id' => $kitaplar[0]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(20)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(6)->toDateString(),
                'iade_tarihi' => null,
                'durum' => 'aktif',
            ],
            [
                'uye_id' => $uyeler[0]->id,
                'kitap_id' => $kitaplar[1]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(18)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(4)->toDateString(),
                'iade_tarihi' => null,
                'durum' => 'aktif',
            ],
            [
                'uye_id' => $uyeler[0]->id,
                'kitap_id' => $kitaplar[3]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(45)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(31)->toDateString(),
                'iade_tarihi' => $bugun->copy()->subDays(30)->toDateString(),
                'durum' => 'iade_edildi',
            ],
            [
                'uye_id' => $uyeler[0]->id,
                'kitap_id' => $kitaplar[7]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(10)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->addDays(4)->toDateString(),
                'iade_tarihi' => null,
                'durum' => 'aktif',
            ],

            // Mehmet Kaya — 4 ödünç (rapor testi)
            [
                'uye_id' => $uyeler[1]->id,
                'kitap_id' => $kitaplar[2]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(25)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(11)->toDateString(),
                'iade_tarihi' => null,
                'durum' => 'aktif',
            ],
            [
                'uye_id' => $uyeler[1]->id,
                'kitap_id' => $kitaplar[4]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(15)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(1)->toDateString(),
                'iade_tarihi' => null,
                'durum' => 'aktif',
            ],
            [
                'uye_id' => $uyeler[1]->id,
                'kitap_id' => $kitaplar[5]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(60)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(46)->toDateString(),
                'iade_tarihi' => $bugun->copy()->subDays(47)->toDateString(),
                'durum' => 'iade_edildi',
            ],
            [
                'uye_id' => $uyeler[1]->id,
                'kitap_id' => $kitaplar[9]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(8)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->addDays(6)->toDateString(),
                'iade_tarihi' => null,
                'durum' => 'aktif',
            ],

            // Zeynep Demir — 2 ödünç
            [
                'uye_id' => $uyeler[2]->id,
                'kitap_id' => $kitaplar[6]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(30)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(16)->toDateString(),
                'iade_tarihi' => null,
                'durum' => 'aktif',
            ],
            [
                'uye_id' => $uyeler[2]->id,
                'kitap_id' => $kitaplar[8]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(40)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(26)->toDateString(),
                'iade_tarihi' => $bugun->copy()->subDays(25)->toDateString(),
                'durum' => 'iade_edildi',
            ],

            // Ali Çelik — 1 ödünç
            [
                'uye_id' => $uyeler[3]->id,
                'kitap_id' => $kitaplar[0]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(5)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->addDays(9)->toDateString(),
                'iade_tarihi' => null,
                'durum' => 'aktif',
            ],

            // Fatma Arslan — 2 ödünç
            [
                'uye_id' => $uyeler[4]->id,
                'kitap_id' => $kitaplar[1]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(22)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(8)->toDateString(),
                'iade_tarihi' => null,
                'durum' => 'aktif',
            ],
            [
                'uye_id' => $uyeler[4]->id,
                'kitap_id' => $kitaplar[5]->id,
                'odunc_tarihi' => $bugun->copy()->subDays(50)->toDateString(),
                'beklenen_iade_tarihi' => $bugun->copy()->subDays(36)->toDateString(),
                'iade_tarihi' => $bugun->copy()->subDays(35)->toDateString(),
                'durum' => 'iade_edildi',
            ],
        ];

        $oduncler = [];

        foreach ($veriler as $veri) {
            $oduncler[] = Odunc::create($veri);
        }

        return $oduncler;
    }

    /**
     * Gecikmiş aktif ödünçlere ceza kayıtları ekle.
     * Ceza tutarı: gecikme_gunu × 5 TL.
     *
     * @param  array<int, Odunc>  $oduncler
     */
    private function cezalariOlustur(array $oduncler): void
    {
        $bugun = Carbon::today();
        $gunlukCeza = 5;

        // Gecikmiş aktif ödünçler (beklenen_iade_tarihi bugünden önce)
        $gecikmisOduncler = collect($oduncler)->filter(function (Odunc $odunc) use ($bugun) {
            return $odunc->durum === 'aktif'
                && $odunc->iade_tarihi === null
                && Carbon::parse($odunc->beklenen_iade_tarihi)->lt($bugun);
        });

        // İlk 3 gecikmiş ödünç için ceza oluştur (ödendi/ödenmedi karışık)
        $odendiDurumlari = [true, false, false];

        foreach ($gecikmisOduncler->take(3)->values() as $index => $odunc) {
            $gecikmeGunu = Carbon::parse($odunc->beklenen_iade_tarihi)->diffInDays($bugun);

            Ceza::create([
                'odunc_id' => $odunc->id,
                'gecikme_gunu' => $gecikmeGunu,
                'ceza_tutari' => $gecikmeGunu * $gunlukCeza,
                'odendi_mi' => $odendiDurumlari[$index],
            ]);
        }
    }
}
