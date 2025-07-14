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

## Fitur Utama

-   **Autentikasi**: Login dan logout dengan token-based authentication
-   **Validasi Data**: Sistem validasi data masyarakat oleh validator
-   **Lowongan Kerja**: Melihat dan mencari lowongan kerja yang tersedia
-   **Aplikasi Kerja**: Melamar pekerjaan untuk posisi yang diinginkan
-   **Manajemen Regional**: Sistem regional provinsi dan kabupaten

## Requirements

-   PHP >= 8.1
-   Composer
-   MySQL/MariaDB
-   Node.js & NPM (untuk frontend assets)

## Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd Tugas-Pemrograman-Web
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies (jika diperlukan)
npm install
```

### 3. Environment Configuration

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_seekers
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Setup

```bash
# Buat database
CREATE DATABASE job_seekers;

# Jalankan migrasi
php artisan migrate

# Jalankan seeder (optional, untuk data dummy)
php artisan db:seed
```

### 6. Import Database (Alternative)

Jika tersedia file `db-dump.sql`:

```bash
mysql -u your_username -p job_seekers < db-dump.sql
```

### 7. Jalankan Server

```bash
# Development server
php artisan serve

# Server akan berjalan di http://127.0.0.1:8000
```

### 8. Build Assets (Jika diperlukan)

```bash
# Development
npm run dev

# Production
npm run build
```

## API Documentation

Base URL: `http://127.0.0.1:8000/api/v1`

### Authentication Routes

| Method | Endpoint       | Description | Body Parameters              |
| ------ | -------------- | ----------- | ---------------------------- |
| POST   | `/auth/login`  | Login user  | `id_card_number`, `password` |
| POST   | `/auth/logout` | Logout user | Query: `token`               |