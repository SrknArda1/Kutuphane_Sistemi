@extends('layouts.app')

@section('title', 'Kitap Düzenle — Kütüphane Sistemi')

@section('content')
    <h1>Kitap Düzenle</h1>

    <form action="{{ route('kitaplar.update', $kitap) }}" method="POST" class="form">
        @csrf
        @method('PUT')

        <div class="form-grup">
            <label for="kategori_id">Kategori <span class="zorunlu">*</span></label>
            <select id="kategori_id" name="kategori_id" required>
                <option value="">— Kategori seçin —</option>
                @foreach ($kategoriler as $kategori)
                    <option value="{{ $kategori->id }}" @selected(old('kategori_id', $kitap->kategori_id) == $kategori->id)>
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
            <input type="text" id="baslik" name="baslik" value="{{ old('baslik', $kitap->baslik) }}" required>
            @error('baslik')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="yazar">Yazar <span class="zorunlu">*</span></label>
            <input type="text" id="yazar" name="yazar" value="{{ old('yazar', $kitap->yazar) }}" required>
            @error('yazar')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $kitap->isbn) }}">
        </div>

        <div class="form-grup">
            <label for="yayin_yili">Yayın Yılı <span class="zorunlu">*</span></label>
            <input type="number" id="yayin_yili" name="yayin_yili" value="{{ old('yayin_yili', $kitap->yayin_yili) }}" required>
            @error('yayin_yili')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="stok_adedi">Stok Adedi <span class="zorunlu">*</span></label>
            <input type="number" id="stok_adedi" name="stok_adedi" value="{{ old('stok_adedi', $kitap->stok_adedi) }}" min="0" required>
            @error('stok_adedi')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-aksiyon">
            <button type="submit" class="btn btn-birincil">Güncelle</button>
            <a href="{{ route('kitaplar.index') }}" class="btn">İptal</a>
        </div>
    </form>
@endsection
