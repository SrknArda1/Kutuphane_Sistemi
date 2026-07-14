<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kitap;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KitapController extends Controller
{
    /**
     * Tüm kitapları kategorileriyle listele.
     */
    public function index(): View
    {
        $kitaplar = Kitap::with('kategori')->orderBy('baslik')->get();

        return view('kitaplar.index', compact('kitaplar'));
    }

    /**
     * Yeni kitap ekleme formunu göster.
     */
    public function create(): View
    {
        $kategoriler = Kategori::orderBy('ad')->get();

        return view('kitaplar.create', compact('kategoriler'));
    }

    /**
     * Yeni kitabı kaydet.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoriler,id',
            'baslik' => 'required',
            'yazar' => 'required',
            'yayin_yili' => 'required|integer',
            'stok_adedi' => 'required|integer',
        ]);

        Kitap::create($request->only([
            'kategori_id',
            'baslik',
            'yazar',
            'isbn',
            'yayin_yili',
            'stok_adedi',
        ]));

        return redirect()->route('kitaplar.index')
            ->with('basari', 'Kitap eklendi.');
    }

    /**
     * Detay sayfası kullanılmıyor; listeye yönlendir.
     */
    public function show(Kitap $kitap): RedirectResponse
    {
        return redirect()->route('kitaplar.index');
    }

    /**
     * Kitap düzenleme formunu göster.
     */
    public function edit(Kitap $kitap): View
    {
        $kategoriler = Kategori::orderBy('ad')->get();

        return view('kitaplar.edit', compact('kitap', 'kategoriler'));
    }

    /**
     * Kitabı güncelle.
     */
    public function update(Request $request, Kitap $kitap): RedirectResponse
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoriler,id',
            'baslik' => 'required',
            'yazar' => 'required',
            'yayin_yili' => 'required|integer',
            'stok_adedi' => 'required|integer',
        ]);

        $kitap->update($request->only([
            'kategori_id',
            'baslik',
            'yazar',
            'isbn',
            'yayin_yili',
            'stok_adedi',
        ]));

        return redirect()->route('kitaplar.index')
            ->with('basari', 'Kitap güncellendi.');
    }

    /**
     * Kitabı sil.
     */
    public function destroy(Kitap $kitap): RedirectResponse
    {
        try {
            $kitap->delete();

            return redirect()->route('kitaplar.index')
                ->with('basari', 'Kitap silindi.');
        } catch (QueryException $e) {
            return redirect()->route('kitaplar.index')
                ->with('hata', 'Bu kitabın ödünç kayıtları olduğu için silinemez.');
        }
    }
}
