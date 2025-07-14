# Job Seekers API - Laravel

Aplikasi API untuk sistem pencari kerja yang dibangun dengan Laravel. Aplikasi ini memungkinkan masyarakat untuk mendaftar, melakukan validasi data, mencari lowongan kerja, dan melamar pekerjaan.

## Nama Kelompok:

-   3012310010 Faiz Nurullah
-   3012310023 Muhammad Muqoffin Nuha
-   3012310005 Ari Setia Hinanda

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

**Login Response:**

```json
{
    "name": "User Name",
    "born_date": "1990-01-01",
    "gender": "male",
    "address": "User Address",
    "token": "generated_token",
    "regional": {
        "id": 1,
        "province": "Province Name",
        "district": "District Name"
    }
}
```

### Validation Routes

| Method | Endpoint       | Description                | Body Parameters                                                         |
| ------ | -------------- | -------------------------- | ----------------------------------------------------------------------- |
| POST   | `/validation`  | Submit validation request  | `job_category_id`, `work_experience`, `job_position`, `reason_accepted` |
| GET    | `/validations` | Get user validation status | Query: `token`                                                          |

**Submit Validation Example:**

```bash
curl -X POST "http://127.0.0.1:8000/api/v1/validation?token=YOUR_TOKEN" \
  -F "job_category_id=1" \
  -F "work_experience=5 years in web development" \
  -F "job_position=Senior Developer" \
  -F "reason_accepted=Experienced in multiple technologies"
```

**Validation Response:**

```json
{
    "validation": {
        "id": 1,
        "status": "pending", // pending, accepted, declined
        "work_experience": "5 years in web development",
        "job_category_id": 1,
        "job_position": "Senior Developer",
        "reason_accepted": "Experienced in multiple technologies",
        "validator_notes": null,
        "validator": null
    }
}
```

### Job Vacancy Routes

| Method | Endpoint              | Description              | Body Parameters |
| ------ | --------------------- | ------------------------ | --------------- |
| GET    | `/job_vacancies`      | Get all job vacancies    | Query: `token`  |
| GET    | `/job_vacancies/{id}` | Get specific job vacancy | Query: `token`  |

**Job Vacancies Response:**

```json
{
    "vacancies": [
        {
            "id": 1,
            "category": {
                "id": 1,
                "job_category": "Computing and ICT"
            },
            "company": "PT. Tech Solutions Indonesia",
            "address": "Jl. Sudirman No. 123, Jakarta Pusat",
            "description": "Job description...",
            "available_position": [
                {
                    "position": "Web Developer",
                    "capacity": 3,
                    "apply_capacity": 15,
                    "apply_count": 2
                }
            ]
        }
    ]
}
```

### Application Routes

| Method | Endpoint        | Description           | Body Parameters                      |
| ------ | --------------- | --------------------- | ------------------------------------ |
| POST   | `/applications` | Apply for job         | `vacancy_id`, `positions[]`, `notes` |
| GET    | `/applications` | Get user applications | Query: `token`                       |

**Apply for Job Example:**

```bash
curl -X POST "http://127.0.0.1:8000/api/v1/applications?token=YOUR_TOKEN" \
  -F "vacancy_id=1" \
  -F "positions[]=1" \
  -F "positions[]=2" \
  -F "notes=I am very interested in this position"
```

**Applications Response:**

```json
{
    "vacancies": [
        {
            "id": 1,
            "category": {
                "id": 1,
                "job_category": "Computing and ICT"
            },
            "company": "PT. Tech Solutions Indonesia",
            "address": "Jl. Sudirman No. 123, Jakarta Pusat",
            "position": [
                {
                    "position": "Web Developer",
                    "apply_status": "pending",
                    "notes": "Application notes"
                }
            ]
        }
    ]
}
```

## Business Rules

1. **Validation Required**: User harus memiliki status validasi "accepted" untuk dapat mengakses lowongan kerja dan melamar pekerjaan
2. **Single Application**: User hanya dapat melamar sekali per lowongan kerja
3. **Token Authentication**: Semua endpoint yang protected memerlukan token yang valid
4. **Data Validation**: Semua input data divalidasi sesuai dengan aturan bisnis

## Error Responses

### Common Error Responses:

**Unauthorized:**

```json
{
    "message": "Unauthorized user"
}
```

**Validation Not Accepted:**

```json
{
    "message": "Your data validator must be accepted by validator before"
}
```

**Duplicate Application:**

```json
{
    "message": "Application for a job can only be once"
}
```

**Duplicate Validation:**

```json
{
    "message": "You have already submitted a validation request"
}
```

## Testing

Proyek ini dilengkapi dengan script testing API:

```bash
# Jalankan test script
chmod +x test_api.sh
./test_api.sh
```

Test script akan menguji semua endpoint API dengan berbagai skenario termasuk:

-   Authentication (login/logout)
-   Validation submission dan retrieval
-   Job vacancy access
-   Job application submission

## Database Schema

### Main Tables:

-   `users` - Data pengguna sistem
-   `societies` - Data masyarakat pencari kerja
-   `job_categories` - Kategori pekerjaan
-   `job_vacancies` - Lowongan kerja
-   `available_positions` - Posisi yang tersedia
-   `validations` - Data validasi masyarakat
-   `validators` - Data validator
-   `regionals` - Data regional (provinsi/kabupaten)
-   `job_apply_societies` - Aplikasi kerja dari masyarakat
-   `job_apply_positions` - Detail posisi yang dilamar

## Development Notes

-   API menggunakan token-based authentication yang disimpan di field `login_tokens` pada tabel `societies`
-   Semua endpoint API berada di grup `/api/v1`
-   Middleware `auth.api` digunakan untuk proteksi endpoint
-   Response format konsisten menggunakan JSON

## Troubleshooting

### Common Issues:

1. **Database Connection Error**: Pastikan konfigurasi database di `.env` sudah benar
2. **Permission Error**: Pastikan folder `storage` dan `bootstrap/cache` memiliki permission write
3. **Token Invalid**: Pastikan menggunakan token yang benar dari response login
4. **Validation Error**: Pastikan user sudah memiliki status validasi "accepted"

### Debug Mode:

Untuk debugging, set `APP_DEBUG=true` di file `.env`
