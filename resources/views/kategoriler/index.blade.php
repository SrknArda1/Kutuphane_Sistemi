@extends('layouts.app')

@section('title', 'Kategoriler — Kütüphane Sistemi')

@section('content')
    <h1>Kategoriler</h1>

    @if (session('basari'))
        <div class="mesaj mesaj-basari">{{ session('basari') }}</div>
    @endif

    @if (session('hata'))
        <div class="mesaj mesaj-hata">{{ session('hata') }}</div>
    @endif

    <p class="ust-arac">
        <a href="{{ route('kategoriler.create') }}" class="btn btn-birincil">Yeni Kategori Ekle</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>Ad</th>
                <th>Açıklama</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoriler as $kategori)
                <tr>
                    <td>{{ $kategori->ad }}</td>
                    <td>{{ $kategori->aciklama ?? '—' }}</td>
                    <td class="islem-hucre">
                        <a href="{{ route('kategoriler.edit', $kategori) }}" class="btn btn-kucuk">Düzenle</a>
                        <form action="{{ route('kategoriler.destroy', $kategori) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-kucuk btn-tehlike" onclick="return confirm('Bu kategoriyi silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Kategori yok</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
