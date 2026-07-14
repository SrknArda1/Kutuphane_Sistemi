@extends('layouts.app')

@section('title', 'Kategori Düzenle — Kütüphane Sistemi')

@section('content')
    <h1>Kategori Düzenle</h1>

    <form action="{{ route('kategoriler.update', $kategori) }}" method="POST" class="form">
        @csrf
        @method('PUT')

        <div class="form-grup">
            <label for="ad">Ad <span class="zorunlu">*</span></label>
            <input type="text" id="ad" name="ad" value="{{ old('ad', $kategori->ad) }}" required>
            @error('ad')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="aciklama">Açıklama</label>
            <textarea id="aciklama" name="aciklama" rows="4">{{ old('aciklama', $kategori->aciklama) }}</textarea>
        </div>

        <div class="form-aksiyon">
            <button type="submit" class="btn btn-birincil">Güncelle</button>
            <a href="{{ route('kategoriler.index') }}" class="btn">İptal</a>
        </div>
    </form>
@endsection
