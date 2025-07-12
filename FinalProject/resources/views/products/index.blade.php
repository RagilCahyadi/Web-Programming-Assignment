@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-box-seam text-primary me-2"></i>
                        Manajemen Produk
                    </h4>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Produk
                    </a>
                </div>
                
                <div class="card-body">
                    <!-- Search and Filter -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" id="searchProduct" class="form-control" placeholder="Cari produk...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select id="filterCategory" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="filterStatus" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Products Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="productsTable">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 80px;">Foto</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr data-category="{{ $product->category_id }}" data-status="{{ $product->is_active ? 1 : 0 }}">
                                    <td>
                                        @if($product->photos->first())
                                            <img src="{{ Storage::url($product->photos->first()->photo_path) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="img-thumbnail" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px; border-radius: 8px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="product-name">{{ $product->name }}</strong>
                                            @if($product->description)
                                                <br><small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $product->category->name }}</span>
                                    </td>
                                    <td>
                                        <strong class="text-success">{{ $product->formatted_price }}</strong>
                                    </td>
                                    <td>
                                        @if($product->stock_quantity > 10)
                                            <span class="badge bg-success">{{ $product->stock_quantity }}</span>
                                        @elseif($product->stock_quantity > 0)
                                            <span class="badge bg-warning">{{ $product->stock_quantity }}</span>
                                        @else
                                            <span class="badge bg-danger">Habis</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_active)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i>Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle me-1"></i>Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $product->created_at->format('d/m/Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('products.show', $product) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('products.edit', $product) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteProduct('{{ $product->id }}')"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="bi bi-inbox display-4 text-muted"></i>
                                        <p class="mt-2 text-muted">Belum ada produk yang ditambahkan.</p>
                                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                                            <i class="bi bi-plus-circle me-2"></i>Tambah Produk Pertama
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchProduct = document.getElementById('searchProduct');
    const filterCategory = document.getElementById('filterCategory');
    const filterStatus = document.getElementById('filterStatus');
    const tableRows = document.querySelectorAll('#productsTable tbody tr');
    
    // Search and filter function
    function filterTable() {
        const searchTerm = searchProduct.value.toLowerCase();
        const categoryFilter = filterCategory.value;
        const statusFilter = filterStatus.value;
        
        tableRows.forEach(row => {
            if (row.cells.length === 1) return; // Skip empty state row
            
            const productName = row.querySelector('.product-name').textContent.toLowerCase();
            const category = row.dataset.category;
            const status = row.dataset.status;
            
            let showRow = true;
            
            // Search filter
            if (searchTerm && !productName.includes(searchTerm)) {
                showRow = false;
            }
            
            // Category filter
            if (categoryFilter && category !== categoryFilter) {
                showRow = false;
            }
            
            // Status filter
            if (statusFilter && status !== statusFilter) {
                showRow = false;
            }
            
            row.style.display = showRow ? '' : 'none';
        });
    }
    
    // Add event listeners
    searchProduct.addEventListener('input', filterTable);
    filterCategory.addEventListener('change', filterTable);
    filterStatus.addEventListener('change', filterTable);
});

// Delete product function
function deleteProduct(productId) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/products/${productId}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endpush
