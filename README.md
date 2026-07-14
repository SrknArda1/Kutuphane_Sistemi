# Kütüphane ve Ödünç Takip Sistemi

Bir kütüphanenin kitap, üye, kategori ve ödünç alma işlemlerini yöneten web tabanlı sistem. Laravel 12 ve MySQL ile geliştirildi.

Proje, ilişkisel veritabanı tasarımı üzerine kuruludur: şema 3. Normal Form (3NF) kurallarına uygun olarak tasarlandı, tablolar arası bağlar birincil/yabancı anahtarlarla kuruldu ve raporlama katmanı JOIN tabanlı SQL sorgularıyla çalışıyor.

---

## Ne Yapıyor?

- **Kategori, üye, kitap ve ödünç kayıtları** için tam CRUD (ekleme, listeleme, güncelleme, silme)
- **Gecikme cezası takibi** — beklenen iade tarihi geçen ödünçler için ceza kaydı
- **JOIN tabanlı raporlama paneli** — üç ayrı istatistik raporu
- **Veri bütünlüğü koruması** — bağlı kaydı olan bir kategori/üye/kitap silinemez, kullanıcıya açıklayıcı hata gösterilir

---

## Teknoloji

| Katman | Teknoloji |
|---|---|
| Backend | PHP 8 / Laravel 12 |
| Veritabanı | MySQL (InnoDB) |
| ORM | Eloquent |
| Arayüz | Blade template + CSS |
| Şema yönetimi | Laravel Migrations |

---

## Veritabanı Şeması

Beş tablo, dört ilişki:

```
kategoriler ──1:N──> kitaplar ──1:N──> oduncler <──1:N── uyeler
                                           │
                                          1:1
                                           ▼
                                        cezalar
```

| Tablo | Açıklama | Yabancı Anahtar |
|---|---|---|
| `kategoriler` | Kitap kategorileri | — |
| `uyeler` | Kütüphane üyeleri | — |
| `kitaplar` | Kitap kayıtları | `kategori_id` → kategoriler |
| `oduncler` | Ödünç alma işlemleri | `uye_id` → uyeler, `kitap_id` → kitaplar |
| `cezalar` | Gecikme cezaları | `odunc_id` → oduncler |

### Silme davranışı (ON DELETE) kararları

Yabancı anahtarların silme davranışı bilinçli olarak seçildi:

- **RESTRICT** (`kitaplar→kategoriler`, `oduncler→uyeler`, `oduncler→kitaplar`): Bağlı kaydı olan bir satır silinemez. Kitabı olan kategori, ödünç geçmişi olan üye kazara silinemez — geçmiş kayıtlar korunur.
- **CASCADE** (`cezalar→oduncler`): Ödünç kaydı silinirse cezası da silinir. Ceza, ödüncün sonucudur; tek başına anlamı yoktur.

### Normalizasyon (3NF)

- **1NF** — tüm sütunlar atomik, tekrarlayan grup yok
- **2NF** — her tabloda tek sütunluk PK (`id`), kısmi bağımlılık yok
- **3NF** — geçişli bağımlılık yok: `kitaplar` kategori *adını* değil `kategori_id` referansını tutar; `oduncler` üye adını/kitap başlığını tekrarlamaz, FK ile gösterir

Detaylı tasarım gerekçeleri ve ER diyagramı için: **[Kutuphane_Sistemi_Rapor.pdf](Kutuphane_Sistemi_Rapor.pdf)**

---

## Raporlar

`/raporlar` sayfası üç JOIN tabanlı rapor sunar:

**1. Üye–Kitap Ödünç Listesi** (3 tablo JOIN)
```sql
SELECT u.ad, u.soyad, k.baslik, o.odunc_tarihi, o.durum
FROM oduncler o
JOIN uyeler u ON o.uye_id = u.id
JOIN kitaplar k ON o.kitap_id = k.id
ORDER BY o.odunc_tarihi DESC;
```

**2. Kategoriye Göre Kitap Sayısı** (GROUP BY + LEFT JOIN)
```sql
SELECT kat.ad, COUNT(kit.id) AS kitap_sayisi
FROM kategoriler kat
LEFT JOIN kitaplar kit ON kit.kategori_id = kat.id
GROUP BY kat.id, kat.ad
ORDER BY kitap_sayisi DESC;
```
`LEFT JOIN` kullanıldı — hiç kitabı olmayan kategori de "0" değeriyle listede görünür.

**3. En Az 3 Kitap Ödünç Almış Üyeler** (GROUP BY + HAVING)
```sql
SELECT u.ad, u.soyad, COUNT(o.id) AS odunc_sayisi
FROM uyeler u
JOIN oduncler o ON o.uye_id = u.id
GROUP BY u.id, u.ad, u.soyad
HAVING COUNT(o.id) >= 3;
```
Gruplama sonrası filtreleme gerektiği için `WHERE` değil `HAVING` kullanıldı — `COUNT` gibi grup fonksiyonları `WHERE` içinde çalışmaz.

Uygulamada bu sorgular Eloquent ORM ile (`with`, `withCount`, `having`) yazıldı; parametreli sorgu üreterek SQL injection'a karşı korumalıdır.

---

## Kurulum

```bash
# 1. Projeyi klonla
git clone https://github.com/SrknArda1/kutuphane-sistemi.git
cd kutuphane-sistemi

# 2. Bağımlılıkları kur
composer install

# 3. Ortam dosyasını hazırla
cp .env.example .env
php artisan key:generate
```

`.env` dosyasında veritabanı ayarlarını düzenle:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kutuphane_sistemi
DB_USERNAME=root
DB_PASSWORD=
```

MySQL'de boş bir veritabanı oluştur (`kutuphane_sistemi`), sonra:

```bash
# 4. Tabloları oluştur ve örnek veriyi yükle
php artisan migrate --seed

# 5. Sunucuyu başlat
php artisan serve
```

Tarayıcıda `http://localhost:8000` adresini aç.

Seeder 4 kategori, 5 üye, 10 kitap, 13 ödünç ve 3 ceza kaydı oluşturur — raporları hemen test edebilirsin.

---

## Sayfalar

| Rota | Açıklama |
|---|---|
| `/raporlar` | Üç JOIN raporu (ana sayfa) |
| `/kategoriler` | Kategori CRUD |
| `/uyeler` | Üye CRUD |
| `/kitaplar` | Kitap CRUD (kategori seçimi dropdown ile) |
| `/oduncler` | Ödünç CRUD (üye + kitap seçimi) |

---

## Geliştirici

**Serkan Arda Bölükbaş**
Kurumsal Bilişim Uzmanlığı — Yalova Üniversitesi, Çınarcık MYO
[GitHub](https://github.com/SrknArda1)