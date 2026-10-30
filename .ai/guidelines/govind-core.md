## GOVIND — core project rules

- Laravel **13.39** (PHP ^8.5, Laravel 11+ slim structure: `bootstrap/app.php`) company-profile site for Govind Abra Enterprise (training programs, Malang). Public site = one standalone page `resources/views/user/home.blade.php` (English UI); admin panel under `/admin` (role `admin`). Production = cPanel shared hosting (MariaDB 10.6); Docker = local dev only.
- Full guide: `AGENTS.md`. Work log for handoffs: `.ai/handoff.md` — read it first, update it before stopping.
- Two controllers hold all app logic: `App\Http\Controllers\AdminController` (dashboard + CRUD for users, categories, programs, testimonials) and `UserController` (public page, WhatsApp redirects, testimonial submit). `Auth/*` are Breeze controllers (login/register customised).
- Roles: `users.role` string `admin` | `user`; gate with `->middleware(['auth', 'role:admin'])` (`RoleMiddleware`, alias in `bootstrap/app.php`). Admin hitting user pages → `admin.home` + error flash; others → `home` + error flash.
- Admin routes use `POST /admin/{area}/store`, `PUT /admin/{area}/update/{id}`, `DELETE /admin/{area}/delete/{id}` with `findOrFail($id)` (never type-hint a model whose variable name differs from the route parameter).
- Code style: controller section banners `// ===== X CONTROLLERS =====`, inline `$request->validate([...])`, flash `success`/`error`, messages in the language the module already uses (Indonesian for users/categories/programs). Do not mass-format with Pint.
- Never run `migrate:fresh|reset|refresh`, `db:wipe` or `db:seed` against a non-throwaway database; never read/print/commit `.env*` or `../deployment/**`.
- The production site runs extra code not in the repo (blog + visitor analytics tables). Never deploy without the user's go-ahead (AGENTS.md §11.1). The hosting must be switched to PHP 8.5 first.
- Git: remotes `origin` (hafizhfalasyah/govind) and `solveit` (solveit-id/govind) share one history since 2026-10-30; release = push `staging` to both, PR `staging → main` on both, merge commit; the trees of both `main` branches must be identical. Commit format `(add|update|fix|merge|test|chore|docs) lowercase summary`, no `Co-Authored-By` trailer.
- Laravel 12→13 pins (keep): `resources/views/errors/minimal.blade.php`, `lang/en.json` (mail subjects), `Pdo\Mysql::ATTR_SSL_CA` in `config/database.php`.
