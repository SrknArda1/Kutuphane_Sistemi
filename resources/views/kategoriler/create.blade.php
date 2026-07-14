@extends('layouts.app')

@section('title', 'Yeni Kategori — Kütüphane Sistemi')

@section('content')
    <h1>Yeni Kategori Ekle</h1>

    <form action="{{ route('kategoriler.store') }}" method="POST" class="form">
        @csrf

        <div class="form-grup">
            <label for="ad">Ad <span class="zorunlu">*</span></label>
            <input type="text" id="ad" name="ad" value="{{ old('ad') }}" required>
            @error('ad')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="aciklama">Açıklama</label>
            <textarea id="aciklama" name="aciklama" rows="4">{{ old('aciklama') }}</textarea>
        </div>

        <div class="form-aksiyon">
            <button type="submit" class="btn btn-birincil">Kaydet</button>
            <a href="{{ route('kategoriler.index') }}" class="btn">İptal</a>
        </div>
    </form>
@endsection
