<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cezalar tablosunu oluştur.
     */
    public function up(): void
    {
        Schema::create('cezalar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('odunc_id')
                ->constrained('oduncler')
                ->onDelete('cascade');
            $table->integer('gecikme_gunu');
            $table->decimal('ceza_tutari', 8, 2);
            $table->boolean('odendi_mi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Cezalar tablosunu kaldır.
     */
    public function down(): void
    {
        Schema::dropIfExists('cezalar');
    }
};
