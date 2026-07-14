<?php

namespace App\Http\Controllers;

use App\Models\Kitap;
use App\Models\Odunc;
use App\Models\Uye;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OduncController extends Controller
{
    /**
     * Tüm ödünç kayıtlarını üye ve kitaplarıyla listele.
     */
    public function index(): View
    {
        $oduncler = Odunc::with(['uye', 'kitap'])
            ->orderBy('odunc_tarihi', 'desc')
            ->get();

        return view('oduncler.index', compact('oduncler'));
    }

    /**
     * Yeni ödünç ekleme formunu göster.
     */
    public function create(): View
    {
        $uyeler = Uye::orderBy('ad')->get();
        $kitaplar = Kitap::orderBy('baslik')->get();

        return view('oduncler.create', compact('uyeler', 'kitaplar'));
    }

    /**
     * Yeni ödünç kaydını kaydet.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'uye_id' => 'required|exists:uyeler,id',
            'kitap_id' => 'required|exists:kitaplar,id',
            'odunc_tarihi' => 'required|date',
            'beklenen_iade_tarihi' => 'required|date',
            'iade_tarihi' => 'nullable|date',
            'durum' => 'required|in:aktif,iade_edildi',
        ]);

        $veri = $request->only([
            'uye_id',
            'kitap_id',
            'odunc_tarihi',
            'beklenen_iade_tarihi',
            'iade_tarihi',
            'durum',
        ]);

        $veri['iade_tarihi'] = $request->filled('iade_tarihi') ? $request->iade_tarihi : null;

        Odunc::create($veri);

        return redirect()->route('oduncler.index')
            ->with('basari', 'Ödünç kaydı eklendi.');
    }

    /**
     * Detay sayfası kullanılmıyor; listeye yönlendir.
     */
    public function show(Odunc $odunc): RedirectResponse
    {
        return redirect()->route('oduncler.index');
    }

    /**
     * Ödünç düzenleme formunu göster.
     */
    public function edit(Odunc $odunc): View
    {
        $uyeler = Uye::orderBy('ad')->get();
        $kitaplar = Kitap::orderBy('baslik')->get();

        return view('oduncler.edit', compact('odunc', 'uyeler', 'kitaplar'));
    }

    /**
     * Ödünç kaydını güncelle.
     */
    public function update(Request $request, Odunc $odunc): RedirectResponse
    {
        $request->validate([
            'uye_id' => 'required|exists:uyeler,id',
            'kitap_id' => 'required|exists:kitaplar,id',
            'odunc_tarihi' => 'required|date',
            'beklenen_iade_tarihi' => 'required|date',
            'iade_tarihi' => 'nullable|date',
            'durum' => 'required|in:aktif,iade_edildi',
        ]);

        $veri = $request->only([
            'uye_id',
            'kitap_id',
            'odunc_tarihi',
            'beklenen_iade_tarihi',
            'iade_tarihi',
            'durum',
        ]);

        $veri['iade_tarihi'] = $request->filled('iade_tarihi') ? $request->iade_tarihi : null;

        $odunc->update($veri);

        return redirect()->route('oduncler.index')
            ->with('basari', 'Ödünç kaydı güncellendi.');
    }

    /**
     * Ödünç kaydını sil.
     */
    public function destroy(Odunc $odunc): RedirectResponse
    {
        try {
            $odunc->delete();

            return redirect()->route('oduncler.index')
                ->with('basari', 'Ödünç kaydı silindi.');
        } catch (QueryException $e) {
            return redirect()->route('oduncler.index')
                ->with('hata', 'Ödünç kaydı silinirken bir hata oluştu.');
        }
    }
}
