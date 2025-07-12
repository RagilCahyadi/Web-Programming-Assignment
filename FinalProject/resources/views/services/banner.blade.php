@extends('layouts.frontend')

@section('title', 'Banner & Signage - RNR Digital Printing')
@section('description', 'Layanan cetak banner dan signage berkualitas tinggi. X-Banner, Roll Banner, Neon Box dengan hasil cetak tajam dan tahan lama.')

@push('styles')
<style>
    /* Hero Section Animations */
    .hero-section {
        background: linear-gradient(135deg, #fd7e14 0%, #e83e8c 100%);
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
        animation: banner-wave 3s ease-in-out infinite;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
    }
    
    @keyframes banner-wave {
        0%, 100% { transform: translateY(0) rotateZ(0deg) scaleX(1); }
        25% { transform: translateY(-10px) rotateZ(2deg) scaleX(1.1); }
        50% { transform: translateY(-20px) rotateZ(0deg) scaleX(1); }
        75% { transform: translateY(-10px) rotateZ(-2deg) scaleX(1.1); }
    }
    
    /* Product Carousel Enhancements */
    .product-carousel {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }
    
    .product-carousel:hover {
        transform: translateY(-10px) perspective(1000px) rotateX(5deg);
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
        background: linear-gradient(90deg, transparent, rgba(253,126,20,0.4), transparent);
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
        background: radial-gradient(circle, rgba(253, 126, 20, 0.1) 0%, transparent 70%);
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
        border-color: #fd7e14;
        box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25);
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
        animation: banner-swing 4s ease-in-out infinite;
    }
    
    @keyframes banner-swing {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(5deg); }
        75% { transform: rotate(-5deg); }
    }
    
    /* Price Display */
    .price-display {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from { filter: drop-shadow(0 0 5px rgba(253, 126, 20, 0.5)); }
        to { filter: drop-shadow(0 0 20px rgba(253, 126, 20, 0.8)); }
    }
    
    .price-breakdown {
        background: linear-gradient(145deg, #fff3cd, #ffeaa7);
        border-radius: 15px;
        padding: 20px;
        border-left: 5px solid #fd7e14;
        animation: slideInRight 0.5s ease;
    }
    
    @keyframes slideInRight {
        from { transform: translateX(50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    /* Promo Section */
    .promo-section {
        background: linear-gradient(45deg, #fd7e14, #e83e8c, #6f42c1);
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
        content: '🎯';
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 2rem;
        animation: target-spin 2s linear infinite;
    }
    
    @keyframes target-spin {
        0% { transform: rotate(0deg) scale(1); }
        50% { transform: rotate(180deg) scale(1.1); }
        100% { transform: rotate(360deg) scale(1); }
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
        background: linear-gradient(45deg, rgba(253,126,20,0.1), rgba(232,62,140,0.1));
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .material-option:hover::before {
        transform: translateX(0);
    }
    
    .material-option:hover {
        border-color: #fd7e14;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 10px 25px rgba(253, 126, 20, 0.2);
    }
    
    .material-option.selected {
        border-color: #fd7e14;
        background: rgba(253, 126, 20, 0.1);
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
    
    .btn-warning {
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
    }
    
    .btn-warning:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(253, 126, 20, 0.4);
        color: white;
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
        border-top: 2px solid #fd7e14;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        transform: translate(-50%, -50%);
    }
    
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    /* Additional styles for material options */
    .material-option {
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
    
    .size-badge {
        background: #007bff;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        margin-left: 8px;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-white-50">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item active">Banner & Signage</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">Banner & Signage</h1>
                <p class="lead">X-Banner, Roll Banner, Neon Box dengan hasil cetak tajam dan tahan lama</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="bi bi-megaphone" style="font-size: 5rem;"></i>
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
                            <img src="https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=500" class="d-block w-100" alt="Banner 1">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1586281010691-7b0eaa00c96c?w=500" class="d-block w-100" alt="Banner 2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=500" class="d-block w-100" alt="Signage 1">
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
                    <h5><i class="bi bi-info-circle text-primary me-2"></i>Spesifikasi Produk</h5>
                    <div class="row">
                        <div class="col-6">
                            <strong>Jenis Banner:</strong>
                            <ul class="list-unstyled ms-3">
                                <li>• X-Banner (Portable)</li>
                                <li>• Roll Banner (Roll Up)</li>
                                <li>• Backdrop Banner</li>
                                <li>• Standing Banner</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <strong>Material:</strong>
                            <ul class="list-unstyled ms-3">
                                <li>• Flexi China (Outdoor)</li>
                                <li>• Flexi Korea (Premium)</li>
                                <li>• Kain Satin (Indoor)</li>
                                <li>• One Way Vision</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <strong>Signage:</strong> Neon Box, LED Sign, Acrylic Sign, Letter Timbul 3D
                    </div>
                </div>
            </div>
            
            <!-- Order Form -->
            <div class="col-lg-6">
                <form id="orderForm" class="form-section">
                    <h4 class="mb-4"><i class="bi bi-basket text-primary me-2"></i>Form Pemesanan</h4>
                    
                    <!-- Product Type Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Jenis Produk</label>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="material-option" onclick="selectProductType('banner')">
                                    <input type="radio" name="product_type" value="banner" id="bannerType" hidden>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-flag text-primary me-3 fs-4"></i>
                                        <div>
                                            <strong>Banner</strong>
                                            <div class="small text-muted">X-Banner, Roll Banner, Backdrop</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="material-option" onclick="selectProductType('signage')">
                                    <input type="radio" name="product_type" value="signage" id="signageType" hidden>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-signpost text-primary me-3 fs-4"></i>
                                        <div>
                                            <strong>Signage</strong>
                                            <div class="small text-muted">Neon Box, LED Sign, Letter Timbul</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Banner Options -->
                    <div id="bannerOptions" class="product-options" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jenis Banner</label>
                            <select name="banner_type" id="bannerTypeSelect" class="form-select">
                                <option value="">Pilih jenis banner</option>
                                <option value="x_banner" data-price="75000">X-Banner (termasuk stand) - Rp 75.000</option>
                                <option value="roll_banner" data-price="150000">Roll Banner (Roll Up) - Rp 150.000</option>
                                <option value="backdrop" data-price="50000">Backdrop Banner - Rp 50.000</option>
                                <option value="standing" data-price="125000">Standing Banner - Rp 125.000</option>
                                <option value="gantung" data-price="35000">Banner Gantung - Rp 35.000</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Material Banner</label>
                            <select name="banner_material" id="bannerMaterial" class="form-select">
                                <option value="flexi_china" data-price="0">Flexi China (Outdoor) - Standard</option>
                                <option value="flexi_korea" data-price="15000">Flexi Korea (Premium) - +Rp 15.000</option>
                                <option value="kain_satin" data-price="20000">Kain Satin (Indoor) - +Rp 20.000</option>
                                <option value="one_way" data-price="35000">One Way Vision - +Rp 35.000</option>
                                <option value="canvas" data-price="25000">Canvas Premium - +Rp 25.000</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ukuran Banner</label>
                            <select name="banner_size" id="bannerSize" class="form-select">
                                <option value="">Pilih ukuran</option>
                                <option value="60x160" data-multiplier="1">60x160 cm <span class="size-badge">Standard</span></option>
                                <option value="80x180" data-multiplier="1.5">80x180 cm <span class="size-badge">Medium</span></option>
                                <option value="100x200" data-multiplier="2">100x200 cm <span class="size-badge">Large</span></option>
                                <option value="120x200" data-multiplier="2.5">120x200 cm <span class="size-badge">XL</span></option>
                                <option value="150x300" data-multiplier="4">150x300 cm <span class="size-badge">Jumbo</span></option>
                                <option value="custom" data-multiplier="1">Custom Size</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Finishing Banner</label>
                            <select name="banner_finishing" id="bannerFinishing" class="form-select">
                                <option value="none" data-price="0">Tanpa Finishing - Gratis</option>
                                <option value="eyelet" data-price="5000">Eyelet (Lubang Ring) - +Rp 5.000</option>
                                <option value="hem" data-price="8000">Hem (Jahit Keliling) - +Rp 8.000</option>
                                <option value="laminating" data-price="15000">Laminasi Doff/Glossy - +Rp 15.000</option>
                                <option value="double_layer" data-price="25000">Double Layer - +Rp 25.000</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Signage Options -->
                    <div id="signageOptions" class="product-options" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jenis Signage</label>
                            <select name="signage_type" id="signageTypeSelect" class="form-select">
                                <option value="">Pilih jenis signage</option>
                                <option value="neon_box" data-price="500000">Neon Box - Rp 500.000</option>
                                <option value="led_sign" data-price="750000">LED Sign - Rp 750.000</option>
                                <option value="acrylic_sign" data-price="200000">Acrylic Sign - Rp 200.000</option>
                                <option value="letter_timbul" data-price="100000">Letter Timbul 3D - Rp 100.000</option>
                                <option value="papan_nama" data-price="150000">Papan Nama Kantor - Rp 150.000</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Material Signage</label>
                            <select name="signage_material" id="signageMaterial" class="form-select">
                                <option value="acrylic" data-price="0">Acrylic - Standard</option>
                                <option value="stainless" data-price="50000">Stainless Steel - +Rp 50.000</option>
                                <option value="aluminum" data-price="25000">Aluminum - +Rp 25.000</option>
                                <option value="brass" data-price="75000">Brass (Kuningan) - +Rp 75.000</option>
                                <option value="pvc_foam" data-price="10000">PVC Foam Board - +Rp 10.000</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ukuran Signage</label>
                            <select name="signage_size" id="signageSize" class="form-select">
                                <option value="">Pilih ukuran</option>
                                <option value="30x40" data-multiplier="1">30x40 cm <span class="size-badge">Small</span></option>
                                <option value="50x70" data-multiplier="1.5">50x70 cm <span class="size-badge">Medium</span></option>
                                <option value="60x80" data-multiplier="2">60x80 cm <span class="size-badge">Large</span></option>
                                <option value="100x150" data-multiplier="3">100x150 cm <span class="size-badge">XL</span></option>
                                <option value="custom" data-multiplier="1">Custom Size</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Lighting (untuk Neon Box/LED)</label>
                            <select name="signage_lighting" id="signageLighting" class="form-select">
                                <option value="none" data-price="0">Tanpa Lighting - Gratis</option>
                                <option value="led_strip" data-price="100000">LED Strip - +Rp 100.000</option>
                                <option value="neon_tube" data-price="150000">Neon Tube - +Rp 150.000</option>
                                <option value="led_module" data-price="200000">LED Module - +Rp 200.000</option>
                                <option value="backlight" data-price="75000">Backlight LED - +Rp 75.000</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Common Fields -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required>
                        <div class="form-text">Minimum order 1 pcs</div>
                    </div>
                    
                    <!-- Custom Dimensions (conditional) -->
                    <div id="customDimensions" class="mb-3" style="display: none;">
                        <label class="form-label fw-semibold">Ukuran Custom</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" name="custom_width" id="customWidth" class="form-control" placeholder="Lebar (cm)">
                            </div>
                            <div class="col-6">
                                <input type="number" name="custom_height" id="customHeight" class="form-control" placeholder="Tinggi (cm)">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Installation -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Instalasi</label>
                        <select name="installation" id="installation" class="form-select">
                            <option value="none" data-price="0">Tanpa Instalasi - Gratis</option>
                            <option value="local" data-price="50000">Instalasi Lokal Gresik - +Rp 50.000</option>
                            <option value="regional" data-price="150000">Instalasi Regional Jatim - +Rp 150.000</option>
                            <option value="consultation" data-price="25000">Konsultasi Instalasi - +Rp 25.000</option>
                        </select>
                    </div>
                    
                    <!-- File Upload -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload File Desain</label>
                        <input type="file" name="design_file" id="designFile" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.ai,.psd,.cdr,.eps" multiple>
                        <div class="form-text">Format: JPG, PNG, PDF, AI, PSD, CDR, EPS (Max: 15MB per file)</div>
                    </div>
                    
                    <!-- Notes -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Tambahan</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Instruksi khusus, warna, deadline, lokasi instalasi, dll..."></textarea>
                    </div>
                    
                    <!-- Customer Information -->
                    <hr class="my-4">
                    <h5 class="mb-3"><i class="bi bi-person text-primary me-2"></i>Informasi Kontak</h5>
                    
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
                            <option value="local" data-cost="25000">Pengiriman Lokal Gresik (Rp 25.000)</option>
                            <option value="regional" data-cost="75000">Pengiriman Regional Jatim (Rp 75.000)</option>
                            <option value="national" data-cost="150000">Pengiriman Nasional (Rp 150.000)</option>
                            <option value="express" data-cost="200000">Express Same Day (Rp 200.000)</option>
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
                    <h5 class="mb-3"><i class="bi bi-calculator text-primary me-2"></i>Ringkasan Harga</h5>
                    
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
                        <strong class="fs-4 text-primary" id="totalPrice">Rp 0</strong>
                    </div>
                    
                    <button type="button" id="placeOrder" class="btn btn-primary btn-lg w-100 mt-3" disabled>
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
        <h3 class="text-center mb-4">Portfolio Banner & Signage</h3>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=300" class="card-img-top" alt="X-Banner Portfolio">
                    <div class="card-body text-center">
                        <h6>X-Banner Event</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1586281010691-7b0eaa00c96c?w=300" class="card-img-top" alt="Roll Banner Portfolio">
                    <div class="card-body text-center">
                        <h6>Roll Banner Premium</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=300" class="card-img-top" alt="Neon Box Portfolio">
                    <div class="card-body text-center">
                        <h6>Neon Box Toko</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?w=300" class="card-img-top" alt="LED Sign Portfolio">
                    <div class="card-body text-center">
                        <h6>LED Sign Modern</h6>
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
        'banner': 35000,
        'signage': 100000
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
        document.getElementById(type === 'banner' ? 'bannerType' : 'signageType').checked = true;
        
        // Show relevant options
        if (type === 'banner') {
            document.getElementById('bannerOptions').style.display = 'block';
            document.getElementById('bannerTypeSelect').required = true;
            document.getElementById('bannerSize').required = true;
        } else {
            document.getElementById('signageOptions').style.display = 'block';
            document.getElementById('signageTypeSelect').required = true;
            document.getElementById('signageSize').required = true;
        }
        
        currentProductType = type;
        calculatePrice();
    };
    
    // Show/hide custom dimensions
    function checkCustomSize() {
        const bannerSize = document.getElementById('bannerSize');
        const signageSize = document.getElementById('signageSize');
        const customDimensions = document.getElementById('customDimensions');
        
        const isCustom = (bannerSize && bannerSize.value === 'custom') || 
                        (signageSize && signageSize.value === 'custom');
        
        customDimensions.style.display = isCustom ? 'block' : 'none';
    }
    
    // Event listeners
    document.addEventListener('change', function(e) {
        if (e.target.matches('#bannerSize, #signageSize')) {
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
        
        if (currentProductType === 'banner') {
            // Banner type cost
            const bannerTypeSelect = document.getElementById('bannerTypeSelect');
            if (bannerTypeSelect && bannerTypeSelect.selectedOptions[0]) {
                additionalCost += parseInt(bannerTypeSelect.selectedOptions[0].dataset.price || 0);
            }
            
            // Material cost
            const bannerMaterial = document.getElementById('bannerMaterial');
            if (bannerMaterial && bannerMaterial.selectedOptions[0]) {
                additionalCost += parseInt(bannerMaterial.selectedOptions[0].dataset.price || 0);
            }
            
            // Size multiplier
            const bannerSize = document.getElementById('bannerSize');
            if (bannerSize && bannerSize.selectedOptions[0]) {
                sizeMultiplier = parseFloat(bannerSize.selectedOptions[0].dataset.multiplier || 1);
            }
            
            // Finishing cost
            const bannerFinishing = document.getElementById('bannerFinishing');
            if (bannerFinishing && bannerFinishing.selectedOptions[0]) {
                additionalCost += parseInt(bannerFinishing.selectedOptions[0].dataset.price || 0);
            }
            
        } else if (currentProductType === 'signage') {
            // Signage type cost
            const signageTypeSelect = document.getElementById('signageTypeSelect');
            if (signageTypeSelect && signageTypeSelect.selectedOptions[0]) {
                additionalCost += parseInt(signageTypeSelect.selectedOptions[0].dataset.price || 0);
            }
            
            // Material cost
            const signageMaterial = document.getElementById('signageMaterial');
            if (signageMaterial && signageMaterial.selectedOptions[0]) {
                additionalCost += parseInt(signageMaterial.selectedOptions[0].dataset.price || 0);
            }
            
            // Size multiplier
            const signageSize = document.getElementById('signageSize');
            if (signageSize && signageSize.selectedOptions[0]) {
                sizeMultiplier = parseFloat(signageSize.selectedOptions[0].dataset.multiplier || 1);
            }
            
            // Lighting cost
            const signageLighting = document.getElementById('signageLighting');
            if (signageLighting && signageLighting.selectedOptions[0]) {
                additionalCost += parseInt(signageLighting.selectedOptions[0].dataset.price || 0);
            }
        }
        
        // Installation cost
        const installation = document.getElementById('installation');
        if (installation && installation.selectedOptions[0]) {
            additionalCost += parseInt(installation.selectedOptions[0].dataset.price || 0);
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
        formData.append('product_id', 2); // Banner/Signage product ID
        
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
