# Deploy GOVIND ke Shared Hosting (cPanel, bukan VPS)

Versi aplikasi: **Laravel 13 + PHP 8.5**. Paket rilis dibangun di komputer lokal (sudah berisi `vendor/`
produksi), lalu diunggah lewat File Manager/FTP.

**Yang TIDAK dibutuhkan di hosting:** Node.js, Composer, Git, dan Terminal.
Tanpa Terminal, perintah `php artisan` dijalankan lewat **Cron Job** atau **web installer sekali pakai**
(bagian 4.7).

> ## ⚠️ Baca dulu sebelum deploy
>
> 1. **Kode di hosting saat ini TIDAK sama dengan repository ini.** Database produksi (dump 2026-10-30) berisi tabel
>    `page_visits` (6.449 baris), `section_visits` (1.400), `blogs` (2) dan `comments` (1) beserta 2 migration
>    `2026_01_10_*_create_page_visits_table` / `..._section_visits_table` yang tidak ada di branch mana pun.
>    Artinya website live punya fitur tambahan (statistik pengunjung, blog). **Deploy repository ini akan
>    menghapus fitur tersebut dari website** (datanya tetap ada di database, hanya tidak dipakai).
>    Sebelum deploy: download dulu kode yang sekarang ada di hosting (bagian 4.1) dan putuskan apakah kode itu
>    harus dimasukkan ke repository terlebih dahulu.
> 2. **Hosting masih PHP 8.4.27** (menurut dump). Kode ini butuh **PHP 8.5** — ganti versi PHP dulu (bagian 4.2).

> Sudah diuji lokal (2026-10-30): dump produksi diimpor ke MariaDB Docker 10.6 dengan `scripts\import-db.ps1 -Migrate`
> → 1 migration baru (`2026_10_30_000000_make_occupation_nullable_on_testimonials_table`, < 1 detik, data tetap),
> halaman `/`, `/login`, `/register`, `/forgot-password`, gambar upload tampil, tidak ada error baru di log.

Ringkasan alur:

```
LOKAL                                         HOSTING (cPanel)
1. ambil kode main + test                     4.1 backup DB, file upload & KODE LAMA
2. gladi resik dengan dump DB produksi        4.3 upload + extract ZIP ke folder baru
3. build ZIP (scripts\build-release.ps1)  →   4.4 pindahkan .env & file upload, 4.5 tukar folder
                                              4.7 storage:link + migrate (Terminal / Cron / web installer)
                                              5.  cek website
```

---

## 0. Syarat hosting (cek sekali, sebelum mulai)

