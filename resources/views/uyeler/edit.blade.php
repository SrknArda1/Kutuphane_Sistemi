@extends('layouts.app')

@section('title', 'Üye Düzenle — Kütüphane Sistemi')

@section('content')
    <h1>Üye Düzenle</h1>

    <form action="{{ route('uyeler.update', $uye) }}" method="POST" class="form">
        @csrf
        @method('PUT')

        <div class="form-grup">
            <label for="ad">Ad <span class="zorunlu">*</span></label>
            <input type="text" id="ad" name="ad" value="{{ old('ad', $uye->ad) }}" required>
            @error('ad')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="soyad">Soyad <span class="zorunlu">*</span></label>
            <input type="text" id="soyad" name="soyad" value="{{ old('soyad', $uye->soyad) }}" required>
            @error('soyad')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="email">E-posta <span class="zorunlu">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email', $uye->email) }}" required>
            @error('email')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="telefon">Telefon</label>
            <input type="text" id="telefon" name="telefon" value="{{ old('telefon', $uye->telefon) }}">
        </div>

        <div class="form-grup">
            <label for="kayit_tarihi">Kayıt Tarihi <span class="zorunlu">*</span></label>
            <input type="date" id="kayit_tarihi" name="kayit_tarihi" value="{{ old('kayit_tarihi', $uye->kayit_tarihi->format('Y-m-d')) }}" required>
            @error('kayit_tarihi')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-aksiyon">
            <button type="submit" class="btn btn-birincil">Güncelle</button>
            <a href="{{ route('uyeler.index') }}" class="btn">İptal</a>
        </div>
    </form>
@endsection
