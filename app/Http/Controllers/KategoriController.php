<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriController extends Controller
{
    /**
     * Tüm kategorileri listele.
     */
    public function index(): View
    {
        $kategoriler = Kategori::orderBy('ad')->get();

        return view('kategoriler.index', compact('kategoriler'));
    }

    /**
     * Yeni kategori ekleme formunu göster.
     */
    public function create(): View
    {
        return view('kategoriler.create');
    }

    /**
     * Yeni kategoriyi kaydet.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ad' => 'required',
        ]);

        Kategori::create($request->only(['ad', 'aciklama']));

        return redirect()->route('kategoriler.index')
            ->with('basari', 'Kategori eklendi.');
    }

    /**
     * Detay sayfası kullanılmıyor; listeye yönlendir.
     */
    public function show(Kategori $kategori): RedirectResponse
    {
        return redirect()->route('kategoriler.index');
    }

    /**
     * Kategori düzenleme formunu göster.
     */
    public function edit(Kategori $kategori): View
    {
        return view('kategoriler.edit', compact('kategori'));
    }

    /**
     * Kategoriyi güncelle.
     */
    public function update(Request $request, Kategori $kategori): RedirectResponse
    {
        $request->validate([
            'ad' => 'required',
        ]);

        $kategori->update($request->only(['ad', 'aciklama']));

        return redirect()->route('kategoriler.index')
            ->with('basari', 'Kategori güncellendi.');
    }

    /**
     * Kategoriyi sil.
     */
    public function destroy(Kategori $kategori): RedirectResponse
    {
        try {
            $kategori->delete();

            return redirect()->route('kategoriler.index')
                ->with('basari', 'Kategori silindi.');
        } catch (QueryException $e) {
            return redirect()->route('kategoriler.index')
                ->with('hata', 'Bu kategoriye bağlı kitaplar olduğu için silinemez.');
        }
    }
}
