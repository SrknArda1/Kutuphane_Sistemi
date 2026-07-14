<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Uye extends Model
{
    /**
     * Modelin ilişkili olduğu tablo.
     *
     * @var string
     */
    protected $table = 'uyeler';

    /**
     * Toplu atanabilir öznitelikler.
     *
     * @var list<string>
     */
    protected $fillable = [
        'ad',
        'soyad',
        'email',
        'telefon',
        'kayit_tarihi',
    ];

    /**
     * Dönüştürülecek öznitelikleri döndür.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'kayit_tarihi' => 'date',
        ];
    }

    /**
     * Bu üyenin ödünç kayıtlarını döndür.
     */
    public function oduncler(): HasMany
    {
        return $this->hasMany(Odunc::class, 'uye_id');
    }
}
