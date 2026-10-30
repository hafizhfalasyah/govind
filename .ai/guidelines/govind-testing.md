## GOVIND — testing

- Run `php artisan test` (Pest 5 / PHPUnit 13). `phpunit.xml` forces SQLite `:memory:` (`<env force>` + `<server>`) and `tests/TestCase.php` throws on any other connection, so `RefreshDatabase` can never wipe the Docker or a real database. Never remove them. Needs `pdo_sqlite`.
- Baseline (2026-10-30, Laravel 13.39 / PHP 8.5.7): 25 tests — **12 passed / 13 failed**. The 13 failures are Breeze defaults for screens/routes the app never had (`dashboard`, `profile`, `<x-*>` components) plus `RegistrationTest` › new users can register (the app also requires phone/address). A change must keep this exact pass/fail set unless it fixes one of them.
- No tests cover the real features yet. With every bug fix or feature add a Pest test in `tests/Feature` (`RefreshDatabase` is applied by `tests/Pest.php`); users via `User::factory()->create(['role' => 'admin'])`, other models created directly.
- Same suite inside Docker: `docker compose --env-file .env.docker exec app php artisan test`.
