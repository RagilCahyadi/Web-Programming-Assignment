<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## JOB SEEKER PLATFORM

## 👥 Daftar Anggota Kelompok  

- **1**: **Muhammad Amirun Nadhif** (3012310019)
- **2**: **Rahmansyah Ragil Cahyadi** (3012310034)  
- **3**: **Ruziqna Hadikafilardi Muhtarom** (3012310039)

## 🚀 Tutorial Instalasi

### 1. Clone Repository

#### Metode 1: Clone Seluruh Repository (Direkomendasikan)
```bash
git clone https://github.com/RagilCahyadi/Web-Programming-Assignment.git
cd Web-Programming-Assignment/Kuis2
```

#### Metode 2: Clone dengan Sparse Checkout (Hanya folder Task-Week-12)
```bash
git clone --filter=blob:none --sparse https://github.com/RagilCahyadi/Web-Programming-Assignment.git
cd Web-Programming-Assignment
git sparse-checkout set Kuis2
cd Kuis2
```

#### Metode 3: Download ZIP
Jika tidak ingin menggunakan Git:
1. Kunjungi: https://github.com/RagilCahyadi/Web-Programming-Assignment
2. Klik tombol **Code** → **Download ZIP**
3. Extract file ZIP
4. Masuk ke folder `Kuis2`

### 1. Install Dependencies

#### Install PHP Dependencies
```bash
composer install
```

### 2. Konfigurasi Environment

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

### 3. Setup Database

#### Jalankan migrasi
```bash
php artisan migrate
```

#### Jalankan seeder
```bash
php artisan db:seed
```
### 4. Jalankan Aplikasi

#### Development Server
```bash
php artisan serve
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

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
