@extends('layouts.app')

@section('title', 'Manajemen Barang Bengkel')

@section('content')
<div class="content-wrapper">
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-dark">
                    <i class="fas fa-tools text-primary me-2"></i>Manajemen Barang Bengkel
                </h1>
                <div class="d-flex gap-2">                    <div id="reset-button-container">
                        @if($sortBy && $sortDirection && ($sortBy != 'id' || $sortDirection != 'asc'))
                            <a href="{{ route('bengkel.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i>Reset Urutan
                            </a>
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary" id="btn-tambah">
                        <i class="fas fa-plus me-1"></i>Tambah Barang
                    </button>
                </div>
            </div>

            <!-- Alert untuk notifikasi -->
            <div id="alert-container"></div>

            <div class="card shadow-sm border-0">                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-dark fw-semibold">
                            Daftar Barang Bengkel
                        </h5>
                        <div class="d-flex align-items-center gap-3">
                            <div id="sorting-info-container">
                                @if($sortBy && $sortDirection)
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="fas fa-sort me-1"></i>
                                        Diurutkan berdasarkan 
                                        <strong class="text-primary mx-1">
                                            {{ $sortBy == 'nama_barang' ? 'Nama Barang' : ($sortBy == 'harga' ? 'Harga' : ucfirst(str_replace('_', ' ', $sortBy))) }}
                                        </strong>
                                        <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} text-primary ms-1"></i>
                                        <span class="text-muted ms-1">({{ $sortDirection == 'asc' ? 'A-Z / 0-9' : 'Z-A / 9-0' }})</span>
                                    </div>
                                @endif
                            </div>
                            <span class="badge bg-light text-muted" id="total-items">0 Barang</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="table-bengkel">                            <thead class="table-light">
                                <tr>
                                    <th class="text-center py-3 fw-semibold text-muted border-0 {{ $sortBy == 'id' ? 'sorting-active' : '' }}" style="width: 70px;">
                                        <a href="javascript:void(0)" 
                                           class="text-decoration-none text-muted d-flex align-items-center justify-content-center sortable-header"
                                           data-sort="id"
                                           data-direction="{{ ($sortBy == 'id' && $sortDirection == 'asc') ? 'desc' : 'asc' }}"
                                           title="Klik untuk mengurutkan berdasarkan ID">
                                            ID
                                            @if($sortBy == 'id')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="py-3 fw-semibold text-muted border-0 {{ $sortBy == 'nama_barang' ? 'sorting-active' : '' }}">
                                        <a href="javascript:void(0)" 
                                           class="text-decoration-none text-muted d-flex align-items-center sortable-header"
                                           data-sort="nama_barang"
                                           data-direction="{{ ($sortBy == 'nama_barang' && $sortDirection == 'asc') ? 'desc' : 'asc' }}"
                                           title="Klik untuk mengurutkan berdasarkan Nama Barang">
                                            Nama Barang
                                            @if($sortBy == 'nama_barang')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="py-3 fw-semibold text-muted border-0 {{ $sortBy == 'merk' ? 'sorting-active' : '' }}">
                                        <a href="javascript:void(0)" 
                                           class="text-decoration-none text-muted d-flex align-items-center sortable-header"
                                           data-sort="merk"
                                           data-direction="{{ ($sortBy == 'merk' && $sortDirection == 'asc') ? 'desc' : 'asc' }}"
                                           title="Klik untuk mengurutkan berdasarkan Merk">
                                            Merk
                                            @if($sortBy == 'merk')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-center py-3 fw-semibold text-muted border-0 {{ $sortBy == 'stok' ? 'sorting-active' : '' }}" style="width: 100px;">
                                        <a href="javascript:void(0)" 
                                           class="text-decoration-none text-muted d-flex align-items-center justify-content-center sortable-header"
                                           data-sort="stok"
                                           data-direction="{{ ($sortBy == 'stok' && $sortDirection == 'asc') ? 'desc' : 'asc' }}"
                                           title="Klik untuk mengurutkan berdasarkan Stok">
                                            Stok
                                            @if($sortBy == 'stok')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-center py-3 fw-semibold text-muted border-0 {{ $sortBy == 'harga' ? 'sorting-active' : '' }}" style="width: 120px;">
                                        <a href="javascript:void(0)" 
                                           class="text-decoration-none text-muted d-flex align-items-center justify-content-center sortable-header"
                                           data-sort="harga"
                                           data-direction="{{ ($sortBy == 'harga' && $sortDirection == 'asc') ? 'desc' : 'asc' }}"
                                           title="Klik untuk mengurutkan berdasarkan Harga">
                                            Harga
                                            @if($sortBy == 'harga')
                                                <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }} ms-1"></i>
                                            @else
                                                <i class="fas fa-sort ms-1 opacity-50"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-center py-3 fw-semibold text-muted border-0" style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <!-- Data akan dimuat via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<footer class="footer-sticky mt-auto py-4 bg-light border-top">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="d-flex justify-content-center align-items-center">
                    <i class="fas fa-code text-primary me-2"></i>
                    <span class="text-muted">
                        Project CRUD ini dibuat menggunakan Laravel dengan AJAX (Asynchronous)
                    </span>
                </div>
                <div class="mt-2">
                    <small class="text-muted">&copy; {{ date('Y') }} - Pemrograman Web UISI</small>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modal untuk Tambah/Edit Barang -->
