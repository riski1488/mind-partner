# Database Setup - Mind Partner

## 🗄️ Database Configuration

### Prerequisites
- XAMPP dengan MySQL/MariaDB
- phpMyAdmin

### Step 1: Create Database
1. Buka phpMyAdmin (http://localhost/phpmyadmin)
2. Klik "New" atau "Baru"
3. Masukkan nama database: `mind_partner`
4. Pilih collation: `utf8mb4_unicode_ci`
5. Klik "Create" atau "Buat"

### Step 2: Import Database
**Option A: Using SQL File**
1. Buka phpMyAdmin
2. Pilih database `mind_partner`
3. Klik tab "Import" atau "Impor"
4. Upload file `database/mind_partner.sql`
5. Klik "Go" atau "Jalankan"

**Option B: Using Laravel Migration**
```bash
php artisan migrate:fresh --seed
```

### Step 3: Verify Database
Setelah import, Anda akan memiliki:
- ✅ Database `mind_partner`
- ✅ Tabel `users`, `mental_health_assessments`, `journal_entries`
- ✅ Admin user: `admin123@gmail.com` / `admin123`
- ✅ Sample user: `john@example.com` / `password`
- ✅ Sample data (assessments dan journals)

## 🔐 Login Credentials

### Admin User
- **Email**: `admin123@gmail.com`
- **Password**: `admin123`
- **Role**: Admin

### Sample User
- **Email**: `john@example.com`
- **Password**: `password`
- **Role**: User

## 📊 Database Structure

### Tables
1. **users** - User management dengan role
2. **mental_health_assessments** - Assessment data
3. **journal_entries** - Journal entries dengan mood tracking
4. **sessions** - User sessions
5. **password_reset_tokens** - Password reset tokens
6. **migrations** - Migration records

### Relationships
- User hasMany Assessments
- User hasMany JournalEntries
- Assessment belongsTo User
- JournalEntry belongsTo User

## 🚀 Getting Started

1. **Start XAMPP**
   - Start Apache dan MySQL

2. **Configure .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mind_partner
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Run Application**
   ```bash
   php artisan serve
   ```

4. **Access Application**
   - URL: http://localhost:8000
   - Login sebagai admin: `admin123@gmail.com` / `admin123`

## 🔧 Troubleshooting

### Connection Issues
- Pastikan MySQL berjalan di XAMPP
- Periksa kredensial database di .env
- Pastikan database `mind_partner` sudah dibuat

### Migration Issues
- Hapus database dan buat ulang jika ada error
- Jalankan `php artisan migrate:fresh --seed`

### Permission Issues
- Pastikan folder `storage` dan `bootstrap/cache` writable
- Jalankan `php artisan storage:link` jika diperlukan 