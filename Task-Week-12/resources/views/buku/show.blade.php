@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="content-wrapper">
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-dark">
                    <i class="fas fa-book-open text-info me-2"></i>Detail Buku
                </h1>
                <div>
                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0 text-dark fw-semibold">
                        <i class="fas fa-info-circle me-2"></i>Informasi Lengkap Buku
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom kiri -->
                        <div class="col-md-12 mb-4">
                            <div class="p-4 bg-light rounded-3">
                                <h3 class="text-primary mb-2 fw-bold">{{ $buku->judul }}</h3>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-user me-2"></i>oleh <strong>{{ $buku->penulis }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 h-100">
                                <label class="form-label fw-semibold text-muted small">ID BUKU</label>
                                <div class="fw-bold text-primary fs-5">#{{ $buku->id }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 h-100">
                                <label class="form-label fw-semibold text-muted small">TAHUN TERBIT</label>
                                <div class="fw-bold text-dark fs-5">{{ $buku->tahun_terbit }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 h-100">
                                <label class="form-label fw-semibold text-muted small">PENERBIT</label>
                                <div class="fw-bold text-dark">{{ $buku->penerbit }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 h-100">
                                <label class="form-label fw-semibold text-muted small">KATEGORI</label>
                                <div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fs-6">
                                        {{ $buku->kategori }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($buku->deskripsi) && $buku->deskripsi)
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="border rounded p-3">
                                <label class="form-label fw-semibold text-muted small">DESKRIPSI</label>
                                <div class="text-dark lh-base">{{ $buku->deskripsi }}</div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 h-100">
                                <label class="form-label fw-semibold text-muted small">DIBUAT PADA</label>
                                <div class="text-dark">
                                    <i class="fas fa-calendar me-2"></i>{{ $buku->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 h-100">
                                <label class="form-label fw-semibold text-muted small">TERAKHIR DIUPDATE</label>
                                <div class="text-dark">
                                    <i class="fas fa-edit me-2"></i>{{ $buku->updated_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>Edit Buku
                            </a>
                            <form action="{{ route('buku.destroy', $buku->id) }}" 
                                  method="POST" 
                                  style="display: inline;"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-1"></i>Hapus Buku
                                </button>
                            </form>
                        </div>
                        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-1"></i>Lihat Semua Buku
                        </a>
                    </div>
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
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .border {
        border-color: #e9ecef !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
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