<div class="modal fade" id="modalBarang" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">
                    <i class="fas fa-tools me-2"></i>Tambah Barang
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formBarang">
                <div class="modal-body">
                    <input type="hidden" id="barang_id" name="barang_id">
                    <input type="hidden" id="method" name="_method" value="POST">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_barang" class="form-label fw-semibold">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            <div class="invalid-feedback" id="error-nama_barang"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="merk" class="form-label fw-semibold">Merk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="merk" name="merk" required>
                            <div class="invalid-feedback" id="error-merk"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="stok" class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="stok" name="stok" min="0" required>
                            <div class="invalid-feedback" id="error-stok"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="harga" name="harga" min="0" step="0.01" required>
                            </div>
                            <div class="invalid-feedback" id="error-harga"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                        <div class="invalid-feedback" id="error-deskripsi"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn-save">
                        <i class="fas fa-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk Detail Barang -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle me-2"></i>Detail Barang
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="p-4 bg-light rounded-3">
                            <h3 class="text-primary mb-2 fw-bold" id="detail-nama"></h3>
                            <p class="text-muted mb-0">
                                <i class="fas fa-tag me-2"></i>Merk: <strong id="detail-merk"></strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-semibold text-muted small">ID BARANG</label>
                            <div class="fw-bold text-primary fs-5" id="detail-id">#</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-semibold text-muted small">STOK</label>
                            <div class="fw-bold text-dark fs-5" id="detail-stok"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="border rounded p-3">
                            <label class="form-label fw-semibold text-muted small">HARGA</label>
                            <div class="fw-bold text-success fs-4" id="detail-harga"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="border rounded p-3">
                            <label class="form-label fw-semibold text-muted small">DESKRIPSI</label>
                            <div class="text-dark" id="detail-deskripsi"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-semibold text-muted small">TANGGAL DIBUAT</label>
                            <div class="text-muted" id="detail-created"></div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3 h-100">
                            <label class="form-label fw-semibold text-muted small">TERAKHIR DIUPDATE</label>
                            <div class="text-muted" id="detail-updated"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

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

    /* Loading state */
    .loading-row {
        animation: pulse 1.5s ease-in-out infinite;
    }

    @keyframes pulse {
        0% {
            opacity: 1;
        }
        50% {
            opacity: .5;
        }
        100% {
            opacity: 1;
        }
    }

    /* Empty state styling */
    .empty-state {
        padding: 3rem 1rem;
    }

    /* Modal improvements */
    .modal-lg {
        max-width: 800px;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Get current sorting parameters from URL
    const urlParams = new URLSearchParams(window.location.search);
    let currentSort = urlParams.get('sort') || 'id';
    let currentDirection = urlParams.get('direction') || 'asc';    // Load data ketika halaman dimuat
    loadData();

    // Initialize UI state based on URL parameters
    if (currentSort !== 'id' || currentDirection !== 'asc') {
        updateSortingUI(currentSort, currentDirection);
    }

    // Event handler untuk sorting
    $('.sortable-header').click(function(e) {
        e.preventDefault();
        const sortBy = $(this).data('sort');
        const direction = $(this).data('direction');
        
        // Update current sort parameters
        currentSort = sortBy;
        currentDirection = direction;
        
        // Update URL without page refresh
        const newUrl = new URL(window.location);
        newUrl.searchParams.set('sort', sortBy);
        newUrl.searchParams.set('direction', direction);
        window.history.pushState({}, '', newUrl);
        
        // Update page content
        updateSortingUI(sortBy, direction);
        loadData();
    });    // Function untuk update sorting UI
    function updateSortingUI(sortBy, direction) {
        // Reset all headers
        $('.sortable-header').each(function() {
            const $this = $(this);
            const currentSort = $this.data('sort');
            
            // Update direction for next click
            if (currentSort === sortBy) {
                $this.data('direction', direction === 'asc' ? 'desc' : 'asc');
                $this.parent().addClass('sorting-active');
                
                // Update icon
                $this.find('i').removeClass('fa-sort fa-sort-up fa-sort-down opacity-50');
                $this.find('i').addClass(direction === 'asc' ? 'fa-sort-up' : 'fa-sort-down');
            } else {
                $this.data('direction', 'asc');
                $this.parent().removeClass('sorting-active');
                
                // Reset icon
                $this.find('i').removeClass('fa-sort-up fa-sort-down').addClass('fa-sort opacity-50');
            }
        });

        // Update reset button
        updateResetButton(sortBy, direction);

        // Update sorting info in card header
        updateSortingInfo(sortBy, direction);
    }    // Function untuk update reset button
    function updateResetButton(sortBy, direction) {
        const $resetContainer = $('#reset-button-container');
        
        if (sortBy !== 'id' || direction !== 'asc') {
            if ($resetContainer.children().length === 0) {
                const resetButton = `
                    <a href="${window.location.pathname}" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i>Reset Urutan
                    </a>
                `;
                $resetContainer.html(resetButton);
            }
        } else {
            $resetContainer.empty();
        }
    }

    // Function untuk update sorting info
    function updateSortingInfo(sortBy, direction) {
        const $sortingContainer = $('#sorting-info-container');
        const sortLabel = getSortLabel(sortBy);
        const directionLabel = direction === 'asc' ? 'A-Z / 0-9' : 'Z-A / 9-0';
        
        const sortingInfo = `
            <div class="d-flex align-items-center text-muted small">
                <i class="fas fa-sort me-1"></i>
                Diurutkan berdasarkan 
                <strong class="text-primary mx-1">${sortLabel}</strong>
                <i class="fas fa-sort-${direction === 'asc' ? 'up' : 'down'} text-primary ms-1"></i>
                <span class="text-muted ms-1">(${directionLabel})</span>
            </div>
        `;
        
        $sortingContainer.html(sortingInfo);
    }

    // Function untuk get sort label
    function getSortLabel(sortBy) {
        const labels = {
            'id': 'ID',
            'nama_barang': 'Nama Barang',
            'merk': 'Merk',
            'stok': 'Stok',
            'harga': 'Harga'
        };
        return labels[sortBy] || sortBy;
    }

    // Event handler untuk tombol tambah
    $('#btn-tambah').click(function() {
        resetForm();
        $('#modalTitle').html('<i class="fas fa-tools me-2"></i>Tambah Barang');
        $('#method').val('POST');
        $('#modalBarang').modal('show');
    });

    // Event handler untuk submit form
    $('#formBarang').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const id = $('#barang_id').val();
        const method = $('#method').val();
        
        let url = '{{ route("bengkel.store") }}';
        
        if (method === 'PUT') {
            url = `/bengkel/${id}`;
            formData.append('_method', 'PUT');
        }

        // Reset validation errors
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        // Show loading state
        $('#btn-save').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...');

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#modalBarang').modal('hide');
                    showAlert(response.message, 'success');
                    loadData();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    
                    Object.keys(errors).forEach(function(key) {
                        $('#' + key).addClass('is-invalid');
                        $('#error-' + key).text(errors[key][0]);
                    });
                } else {
                    showAlert('Terjadi kesalahan!', 'danger');
                }
            },
            complete: function() {
                $('#btn-save').prop('disabled', false).html('<i class="fas fa-save me-1"></i>Simpan');
            }
        });
    });    // Function untuk load data
    function loadData() {
        // Show loading state
        showLoadingState();

        $.ajax({
            url: '{{ route("bengkel.get-data") }}',
            method: 'GET',
            data: {
                sort: currentSort,
                direction: currentDirection
            },
            success: function(data) {
                let tableBody = '';
                
                if (data.length === 0) {
                    tableBody = `
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-tools fa-3x text-muted mb-3" style="opacity: 0.5;"></i>
                                    <h5 class="text-muted mb-2">Belum ada data barang</h5>
                                    <p class="text-muted mb-3">Mulai dengan menambahkan barang pertama Anda</p>
                                    <button class="btn btn-primary" id="btn-tambah-empty">
                                        <i class="fas fa-plus me-1"></i>Tambah Barang Pertama
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                } else {
                    data.forEach(function(item) {
                        tableBody += `
                            <tr class="border-bottom">
                                <td class="text-center py-3">
                                    <span class="fw-bold text-primary">${item.id}</span>
                                </td>
                                <td class="py-3">
                                    <div class="fw-semibold text-dark">${item.nama_barang}</div>
                                </td>
                                <td class="py-3">
                                    <span class="text-muted">${item.merk}</span>
                                </td>
                                <td class="text-center py-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                        ${item.stok}
                                    </span>
                                </td>
                                <td class="text-center py-3">
                                    <span class="fw-semibold text-success">Rp ${formatRupiah(item.harga)}</span>
                                </td>
                                <td class="text-center py-3">
                                    <div class="d-flex justify-content-center action-buttons" role="group">
                                        <button class="btn btn-outline-info btn-sm btn-action" onclick="showDetail(${item.id})" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm btn-action" onclick="editData(${item.id})" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm btn-action" onclick="deleteData(${item.id})" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                }
                
                $('#table-body').html(tableBody);
                $('#total-items').text(`${data.length} Barang`);

                // Bind event untuk tombol tambah di empty state
                $('#btn-tambah-empty').click(function() {
                    resetForm();
                    $('#modalTitle').html('<i class="fas fa-tools me-2"></i>Tambah Barang');
                    $('#method').val('POST');
                    $('#modalBarang').modal('show');
                });
            },
            error: function() {
                showAlert('Gagal memuat data!', 'danger');
                $('#table-body').html(`
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-danger">
                                <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                <p>Gagal memuat data. Silakan refresh halaman.</p>
                            </div>
                        </td>
                    </tr>
                `);
            }
        });
    }

    // Function untuk show loading state
    function showLoadingState() {
        let loadingRows = '';
        for (let i = 0; i < 3; i++) {
            loadingRows += `
                <tr class="loading-row">
                    <td class="text-center py-3"><div class="bg-light rounded" style="height: 20px; width: 30px; margin: 0 auto;"></div></td>
                    <td class="py-3"><div class="bg-light rounded" style="height: 20px; width: 150px;"></div></td>
                    <td class="py-3"><div class="bg-light rounded" style="height: 20px; width: 100px;"></div></td>
                    <td class="text-center py-3"><div class="bg-light rounded" style="height: 20px; width: 50px; margin: 0 auto;"></div></td>
                    <td class="text-center py-3"><div class="bg-light rounded" style="height: 20px; width: 80px; margin: 0 auto;"></div></td>
                    <td class="text-center py-3"><div class="bg-light rounded" style="height: 20px; width: 120px; margin: 0 auto;"></div></td>
                </tr>
            `;
        }
        $('#table-body').html(loadingRows);
    }

    // Function untuk show detail
    window.showDetail = function(id) {
        $.ajax({
            url: `/bengkel/${id}`,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#detail-id').text('#' + data.id);
                    $('#detail-nama').text(data.nama_barang);
                    $('#detail-merk').text(data.merk);
                    $('#detail-stok').text(data.stok + ' Unit');
                    $('#detail-harga').text('Rp ' + formatRupiah(data.harga));
                    $('#detail-deskripsi').text(data.deskripsi);
                    $('#detail-created').text(formatDate(data.created_at));
                    $('#detail-updated').text(formatDate(data.updated_at));
                    
                    $('#modalDetail').modal('show');
                }
            },
            error: function() {
                showAlert('Gagal memuat detail!', 'danger');
            }
        });
    };

    // Function untuk edit data
    window.editData = function(id) {
        $.ajax({
            url: `/bengkel/${id}/edit`,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    
                    $('#barang_id').val(data.id);
                    $('#nama_barang').val(data.nama_barang);
                    $('#merk').val(data.merk);
                    $('#stok').val(data.stok);
                    $('#harga').val(data.harga);
                    $('#deskripsi').val(data.deskripsi);
                    
                    $('#modalTitle').html('<i class="fas fa-edit me-2"></i>Edit Barang');
                    $('#method').val('PUT');
                    $('#modalBarang').modal('show');
                }
            },
            error: function() {
                showAlert('Gagal memuat data untuk edit!', 'danger');
            }
        });
    };

    // Function untuk delete data
    window.deleteData = function(id) {
        if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
            $.ajax({
                url: `/bengkel/${id}`,
                method: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        showAlert(response.message, 'success');
                        loadData();
                    }
                },
                error: function() {
                    showAlert('Gagal menghapus data!', 'danger');
                }
            });
        }
    };

    // Function untuk reset form
    function resetForm() {
        $('#formBarang')[0].reset();
        $('#barang_id').val('');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');
    }

    // Function untuk show alert
    function showAlert(message, type) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('#alert-container').html(alertHtml);
        
        // Auto hide alert after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    }

    // Function untuk format rupiah
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    // Function untuk format date
    function formatDate(dateString) {
        const options = { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }
});
</script>
@endpush
