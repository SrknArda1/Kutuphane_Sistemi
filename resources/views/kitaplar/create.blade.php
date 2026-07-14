@extends('layouts.app')

@section('title', 'Yeni Kitap — Kütüphane Sistemi')

@section('content')
    <h1>Yeni Kitap Ekle</h1>

    <form action="{{ route('kitaplar.store') }}" method="POST" class="form">
        @csrf

        <div class="form-grup">
            <label for="kategori_id">Kategori <span class="zorunlu">*</span></label>
            <select id="kategori_id" name="kategori_id" required>
                <option value="">— Kategori seçin —</option>
                @foreach ($kategoriler as $kategori)
                    <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>
                        {{ $kategori->ad }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="baslik">Başlık <span class="zorunlu">*</span></label>
            <input type="text" id="baslik" name="baslik" value="{{ old('baslik') }}" required>
            @error('baslik')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="yazar">Yazar <span class="zorunlu">*</span></label>
            <input type="text" id="yazar" name="yazar" value="{{ old('yazar') }}" required>
            @error('yazar')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}">
        </div>

        <div class="form-grup">
            <label for="yayin_yili">Yayın Yılı <span class="zorunlu">*</span></label>
            <input type="number" id="yayin_yili" name="yayin_yili" value="{{ old('yayin_yili') }}" required>
            @error('yayin_yili')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="stok_adedi">Stok Adedi <span class="zorunlu">*</span></label>
            <input type="number" id="stok_adedi" name="stok_adedi" value="{{ old('stok_adedi', 1) }}" min="0" required>
            @error('stok_adedi')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-aksiyon">
            <button type="submit" class="btn btn-birincil">Kaydet</button>
            <a href="{{ route('kitaplar.index') }}" class="btn">İptal</a>
        </div>
    </form>
@endsection
