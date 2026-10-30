---
name: govind-verify
description: Verification checklist for GOVIND changes. Use before reporting a task as done or before committing - runs the Pest suite against the known baseline and checks routes, roles, uploads, views and migrations according to what changed.
---

# GOVIND verification

Run only the checks relevant to what changed, then report results honestly (paste failing output).

## 1. Always
```bash
git status -sb && git diff --stat
php artisan test
```
Tests run on SQLite `:memory:` (forced by `phpunit.xml` + guard in `tests/TestCase.php`), so they never touch a real database.
Baseline: **12 passed / 13 failed** — the 13 known Breeze failures listed in AGENTS.md §10. Compare the *set* of failing tests, not only the counts.

## 2. Conditional checks

| If you changed… | Then |
|---|---|
| `routes/web.php` / `routes/auth.php` | `php artisan route:list --except-vendor`; route names unique; correct `auth` + `role:admin|user` group; views/links that use the route name still resolve |
| `RoleMiddleware`, `bootstrap/app.php`, auth controllers | Walk the role matrix (AGENTS.md §6) for guest / user / admin, including the flash messages |
| An admin CRUD method | Create, update, delete, validation error and search all work; `findOrFail($id)` used with `{id}` routes; flash message shown on the list page |
| A migration | New file only, works on SQLite (tests) and MariaDB 10.6 (Docker: `docker compose --env-file .env.docker exec app php artisan migrate`); never edit a migration that already ran in production |
| Uploads | Stored on disk `public` under `users/` or `programs/`, filename saved, old file removed on replace, `asset('storage/<dir>/'.$img)` renders |
| Blade views | Page renders for each role that sees it; desktop + ~390 px mobile; no new `@vite`; output escaped |
| `composer.json` / framework | `php artisan optimize:clear`; re-check the Laravel 13 pins (AGENTS.md §12a) |

## 3. Optional manual check
`php artisan serve` (or Docker http://localhost:8083) and open `/`, `/login`, `/admin/home` (admin), `/home` (user). Create test data through the UI or tinker on a **local** database only; never run `migrate:fresh`/`db:seed` against a database you did not create yourself. Avoid clicking admin delete buttons in browser automation (`confirm()` dialogs).

## 4. Report
List: tests (pass/fail vs. baseline), which conditional checks applied and their result, anything not verified.
