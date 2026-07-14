<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ceza extends Model
{
    /**
     * Modelin ilişkili olduğu tablo.
     *
     * @var string
     */
    protected $table = 'cezalar';

    /**
     * Toplu atanabilir öznitelikler.
     *
     * @var list<string>
     */
    protected $fillable = [
        'odunc_id',
        'gecikme_gunu',
        'ceza_tutari',
        'odendi_mi',
    ];

    /**
     * Dönüştürülecek öznitelikleri döndür.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'ceza_tutari' => 'decimal:2',
            'odendi_mi' => 'boolean',
        ];
    }

    /**
     * Bu cezanın ait olduğu ödünç kaydını döndür.
     */
    public function odunc(): BelongsTo
    {
        return $this->belongsTo(Odunc::class, 'odunc_id');
    }
}
