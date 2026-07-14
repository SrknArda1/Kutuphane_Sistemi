@extends('layouts.app')

@section('title', 'Raporlar — Kütüphane Sistemi')

@section('content')
    <h1>Raporlar</h1>

    {{-- Rapor 1: Üye-kitap ödünç listesi --}}
    <section>
        <h2>Üye-Kitap Ödünç Listesi</h2>

        <table>
            <thead>
                <tr>
                    <th>Üye Adı</th>
                    <th>Kitap</th>
                    <th>Ödünç Tarihi</th>
                    <th>Beklenen İade</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($oduncListesi as $odunc)
                    <tr>
                        <td>{{ $odunc->uye->ad }} {{ $odunc->uye->soyad }}</td>
                        <td>{{ $odunc->kitap->baslik }}</td>
                        <td>{{ $odunc->odunc_tarihi->format('d.m.Y') }}</td>
                        <td>{{ $odunc->beklenen_iade_tarihi->format('d.m.Y') }}</td>
                        <td>
                            @if ($odunc->durum === 'aktif')
                                <span class="durum-aktif">Aktif</span>
                            @else
                                <span class="durum-iade">İade Edildi</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Kayıt bulunamadı</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    {{-- Rapor 2: Kategoriye göre kitap sayısı --}}
    <section>
        <h2>Kategoriye Göre Kitap Sayısı</h2>

        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Kitap Sayısı</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoriIstatistik as $kategori)
                    <tr>
                        <td>{{ $kategori->ad }}</td>
                        <td>{{ $kategori->kitaplar_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Kayıt bulunamadı</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    {{-- Rapor 3: En az 3 kitap ödünç almış üyeler --}}
    <section>
        <h2>En Az 3 Kitap Ödünç Almış Üyeler</h2>

        <table>
            <thead>
                <tr>
                    <th>Ad Soyad</th>
                    <th>Ödünç Sayısı</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($aktifUyeler as $uye)
                    <tr>
                        <td>{{ $uye->ad }} {{ $uye->soyad }}</td>
                        <td>{{ $uye->oduncler_count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Kayıt bulunamadı</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
