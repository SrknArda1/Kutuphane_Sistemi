<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KitapController;
use App\Http\Controllers\OduncController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\UyeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('raporlar.index'));

Route::get('/raporlar', [RaporController::class, 'index'])->name('raporlar.index');

Route::resource('kategoriler', KategoriController::class)->parameters([
    'kategoriler' => 'kategori',
]);

Route::resource('uyeler', UyeController::class)->parameters([
    'uyeler' => 'uye',
]);

Route::resource('kitaplar', KitapController::class)->parameters([
    'kitaplar' => 'kitap',
]);

Route::resource('oduncler', OduncController::class)->parameters([
    'oduncler' => 'odunc',
]);

