<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kitap extends Model
{
    /**
     * Modelin ilişkili olduğu tablo.
     *
     * @var string
     */
    protected $table = 'kitaplar';

    /**
     * Toplu atanabilir öznitelikler.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kategori_id',
        'baslik',
        'yazar',
        'isbn',
        'yayin_yili',
        'stok_adedi',
    ];

    /**
     * Bu kitabın ait olduğu kategoriyi döndür.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Bu kitaba ait ödünç kayıtlarını döndür.
     */
    public function oduncler(): HasMany
    {
        return $this->hasMany(Odunc::class, 'kitap_id');
    }
}
