# Troubleshooting - Mind Partner Database

## 🚨 Error: "No connection could be made because the target machine actively refused it"

### **Penyebab Error:**
Error ini terjadi karena MySQL belum berjalan di XAMPP atau ada masalah koneksi database.

### **Solusi Lengkap:**

## 🔧 **Step 1: Start XAMPP Services**

1. **Buka XAMPP Control Panel**
   - Cari dan buka XAMPP Control Panel
   - Atau buka: `C:\xampp\xampp-control.exe`

2. **Start MySQL Service**
   - Klik tombol "Start" di sebelah MySQL
   - Tunggu sampai status berubah menjadi "Running" (hijau)

3. **Start Apache Service** (Opsional)
   - Klik tombol "Start" di sebelah Apache
   - Untuk menjalankan aplikasi web

4. **Verifikasi Status**
   - Pastikan MySQL status: **Running** (hijau)
   - Pastikan Apache status: **Running** (hijau)

## 🗄️ **Step 2: Create Database**

### **Option A: Using phpMyAdmin**
1. Buka browser: `http://localhost/phpmyadmin`
2. Klik "New" atau "Baru"
3. Masukkan nama database: `mind_partner`
4. Pilih collation: `utf8mb4_unicode_ci`
5. Klik "Create" atau "Buat"

### **Option B: Using SQL File**
1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Pilih database `mind_partner` (atau buat baru)
3. Klik tab "Import" atau "Impor"
4. Upload file: `database/mind_partner.sql`
5. Klik "Go" atau "Jalankan"

## ⚙️ **Step 3: Verify .env Configuration**

Pastikan file `.env` sudah benar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mind_partner
DB_USERNAME=root
DB_PASSWORD=
```

## 🔄 **Step 4: Clear Laravel Cache**

Jalankan perintah berikut di terminal:

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

## 🚀 **Step 5: Test Connection**

### **Test dengan Migration**
```bash
php artisan migrate:status
```

### **Test dengan Seeder**
```bash
php artisan db:seed
```

## 🎯 **Step 6: Alternative Solutions**

### **Jika masih error, coba:**

1. **Restart XAMPP**
   - Stop semua service
   - Start ulang MySQL dan Apache

2. **Check Port**
   - Pastikan port 3306 tidak digunakan aplikasi lain
   - Cek di Task Manager

3. **Check Firewall**
   - Pastikan firewall tidak memblokir MySQL

4. **Manual Database Creation**
   - Buat database manual di phpMyAdmin
   - Import file SQL manual

## 📊 **Verification Steps**

### **Check Database Connection**
1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Pastikan database `mind_partner` ada
3. Pastikan tabel-tabel sudah terbuat:
   - `users`
   - `mental_health_assessments`
   - `journal_entries`
   - `sessions`
   - `password_reset_tokens`
   - `migrations`

### **Check Admin User**
1. Buka tabel `users`
2. Pastikan ada user dengan email: `admin123@gmail.com`
3. Password hash: `$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi`

## 🔐 **Login Credentials**

### **Admin User**
- **Email**: `admin123@gmail.com`
- **Password**: `admin123`
- **Role**: Admin

### **Sample User**
- **Email**: `john@example.com`
- **Password**: `password`
- **Role**: User

## 🆘 **Jika Masih Error**

### **Contact Support**
1. Pastikan XAMPP versi terbaru
2. Cek log error di XAMPP
3. Restart komputer jika perlu
4. Reinstall XAMPP jika masih bermasalah

### **Alternative Database**
Jika MySQL bermasalah, bisa gunakan SQLite sementara:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
``` 