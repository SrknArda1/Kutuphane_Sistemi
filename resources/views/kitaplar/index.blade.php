@extends('layouts.app')

@section('title', 'Kitaplar — Kütüphane Sistemi')

@section('content')
    <h1>Kitaplar</h1>

    @if (session('basari'))
        <div class="mesaj mesaj-basari">{{ session('basari') }}</div>
    @endif

    @if (session('hata'))
        <div class="mesaj mesaj-hata">{{ session('hata') }}</div>
    @endif

    <p class="ust-arac">
        <a href="{{ route('kitaplar.create') }}" class="btn btn-birincil">Yeni Kitap Ekle</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>Başlık</th>
                <th>Yazar</th>
                <th>Kategori</th>
                <th>ISBN</th>
                <th>Yayın Yılı</th>
                <th>Stok</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kitaplar as $kitap)
                <tr>
                    <td>{{ $kitap->baslik }}</td>
                    <td>{{ $kitap->yazar }}</td>
                    <td>{{ $kitap->kategori->ad }}</td>
                    <td>{{ $kitap->isbn ?? '—' }}</td>
                    <td>{{ $kitap->yayin_yili }}</td>
                    <td>{{ $kitap->stok_adedi }}</td>
                    <td class="islem-hucre">
                        <a href="{{ route('kitaplar.edit', $kitap) }}" class="btn btn-kucuk">Düzenle</a>
                        <form action="{{ route('kitaplar.destroy', $kitap) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-kucuk btn-tehlike" onclick="return confirm('Bu kitabı silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Kitap yok</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
