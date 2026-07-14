@extends('layouts.app')

@section('title', 'Ödünçler — Kütüphane Sistemi')

@section('content')
    <h1>Ödünçler</h1>

    @if (session('basari'))
        <div class="mesaj mesaj-basari">{{ session('basari') }}</div>
    @endif

    @if (session('hata'))
        <div class="mesaj mesaj-hata">{{ session('hata') }}</div>
    @endif

    <p class="ust-arac">
        <a href="{{ route('oduncler.create') }}" class="btn btn-birincil">Yeni Ödünç Ekle</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>Üye</th>
                <th>Kitap</th>
                <th>Ödünç Tarihi</th>
                <th>Beklenen İade</th>
                <th>İade Tarihi</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($oduncler as $odunc)
                <tr>
                    <td>{{ $odunc->uye->ad }} {{ $odunc->uye->soyad }}</td>
                    <td>{{ $odunc->kitap->baslik }}</td>
                    <td>{{ $odunc->odunc_tarihi->format('d.m.Y') }}</td>
                    <td>{{ $odunc->beklenen_iade_tarihi->format('d.m.Y') }}</td>
                    <td>{{ $odunc->iade_tarihi ? $odunc->iade_tarihi->format('d.m.Y') : '—' }}</td>
                    <td>
                        @if ($odunc->durum === 'aktif')
                            <span class="durum-aktif">Aktif</span>
                        @else
                            <span class="durum-iade">İade Edildi</span>
                        @endif
                    </td>
                    <td class="islem-hucre">
                        <a href="{{ route('oduncler.edit', $odunc) }}" class="btn btn-kucuk">Düzenle</a>
                        <form action="{{ route('oduncler.destroy', $odunc) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-kucuk btn-tehlike" onclick="return confirm('Bu ödünç kaydını silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Ödünç kaydı yok</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
