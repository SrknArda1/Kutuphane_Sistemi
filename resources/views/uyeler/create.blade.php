@extends('layouts.app')

@section('title', 'Yeni Üye — Kütüphane Sistemi')

@section('content')
    <h1>Yeni Üye Ekle</h1>

    <form action="{{ route('uyeler.store') }}" method="POST" class="form">
        @csrf

        <div class="form-grup">
            <label for="ad">Ad <span class="zorunlu">*</span></label>
            <input type="text" id="ad" name="ad" value="{{ old('ad') }}" required>
            @error('ad')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="soyad">Soyad <span class="zorunlu">*</span></label>
            <input type="text" id="soyad" name="soyad" value="{{ old('soyad') }}" required>
            @error('soyad')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="email">E-posta <span class="zorunlu">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="telefon">Telefon</label>
            <input type="text" id="telefon" name="telefon" value="{{ old('telefon') }}">
        </div>

        <div class="form-grup">
            <label for="kayit_tarihi">Kayıt Tarihi <span class="zorunlu">*</span></label>
            <input type="date" id="kayit_tarihi" name="kayit_tarihi" value="{{ old('kayit_tarihi') }}" required>
            @error('kayit_tarihi')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-aksiyon">
            <button type="submit" class="btn btn-birincil">Kaydet</button>
            <a href="{{ route('uyeler.index') }}" class="btn">İptal</a>
        </div>
    </form>
@endsection
