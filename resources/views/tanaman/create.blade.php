@extends('layouts.app') 
@section('title', 'Tambah Data Tanaman') 
@section('content') 
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Tambah Tanaman</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tanaman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nama_tanaman" class="form-label fw-bold">Nama Tanaman <span class="text-danger">*</span></label>
                        <input type="text" 
                            name="nama_tanaman" 
                            id="nama_tanaman" 
                            class="form-control @error('nama_tanaman') is-invalid @enderror" 
                            value="{{ old('nama_tanaman') }}"
                            required autofocus>
                        @error('nama_tanaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 border p-3 rounded">
                        <label for="nama_ilmiah" class="form-label fw-bold">Nama Ilmiah</label>
                        <input type="text" name="nama_ilmiah" id="nama_ilmiah" class="form-control @error('nama_ilmiah') is-invalid @enderror" value="{{ old('nama_ilmiah') }}" placeholder="Contoh: Zingiber officinale">
                        @error('nama_ilmiah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 border p-3 rounded">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Daun" {{ old('kategori') == 'Daun' ? 'selected' : '' }}>Daun</option>
                            <option value="Rimpang" {{ old('kategori') == 'Rimpang' ? 'selected' : '' }}>Rimpang</option>
                            <option value="Batang" {{ old('kategori') == 'Batang' ? 'selected' : '' }}>Batang</option>
                            <option value="Bunga" {{ old('kategori') == 'Bunga' ? 'selected' : '' }}>Bunga</option>
                            <option value="Akar" {{ old('kategori') == 'Akar' ? 'selected' : '' }}>Akar</option>
                            <option value="Buah" {{ old('kategori') == 'Buah' ? 'selected' : '' }}>Buah</option>
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi Singkat</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 border p-3 rounded">
                        <label for="khasiat" class="form-label fw-bold">Manfaat / Khasiat</label>
                        <textarea name="khasiat" id="khasiat" class="form-control @error('khasiat') is-invalid @enderror" rows="3" placeholder="Pisahkan dengan koma atau baris baru">{{ old('khasiat') }}</textarea>
                        @error('khasiat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 border p-3 rounded">
                        <label for="olahan" class="form-label fw-bold">Cara Pengolahan</label>
                        <textarea name="olahan" id="olahan" class="form-control @error('olahan') is-invalid @enderror" rows="3">{{ old('olahan') }}</textarea>
                        @error('olahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 border p-3 rounded">
                        <label for="efek_samping" class="form-label fw-bold">Efek Samping</label>
                        <textarea name="efek_samping" id="efek_samping" class="form-control @error('efek_samping') is-invalid @enderror" rows="2">{{ old('efek_samping') }}</textarea>
                        @error('efek_samping') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 border p-3 rounded">
                        <label for="sumber" class="form-label fw-bold">Sumber / Kutipan (Opsional)</label>
                        <input type="text" name="sumber" id="sumber" class="form-control @error('sumber') is-invalid @enderror" value="{{ old('sumber') }}" placeholder="Contoh: Jurnal Kesehatan 2023">
                        @error('sumber') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-bold">Upload Gambar</label>
                        <input type="file" 
                            name="gambar" 
                            id="gambar" 
                            accept="image/*"
                            class="form-control @error('gambar') is-invalid @enderror">
                        <div class="form-text">Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal ukuran 2MB.</div>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tanaman.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@endsection
