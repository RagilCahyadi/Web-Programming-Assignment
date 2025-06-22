# Aplikasi Laravel - Sistem Manajemen Data

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 📋 Deskripsi Aplikasi

Aplikasi web berbasis Laravel 12 yang menyediakan sistem manajemen data untuk:
- **Kontak** - Manajemen data kontak
- **Mahasiswa** - Sistem informasi mahasiswa  
- **Buku** - Katalog dan manajemen buku
- **Bengkel** - Informasi bengkel

Aplikasi ini menggunakan modular architecture dengan Laravel Modules dan dilengkapi dengan Tailwind CSS untuk antarmuka yang modern.

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12.x
- **Frontend**: Blade Templates + Tailwind CSS 4.x
- **Database**: MySQL/PostgreSQL/SQLite (configurable)
- **Build Tool**: Vite 6.x
- **Package Manager**: Composer + NPM
- **Modular Architecture**: Laravel Modules (nwidart/laravel-modules)

## 📋 Persyaratan Sistem

Pastikan sistem Anda memiliki persyaratan berikut sebelum instalasi:

- **PHP**: >= 8.2
- **Composer**: >= 2.0
- **Node.js**: >= 18.x
- **NPM**: >= 9.x
- **Database**: MySQL >= 8.0 / PostgreSQL >= 13 / SQLite
- **Web Server**: Apache/Nginx (untuk production)

## 🚀 Tutorial Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/aplikasi-laravel.git
cd aplikasi-laravel
```

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

### Module Commands
Aplikasi ini menggunakan Laravel Modules. Beberapa command yang berguna:

```bash
# List semua modules
php artisan module:list

# Enable module
php artisan module:enable ModuleName

# Disable module
php artisan module:disable ModuleName
```

## 📁 Struktur Direktori

```
├── app/                    # Core aplikasi
│   ├── Http/Controllers/   # Controllers
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── Modules/               # Modular components
│   └── Pendaftaran/       # Module pendaftaran
├── database/              # Database files
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── resources/             # Frontend resources
│   ├── views/            # Blade templates
│   ├── css/              # Stylesheets
│   └── js/               # JavaScript files
├── routes/                # Route definitions
└── public/               # Public assets
```

## 🌐 Deployment ke Production

### 1. Server Requirements
- PHP 8.2+ dengan extensions yang diperlukan
- Composer
- Node.js & NPM
- Web server (Apache/Nginx)
- Database server

### 2. Environment Production
```bash
# Set environment ke production
APP_ENV=production
APP_DEBUG=false

# Build assets untuk production
npm run build

# Optimize aplikasi
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Web Server Configuration

#### Apache (.htaccess sudah tersedia)
Pastikan mod_rewrite aktif dan document root menuju ke folder `public/`

#### Nginx
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/your/project/public;
    
    index index.php index.html;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## 🐛 Troubleshooting

### Permission Issues (Linux/Mac)
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Composer Issues
```bash
composer dump-autoload
composer install --no-dev --optimize-autoloader
```

### NPM Issues
```bash
rm -rf node_modules package-lock.json
npm install
```

## 📝 Contributing

1. Fork repository
2. Buat branch feature (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add some amazing feature'`)
4. Push ke branch (`git push origin feature/amazing-feature`)
5. Buat Pull Request

## 📄 License

Aplikasi ini menggunakan lisensi [MIT License](https://opensource.org/licenses/MIT).

## 👥 Tim Pengembang

- **Developer**: [Nama Anda]
- **Email**: [email@example.com]
- **GitHub**: [username]

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
