@extends('layouts.app')

@section('title', 'Üyeler — Kütüphane Sistemi')

@section('content')
    <h1>Üyeler</h1>

    @if (session('basari'))
        <div class="mesaj mesaj-basari">{{ session('basari') }}</div>
    @endif

    @if (session('hata'))
        <div class="mesaj mesaj-hata">{{ session('hata') }}</div>
    @endif

    <p class="ust-arac">
        <a href="{{ route('uyeler.create') }}" class="btn btn-birincil">Yeni Üye Ekle</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>Ad Soyad</th>
                <th>E-posta</th>
                <th>Telefon</th>
                <th>Kayıt Tarihi</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($uyeler as $uye)
                <tr>
                    <td>{{ $uye->ad }} {{ $uye->soyad }}</td>
                    <td>{{ $uye->email }}</td>
                    <td>{{ $uye->telefon ?? '—' }}</td>
                    <td>{{ $uye->kayit_tarihi->format('d.m.Y') }}</td>
                    <td class="islem-hucre">
                        <a href="{{ route('uyeler.edit', $uye) }}" class="btn btn-kucuk">Düzenle</a>
                        <form action="{{ route('uyeler.destroy', $uye) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-kucuk btn-tehlike" onclick="return confirm('Bu üyeyi silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Üye yok</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
