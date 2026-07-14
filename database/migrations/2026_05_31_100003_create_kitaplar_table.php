<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kitaplar tablosunu oluştur.
     */
    public function up(): void
    {
        Schema::create('kitaplar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->constrained('kategoriler')
                ->onDelete('restrict');
            $table->string('baslik');
            $table->string('yazar');
            $table->string('isbn')->nullable();
            // YEAR tipi 1901-2155 ile sınırlı olduğu için tüm yılları destekleyen integer kullanılır
            $table->integer('yayin_yili');
            $table->integer('stok_adedi')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Kitaplar tablosunu kaldır.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitaplar');
    }
};