| Syarat | Di mana mengecek |
|---|---|
| **PHP 8.5** untuk domain ini | cPanel → *Select PHP Version* / *MultiPHP Manager* |
| Ekstensi PHP: `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `mbstring`, `openssl`, `pdo_mysql`, `session`, `tokenizer`, `xml` | *Select PHP Version → Extensions* |
| Database MySQL/MariaDB + **phpMyAdmin** | *MySQL Databases*, *phpMyAdmin* |
| **File Manager** (upload & extract ZIP) atau akses FTP | *File Manager* |
| Salah satu cara menjalankan perintah: **Terminal**, **Cron Jobs**, atau fungsi PHP `symlink()` aktif (untuk web installer) | *Terminal* / *Cron Jobs* |

Bila PHP 8.5 belum tersedia, **jangan deploy**: aplikasi langsung berhenti dengan pesan
"Composer detected issues in your platform". Minta hosting mengaktifkannya terlebih dahulu.

---

## 1. Persiapan di komputer lokal — TANPA Docker

### 1.1 Yang perlu terpasang

| Program | Keterangan |
|---|---|
| PHP **8.5** (CLI) | ekstensi seperti di atas + `pdo_sqlite` & `sqlite3` (untuk test). Cek: `php -v`, `php -m` (XAMPP: `C:\xampp\php\php.exe`) |
| Composer 2 | cek: `composer --version` |
| Git | cek: `git --version` |
| MySQL/MariaDB lokal | mis. XAMPP (`C:\xampp\mysql\bin\mysql.exe`, user `root` tanpa password) — untuk gladi resik |

Node.js **tidak** dibutuhkan (semua CSS/JS dari CDN).

### 1.2 Langkah

1. **Ambil kode terbaru**
   ```powershell
   cd "D:\PROYEK\PROYEK SOLVE IT\WEB\govind\govind_v1"
   git checkout main
   git pull
   composer install
   ```
2. **Jalankan test** (SQLite in-memory, tidak menyentuh database apa pun):
   ```powershell
   php artisan test
   ```
   Semua test harus lulus (saat ini 39 test). Ada yang gagal = jangan deploy.
3. **Gladi resik dengan data produksi terbaru** (sangat disarankan)
   1. Hosting → phpMyAdmin → pilih database → *Export* → *Quick*, format *SQL* → simpan, mis.
      `D:\PROYEK\PROYEK SOLVE IT\WEB\govind\deployment\database\produksi.sql`.
   2. Atur `.env` lokal agar menunjuk MySQL XAMPP (isi database lokal ini akan **diganti**):
      ```dotenv
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=govind
      DB_USERNAME=root
      DB_PASSWORD=
      ```
   3. Impor dump dan jalankan migration persis seperti yang nanti terjadi di hosting:
      ```powershell
      powershell -ExecutionPolicy Bypass -File scripts\import-db.ps1 -File ..\deployment\database\produksi.sql -Migrate -Native
      ```
      (`mysql.exe` di lokasi lain: tambahkan `-MysqlPath "C:\path\ke\mysql.exe"`.)
   4. Jalankan lalu cek situs:
      ```powershell
      php artisan serve
      ```
      Buka http://localhost:8000: Beranda (program, testimoni, peta), `/login`, `/register`; login admin produksi
      (password sama karena data dari produksi) → `/admin/home`, Users, Category, Program, Testimonial.
      Agar gambar tampil, salin isi `storage/app/public` dari hosting ke folder yang sama di lokal (opsional).
4. **Bangun paket rilis**
   ```powershell
   powershell -ExecutionPolicy Bypass -File scripts\build-release.ps1
   # bila hosting TIDAK punya Terminal DAN Cron Job:
   powershell -ExecutionPolicy Bypass -File scripts\build-release.ps1 -WithWebInstaller
   ```
   Script menjalankan test lagi dan berhenti bila ada yang gagal. Folder `release\` dibuat otomatis (tidak ikut git).
   Hasil: `release\govind-<commit>-<tanggal>.zip`. Dengan `-WithWebInstaller`, URL + kunci web installer
   ditampilkan dan disimpan di `release\govind-<commit>-<tanggal>-installer.txt`. **Rahasiakan kunci itu.**

---

## 2. Persiapan di komputer lokal — DENGAN Docker

### 2.1 Yang perlu terpasang
Docker Desktop dan Git. PHP, Composer, dan MySQL **tidak** perlu ada di Windows.

### 2.2 Langkah

1. **Ambil kode terbaru dan jalankan stack** (lihat `README-Docker.md` untuk `.env.docker`)
   ```powershell
   cd "D:\PROYEK\PROYEK SOLVE IT\WEB\govind\govind_v1"
   git checkout main
   git pull
   docker compose --env-file .env.docker up -d --build
   docker compose --env-file .env.docker exec app composer install
   ```
2. **Jalankan test**
   ```powershell
   docker compose --env-file .env.docker exec app php artisan test
   ```
3. **Gladi resik dengan data produksi terbaru**
   1. Export database produksi dari phpMyAdmin (seperti 1.2 langkah 3.1).
   2. Impor ke MariaDB Docker lalu jalankan migration:
      ```powershell
      powershell -ExecutionPolicy Bypass -File scripts\import-db.ps1 -File ..\deployment\database\produksi.sql -Migrate
      ```
   3. Buka http://localhost:8083 dan cek seperti 1.2 langkah 3.4. Email yang terkirim terlihat di http://localhost:8026.
4. **Bangun paket rilis** (PHP & Composer dijalankan di dalam container):
   ```powershell
   powershell -ExecutionPolicy Bypass -File scripts\build-release.ps1 -UseDocker
   # bila hosting TIDAK punya Terminal DAN Cron Job:
   powershell -ExecutionPolicy Bypass -File scripts\build-release.ps1 -UseDocker -WithWebInstaller
   ```

---

## 3. Siapkan `.env` produksi

Ambil `.env` yang sekarang dipakai di hosting (File Manager → klik kanan → *Download*; salinan maintainer ada di
`..\deployment\prod\.env` — jangan di-commit), lalu pastikan isinya:

```dotenv
APP_NAME=...                  # SAMA dengan .env produksi lama (nama ini menentukan nama cookie sesi)
APP_ENV=production
APP_KEY=base64:...            # SAMA dengan .env produksi lama, JANGAN generate baru
APP_DEBUG=false
APP_URL=https://DOMAIN-ANDA
APP_LOCALE=en                 # tetap en (judul email dipertahankan lewat lang/en.json)

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=...               # dari cPanel → MySQL Databases
DB_USERNAME=...
DB_PASSWORD=...

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local

