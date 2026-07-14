<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Odunc;
use App\Models\Uye;

class RaporController extends Controller
{
    /**
     * Tüm raporları hazırlayıp tek sayfada göster.
     */
    public function index()
    {
        // Rapor 1: Üye-kitap ödünç listesi
        $oduncListesi = Odunc::with(['uye', 'kitap'])
            ->orderBy('odunc_tarihi', 'desc')
            ->get();

        // Rapor 2: Kategoriye göre kitap sayısı
        $kategoriIstatistik = Kategori::withCount('kitaplar')
            ->orderBy('kitaplar_count', 'desc')
            ->get();

        // Rapor 3: En az 3 kitap ödünç almış üyeler
        $aktifUyeler = Uye::withCount('oduncler')
            ->having('oduncler_count', '>=', 3)
            ->orderBy('oduncler_count', 'desc')
            ->get();

        return view('raporlar.index', compact(
            'oduncListesi',
            'kategoriIstatistik',
            'aktifUyeler'
        ));
    }
}
