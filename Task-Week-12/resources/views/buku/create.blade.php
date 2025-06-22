@extends('layouts.app')

@section('title', 'Tambah Buku Baru')

@section('content')
<div class="content-wrapper">
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-dark">
                    <i class="fas fa-plus text-primary me-2"></i>Tambah Buku Baru
                </h1>
                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0 text-dark fw-semibold">
                        <i class="fas fa-book me-2"></i>Form Data Buku
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('buku.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="judul" class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('judul') is-invalid @enderror" 
                                       id="judul" 
                                       name="judul" 
                                       value="{{ old('judul') }}"
                                       placeholder="Masukkan judul buku">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="penulis" class="form-label fw-semibold">Penulis <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('penulis') is-invalid @enderror" 
                                       id="penulis" 
                                       name="penulis" 
                                       value="{{ old('penulis') }}"
                                       placeholder="Nama penulis">
                                @error('penulis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tahun_terbit" class="form-label fw-semibold">Tahun Terbit <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('tahun_terbit') is-invalid @enderror" 
                                       id="tahun_terbit" 
                                       name="tahun_terbit" 
                                       value="{{ old('tahun_terbit') }}"
                                       placeholder="2024"
                                       min="1900" 
                                       max="{{ date('Y') }}">
                                @error('tahun_terbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="penerbit" class="form-label fw-semibold">Penerbit <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('penerbit') is-invalid @enderror" 
                                       id="penerbit" 
                                       name="penerbit" 
                                       value="{{ old('penerbit') }}"
                                       placeholder="Nama penerbit">
                                @error('penerbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori') is-invalid @enderror" 
                                        id="kategori" 
                                        name="kategori">
                                    <option value="">Pilih kategori</option>
                                    <option value="Fiksi" {{ old('kategori') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                                    <option value="Non-Fiksi" {{ old('kategori') == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                                    <option value="Ilmiah" {{ old('kategori') == 'Ilmiah' ? 'selected' : '' }}>Ilmiah</option>
                                    <option value="Pendidikan" {{ old('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                    <option value="Teknologi" {{ old('kategori') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                                    <option value="Bisnis" {{ old('kategori') == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" 
                                          name="deskripsi" 
                                          rows="4"
                                          placeholder="Deskripsi singkat tentang buku (opsional)">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>    </div>
</div>
</div>

<footer class="footer-sticky mt-auto py-4 bg-light border-top">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="d-flex justify-content-center align-items-center">
                    <i class="fas fa-code text-primary me-2"></i>
                    <span class="text-muted">
                        Project CRUD ini dibuat menggunakan Laravel dengan refresh (Synchronous)
                    </span>
                </div>
                <div class="mt-2">
                    <small class="text-muted">&copy; {{ date('Y') }} - Aplikasi Manajemen Data Buku</small>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .card {
        border-radius: 8px;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    /* Footer styling */
    .footer-sticky {
        flex-shrink: 0;
        position: relative;
        bottom: 0;
        width: 100%;
    }
</style>
@endsection