MAIL_MAILER=smtp              # sesuai email hosting (dipakai untuk link reset password)
MAIL_HOST=...
MAIL_PORT=465
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_SCHEME=smtps
MAIL_FROM_ADDRESS=...
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 4. Di hosting

> Contoh path: aplikasi di `/home/USER/govind`, domain menunjuk ke `/home/USER/govind/public`. Sesuaikan dengan
> struktur yang sekarang dipakai. Kerjakan saat pengunjung sepi: sejak langkah 4.5 sampai perintah selesai
> website bisa menampilkan error.

### 4.1 Backup (wajib)
1. phpMyAdmin → database → *Export* → *Quick* → SQL. Simpan di komputer (`..\deployment\database\`).
2. File Manager → folder aplikasi → `storage/app/public` → *Compress* (ZIP) → *Download* (foto user `users/` dan
   gambar program `programs/`). Download juga file `.env`.
3. **Kode lama**: File Manager → folder aplikasi (tanpa `vendor/` bila terlalu besar) → *Compress* → *Download*.
   Ini satu-satunya salinan fitur blog/statistik yang belum ada di repository (lihat peringatan di atas).

### 4.2 PHP 8.5
*Select PHP Version* → pilih **8.5** → centang ekstensi di bagian 0 → *Save*. Bila tersedia tab *Options*, set
`upload_max_filesize = 8M`, `post_max_size = 16M` (gambar program boleh 4 MB), `memory_limit = 256M`.

### 4.3 Upload dan extract
1. File Manager → folder home (`/home/USER`) → *Upload* → pilih `govind-<commit>-<tanggal>.zip`.
   Bila upload lewat browser gagal karena ukuran, pakai FTP (mis. FileZilla).
2. Klik kanan ZIP → *Extract* → ke folder baru `/home/USER/govind_new`. Setelah selesai, hapus file ZIP.

### 4.4 Pindahkan data yang tidak ada di paket
1. Upload `.env` produksi (bagian 3) ke `/home/USER/govind_new/.env`.
2. Salin seluruh isi `/home/USER/govind/storage/app/public/` ke `/home/USER/govind_new/storage/app/public/`
   (File Manager → pilih semua → *Copy*).
3. Pastikan folder `storage/framework/cache/data`, `storage/framework/sessions`, `storage/framework/views` dan
   `storage/logs` ada di `govind_new` (paket tidak membawa folder kosong ini — buat lewat *+ Folder* bila belum ada).

### 4.5 Tukar folder (memudahkan rollback)
*Rename* `govind` → `govind_old`, lalu `govind_new` → `govind`.

### 4.6 Document root
- **Domain menunjuk ke `govind/public`**: tidak perlu apa-apa.
- **Web root `public_html`** berisi salinan folder `public/`: salin isi `govind/public/` ke `public_html/` (timpa),
  **kecuali `index.php`**. `index.php` di `public_html` sudah berisi path ke folder aplikasi, jadi biarkan.
  Pastikan `.htaccess` ikut tersalin (isinya sama dengan `..\htaccess`). Bila memakai web installer, file
  `install-*.php` ikut tersalin juga.

### 4.7 Jalankan perintah deploy — pilih SATU metode

Perintah yang harus dijalankan (urutan penting):
```
php artisan optimize:clear
php artisan storage:link
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
Migration yang dijalankan saat ini: `2026_10_30_000000_make_occupation_nullable_on_testimonials_table`
(kolom `testimonials.occupation` boleh kosong; data tidak berubah).

**Metode A: Terminal** (bila tersedia). cPanel → *Terminal*:
```bash
cd ~/govind
php -v        # harus 8.5.x
php artisan optimize:clear && php artisan storage:link && php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache
```

**Metode B: Cron Job sekali jalan** (tanpa Terminal)
1. Cari path PHP 8.5 di server, umumnya salah satu dari: `/usr/local/bin/ea-php85` (cPanel EasyApache),
   `/opt/cpanel/ea-php85/root/usr/bin/php`, atau `/opt/alt/php85/usr/bin/php` (CloudLinux — hosting ini memakai CloudLinux).
   Bila ragu, tanyakan ke support hosting.
2. cPanel → *Cron Jobs* → *Add New Cron Job* → *Common Settings*: **Once Per Minute** (`* * * * *`). Command
   (ganti `USER` dan path PHP):
   ```bash
   cd /home/USER/govind && P=/opt/alt/php85/usr/bin/php && $P artisan optimize:clear > storage/logs/deploy.log 2>&1 && $P artisan storage:link >> storage/logs/deploy.log 2>&1 && $P artisan migrate --force >> storage/logs/deploy.log 2>&1 && $P artisan config:cache >> storage/logs/deploy.log 2>&1 && $P artisan route:cache >> storage/logs/deploy.log 2>&1 && $P artisan view:cache >> storage/logs/deploy.log 2>&1
   ```
3. Tunggu 1–2 menit, buka `govind/storage/logs/deploy.log` di File Manager. Harus ada migration
   `2026_10_30_000000_make_occupation_nullable_on_testimonials_table ... DONE` (atau `Nothing to migrate` bila sudah
   pernah jalan) dan diakhiri `Blade templates cached successfully`.
   Baris `ERROR The [public/storage] link already exists.` itu **normal**; error lain berarti gagal.
4. **Hapus cron job tersebut.**
5. Bila `deploy.log` kosong atau tidak ada, path PHP-nya salah. Buat cron `php -v > /home/USER/phpver.txt 2>&1` untuk
   melihat versi `php` default, atau tanyakan path PHP 8.5 ke support.
6. Struktur `public_html`: link storage harus dibuat di `public_html`, jadi ganti `$P artisan storage:link` dengan
   `ln -s /home/USER/govind/storage/app/public /home/USER/public_html/storage` (lewati bila `public_html/storage` sudah ada).

**Metode C: Web installer** (tanpa Terminal **dan** tanpa Cron Job)
1. Paket harus dibuat dengan `-WithWebInstaller` (1.2 langkah 4 / 2.2 langkah 4).
2. Buka URL dari `release\...-installer.txt`, mis. `https://DOMAIN-ANDA/install-1a2b3c4d5e6f7a8b.php?key=...`.
   Tanpa kunci yang benar halaman ini menjawab 404.
3. Halaman menampilkan pemeriksaan server: versi PHP, ekstensi, `.env`, izin folder, `symlink()`, koneksi database,
   dan daftar migration yang akan dijalankan. Semua harus ✔.
4. Klik **Jalankan deploy** dan tunggu sampai selesai. Semua langkah harus ✔.
5. File installer **menghapus dirinya sendiri** setelah berhasil. Pastikan `install-*.php` sudah tidak ada di folder
   `public` (atau `public_html`); bila masih ada, hapus manual.

**Metode D: tanpa menjalankan PHP di server**
1. phpMyAdmin hosting → database → tab *SQL* → jalankan (sama dengan migration di atas):
   ```sql
   ALTER TABLE `testimonials` MODIFY `occupation` VARCHAR(255) NULL;
   INSERT INTO `migrations` (`migration`, `batch`)
     SELECT '2026_10_30_000000_make_occupation_nullable_on_testimonials_table', COALESCE(MAX(`batch`), 0) + 1 FROM `migrations`;
   ```
2. Minta support hosting membuat link storage bila belum ada
   (`ln -s /home/USER/govind/storage/app/public /home/USER/govind/public/storage`).
3. Hapus isi `bootstrap/cache/*.php` (kecuali `.gitignore`) agar cache lama tidak terpakai.

### 4.8 Izin folder
`storage/` dan `bootstrap/cache/` harus bisa ditulis web server (755 atau 775): File Manager → klik kanan →
*Change Permissions*.

### 4.9 Rollback (bila ada masalah)
1. *Rename* `govind` → `govind_gagal`, lalu `govind_old` → `govind`.
2. Kembalikan versi PHP sebelumnya (8.4) bila kode lama tidak jalan di 8.5.
3. Migration deploy ini hanya membuat `testimonials.occupation` boleh kosong — kode lama tetap jalan dengan itu.
   Restore database dari backup 4.1 hanya bila ada perubahan data yang salah.

---

## 5. Checklist setelah deploy

- [ ] `/` tampil normal: hero, program (slider + gambar), benefit, layanan, testimoni (slider), kontak + peta (cek juga di HP).
- [ ] Gambar program dan foto user tampil (artinya `storage/app/public` dan link `public/storage` benar).
- [ ] `/register` → daftar akun uji → masuk sebagai user → `/testimonial` bisa dibuka; tombol daftar program membuka WhatsApp.
- [ ] Login admin → `/admin/home`, Users, Category, Program, Testimonial (cari, paging, tampil/sembunyikan testimoni).
- [ ] Program: edit satu program (nama/aktif) → berubah di daftar tanpa baris baru; buat program uji lalu hapus.
- [ ] `/login` → *Forgot password?* membuka halaman reset (email reset terkirim bila SMTP sudah diisi).
- [ ] Hapus akun uji lewat Users.
- [ ] Tidak ada error baru di `storage/logs/laravel.log`.
- [ ] Metode B: cron job sudah dihapus. Metode C: file `install-*.php` sudah tidak ada.
- [ ] Setelah beberapa hari normal: hapus folder `govind_old` (setelah kode lamanya tersimpan di komputer, 4.1 langkah 3).
- Tidak perlu cron permanen maupun queue worker.

## 6. Masalah yang sering muncul

| Gejala | Penyebab & solusi |
|---|---|
| Halaman putih / "Composer detected issues in your platform" | PHP di hosting belum 8.5 (4.2) |
| Error 500 di semua halaman | Baca `storage/logs/laravel.log`; pastikan `.env` lengkap, folder `storage/framework/*` ada (4.4) dan bisa ditulis (4.8) |
| `optimize:clear` error "no such table: cache" / "Table 'cache' doesn't exist" | Database masih kosong (instalasi pertama): cache memakai driver `database`. Jalankan `php artisan migrate --force` dulu, lalu `optimize:clear` (web installer sudah mengurutkannya sendiri) |
| "Please provide a valid cache path" | Folder `storage/framework/views` (dan `cache/data`, `sessions`) belum ada (4.4 langkah 3) |
| Gambar tidak tampil | Link `public/storage` belum ada (ulangi `storage:link` / Metode B langkah 6) atau isi `storage/app/public` belum disalin (4.4) |
| Web installer: ✘ `symlink()` | Fungsi dinonaktifkan hosting: pakai Metode B, atau minta support membuat link (Metode D) |
| "419 Page Expired" saat login | `APP_KEY`/`APP_NAME` berubah atau cookie lama: samakan dengan `.env` lama, lalu hapus cookie browser |
| Upload gambar program > 2 MB gagal | Naikkan `upload_max_filesize`/`post_max_size` (4.2) |
| Fitur statistik/blog hilang | Kode produksi lama tidak ada di repository (peringatan di atas) — rollback 4.9, lalu masukkan kode itu ke repository |
| Perubahan tidak terlihat | Ulangi `optimize:clear`, lalu `config:cache`, `route:cache`, `view:cache` |
