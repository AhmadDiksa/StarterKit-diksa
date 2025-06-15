## Dokumentasi Teknis

### Struktur Folder

- `app/Http/Controllers`  
  Berisi controller utama, seperti [`BeritaController`](app/Http/Controllers/BeritaController.php), [`PublicController`](app/Http/Controllers/PublicController.php), dan controller admin.
- `app/Models`  
  Model Eloquent, misal [`Berita`](app/Models/Berita.php), User, Category.
- `resources/views`  
  Blade template untuk tampilan publik (`public/`), dashboard admin (`admin/`), dan berita (`berita/`).
- `routes/web.php`  
  Semua rute aplikasi, termasuk rute publik, dashboard, berita, user, kategori, dan autentikasi.
- `database/migrations`  
  Migrasi database, misal [2025_06_15_002610_create_beritas_table.php](database/migrations/2025_06_15_002610_create_beritas_table.php).
- `database/seeders`  
  Seeder data awal, misal [`DatabaseSeeder`](database/seeders/DatabaseSeeder.php).

### Alur Fitur Utama

#### 1. Manajemen Berita

- **Menulis Berita:**  
  Wartawan/Admin dapat menulis berita melalui form di [`resources/views/berita/create.blade.php`](resources/views/berita/create.blade.php). Data disimpan oleh [`BeritaController@store`](app/Http/Controllers/BeritaController.php).
- **Approval Berita:**  
  Editor/Admin dapat approve/reject berita melalui tombol di [`resources/views/berita/index.blade.php`](resources/views/berita/index.blade.php) yang memanggil [`BeritaController@approve`](app/Http/Controllers/BeritaController.php) dan [`BeritaController@reject`](app/Http/Controllers/BeritaController.php).
- **Tampilan Publik:**  
  Berita yang sudah publish ditampilkan di halaman utama oleh [`PublicController@index`](app/Http/Controllers/PublicController.php) dan detailnya oleh [`PublicController@show`](app/Http/Controllers/PublicController.php).

#### 2. Manajemen User & Role

- **Role & Permission:**  
  Menggunakan package [spatie/laravel-permission](https://github.com/spatie/laravel-permission).  
  Middleware role sudah di-alias di [`bootstrap/app.php`](bootstrap/app.php).
- **Manajemen User:**  
  Hanya Admin yang dapat mengakses menu user di dashboard ([`config/adminlte.php`](config/adminlte.php)).  
  Form edit user dan role ada di [`resources/views/admin/users/edit.blade.php`](resources/views/admin/users/edit.blade.php).

#### 3. Manajemen Kategori

- **CRUD Kategori:**  
  Hanya Admin yang dapat mengelola kategori melalui menu di dashboard.  
  Rute dan controller: [`CategoryController`](app/Http/Controllers/CategoryController.php).

#### 4. Autentikasi & Socialite

- **Autentikasi:**  
  Menggunakan Laravel Breeze (login, register, reset password).
- **Socialite:**  
  Login dengan Google/Github tersedia di rute `/auth/redirect/{provider}` dan `/auth/callback/{provider}` ([`routes/web.php`](routes/web.php)).

### Rute Penting

- Publik: `/`, `/berita/{slug}`, `/kategori/{category:slug}`
- Dashboard: `/dashboard`
- Berita: `/berita`, `/berita/new/create`, `/berita/{id}/edit`
- User: `/users`
- Kategori: `/kategori`

### Migrasi & Seeder

- Struktur tabel berita: [2025_06_15_002610_create_beritas_table.php](database/migrations/2025_06_15_002610_create_beritas_table.php)
- Seeder role, kategori, dan user dummy dapat diaktifkan di [`DatabaseSeeder`](database/seeders/DatabaseSeeder.php).

### Konfigurasi Tambahan

- Konfigurasi AdminLTE: [`config/adminlte.php`](config/adminlte.php)
- Konfigurasi database: [`config/database.php`](config/database.php)
- Konfigurasi cache, mail, logging, dsb: [`config/`](config/)

---

Untuk detail lebih lanjut, silakan baca komentar di setiap file controller dan