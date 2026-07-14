<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ödünçler tablosunu oluştur.
     */
    public function up(): void
    {
        Schema::create('oduncler', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uye_id')
                ->constrained('uyeler')
                ->onDelete('restrict');
            $table->foreignId('kitap_id')
                ->constrained('kitaplar')
                ->onDelete('restrict');
            $table->date('odunc_tarihi');
            $table->date('beklenen_iade_tarihi');
            $table->date('iade_tarihi')->nullable();
            $table->enum('durum', ['aktif', 'iade_edildi'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Ödünçler tablosunu kaldır.
     */
    public function down(): void
    {
        Schema::dropIfExists('oduncler');
    }
};
