<?php

/**
 * Membuat .env LOKAL dari .env.example + nilai di .env.docker (tanpa menampilkan rahasia).
 *
 * - .env yang sudah ada (mis. .env produksi) dipindahkan ke ../deployment/prod/.env.project-root-<waktu>
 *   (tidak pernah menimpa file lain), lalu .env lokal dibuat dan disalin ke ../deployment/local/.env.
 * - APP_KEY dan DB_* diambil dari .env.docker (GOVIND_APP_KEY, GOVIND_DB_*), sehingga `php artisan serve`
 *   native memakai MariaDB Docker (127.0.0.1:GOVIND_DB_PORT) dan container memakai APP_KEY yang sama.
 *
 * Pakai: php scripts/make-local-env.php
 */

date_default_timezone_set('Asia/Jakarta');

$root = dirname(__DIR__);
$deployment = dirname($root) . DIRECTORY_SEPARATOR . 'deployment';

function readEnvFile(string $file): array
{
    $values = [];
    foreach (file($file, FILE_IGNORE_NEW_LINES) ?: [] as $line) {
        if (preg_match('/^\s*([A-Z0-9_]+)\s*=\s*(.*)\s*$/', $line, $m)) {
            $values[$m[1]] = trim($m[2], "\"'");
        }
    }

    return $values;
}

function setEnvValue(string $env, string $key, string $value): string
{
    $line = $key . '=' . (preg_match('/[\s#"]/', $value) ? '"' . addcslashes($value, '"') . '"' : $value);

    return preg_match("/^{$key}=.*$/m", $env)
        ? preg_replace("/^{$key}=.*$/m", str_replace(['\\', '$'], ['\\\\', '\\$'], $line), $env)
        : rtrim($env) . PHP_EOL . $line . PHP_EOL;
}

if (! is_file("$root/.env.docker")) {
    fwrite(STDERR, "Gagal: .env.docker tidak ditemukan (salin dari .env.docker.example dan isi dulu).\n");
    exit(1);
}

$docker = readEnvFile("$root/.env.docker");
foreach (['GOVIND_APP_KEY', 'GOVIND_DB_DATABASE', 'GOVIND_DB_USERNAME', 'GOVIND_DB_PASSWORD'] as $required) {
    if (($docker[$required] ?? '') === '') {
        fwrite(STDERR, "Gagal: {$required} di .env.docker masih kosong.\n");
        exit(1);
    }
}

// 1. Pindahkan .env lama (produksi) keluar dari folder proyek
if (is_file("$root/.env")) {
    @mkdir("$deployment/prod", 0777, true);
    $target = "$deployment/prod/.env.project-root-" . date('Ymd-His');
    $sameAsProd = is_file("$deployment/prod/.env") && hash_file('sha256', "$deployment/prod/.env") === hash_file('sha256', "$root/.env");

    if (! rename("$root/.env", $target)) {
        fwrite(STDERR, "Gagal memindahkan .env lama ke {$target}.\n");
        exit(1);
    }

    echo ".env lama dipindahkan ke: {$target}\n";
    echo '  isinya sama dengan deployment/prod/.env: ' . ($sameAsProd ? 'ya' : 'tidak') . "\n";
}

// 2. Buat .env lokal
$env = file_get_contents("$root/.env.example");
$set = [
    'APP_ENV' => 'local',
    'APP_KEY' => $docker['GOVIND_APP_KEY'],
    'APP_DEBUG' => 'true',
    'APP_URL' => 'http://localhost:8000',
    'DB_CONNECTION' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => $docker['GOVIND_DB_PORT'] ?? '3308',
    'DB_DATABASE' => $docker['GOVIND_DB_DATABASE'],
    'DB_USERNAME' => $docker['GOVIND_DB_USERNAME'],
    'DB_PASSWORD' => $docker['GOVIND_DB_PASSWORD'],
];
foreach ($set as $key => $value) {
    $env = setEnvValue($env, $key, $value);
}

file_put_contents("$root/.env", $env);
@mkdir("$deployment/local", 0777, true);
copy("$root/.env", "$deployment/local/.env");

echo ".env lokal dibuat (APP_ENV=local, DB {$set['DB_HOST']}:{$set['DB_PORT']}/{$set['DB_DATABASE']}) dan disalin ke deployment/local/.env\n";
echo "Jalankan database: docker compose --env-file .env.docker up -d db mailpit\n";
