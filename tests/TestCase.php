<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    /**
     * Pengaman: Feature test memakai RefreshDatabase, jadi test hanya boleh berjalan di SQLite in-memory
     * (mis. bila env docker compose menunjuk ke MariaDB, test berhenti sebelum database terhapus).
     */
    public function createApplication()
    {
        $app = parent::createApplication();

        $connection = $app['config']->get('database.default');
        $database = $app['config']->get("database.connections.{$connection}.database");

        if ($connection !== 'sqlite' || $database !== ':memory:') {
            throw new RuntimeException("Test dihentikan: koneksi database [{$connection}] bukan SQLite :memory:. Periksa phpunit.xml.");
        }

        return $app;
    }
}
