<?php

namespace App\Http\Controllers;

use App\Models\Uye;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UyeController extends Controller
{
    /**
     * Tüm üyeleri listele.
     */
    public function index(): View
    {
        $uyeler = Uye::orderBy('ad')->get();

        return view('uyeler.index', compact('uyeler'));
    }

    /**
     * Yeni üye ekleme formunu göster.
     */
    public function create(): View
    {
        return view('uyeler.create');
    }

    /**
     * Yeni üyeyi kaydet.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ad' => 'required',
            'soyad' => 'required',
            'email' => 'required|email',
            'kayit_tarihi' => 'required|date',
        ]);

        Uye::create($request->only(['ad', 'soyad', 'email', 'telefon', 'kayit_tarihi']));

        return redirect()->route('uyeler.index')
            ->with('basari', 'Üye eklendi.');
    }

    /**
     * Detay sayfası kullanılmıyor; listeye yönlendir.
     */
    public function show(Uye $uye): RedirectResponse
    {
        return redirect()->route('uyeler.index');
    }

    /**
     * Üye düzenleme formunu göster.
     */
    public function edit(Uye $uye): View
    {
        return view('uyeler.edit', compact('uye'));
    }

    /**
     * Üyeyi güncelle.
     */
    public function update(Request $request, Uye $uye): RedirectResponse
    {
        $request->validate([
            'ad' => 'required',
            'soyad' => 'required',
            'email' => 'required|email',
            'kayit_tarihi' => 'required|date',
        ]);

        $uye->update($request->only(['ad', 'soyad', 'email', 'telefon', 'kayit_tarihi']));

        return redirect()->route('uyeler.index')
            ->with('basari', 'Üye güncellendi.');
    }

    /**
     * Üyeyi sil.
     */
    public function destroy(Uye $uye): RedirectResponse
    {
        try {
            $uye->delete();

            return redirect()->route('uyeler.index')
                ->with('basari', 'Üye silindi.');
        } catch (QueryException $e) {
            return redirect()->route('uyeler.index')
                ->with('hata', 'Bu üyenin ödünç kayıtları olduğu için silinemez.');
        }
    }
}
