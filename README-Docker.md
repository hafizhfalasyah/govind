# GOVIND — Docker untuk development lokal

Docker hanya untuk komputer lokal. Produksi tetap di shared hosting (lihat `docs/DEPLOY-SHARED-HOSTING.md`).

| Service | Image | Akses dari Windows | Fungsi |
|---|---|---|---|
| `app` | `govind-app` (dibangun dari `Dockerfile`: PHP **8.5.7** + Apache 2.4, ekstensi bcmath, exif, gd (JPEG/WebP/FreeType), intl, mysqli, pdo_mysql, zip, OPcache bawaan) | http://localhost:8083 | Aplikasi Laravel 13 |
| `db` | `mariadb:10.6.27` (produksi: MariaDB 10.6) | `127.0.0.1:3308` | Database (data di volume `govind-db-data`) |
| `mailpit` | `axllent/mailpit` | UI http://localhost:8026, SMTP 1026 | Menangkap semua email lokal |

Tidak ada service `node`: semua halaman memakai Tailwind/Alpine/AOS/Leaflet dari CDN dan tidak memakai Vite,
jadi tidak ada aset yang perlu di-compile.

Port sengaja berbeda dari stack RRCONS (8082 / 3307 / 1025 / 8025) supaya keduanya bisa berjalan bersamaan.
Folder proyek di-mount ke container, jadi perubahan kode langsung terlihat tanpa build ulang.

## Pertama kali

```powershell
copy .env.docker.example .env.docker      # isi password DB & GOVIND_APP_KEY
php scripts\make-local-env.php           # .env lokal dari .env.example + .env.docker (APP_KEY & DB sama);
                                          # .env lama (mis. produksi) dipindah ke ..\deployment\prod\
docker compose --env-file .env.docker up -d --build
docker compose --env-file .env.docker exec app php artisan migrate
```

`GOVIND_APP_KEY` bisa dibuat dengan `php artisan key:generate --show` (PHP 8.5 lokal) atau
`docker compose --env-file .env.docker run --rm app php artisan key:generate --show`.

Data produksi (dump phpMyAdmin, mis. `..\deployment\database\*.sql`) bisa dimuat dengan
(tanpa Docker: tambahkan `-Native`, memakai MySQL lokal dari `.env`):

```powershell
powershell -ExecutionPolicy Bypass -File scripts\import-db.ps1 -File ..\deployment\database\govindab_govind_30-10-2026.sql -Migrate
```

Data contoh (hanya untuk database lokal kosong): `docker compose --env-file .env.docker exec app php artisan db:seed`
→ `admin@example.com` / `user@example.com`, password `12345`.

## Perintah harian

```powershell
docker compose --env-file .env.docker up -d                    # start
docker compose --env-file .env.docker down                     # stop (data DB tetap)
docker compose --env-file .env.docker exec app php artisan test
docker compose --env-file .env.docker exec app php artisan optimize:clear
docker compose --env-file .env.docker logs -f app
```

Test **selalu** memakai SQLite in-memory (`phpunit.xml` + pengaman di `tests/TestCase.php`),
jadi aman dijalankan di container walaupun container terhubung ke MariaDB.
Hasil saat ini: 39 test, semua lulus.

## Tanpa Docker untuk PHP (native PHP 8.5)

PHP 8.5 di Windows (XAMPP) bisa menjalankan aplikasi langsung, cukup `db` dan `mailpit` dari Docker:

```powershell
docker compose --env-file .env.docker up -d db mailpit
php artisan serve                         # http://localhost:8000
```

Nilai `.env` untuk mode ini (lihat `.env.example`): `DB_HOST=127.0.0.1`, `DB_PORT=3308`,
`DB_DATABASE`/`DB_USERNAME`/`DB_PASSWORD` sama dengan `GOVIND_DB_*` di `.env.docker`,
`APP_URL=http://localhost:8000`. Untuk melihat email di Mailpit: `MAIL_MAILER=smtp`, `MAIL_HOST=127.0.0.1`, `MAIL_PORT=1026`.
Nilai `DB_*` di `.env` tidak mengganggu Docker karena `compose.yaml` menimpanya.

Tanpa Docker sama sekali (MySQL XAMPP): `DB_PORT=3306`, `DB_USERNAME=root`.

Folder `storage/framework/{views,cache/data,sessions}` dan `storage/logs` ikut repository (berisi `.gitignore`),
jadi clone baru langsung bisa dijalankan.

## Gambar upload (`public/storage`)

`public/storage` adalah symlink **relatif** ke `../storage/app/public` sehingga bekerja di container dan di Windows.
Container membuatnya saat start bila belum ada. Bila hilang, buat ulang dari Windows (butuh Developer Mode atau
terminal Administrator):

```powershell
cmd /c mklink /D public\storage ..\storage\app\public
```

## Batas upload

`docker/php/custom.ini`: `upload_max_filesize=8M`, `post_max_size=16M` (gambar program maks 4 MB, foto user 2 MB).

## Paket rilis untuk shared hosting

```powershell
powershell -ExecutionPolicy Bypass -File scripts\build-release.ps1 -UseDocker
# hosting tanpa Terminal & Cron Job: tambahkan -WithWebInstaller
```

Hasilnya ada di folder `release\` (dibuat otomatis saat build pertama; tidak ikut git karena berisi kunci web installer).
Langkah lengkap (dan **peringatan penting soal kode produksi**): `docs/DEPLOY-SHARED-HOSTING.md`.
