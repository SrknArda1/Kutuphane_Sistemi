<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kategoriler tablosunu oluştur.
     */
    public function up(): void
    {
        Schema::create('kategoriler', function (Blueprint $table) {
            $table->id();
            $table->string('ad');
            $table->text('aciklama')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Kategoriler tablosunu kaldır.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoriler');
    }
};
