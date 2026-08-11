# CodeIgniter 3 - HMVC & Blade

Proyek ini adalah modifikasi tingkat lanjut dari framework CodeIgniter 3 yang dioptimalkan untuk berjalan di **PHP 8.0.x**. Boilerplate ini mengusung arsitektur **HMVC**, **Blade Template Engine**, dan berbagai fitur modern ala Laravel (seperti Migrations, UUID, Collections, dan Auth Facade) tanpa meninggalkan performa ringan khas CI3.

## 🚀 Fitur Utama

- **HMVC Architecture:** Pemisahan modul yang terstruktur.
- **Blade Template Engine:** Render *view* dengan sintaks yang elegan dan mewarisi tata letak (Layouts) khas Laravel.
- **Ramsey UUID (v4):** Dukungan penuh untuk Primary Key berbasis UUID string (36 karakter) yang anti-tabrakan.
- **Laravel-like Migrations & Seeders:** Eksekusi migrasi database lewat Command Line (CLI).
- **Modern Validator & Collections:** Manipulasi data array/object dan validasi request yang bersih dari *spaghetti code*.

## 🛠️ Persyaratan Sistem

- **PHP:** `^8.0.0` (Direkomendasikan `8.0.30` atau lebih baru)
- **Composer**
- **Web Server:** Apache (dengan `mod_rewrite`) atau Nginx (PHP-FPM)
- **Database:** MySQL / MariaDB

## 📦 Instalasi

1. Kloning repositori ini ke dalam direktori *server* lokal Anda (misal: `htdocs` atau `www`).
2. Buka terminal di direktori proyek dan jalankan perintah:
   ```bash
   composer install
   ```
3. Sesuaikan konfigurasi database Anda di:
   `application/config/database.php`
4. **Penting (Konfigurasi Web Server):** 
   Pastikan Anda menggunakan `.htaccess` berikut di root direktori agar *routing* HMVC terbaca sempurna oleh PHP-FPM:
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine On
       RewriteBase /
       
       RewriteCond %{REQUEST_FILENAME} !-f
       RewriteCond %{REQUEST_FILENAME} !-d
       RewriteRule ^(.*)$ index.php?/$1 [L,QSA]
   </IfModule>
   ```

## 💻 Penggunaan Dasar (Basic Usage)

### 1. Merender Blade View
Berkat integrasi Blade, Anda tidak perlu lagi menggunakan `$this->load->view()`. Gunakan sintaks Blade untuk me-render halaman.

```php
public function index()
{
    $data = ['title' => 'Dashboard', 'user' => 'John Doe'];
    
    // Asumsi file berada di application/views/admin/dashboard.blade.php
    return view('admin.dashboard', $data);
}
```

### 2. Menggunakan UUID pada Model
Sistem ini menggunakan `ramsey/uuid`. Model yang mewarisi konfigurasi UUID akan otomatis membuatkan ID saat fungsi `create()` dipanggil.

```php
$this->load->model('M_User');

$user = $this->M_User->create([
    'name'  => 'Budi',
    'email' => 'budi@example.com'
]);

echo $user->id; // Output: 123e4567-e89b-12d3-a456-426614174000
```

### 3. Middleware & Auth Facade
Pengecekan otentikasi di konstruktor Controller kini lebih deklaratif layaknya Laravel.

```php
public function __construct()
{
    parent::__construct();
    
    // Melindungi seluruh controller ini (hanya untuk user yang login)
    $this->middleware('auth');
}

public function profil()
{
    // Mengambil data user yang sedang login secara statis
    $nama = Auth::user()->name;
}
```

## 🗄️ Database Migrations & Seeding (via CLI)

Alih-alih menggunakan antarmuka web, Anda dapat mengeksekusi struktur database langsung dari terminal. Buka terminal di *root* proyek (sejajar dengan `index.php`).

### Menjalankan Migration
Karena arsitektur menggunakan HMVC, panggil nama modul dan controllernya secara spesifik:

```bash
php index.php migrate/migrate index
```
*(Perintah ini akan membaca semua file di dalam folder `application/migrations/` dan mengeksekusinya ke dalam database).*

### Menjalankan Seeder
Untuk memasukkan data awal (*dummy data*) seperti akun Administrator:

```bash
php index.php seeder index
```

## 📂 Struktur Direktori Penting

```text
├── application/
│   ├── config/          # Konfigurasi utama CI3, Database, dan Routes
│   ├── core/            # MY_Controller, MY_Model (Base classes)
│   ├── libraries/       # Auth, Validator, Collection custom classes
│   ├── middlewares/     # Tempat meletakkan class Middleware
│   ├── migrations/      # File database migrations (Timestamp format)
│   ├── modules/         # Modul-modul HMVC (Controllers, Models, Views spesifik)
│   └── views/           # File template global (.blade.php)
├── vendor/              # Dependencies (Ramsey UUID, dll)
├── .htaccess            # Aturan rewrite URL
├── composer.json        # Manifest proyek
└── index.php            # Entry point aplikasi
```

## 📄 Lisensi
Framework ini berlisensi MIT. Silakan dimodifikasi dan didistribusikan sesuai kebutuhan proyek, instansi, atau perusahaan Anda.