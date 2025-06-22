@extends('layouts.app')

@section('title', 'Manajemen Data Buku')

@section('content')
<div class="content-wrapper">
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-dark">
                    <i class="fas fa-book text-primary me-2"></i>Manajemen Data Buku
                </h1>
                <div class="d-flex gap-2">
                    @if($sortBy && $sortDirection && ($sortBy != 'id' || $sortDirection != 'asc'))
                        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-undo me-1"></i>Reset Urutan
                        </a>
                    @endif
                    <a href="{{ route('buku.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Tambah Buku
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-dark fw-semibold">
                            Daftar Buku
                        </h5>
                        <div class="d-flex align-items-center gap-3">
                            @if($sortBy && $sortDirection)
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="fas fa-sort me-1"></i>
                                    Diurutkan berdasarkan 
                                    <strong class="text-primary mx-1">
                                        {{ ucfirst(str_replace('_', ' ', $sortBy)) }}
                                    </strong>
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} text-primary ms-1"></i>
                                    <span class="text-muted ms-1">({{ $sortDirection == 'asc' ? 'A-Z' : 'Z-A' }})</span>
                                </div>
                            @endif
                            <span class="badge bg-light text-muted">{{ $bukus->count() }} Buku</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>                                    <th class="text-center py-3 fw-semibold text-muted border-0 {{ $sortBy == 'id' ? 'sorting-active' : '' }}" style="width: 70px;">
                                        <a href="{{ route('buku.index', ['sort' => 'id', 'direction' => ($sortBy == 'id' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-muted d-flex align-items-center justify-content-center"
                                           title="Klik untuk mengurutkan berdasarkan ID">
                                            ID
                                            @if($sortBy == 'id')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="py-3 fw-semibold text-muted border-0 {{ $sortBy == 'judul' ? 'sorting-active' : '' }}">
                                        <a href="{{ route('buku.index', ['sort' => 'judul', 'direction' => ($sortBy == 'judul' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-muted d-flex align-items-center"
                                           title="Klik untuk mengurutkan berdasarkan Judul">
                                            Judul Buku
                                            @if($sortBy == 'judul')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="py-3 fw-semibold text-muted border-0 {{ $sortBy == 'penulis' ? 'sorting-active' : '' }}">
                                        <a href="{{ route('buku.index', ['sort' => 'penulis', 'direction' => ($sortBy == 'penulis' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-muted d-flex align-items-center"
                                           title="Klik untuk mengurutkan berdasarkan Penulis">
                                            Penulis
                                            @if($sortBy == 'penulis')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-center py-3 fw-semibold text-muted border-0 {{ $sortBy == 'tahun_terbit' ? 'sorting-active' : '' }}" style="width: 100px;">
                                        <a href="{{ route('buku.index', ['sort' => 'tahun_terbit', 'direction' => ($sortBy == 'tahun_terbit' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-muted d-flex align-items-center justify-content-center"
                                           title="Klik untuk mengurutkan berdasarkan Tahun Terbit">
                                            Tahun Terbit
                                            @if($sortBy == 'tahun_terbit')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="py-3 fw-semibold text-muted border-0 {{ $sortBy == 'penerbit' ? 'sorting-active' : '' }}">
                                        <a href="{{ route('buku.index', ['sort' => 'penerbit', 'direction' => ($sortBy == 'penerbit' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-muted d-flex align-items-center"
                                           title="Klik untuk mengurutkan berdasarkan Penerbit">
                                            Penerbit
                                            @if($sortBy == 'penerbit')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-center py-3 fw-semibold text-muted border-0 {{ $sortBy == 'kategori' ? 'sorting-active' : '' }}" style="width: 120px;">
                                        <a href="{{ route('buku.index', ['sort' => 'kategori', 'direction' => ($sortBy == 'kategori' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                                           class="text-decoration-none text-muted d-flex align-items-center justify-content-center"
                                           title="Klik untuk mengurutkan berdasarkan Kategori">
                                            Kategori
                                            @if($sortBy == 'kategori')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-center py-3 fw-semibold text-muted border-0" style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bukus as $buku)
                                <tr class="border-bottom">
                                    <td class="text-center py-3">
                                        <span class="fw-bold text-primary">{{ $buku->id }}</span>
                                    </td>
                                    <td class="py-3">
                                        <div class="fw-semibold text-dark">{{ $buku->judul }}</div>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-muted">{{ $buku->penulis }}</span>
                                    </td>
                                    <td class="text-center py-3">
                                        <span class="text-muted">{{ $buku->tahun_terbit }}</span>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-muted">{{ $buku->penerbit }}</span>
                                    </td>
                                    <td class="text-center py-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                            {{ $buku->kategori }}
                                        </span>
                                    </td>
                                    <td class="text-center py-3">
                                        <div class="d-flex justify-content-center action-buttons" role="group">
                                            <a href="{{ route('buku.show', $buku->id) }}" 
                                               class="btn btn-outline-info btn-sm btn-action" 
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('buku.edit', $buku->id) }}" 
                                               class="btn btn-outline-warning btn-sm btn-action"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('buku.destroy', $buku->id) }}" 
                                                  method="POST" 
                                                  style="display: inline;"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger btn-sm btn-action"
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="fas fa-book fa-3x text-muted mb-3" style="opacity: 0.5;"></i>
                                            <h5 class="text-muted mb-2">Belum ada data buku</h5>
                                            <p class="text-muted mb-3">Mulai dengan menambahkan buku pertama Anda</p>
                                            <a href="{{ route('buku.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-1"></i>Tambah Buku Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                    <small class="text-muted">&copy; {{ date('Y') }} - Pemrograman Web UISI</small>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .card {
        border-radius: 8px;
    }
    
    /* Button styling untuk konsistensi ukuran dan spacing */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 35px;
        height: 30px;
        padding: 0;
        border-radius: 4px;
        transition: all 0.2s ease;
    }
    
    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .btn-action i {
        font-size: 12px;
    }
    
    /* Gap spacing untuk button group */
    .action-buttons {
        gap: 6px;
    }
      /* Footer styling */
    .footer-sticky {
        flex-shrink: 0;
        position: relative;
        bottom: 0;
        width: 100%;
    }
      /* Sortable header styling */
    th a {
        transition: all 0.2s ease;
    }
    
    th a:hover {
        color: #0d6efd !important;
        transform: translateY(-1px);
    }
    
    th a:hover i {
        opacity: 1 !important;
    }
    
    .fas.fa-sort-up,
    .fas.fa-sort-down {
        color: #0d6efd;
    }
    
    /* Active sorting column */
    .sorting-active {
        background-color: #f8f9fa !important;
        border-left: 3px solid #0d6efd;
    }
    
    .sorting-active a {
        color: #0d6efd !important;
        font-weight: 600;
    }
</style>
@endsection
