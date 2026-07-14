<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Üyeler tablosunu oluştur.
     */
    public function up(): void
    {
        Schema::create('uyeler', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->string('soyad');
            $table->string('email')->unique();
            $table->string('telefon')->nullable();
            $table->date('kayit_tarihi');
            $table->timestamps();
        });
    }

    /**
     * Üyeler tablosunu kaldır.
     */
    public function down(): void
    {
        Schema::dropIfExists('uyeler');
    }
};
