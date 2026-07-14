<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Odunc extends Model
{
    /**
     * Modelin ilişkili olduğu tablo.
     *
     * @var string
     */
    protected $table = 'oduncler';

    /**
     * Toplu atanabilir öznitelikler.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uye_id',
        'kitap_id',
        'odunc_tarihi',
        'beklenen_iade_tarihi',
        'iade_tarihi',
        'durum',
    ];

    /**
     * Dönüştürülecek öznitelikleri döndür.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'odunc_tarihi' => 'date',
            'beklenen_iade_tarihi' => 'date',
            'iade_tarihi' => 'date',
        ];
    }

    /**
     * Bu ödünç kaydının ait olduğu üyeyi döndür.
     */
    public function uye(): BelongsTo
    {
        return $this->belongsTo(Uye::class, 'uye_id');
    }

    /**
     * Bu ödünç kaydının ait olduğu kitabı döndür.
     */
    public function kitap(): BelongsTo
    {
        return $this->belongsTo(Kitap::class, 'kitap_id');
    }

    /**
     * Bu ödünç kaydına ait cezayı döndür.
     */
    public function ceza(): HasOne
    {
        return $this->hasOne(Ceza::class, 'odunc_id');
    }
}
