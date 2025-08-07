# 🧠 Mind Partner - Platform Kesehatan Mental

## 📋 Tentang Mind Partner

**Mind Partner** adalah platform web berbasis Laravel yang dirancang untuk membantu pengguna memantau dan mengelola kesehatan mental mereka. Platform ini menyediakan berbagai fitur yang mendukung perjalanan kesehatan mental pengguna melalui assessment mental, jurnal harian, dan sistem monitoring yang komprehensif.

### 🎯 Latar Belakang Studi Kasus

Di era modern yang penuh tekanan, kesehatan mental menjadi aspek penting yang sering terabaikan. Banyak orang mengalami stres, kecemasan, dan masalah mental lainnya tanpa memiliki sarana yang tepat untuk memantau dan mengelola kondisi mereka. Mind Partner hadir sebagai solusi digital yang memberikan:

- **Pemantauan Rutin**: Assessment berkala untuk mengukur kondisi mental
- **Jurnal Reflektif**: Ruang untuk menulis dan merefleksikan perasaan harian
- **Sistem Tracking**: Melacak perubahan mood dan kondisi mental dari waktu ke waktu
- **Akses Mudah**: Platform yang user-friendly untuk semua kalangan

Platform ini dirancang dengan pendekatan yang holistik, mengintegrasikan aspek psikologis dengan teknologi modern untuk memberikan pengalaman yang mendukung perjalanan kesehatan mental pengguna.

## ✨ Fitur Utama

### 👤 Fitur Pengguna (User)
- **Dashboard Personal**: Tampilan ringkasan kondisi mental dan aktivitas terbaru
- **Mental Health Assessment**: 
  - Assessment berkala untuk mengukur kondisi mental
  - Kategori assessment yang beragam (Stres, Kecemasan, Depresi, dll)
  - Sistem scoring dan interpretasi hasil
  - Filter berdasarkan kategori, status, dan pencarian
- **Jurnal Harian**:
  - Menulis jurnal dengan mood tracking
  - Opsi privasi (publik/pribadi)
  - Filter berdasarkan mood, privasi, tanggal, dan pencarian
  - Sistem kategori jurnal
- **Profil Pengguna**:
  - Edit informasi personal (nama, email, telepon, tanggal lahir, gender)
  - Ubah password dengan validasi keamanan
  - Sistem logout otomatis jika email/password berubah

### 🔧 Fitur Admin
- **Dashboard Admin**: Overview sistem dan statistik pengguna
- **Kelola Pengguna**:
  - Lihat daftar semua pengguna
  - Edit informasi pengguna (nama, role)
  - Hapus pengguna
- **Kelola Assessment**:
  - Lihat semua assessment dari pengguna
  - Edit detail assessment
  - Hapus assessment
- **Kelola Jurnal**:
  - Lihat semua jurnal dari pengguna
  - Edit status privasi jurnal
  - Hapus jurnal

### 🔐 Sistem Autentikasi
- **Registrasi**: Pendaftaran dengan validasi lengkap
- **Login**: Sistem login dengan remember me
- **Logout**: Logout aman dengan invalidasi session
- **Role-based Access**: Pembedaan akses user dan admin

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP Framework)
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel's built-in authentication
- **Icons**: FontAwesome
- **Development**: XAMPP (Apache, MySQL, PHP)

## 📦 Cara Instalasi

### Prerequisites
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL
- XAMPP (atau server web lainnya)

### Langkah-langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/riski1488/mind-partner.git
   cd mind-partner
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   - Buat database MySQL baru
   - Edit file `.env` dan sesuaikan konfigurasi database:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=mind_partner
     DB_USERNAME=root
     DB_PASSWORD=
     ```

5. **Jalankan Migration**
   ```bash
   php artisan migrate
   ```

6. **Seed Database (Opsional)**
   ```bash
   php artisan db:seed
   ```

7. **Setup Storage**
   ```bash
   php artisan storage:link
   ```

8. **Jalankan Server**
   ```bash
   php artisan serve
   ```

9. **Akses Aplikasi**
   - Buka browser dan akses: `http://localhost:8000`

## 👨‍💼 Cara Login sebagai Admin

### Data Admin Default
Platform ini sudah dilengkapi dengan data admin default yang dapat digunakan untuk testing:

**Email**: `admin123@gmail.com`  
**Password**: `admin123`

### Langkah Login Admin
1. Buka halaman login: `http://localhost:8000/login`
2. Masukkan email: `admin123@gmail.com`
3. Masukkan password: `admin123`
4. Klik tombol "Login"
5. Setelah login berhasil, Anda akan diarahkan ke dashboard admin
6. Di sidebar akan muncul menu "Admin" dengan sub-menu:
   - Dashboard
   - Kelola Pengguna
   - Kelola Assessment
   - Kelola Jurnal

### Fitur Admin yang Tersedia
- **Dashboard**: Overview statistik pengguna dan aktivitas
- **Kelola Pengguna**: CRUD operasi untuk manajemen user
- **Kelola Assessment**: Monitoring dan manajemen assessment mental
- **Kelola Jurnal**: Pengelolaan jurnal harian pengguna

## 📁 Struktur Proyek

```
mind-partner/
├── app/
│   ├── Http/Controllers/     # Controller untuk handling request
│   ├── Models/              # Eloquent models
│   └── Policies/            # Authorization policies
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   └── views/              # Blade templates
├── routes/
│   └── web.php             # Web routes
└── public/                 # Public assets
```

## 🔧 Konfigurasi Tambahan

### Clear Cache (Jika Ada Masalah)
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Reset Database (Untuk Development)
```bash
php artisan migrate:fresh --seed
```

## 📞 Support

Jika mengalami masalah atau memiliki pertanyaan, silakan:
1. Buat issue di repository GitHub
2. Hubungi developer melalui email yang tertera di profil

## 📄 License

Proyek ini dikembangkan untuk tujuan edukasi dan pengembangan aplikasi kesehatan mental.

---

**Mind Partner** - Mendampingi Perjalanan Kesehatan Mental Anda 🧠💙
