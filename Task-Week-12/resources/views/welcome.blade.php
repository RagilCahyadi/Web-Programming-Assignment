<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Manajemen Data</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f5f5f5;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                background: white;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                padding: 40px;
            }
            h1 {
                text-align: center;
                color: #333;
                margin-bottom: 30px;
            }
            .menu-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 20px;
                margin-top: 30px;
            }
            .menu-item {
                display: block;
                padding: 20px;
                background: #f8f9fa;
                border: 2px solid #e9ecef;
                border-radius: 8px;
                text-decoration: none;
                color: #495057;
                transition: all 0.3s ease;
            }
            .menu-item:hover {
                background: #007bff;
                color: white;
                border-color: #007bff;
                transform: translateY(-2px);
            }
            .menu-title {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 5px;
            }
            .menu-desc {
                font-size: 14px;
                opacity: 0.8;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Sistem Manajemen Data</h1>
            <p style="text-align: center; color: #666; margin-bottom: 40px;">
                Pilih menu di bawah ini untuk mengakses fitur yang tersedia
            </p>
            
            <div class="menu-grid">
                <a href="{{ route('kontaks.index') }}" class="menu-item">
                    <div class="menu-title">📞 Manajemen Kontak</div>
                    <div class="menu-desc">Kelola data kontak dan informasi komunikasi</div>
                </a>

                <a href="{{ route('mahasiswa.index') }}" class="menu-item">
                    <div class="menu-title">🎓 Data Mahasiswa</div>
                    <div class="menu-desc">Sistem informasi dan manajemen data mahasiswa</div>
                </a>

                <a href="{{ route('buku.index') }}" class="menu-item">
                    <div class="menu-title">📚 Katalog Buku</div>
                    <div class="menu-desc">Manajemen katalog dan inventori buku</div>
                </a>

                <a href="{{ route('bengkel.index') }}" class="menu-item">
                    <div class="menu-title">🔧 Data Bengkel</div>
                    <div class="menu-desc">Informasi dan manajemen data bengkel</div>
                </a>
            </div>
        </div>
    </body>
</html>
