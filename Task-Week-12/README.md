# Aplikasi Laravel - Sistem Manajemen Data

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 👥 Daftar Anggota Kelompok  

- **1**: **Muhammad Amirun Nadhif** (3012310019)
- **2**: **Rahmansyah Ragil Cahyadi** (3012310034)  
- **3**: **Ruziqna Hadikafilardi Muhtarom** (3012310039)

## 📋 Deskripsi Aplikasi

Aplikasi web berbasis Laravel 12 yang menyediakan sistem manajemen data untuk:
- **Kontak** - Manajemen data kontak
- **Mahasiswa** - Sistem informasi mahasiswa  
- **Buku** - Katalog dan manajemen buku
- **Bengkel** - Informasi bengkel

Aplikasi ini menggunakan modular architecture dengan Laravel Modules dan dilengkapi dengan Tailwind CSS untuk antarmuka yang modern.

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12
- **Frontend**: Blade Templates + Tailwind CSS 4
- **Database**: MySQL/PostgreSQL/SQLite (configurable)
- **Build Tool**: Vite 6
- **Package Manager**: Composer + NPM
- **Modular Architecture**: Laravel Modules (nwidart/laravel-modules)

## 📋 Persyaratan Sistem

Pastikan sistem Anda memiliki persyaratan berikut sebelum instalasi:

- **PHP**: >= 8.2
- **Composer**: >= 2.0
- **Node.js**: >= 18
- **NPM**: >= 9
- **Database**: MySQL >= 8.0 / PostgreSQL >= 13 / SQLite
- **Web Server**: Apache/Nginx (untuk production)

## 🚀 Tutorial Instalasi

### 1. Clone Repository

#### Metode 1: Clone Seluruh Repository (Direkomendasikan)
```bash
git clone https://github.com/RagilCahyadi/Web-Programming-Assignment.git
cd Web-Programming-Assignment/Task-Week-12
```

#### Metode 2: Clone dengan Sparse Checkout (Hanya folder Task-Week-12)
```bash
git clone --filter=blob:none --sparse https://github.com/RagilCahyadi/Web-Programming-Assignment.git
cd Web-Programming-Assignment
git sparse-checkout set Task-Week-12
cd Task-Week-12
```

#### Metode 3: Download ZIP
Jika tidak ingin menggunakan Git:
1. Kunjungi: https://github.com/RagilCahyadi/Web-Programming-Assignment
2. Klik tombol **Code** → **Download ZIP**
3. Extract file ZIP
4. Masuk ke folder `Task-Week-12`

### 2. Install Dependencies

#### Install PHP Dependencies
```bash
composer install
```

#### Install Node.js Dependencies
```bash
npm install
```

### 3. Konfigurasi Environment

#### Copy file environment
```bash
cp .env.example .env
```

#### Generate Application Key
```bash
php artisan key:generate
```

#### Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

### 4. Setup Database

#### Buat database baru (MySQL)
```sql
CREATE DATABASE nama_database_anda;
```

#### Jalankan migrasi
```bash
php artisan migrate
```

#### Jalankan seeder (opsional)
```bash
php artisan db:seed
```

### 5. Build Assets

#### Development mode
```bash
npm run dev
```

#### Production mode
```bash
npm run build
```

### 6. Jalankan Aplikasi

#### Development Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

#### Dengan Vite Hot Reload (Development)
Buka terminal kedua dan jalankan:
```bash
npm run dev
```

## 🔧 Konfigurasi Tambahan

### Storage Link
```bash
php artisan storage:link
```

### Clear Cache (jika diperlukan)
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```  

## 🔗 Links

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Modules Documentation](https://nwidart.com/laravel-modules/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
