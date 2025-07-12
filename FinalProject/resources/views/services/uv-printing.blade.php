@extends('layouts.frontend')

@section('title', 'UV Printing - RNR Digital Printing')
@section('description', 'Layanan UV Printing berkualitas tinggi. Cetak Akrilik, Kayu, Logam, dan material keras lainnya dengan hasil tajam dan tahan lama.')

@push('styles')
<style>
    /* Hero Section Animations */
    .hero-section {
        background: linear-gradient(135deg, #6f42c1 0%, #495057 100%);
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
        animation: uv-glow 3s ease-in-out infinite;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
    }
    
    @keyframes uv-glow {
        0%, 100% { 
            transform: translateY(0) scale(1);
            filter: drop-shadow(0 10px 20px rgba(111,66,193,0.3)) brightness(1);
        }
        50% { 
            transform: translateY(-15px) scale(1.05);
            filter: drop-shadow(0 20px 40px rgba(111,66,193,0.6)) brightness(1.2);
        }
    }
    
    /* Product Carousel Enhancements */
    .product-carousel {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }
    
    .product-carousel:hover {
        transform: translateY(-10px) perspective(1000px) rotateY(5deg);
        box-shadow: 0 30px 60px rgba(111,66,193,0.3);
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
        background: linear-gradient(90deg, transparent, rgba(111,66,193,0.4), transparent);
        transition: left 0.6s ease;
    }
    
    .animated-card:hover::before {
        left: 100%;
    }
    
    .animated-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(111,66,193,0.2);
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
        background: radial-gradient(circle, rgba(111, 66, 193, 0.1) 0%, transparent 70%);
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
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
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
        box-shadow: 0 20px 40px rgba(111,66,193,0.15);
    }
    
    .spec-icon {
        animation: uv-beam 3s ease-in-out infinite;
    }
    
    @keyframes uv-beam {
        0%, 100% { 
            transform: rotate(0deg) scale(1);
            filter: hue-rotate(0deg) brightness(1);
        }
        33% { 
            transform: rotate(120deg) scale(1.1);
            filter: hue-rotate(120deg) brightness(1.2);
        }
        66% { 
            transform: rotate(240deg) scale(1.1);
            filter: hue-rotate(240deg) brightness(1.2);
        }
    }
    
    /* Price Display */
    .price-display {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(45deg, #6f42c1, #495057);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from { filter: drop-shadow(0 0 5px rgba(111, 66, 193, 0.5)); }
        to { filter: drop-shadow(0 0 20px rgba(111, 66, 193, 0.8)); }
    }
    
    .price-breakdown {
        background: linear-gradient(145deg, #fff8e1, #f3e5f5);
        border-radius: 15px;
        padding: 20px;
        border-left: 5px solid #6f42c1;
        animation: slideInRight 0.5s ease;
    }
    
    @keyframes slideInRight {
        from { transform: translateX(50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    /* Promo Section */
    .promo-section {
        background: linear-gradient(45deg, #6f42c1, #495057, #17a2b8);
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
        content: '⚡';
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 2rem;
        animation: electric-pulse 1.5s ease-in-out infinite;
    }
    
    @keyframes electric-pulse {
        0%, 100% { 
            opacity: 0.7; 
            transform: scale(1) rotate(0deg);
            text-shadow: 0 0 10px rgba(255,255,0,0.5);
        }
        50% { 
            opacity: 1; 
            transform: scale(1.3) rotate(10deg);
            text-shadow: 0 0 20px rgba(255,255,0,1);
        }
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
        background: linear-gradient(45deg, rgba(111,66,193,0.1), rgba(73,80,87,0.1));
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .material-option:hover::before {
        transform: translateX(0);
    }
    
    .material-option:hover {
        border-color: #6f42c1;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 10px 25px rgba(111, 66, 193, 0.2);
    }
    
    .material-option.selected {
        border-color: #6f42c1;
        background: rgba(111, 66, 193, 0.1);
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
    
    .btn-dark {
        background: linear-gradient(45deg, #6f42c1, #495057);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
    }
    
    .btn-dark:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(111, 66, 193, 0.4);
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
        border-top: 2px solid #6f42c1;
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
        border-color: #ff9800;
        background-color: #fff8f0;
    }
    
    .material-option.selected {
        border-color: #ff9800;
        background-color: #fff8e1;
    }
    
    .material-sample {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        margin-right: 10px;
        border: 2px solid #ddd;
    }
    
    .material-sample.acrylic {
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3));
        border-color: #e3f2fd;
    }
    
    .material-sample.wood {
        background: linear-gradient(45deg, #8d6e63, #a1887f);
    }
    
    .material-sample.metal {
        background: linear-gradient(45deg, #90a4ae, #b0bec5);
    }
    
    .material-sample.glass {
        background: linear-gradient(45deg, rgba(173,216,230,0.3), rgba(135,206,235,0.3));
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="bg-warning text-dark py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-dark">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                        <li class="breadcrumb-item active">UV Printing</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">UV Printing</h1>
                <p class="lead">Cetak Akrilik, Kayu, Logam, dan material keras lainnya dengan hasil tajam dan tahan lama</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="bi bi-printer" style="font-size: 5rem;"></i>
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
                            <img src="https://images.unsplash.com/photo-1581833971358-2c8b550f87b3?w=500" class="d-block w-100" alt="UV Printing 1">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=500" class="d-block w-100" alt="UV Printing 2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=500" class="d-block w-100" alt="UV Printing 3">
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
                    <h5><i class="bi bi-info-circle text-warning me-2"></i>Spesifikasi UV Printing</h5>
                    <div class="row">
                        <div class="col-6">
                            <strong>Material yang Bisa Dicetak:</strong>
                            <ul class="list-unstyled ms-3">
                                <li>• Akrilik (Clear/Putih/Warna)</li>
                                <li>• Kayu (Multiplek/MDF/Solid)</li>
                                <li>• Logam (Aluminium/Stainless)</li>
                                <li>• Kaca & Cermin</li>
                                <li>• PVC & Foam Board</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <strong>Keunggulan UV Print:</strong>
                            <ul class="list-unstyled ms-3">
                                <li>• Tahan Cuaca & Air</li>
                                <li>• Warna Tajam & Cerah</li>
                                <li>• Tekstur Emboss/Raised</li>
                                <li>• Tidak Perlu Laminasi</li>
                                <li>• Hasil Instant Kering</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <strong>Aplikasi:</strong> Papan Nama, Hiasan Dinding, Souvenir, Display Product, Interior Design
                    </div>
                </div>
            </div>
            
            <!-- Order Form -->
            <div class="col-lg-6">
                <form id="orderForm" class="form-section">
                    <h4 class="mb-4"><i class="bi bi-basket text-warning me-2"></i>Form Pemesanan</h4>
                    
                    <!-- Material Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Pilih Material</label>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="material-option" onclick="selectMaterial('acrylic')">
                                    <input type="radio" name="material_type" value="acrylic" id="acrylicMaterial" hidden>
                                    <div class="d-flex align-items-center">
                                        <div class="material-sample acrylic"></div>
                                        <div>
                                            <strong>Akrilik</strong>
                                            <div class="small text-muted">Clear, Putih, Warna</div>
                                            <div class="small text-warning fw-bold">Rp 50.000/m²</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="material-option" onclick="selectMaterial('wood')">
                                    <input type="radio" name="material_type" value="wood" id="woodMaterial" hidden>
                                    <div class="d-flex align-items-center">
                                        <div class="material-sample wood"></div>
                                        <div>
                                            <strong>Kayu</strong>
                                            <div class="small text-muted">Multiplek, MDF, Solid</div>
                                            <div class="small text-warning fw-bold">Rp 35.000/m²</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="material-option" onclick="selectMaterial('metal')">
                                    <input type="radio" name="material_type" value="metal" id="metalMaterial" hidden>
                                    <div class="d-flex align-items-center">
                                        <div class="material-sample metal"></div>
                                        <div>
                                            <strong>Logam</strong>
                                            <div class="small text-muted">Aluminium, Stainless</div>
                                            <div class="small text-warning fw-bold">Rp 75.000/m²</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="material-option" onclick="selectMaterial('glass')">
                                    <input type="radio" name="material_type" value="glass" id="glassMaterial" hidden>
                                    <div class="d-flex align-items-center">
                                        <div class="material-sample glass"></div>
                                        <div>
                                            <strong>Kaca</strong>
                                            <div class="small text-muted">Kaca Bening, Cermin</div>
                                            <div class="small text-warning fw-bold">Rp 65.000/m²</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Material Options -->
                    <div id="materialOptions" style="display: none;">
                        <!-- Acrylic Options -->
                        <div id="acrylicOptions" class="material-sub-options" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jenis Akrilik</label>
                                <select name="acrylic_type" id="acrylicType" class="form-select">
                                    <option value="clear" data-price="0">Akrilik Clear - Standard</option>
                                    <option value="white" data-price="5000">Akrilik Putih - +Rp 5.000</option>
                                    <option value="colored" data-price="10000">Akrilik Warna - +Rp 10.000</option>
                                    <option value="frosted" data-price="15000">Akrilik Frosted - +Rp 15.000</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ketebalan</label>
                                <select name="acrylic_thickness" id="acrylicThickness" class="form-select">
                                    <option value="3mm" data-multiplier="1">3mm - Standard</option>
                                    <option value="5mm" data-multiplier="1.5">5mm - +50%</option>
                                    <option value="8mm" data-multiplier="2">8mm - +100%</option>
                                    <option value="10mm" data-multiplier="2.5">10mm - +150%</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Wood Options -->
                        <div id="woodOptions" class="material-sub-options" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jenis Kayu</label>
                                <select name="wood_type" id="woodType" class="form-select">
                                    <option value="mdf" data-price="0">MDF - Standard</option>
                                    <option value="multiplex" data-price="8000">Multiplek - +Rp 8.000</option>
                                    <option value="solid_pine" data-price="25000">Solid Pine - +Rp 25.000</option>
                                    <option value="solid_mahogany" data-price="50000">Solid Mahogany - +Rp 50.000</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ketebalan</label>
                                <select name="wood_thickness" id="woodThickness" class="form-select">
                                    <option value="9mm" data-multiplier="1">9mm - Standard</option>
                                    <option value="12mm" data-multiplier="1.3">12mm - +30%</option>
                                    <option value="15mm" data-multiplier="1.6">15mm - +60%</option>
                                    <option value="18mm" data-multiplier="2">18mm - +100%</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Metal Options -->
                        <div id="metalOptions" class="material-sub-options" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jenis Logam</label>
                                <select name="metal_type" id="metalType" class="form-select">
                                    <option value="aluminum" data-price="0">Aluminum - Standard</option>
                                    <option value="stainless" data-price="35000">Stainless Steel - +Rp 35.000</option>
                                    <option value="brass" data-price="60000">Brass (Kuningan) - +Rp 60.000</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ketebalan</label>
                                <select name="metal_thickness" id="metalThickness" class="form-select">
                                    <option value="1mm" data-multiplier="1">1mm - Standard</option>
                                    <option value="2mm" data-multiplier="1.5">2mm - +50%</option>
                                    <option value="3mm" data-multiplier="2">3mm - +100%</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Glass Options -->
                        <div id="glassOptions" class="material-sub-options" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jenis Kaca</label>
                                <select name="glass_type" id="glassType" class="form-select">
                                    <option value="clear" data-price="0">Kaca Bening - Standard</option>
                                    <option value="frosted" data-price="15000">Kaca Frosted - +Rp 15.000</option>
                                    <option value="mirror" data-price="20000">Cermin - +Rp 20.000</option>
                                    <option value="tempered" data-price="40000">Tempered Glass - +Rp 40.000</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ketebalan</label>
                                <select name="glass_thickness" id="glassThickness" class="form-select">
                                    <option value="5mm" data-multiplier="1">5mm - Standard</option>
                                    <option value="6mm" data-multiplier="1.2">6mm - +20%</option>
                                    <option value="8mm" data-multiplier="1.6">8mm - +60%</option>
                                    <option value="10mm" data-multiplier="2">10mm - +100%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dimensions -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ukuran Material</label>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label small">Lebar (cm)</label>
                                <input type="number" name="width" id="width" class="form-control" min="1" max="200" value="30" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label small">Tinggi (cm)</label>
                                <input type="number" name="height" id="height" class="form-control" min="1" max="300" value="40" required>
                            </div>
                        </div>
                        <div class="form-text">Ukuran maksimal: 200cm x 300cm</div>
                    </div>
                    
                    <!-- Print Quality -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kualitas Cetak</label>
                        <select name="print_quality" id="printQuality" class="form-select" required>
                            <option value="standard" data-price="0">Standard 720dpi - Gratis</option>
                            <option value="high" data-price="15000">High Quality 1440dpi - +Rp 15.000</option>
                            <option value="ultra" data-price="30000">Ultra HD 2880dpi - +Rp 30.000</option>
                        </select>
                    </div>
                    
                    <!-- Print Effects -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Efek Cetak (Opsional)</label>
                        <select name="print_effect" id="printEffect" class="form-select">
                            <option value="none" data-price="0">Tanpa Efek - Gratis</option>
                            <option value="raised" data-price="25000">Raised/Emboss Effect - +Rp 25.000</option>
                            <option value="spot_uv" data-price="35000">Spot UV Coating - +Rp 35.000</option>
                            <option value="textured" data-price="20000">Textured Finish - +Rp 20.000</option>
                            <option value="metallic" data-price="45000">Metallic Effect - +Rp 45.000</option>
                        </select>
                    </div>
                    
                    <!-- Cutting & Finishing -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Cutting & Finishing</label>
                        <select name="cutting_finishing" id="cuttingFinishing" class="form-select">
                            <option value="straight" data-price="0">Potong Lurus - Gratis</option>
                            <option value="rounded" data-price="8000">Rounded Corner - +Rp 8.000</option>
                            <option value="custom_shape" data-price="25000">Custom Shape/Logo - +Rp 25.000</option>
                            <option value="laser_cut" data-price="40000">Laser Cut Detail - +Rp 40.000</option>
                            <option value="cnc_cut" data-price="60000">CNC Cut 3D - +Rp 60.000</option>
                        </select>
                    </div>
                    
                    <!-- Mounting Options -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mounting System</label>
                        <select name="mounting" id="mounting" class="form-select">
                            <option value="none" data-price="0">Tanpa Mounting - Gratis</option>
                            <option value="adhesive" data-price="5000">3M Adhesive Tape - +Rp 5.000</option>
                            <option value="wall_bracket" data-price="15000">Wall Bracket - +Rp 15.000</option>
                            <option value="standoff" data-price="25000">Standoff Mounting - +Rp 25.000</option>
                            <option value="floating" data-price="35000">Floating Mount - +Rp 35.000</option>
                        </select>
                    </div>
                    
                    <!-- Quantity -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required>
                        <div class="form-text">Minimum order 1 pcs (Diskon quantity mulai 5 pcs)</div>
                    </div>
                    
                    <!-- File Upload -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload File Desain</label>
                        <input type="file" name="design_file" id="designFile" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.ai,.psd,.cdr,.eps,.svg" multiple>
                        <div class="form-text">Format: JPG, PNG, PDF, AI, PSD, CDR, EPS, SVG (Resolusi minimal 300dpi)</div>
                    </div>
                    
                    <!-- Notes -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Tambahan</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Instruksi khusus, warna, deadline, lokasi pemasangan, dll..."></textarea>
                    </div>
                    
                    <!-- Customer Information -->
                    <hr class="my-4">
                    <h5 class="mb-3"><i class="bi bi-person text-warning me-2"></i>Informasi Kontak</h5>
                    
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
                            <option value="local" data-cost="35000">Pengiriman Lokal Gresik (Rp 35.000)</option>
                            <option value="regional" data-cost="85000">Pengiriman Regional Jatim (Rp 85.000)</option>
                            <option value="national" data-cost="200000">Pengiriman Nasional (Rp 200.000)</option>
                            <option value="installation" data-cost="150000">Termasuk Instalasi (Rp 150.000)</option>
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
                    <h5 class="mb-3"><i class="bi bi-calculator text-warning me-2"></i>Ringkasan Harga</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Area Cetak:</span>
                        <span id="printArea">0 m²</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Harga per m²:</span>
                        <span id="pricePerSqm">Rp 0</span>
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
                        <strong class="fs-4 text-warning" id="totalPrice">Rp 0</strong>
                    </div>
                    
                    <button type="button" id="placeOrder" class="btn btn-warning btn-lg w-100 mt-3" disabled>
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
        <h3 class="text-center mb-4">Portfolio UV Printing</h3>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1581833971358-2c8b550f87b3?w=300" class="card-img-top" alt="UV Acrylic">
                    <div class="card-body text-center">
                        <h6>UV Print Akrilik</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=300" class="card-img-top" alt="UV Wood">
                    <div class="card-body text-center">
                        <h6>UV Print Kayu</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=300" class="card-img-top" alt="UV Metal">
                    <div class="card-body text-center">
                        <h6>UV Print Logam</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=300" class="card-img-top" alt="UV Glass">
                    <div class="card-body text-center">
                        <h6>UV Print Kaca</h6>
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
    // Base prices per square meter for different materials
    const materialPrices = {
        'acrylic': 50000,
        'wood': 35000,
        'metal': 75000,
        'glass': 65000
    };
    
    let currentMaterial = '';
    let appliedPromo = null;
    
    // Form elements
    const form = document.getElementById('orderForm');
    const width = document.getElementById('width');
    const height = document.getElementById('height');
    const quantity = document.getElementById('quantity');
    const shippingMethod = document.getElementById('shippingMethod');
    const promoCode = document.getElementById('promoCode');
    const applyPromo = document.getElementById('applyPromo');
    const placeOrder = document.getElementById('placeOrder');
    
    // Price display elements
    const printAreaDisplay = document.getElementById('printArea');
    const pricePerSqmDisplay = document.getElementById('pricePerSqm');
    const quantityDisplay = document.getElementById('quantityDisplay');
    const subtotalDisplay = document.getElementById('subtotal');
    const additionalCostDisplay = document.getElementById('additionalCost');
    const discountRow = document.getElementById('discountRow');
    const discountDisplay = document.getElementById('discount');
    const shippingCostDisplay = document.getElementById('shippingCost');
    const taxDisplay = document.getElementById('tax');
    const totalDisplay = document.getElementById('totalPrice');
    
    // Material selection
    window.selectMaterial = function(material) {
        // Remove previous selections
        document.querySelectorAll('.material-option').forEach(opt => opt.classList.remove('selected'));
        document.querySelectorAll('.material-sub-options').forEach(opt => opt.style.display = 'none');
        
        // Select current material
        event.currentTarget.classList.add('selected');
        document.getElementById(material + 'Material').checked = true;
        
        // Show material options
        document.getElementById('materialOptions').style.display = 'block';
        document.getElementById(material + 'Options').style.display = 'block';
        
        currentMaterial = material;
        calculatePrice();
    };
    
    // Event listeners
    [width, height, quantity, shippingMethod].forEach(element => {
        element.addEventListener('input', calculatePrice);
    });
    
    document.addEventListener('change', calculatePrice);
    
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
        if (!currentMaterial || !width.value || !height.value || !quantity.value) return;
        
        let w = parseFloat(width.value) / 100; // Convert cm to meter
        let h = parseFloat(height.value) / 100; // Convert cm to meter
        let area = w * h;
        let qty = parseInt(quantity.value);
        
        // Base price per square meter
        let basePricePerSqm = materialPrices[currentMaterial] || 0;
        
        // Calculate additional costs
        let additionalCost = 0;
        let thicknessMultiplier = 1;
        
        // Material type additional cost
        const materialTypeSelects = {
            'acrylic': document.getElementById('acrylicType'),
            'wood': document.getElementById('woodType'),
            'metal': document.getElementById('metalType'),
            'glass': document.getElementById('glassType')
        };
        
        const thicknessSelects = {
            'acrylic': document.getElementById('acrylicThickness'),
            'wood': document.getElementById('woodThickness'),
            'metal': document.getElementById('metalThickness'),
            'glass': document.getElementById('glassThickness')
        };
        
        // Material type cost
        if (materialTypeSelects[currentMaterial] && materialTypeSelects[currentMaterial].selectedOptions[0]) {
            additionalCost += parseInt(materialTypeSelects[currentMaterial].selectedOptions[0].dataset.price || 0);
        }
        
        // Thickness multiplier
        if (thicknessSelects[currentMaterial] && thicknessSelects[currentMaterial].selectedOptions[0]) {
            thicknessMultiplier = parseFloat(thicknessSelects[currentMaterial].selectedOptions[0].dataset.multiplier || 1);
        }
        
        // Print quality cost
        const printQuality = document.getElementById('printQuality');
        if (printQuality && printQuality.selectedOptions[0]) {
            additionalCost += parseInt(printQuality.selectedOptions[0].dataset.price || 0);
        }
        
        // Print effect cost
        const printEffect = document.getElementById('printEffect');
        if (printEffect && printEffect.selectedOptions[0]) {
            additionalCost += parseInt(printEffect.selectedOptions[0].dataset.price || 0);
        }
        
        // Cutting finishing cost
        const cuttingFinishing = document.getElementById('cuttingFinishing');
        if (cuttingFinishing && cuttingFinishing.selectedOptions[0]) {
            additionalCost += parseInt(cuttingFinishing.selectedOptions[0].dataset.price || 0);
        }
        
        // Mounting cost
        const mounting = document.getElementById('mounting');
        if (mounting && mounting.selectedOptions[0]) {
            additionalCost += parseInt(mounting.selectedOptions[0].dataset.price || 0);
        }
        
        // Calculate final price per square meter
        let finalPricePerSqm = (basePricePerSqm + (additionalCost / area)) * thicknessMultiplier;
        
        // Calculate subtotal
        let subtotalPerItem = finalPricePerSqm * area;
        let subtotal = subtotalPerItem * qty;
        
        // Quantity discount
        let quantityDiscount = 0;
        if (qty >= 10) quantityDiscount = 0.15;
        else if (qty >= 5) quantityDiscount = 0.10;
        
        let subtotalAfterQuantityDiscount = subtotal * (1 - quantityDiscount);
        
        // Apply promo discount
        let discount = 0;
        if (appliedPromo) {
            if (appliedPromo.type === 'percentage') {
                discount = subtotalAfterQuantityDiscount * appliedPromo.value;
            } else {
                discount = Math.min(appliedPromo.value, subtotalAfterQuantityDiscount);
            }
        }
        
        let subtotalAfterDiscount = subtotalAfterQuantityDiscount - discount;
        
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
        printAreaDisplay.textContent = area.toFixed(3) + ' m²';
        pricePerSqmDisplay.textContent = 'Rp ' + finalPricePerSqm.toLocaleString();
        quantityDisplay.textContent = qty + ' pcs';
        subtotalDisplay.textContent = 'Rp ' + subtotal.toLocaleString();
        additionalCostDisplay.textContent = 'Rp ' + (additionalCost * qty).toLocaleString();
        
        if (discount > 0 || quantityDiscount > 0) {
            discountRow.style.display = 'flex';
            let totalDiscount = (subtotal - subtotalAfterQuantityDiscount) + discount;
            discountDisplay.textContent = '- Rp ' + totalDiscount.toLocaleString();
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
        let isValid = currentMaterial !== '';
        
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
        formData.append('product_id', 3); // UV Printing product ID
        
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
                currentMaterial = '';
                document.querySelectorAll('.material-option').forEach(opt => opt.classList.remove('selected'));
                document.getElementById('materialOptions').style.display = 'none';
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
