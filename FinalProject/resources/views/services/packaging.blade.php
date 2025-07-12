@extends('layouts.frontend')

@section('title', 'Packaging & Label - RNR Digital Printing')
@section('description', 'Layanan cetak packaging dan label berkualitas tinggi. Label stiker, packaging custom, mug sublim dengan hasil yang rapi dan tahan lama.')

@push('styles')
<style>
    /* Hero Section Animations */
    .hero-section {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.15"/><circle cx="90" cy="40" r="0.8" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        animation: float 20s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(1deg); }
    }
    
    .hero-icon {
        font-size: 5rem;
        animation: packaging-bounce 2s ease-in-out infinite;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
    }
    
    @keyframes packaging-bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0) rotateY(0deg); }
        40% { transform: translateY(-20px) rotateY(10deg); }
        60% { transform: translateY(-10px) rotateY(-5deg); }
    }
    
    /* Product Carousel Enhancements */
    .product-carousel {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }
    
    .product-carousel:hover {
        transform: translateY(-10px) rotateX(5deg);
        box-shadow: 0 30px 60px rgba(0,0,0,0.2);
    }
    
    .product-carousel .carousel-item img {
        height: 400px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-carousel:hover .carousel-item.active img {
        transform: scale(1.05);
    }
    
    /* Animated Cards */
    .animated-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .animated-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(40,167,69,0.4), transparent);
        transition: left 0.6s ease;
    }
    
    .animated-card:hover::before {
        left: 100%;
    }
    
    .animated-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    /* Form Enhancements */
    .form-section {
        background: linear-gradient(145deg, #f8f9fa, #e9ecef);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    
    .form-section::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(40, 167, 69, 0.1) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }
    
    .form-control, .form-select {
        border-radius: 15px;
        border: 2px solid transparent;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        transform: translateY(-2px);
    }
    
    /* Product Specs */
    .product-specs {
        background: linear-gradient(145deg, white, #f8f9fa);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .product-specs:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .spec-icon {
        animation: rotate 4s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Price Display */
    .price-display {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(45deg, #28a745, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from { filter: drop-shadow(0 0 5px rgba(40, 167, 69, 0.5)); }
        to { filter: drop-shadow(0 0 20px rgba(40, 167, 69, 0.8)); }
    }
    
    .price-breakdown {
        background: linear-gradient(145deg, #e8f5e8, #d4edda);
        border-radius: 15px;
        padding: 20px;
        border-left: 5px solid #28a745;
        animation: slideInRight 0.5s ease;
    }
    
    @keyframes slideInRight {
        from { transform: translateX(50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    /* Promo Section */
    .promo-section {
        background: linear-gradient(45deg, #28a745, #20c997, #17a2b8);
        background-size: 300% 300%;
        animation: gradientShift 3s ease infinite;
        color: white;
        border-radius: 15px;
        padding: 20px;
        margin: 15px 0;
        position: relative;
        overflow: hidden;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .promo-section::before {
        content: '📦';
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 2rem;
        animation: twinkle 1.5s ease-in-out infinite;
    }
    
    @keyframes twinkle {
        0%, 100% { opacity: 0.5; transform: scale(1) rotate(0deg); }
        50% { opacity: 1; transform: scale(1.2) rotate(5deg); }
    }
    
    /* Material Options */
    .material-option {
        border: 2px solid #dee2e6;
        border-radius: 15px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        background: white;
    }
    
    .material-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(40,167,69,0.1), rgba(32,201,151,0.1));
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .material-option:hover::before {
        transform: translateX(0);
    }
    
    .material-option:hover {
        border-color: #28a745;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.2);
    }
    
    .material-option.selected {
        border-color: #28a745;
        background: rgba(40, 167, 69, 0.1);
        transform: scale(1.02);
    }
    
    /* Button Animations */
    .btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.3s, height 0.3s;
    }
    
    .btn:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .btn-success {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.4);
    }
    
    /* Fade in animations */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Loading animation for price calculation */
    .loading-price {
        position: relative;
    }
    
    .loading-price::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #28a745;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        transform: translate(-50%, -50%);
    }
    
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
</style>
@endpush
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .material-option:hover {
        border-color: #28a745;
        background-color: #f8fff8;
    }
    
    .material-option.selected {
        border-color: #28a745;
        background-color: #e8f5e8;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="hero-section text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 fade-in">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-white-50">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item active">Packaging & Label</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">Packaging & Label</h1>
                <p class="lead">Label Stiker, Packaging Custom, Mug Sublim dengan hasil yang rapi dan tahan lama</p>
            </div>
            <div class="col-lg-4 text-center fade-in">
                <i class="bi bi-box hero-icon"></i>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6 mb-4">
                <div id="productCarousel" class="carousel slide product-carousel" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-3">
                        <div class="carousel-item active">
                            <img src="{{ asset('template/assets/packaging-1.jpg') }}" class="d-block w-100" alt="Packaging 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('template/assets/packaging-2.jpg') }}" class="d-block w-100" alt="Packaging 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('template/assets/packaging-3.jpg') }}" class="d-block w-100" alt="Packaging 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
                
                <!-- Product Specifications -->
                <div class="product-specs mt-4">
                    <h5><i class="bi bi-info-circle text-success me-2"></i>Spesifikasi Produk</h5>
                    <div class="row">
                        <div class="col-6">
                            <strong>Jenis Label:</strong>
                            <ul class="list-unstyled ms-3">
                                <li>• Vinyl Doff/Glossy</li>
                                <li>• Bontak (Bahan Kertas)</li>
                                <li>• Transparan</li>
                                <li>• Hologram</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <strong>Cutting:</strong>
                            <ul class="list-unstyled ms-3">
                                <li>• Kotak (Square Cut)</li>
                                <li>• Kiss Cut</li>
                                <li>• Die Cut Custom</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <strong>Packaging Custom:</strong> Mug Sublim, Box Custom, Paper Bag, dll
                    </div>
                </div>
            </div>
            
            <!-- Order Form -->
            <div class="col-lg-6">
                <form id="orderForm" class="form-section">
                    <h4 class="mb-4"><i class="bi bi-basket text-success me-2"></i>Form Pemesanan</h4>
                    
                    <!-- Product Type Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Jenis Produk</label>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="material-option" onclick="selectProductType('label_stiker')">
                                    <input type="radio" name="product_type" value="label_stiker" id="labelStiker" hidden>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-tags text-success me-3 fs-4"></i>
                                        <div>
                                            <strong>Label Stiker</strong>
                                            <div class="small text-muted">Vinyl, Bontak, Transparan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="material-option" onclick="selectProductType('packaging_custom')">
                                    <input type="radio" name="product_type" value="packaging_custom" id="packagingCustom" hidden>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-box-seam text-success me-3 fs-4"></i>
                                        <div>
                                            <strong>Packaging Custom</strong>
                                            <div class="small text-muted">Mug, Box, Paper Bag</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Label Stiker Options -->
                    <div id="labelStikerOptions" class="product-options" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jenis Material</label>
                            <select name="material_type" id="materialType" class="form-select">
                                <option value="">Pilih material</option>
                                <option value="vinyl_doff" data-price="3000">Vinyl Doff (+Rp 3.000)</option>
                                <option value="vinyl_glossy" data-price="3500">Vinyl Glossy (+Rp 3.500)</option>
                                <option value="bontak" data-price="2500">Bontak (+Rp 2.500)</option>
                                <option value="transparan" data-price="4000">Transparan (+Rp 4.000)</option>
                                <option value="hologram" data-price="8000">Hologram (+Rp 8.000)</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jenis Cutting</label>
                            <select name="cut_type" id="cutType" class="form-select">
                                <option value="kotak" data-price="0">Kotak/Square Cut (+Rp 0)</option>
                                <option value="kiss_cut" data-price="1000">Kiss Cut (+Rp 1.000)</option>
                                <option value="die_cut" data-price="5000">Die Cut Custom (+Rp 5.000)</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ukuran Stiker</label>
                            <select name="sticker_size" id="stickerSize" class="form-select">
                                <option value="">Pilih ukuran</option>
                                <option value="5x5" data-multiplier="1">5x5 cm</option>
                                <option value="7x7" data-multiplier="1.5">7x7 cm</option>
                                <option value="10x10" data-multiplier="2">10x10 cm</option>
                                <option value="15x15" data-multiplier="3">15x15 cm</option>
                                <option value="custom" data-multiplier="1">Custom Size</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Packaging Custom Options -->
                    <div id="packagingCustomOptions" class="product-options" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jenis Packaging</label>
                            <select name="packaging_type" id="packagingType" class="form-select">
                                <option value="">Pilih jenis packaging</option>
                                <option value="mug_sublim" data-price="25000">Mug Sublim (+Rp 25.000)</option>
                                <option value="box_custom" data-price="15000">Box Custom (+Rp 15.000)</option>
                                <option value="paper_bag" data-price="8000">Paper Bag (+Rp 8.000)</option>
                                <option value="standing_pouch" data-price="12000">Standing Pouch (+Rp 12.000)</option>
                                <option value="blister_pack" data-price="10000">Blister Pack (+Rp 10.000)</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ukuran/Kapasitas</label>
                            <select name="packaging_size" id="packagingSize" class="form-select">
                                <option value="">Pilih ukuran</option>
                                <option value="small" data-multiplier="1">Small</option>
                                <option value="medium" data-multiplier="1.5">Medium</option>
                                <option value="large" data-multiplier="2">Large</option>
                                <option value="xl" data-multiplier="2.5">Extra Large</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Finishing</label>
                            <select name="packaging_finishing" id="packagingFinishing" class="form-select">
                                <option value="none" data-price="0">Tanpa Finishing (+Rp 0)</option>
                                <option value="laminating" data-price="2000">Laminasi (+Rp 2.000)</option>
                                <option value="emboss" data-price="5000">Emboss (+Rp 5.000)</option>
                                <option value="hot_print" data-price="7000">Hot Print (+Rp 7.000)</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Common Fields -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="100" required>
                        <div class="form-text">Minimum order berbeda untuk setiap jenis produk</div>
                    </div>
                    
                    <!-- Custom Dimensions (conditional) -->
                    <div id="customDimensions" class="mb-3" style="display: none;">
                        <label class="form-label fw-semibold">Ukuran Custom</label>
                        <div class="row">
                            <div class="col-4">
                                <input type="number" name="custom_width" id="customWidth" class="form-control" placeholder="Lebar (cm)">
                            </div>
                            <div class="col-4">
                                <input type="number" name="custom_height" id="customHeight" class="form-control" placeholder="Tinggi (cm)">
                            </div>
                            <div class="col-4">
                                <input type="number" name="custom_depth" id="customDepth" class="form-control" placeholder="Tebal (cm)">
                            </div>
                        </div>
                    </div>
                    
                    <!-- File Upload -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload File Desain</label>
                        <input type="file" name="design_file" id="designFile" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.ai,.psd,.cdr" multiple>
                        <div class="form-text">Format: JPG, PNG, PDF, AI, PSD, CDR (Max: 10MB per file)</div>
                    </div>
                    
                    <!-- Notes -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Tambahan</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Instruksi khusus, warna, deadline, dll..."></textarea>
                    </div>
                    
                    <!-- Customer Information -->
                    <hr class="my-4">
                    <h5 class="mb-3"><i class="bi bi-person text-success me-2"></i>Informasi Kontak</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="customer_name" id="customerName" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. Telepon</label>
                            <input type="tel" name="customer_phone" id="customerPhone" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="customer_email" id="customerEmail" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea name="customer_address" id="customerAddress" class="form-control" rows="2" required></textarea>
                    </div>
                    
                    <!-- Shipping -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Metode Pengiriman</label>
                        <select name="shipping_method" id="shippingMethod" class="form-select" required>
                            <option value="">Pilih metode pengiriman</option>
                            <option value="pickup" data-cost="0">Ambil Sendiri (Gratis)</option>
                            <option value="local" data-cost="15000">Pengiriman Lokal Gresik (Rp 15.000)</option>
                            <option value="regional" data-cost="25000">Pengiriman Regional Jatim (Rp 25.000)</option>
                            <option value="national" data-cost="50000">Pengiriman Nasional (Rp 50.000)</option>
                            <option value="express" data-cost="75000">Express Same Day (Rp 75.000)</option>
                        </select>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Metode Pembayaran</label>
                        <select name="payment_method" id="paymentMethod" class="form-select" required>
                            <option value="">Pilih metode pembayaran</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="ovo">OVO</option>
                            <option value="gopay">GoPay</option>
                            <option value="dana">DANA</option>
                            <option value="cash">Cash (Untuk pickup)</option>
                        </select>
                    </div>
                    
                    <!-- Promo Code -->
                    <div class="promo-section">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-gift me-2"></i>
                            <strong>Punya Kode Promo?</strong>
                        </div>
                        <div class="input-group">
                            <input type="text" name="promo_code" id="promoCode" class="form-control" placeholder="Masukkan kode promo">
                            <button type="button" id="applyPromo" class="btn btn-light">Gunakan</button>
                        </div>
                        <small class="d-block mt-1">Kode: HEMAT10, NEWUSER15, GRATIS50</small>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Price Summary -->
        <div class="row mt-4">
            <div class="col-lg-6 offset-lg-6">
                <div class="price-breakdown">
                    <h5 class="mb-3"><i class="bi bi-calculator text-success me-2"></i>Ringkasan Harga</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Harga Dasar:</span>
                        <span id="basePrice">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Jumlah:</span>
                        <span id="quantityDisplay">0 pcs</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span id="subtotal">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Biaya Tambahan:</span>
                        <span id="additionalCost">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2" id="discountRow" style="display: none;">
                        <span>Diskon:</span>
                        <span id="discount" class="text-success">- Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Ongkos Kirim:</span>
                        <span id="shippingCost">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Pajak (10%):</span>
                        <span id="tax">Rp 0</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong class="fs-5">Total:</strong>
                        <strong class="fs-4 text-success" id="totalPrice">Rp 0</strong>
                    </div>
                    
                    <button type="button" id="placeOrder" class="btn btn-success btn-lg w-100 mt-3" disabled>
                        <i class="bi bi-whatsapp me-2"></i>Pesan via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="text-center mb-4">Portfolio Packaging & Label</h3>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('template/assets/portfolio-label-1.jpg') }}" class="card-img-top" alt="Label Portfolio 1">
                    <div class="card-body text-center">
                        <h6>Label Produk UMKM</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('template/assets/portfolio-packaging-1.jpg') }}" class="card-img-top" alt="Packaging Portfolio 1">
                    <div class="card-body text-center">
                        <h6>Box Kemasan Makanan</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('template/assets/portfolio-mug-1.jpg') }}" class="card-img-top" alt="Mug Portfolio 1">
                    <div class="card-body text-center">
                        <h6>Mug Sublim Custom</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('template/assets/portfolio-label-2.jpg') }}" class="card-img-top" alt="Label Portfolio 2">
                    <div class="card-body text-center">
                        <h6>Stiker Hologram</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Base prices for different product types
    const basePrices = {
        'label_stiker': 1000,
        'packaging_custom': 5000
    };
    
    let currentProductType = '';
    let appliedPromo = null;
    
    // Form elements
    const form = document.getElementById('orderForm');
    const quantity = document.getElementById('quantity');
    const shippingMethod = document.getElementById('shippingMethod');
    const promoCode = document.getElementById('promoCode');
    const applyPromo = document.getElementById('applyPromo');
    const placeOrder = document.getElementById('placeOrder');
    
    // Price display elements
    const baseDisplay = document.getElementById('basePrice');
    const quantityDisplay = document.getElementById('quantityDisplay');
    const subtotalDisplay = document.getElementById('subtotal');
    const additionalCostDisplay = document.getElementById('additionalCost');
    const discountRow = document.getElementById('discountRow');
    const discountDisplay = document.getElementById('discount');
    const shippingCostDisplay = document.getElementById('shippingCost');
    const taxDisplay = document.getElementById('tax');
    const totalDisplay = document.getElementById('totalPrice');
    
    // Product type selection
    window.selectProductType = function(type) {
        // Remove previous selections
        document.querySelectorAll('.material-option').forEach(opt => opt.classList.remove('selected'));
        document.querySelectorAll('.product-options').forEach(opt => opt.style.display = 'none');
        
        // Select current type
        event.currentTarget.classList.add('selected');
        document.getElementById(type === 'label_stiker' ? 'labelStiker' : 'packagingCustom').checked = true;
        
        // Show relevant options
        if (type === 'label_stiker') {
            document.getElementById('labelStikerOptions').style.display = 'block';
            document.getElementById('materialType').required = true;
            document.getElementById('cutType').required = true;
            document.getElementById('stickerSize').required = true;
        } else {
            document.getElementById('packagingCustomOptions').style.display = 'block';
            document.getElementById('packagingType').required = true;
            document.getElementById('packagingSize').required = true;
        }
        
        currentProductType = type;
        calculatePrice();
    };
    
    // Show/hide custom dimensions
    function checkCustomSize() {
        const stickerSize = document.getElementById('stickerSize');
        const customDimensions = document.getElementById('customDimensions');
        
        if (stickerSize && stickerSize.value === 'custom') {
            customDimensions.style.display = 'block';
        } else {
            customDimensions.style.display = 'none';
        }
    }
    
    // Event listeners
    document.addEventListener('change', function(e) {
        if (e.target.matches('#stickerSize')) {
            checkCustomSize();
        }
        calculatePrice();
    });
    
    [quantity, shippingMethod].forEach(element => {
        element.addEventListener('input', calculatePrice);
    });
    
    // Promo code application
    applyPromo.addEventListener('click', function() {
        const code = promoCode.value.trim().toUpperCase();
        const promoCodes = {
            'HEMAT10': { type: 'percentage', value: 0.10, description: 'Diskon 10%' },
            'NEWUSER15': { type: 'percentage', value: 0.15, description: 'Diskon 15% User Baru' },
            'GRATIS50': { type: 'fixed', value: 50000, description: 'Gratis Ongkir Rp 50.000' }
        };
        
        if (promoCodes[code]) {
            appliedPromo = promoCodes[code];
            promoCode.disabled = true;
            this.textContent = 'Terapkan';
            this.disabled = true;
            calculatePrice();
            
            showAlert('success', `Kode promo "${code}" berhasil diterapkan! ${promoCodes[code].description}`);
        } else {
            showAlert('danger', 'Kode promo tidak valid!');
        }
    });
    
    // Price calculation function
    function calculatePrice() {
        if (!currentProductType || !quantity.value || quantity.value < 1) return;
        
        let basePrice = basePrices[currentProductType] || 0;
        let qty = parseInt(quantity.value);
        
        // Calculate additional costs based on product type
        let additionalCost = 0;
        let sizeMultiplier = 1;
        
        if (currentProductType === 'label_stiker') {
            // Material cost
            const materialType = document.getElementById('materialType');
            if (materialType && materialType.selectedOptions[0]) {
                additionalCost += parseInt(materialType.selectedOptions[0].dataset.price || 0);
            }
            
            // Cut type cost
            const cutType = document.getElementById('cutType');
            if (cutType && cutType.selectedOptions[0]) {
                additionalCost += parseInt(cutType.selectedOptions[0].dataset.price || 0);
            }
            
            // Size multiplier
            const stickerSize = document.getElementById('stickerSize');
            if (stickerSize && stickerSize.selectedOptions[0]) {
                sizeMultiplier = parseFloat(stickerSize.selectedOptions[0].dataset.multiplier || 1);
            }
            
        } else if (currentProductType === 'packaging_custom') {
            // Packaging type cost
            const packagingType = document.getElementById('packagingType');
            if (packagingType && packagingType.selectedOptions[0]) {
                additionalCost += parseInt(packagingType.selectedOptions[0].dataset.price || 0);
            }
            
            // Size multiplier
            const packagingSize = document.getElementById('packagingSize');
            if (packagingSize && packagingSize.selectedOptions[0]) {
                sizeMultiplier = parseFloat(packagingSize.selectedOptions[0].dataset.multiplier || 1);
            }
            
            // Finishing cost
            const packagingFinishing = document.getElementById('packagingFinishing');
            if (packagingFinishing && packagingFinishing.selectedOptions[0]) {
                additionalCost += parseInt(packagingFinishing.selectedOptions[0].dataset.price || 0);
            }
        }
        
        // Calculate totals
        let itemPrice = basePrice + additionalCost;
        let itemSubtotal = (itemPrice * sizeMultiplier) * qty;
        let subtotalWithOptions = itemSubtotal;
        
        // Apply promo discount
        let discount = 0;
        if (appliedPromo) {
            if (appliedPromo.type === 'percentage') {
                discount = subtotalWithOptions * appliedPromo.value;
            } else {
                discount = Math.min(appliedPromo.value, subtotalWithOptions);
            }
        }
        
        let subtotalAfterDiscount = subtotalWithOptions - discount;
        
        // Shipping cost
        const shippingOption = shippingMethod.options[shippingMethod.selectedIndex];
        let shippingCost = 0;
        if (shippingOption && shippingOption.dataset.cost) {
            shippingCost = parseInt(shippingOption.dataset.cost);
            
            // Apply shipping discount if applicable
            if (appliedPromo && appliedPromo.type === 'fixed') {
                shippingCost = Math.max(0, shippingCost - (appliedPromo.value - discount));
            }
        }
        
        // Tax calculation (10%)
        let tax = subtotalAfterDiscount * 0.10;
        
        // Final total
        let total = subtotalAfterDiscount + shippingCost + tax;
        
        // Update displays
        baseDisplay.textContent = 'Rp ' + itemPrice.toLocaleString();
        quantityDisplay.textContent = qty + ' pcs';
        subtotalDisplay.textContent = 'Rp ' + itemSubtotal.toLocaleString();
        additionalCostDisplay.textContent = 'Rp ' + (additionalCost * qty).toLocaleString();
        
        if (discount > 0) {
            discountRow.style.display = 'flex';
            discountDisplay.textContent = '- Rp ' + discount.toLocaleString();
        } else {
            discountRow.style.display = 'none';
        }
        
        shippingCostDisplay.textContent = 'Rp ' + shippingCost.toLocaleString();
        taxDisplay.textContent = 'Rp ' + tax.toLocaleString();
        totalDisplay.textContent = 'Rp ' + total.toLocaleString();
        
        // Enable order button if form is ready
        checkFormValid();
    }
    
    // Form validation
    function checkFormValid() {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = currentProductType !== '';
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
            }
        });
        
        placeOrder.disabled = !isValid;
    }
    
    // Form input validation
    form.addEventListener('input', checkFormValid);
    form.addEventListener('change', checkFormValid);
    
    // Place order
    placeOrder.addEventListener('click', function() {
        if (this.disabled) return;
        
        const formData = new FormData(form);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('product_id', 1); // Default product ID
        
        this.disabled = true;
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
        
        fetch('{{ route("services.place-order") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.open(data.data.whatsapp_url, '_blank');
                showAlert('success', 'Pesanan berhasil dibuat! Nomor pesanan: ' + data.data.order_number);
                form.reset();
                currentProductType = '';
                document.querySelectorAll('.material-option').forEach(opt => opt.classList.remove('selected'));
                document.querySelectorAll('.product-options').forEach(opt => opt.style.display = 'none');
                calculatePrice();
            } else {
                showAlert('danger', 'Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'Terjadi kesalahan. Silakan coba lagi.');
        })
        .finally(() => {
            this.disabled = false;
            this.innerHTML = '<i class="bi bi-whatsapp me-2"></i>Pesan via WhatsApp';
        });
    });
    
    // Show alert function
    function showAlert(type, message) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        const container = document.querySelector('.container');
        container.insertBefore(alert, container.firstChild);
        
        setTimeout(() => {
            alert.remove();
        }, 5000);
    }
});
</script>
@endpush

@push('scripts')
<!-- Services Animation Script -->
<script src="{{ asset('js/services-animations.js') }}"></script>
@endpush
