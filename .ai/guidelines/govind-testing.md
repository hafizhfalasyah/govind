## GOVIND — testing

- Run `php artisan test` (Pest 5 / PHPUnit 13). `phpunit.xml` forces SQLite `:memory:` (`<env force>` + `<server>`) and `tests/TestCase.php` throws on any other connection, so `RefreshDatabase` can never wipe the Docker or a real database. Never remove them. Needs `pdo_sqlite`.
- Baseline (2026-10-30, Laravel 13.39 / PHP 8.5.7): **39 tests / 100 assertions, all passing** — `Auth/*` (Breeze, adapted to role redirects), `ProgramManagementTest`, `TestimonialTest`, `RegressionTest` (all Blade views compile, OG image, WhatsApp config, visible validation errors).
- With every bug fix or feature add a Pest test in `tests/Feature` (`RefreshDatabase` is applied by `tests/Pest.php`); users via `User::factory()->create(['role' => 'admin'])` (default role `user`), other models created directly.
- Same suite inside Docker: `docker compose --env-file .env.docker exec app php artisan test`.
