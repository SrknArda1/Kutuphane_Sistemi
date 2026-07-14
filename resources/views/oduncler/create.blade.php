@extends('layouts.app')

@section('title', 'Yeni Ödünç — Kütüphane Sistemi')

@section('content')
    <h1>Yeni Ödünç Ekle</h1>

    <form action="{{ route('oduncler.store') }}" method="POST" class="form">
        @csrf

        <div class="form-grup">
            <label for="uye_id">Üye <span class="zorunlu">*</span></label>
            <select id="uye_id" name="uye_id" required>
                <option value="">— Üye seçin —</option>
                @foreach ($uyeler as $uye)
                    <option value="{{ $uye->id }}" @selected(old('uye_id') == $uye->id)>
                        {{ $uye->ad }} {{ $uye->soyad }}
                    </option>
                @endforeach
            </select>
            @error('uye_id')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="kitap_id">Kitap <span class="zorunlu">*</span></label>
            <select id="kitap_id" name="kitap_id" required>
                <option value="">— Kitap seçin —</option>
                @foreach ($kitaplar as $kitap)
                    <option value="{{ $kitap->id }}" @selected(old('kitap_id') == $kitap->id)>
                        {{ $kitap->baslik }}
                    </option>
                @endforeach
            </select>
            @error('kitap_id')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="odunc_tarihi">Ödünç Tarihi <span class="zorunlu">*</span></label>
            <input type="date" id="odunc_tarihi" name="odunc_tarihi" value="{{ old('odunc_tarihi') }}" required>
            @error('odunc_tarihi')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="beklenen_iade_tarihi">Beklenen İade Tarihi <span class="zorunlu">*</span></label>
            <input type="date" id="beklenen_iade_tarihi" name="beklenen_iade_tarihi" value="{{ old('beklenen_iade_tarihi') }}" required>
            @error('beklenen_iade_tarihi')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="iade_tarihi">İade Tarihi</label>
            <input type="date" id="iade_tarihi" name="iade_tarihi" value="{{ old('iade_tarihi') }}">
            @error('iade_tarihi')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-grup">
            <label for="durum">Durum <span class="zorunlu">*</span></label>
            <select id="durum" name="durum" required>
                <option value="aktif" @selected(old('durum', 'aktif') === 'aktif')>Aktif</option>
                <option value="iade_edildi" @selected(old('durum') === 'iade_edildi')>İade Edildi</option>
            </select>
            @error('durum')
                <span class="form-hata">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-aksiyon">
            <button type="submit" class="btn btn-birincil">Kaydet</button>
            <a href="{{ route('oduncler.index') }}" class="btn">İptal</a>
        </div>
    </form>
@endsection
