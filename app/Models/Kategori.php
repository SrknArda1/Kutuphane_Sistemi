<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    /**
     * Modelin ilişkili olduğu tablo.
     *
     * @var string
     */
    protected $table = 'kategoriler';

    /**
     * Toplu atanabilir öznitelikler.
     *
     * @var list<string>
     */
    protected $fillable = [
        'ad',
        'aciklama',
    ];

    /**
     * Bu kategoriye ait kitapları döndür.
     */
    public function kitaplar(): HasMany
    {
        return $this->hasMany(Kitap::class, 'kategori_id');
    }
}
