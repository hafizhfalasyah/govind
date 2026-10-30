# GOVIND — Agent Handoff Guide

> Canonical, tool-agnostic project guide for AI coding agents (Claude Code, Codex, Cursor, Copilot, Gemini, …) and humans.
> `CLAUDE.md` imports this file. Concise topic rules live in `.ai/guidelines/` (Laravel Boost format).
> The running work log for handoffs is `.ai/handoff.md`.
>
> Last full audit: **2026-10-30** — Laravel 13.39.0 on PHP 8.5.7 (upgraded 1:1 from Laravel 12.43.1, see §12a). Audit bugs fixed the same day (§12). Test suite: **39 tests, all passing** (100 assertions). Also verified inside Docker and on a copy of the production database.

---

## 0. Handoff protocol (do this first)

1. Read this file fully, then `.ai/handoff.md` (what the previous agent was doing / what is open).
2. Check repository state before touching anything:
   ```bash
   git status -sb && git branch -vv && git log --oneline -10
   ```
   Know the two remotes (see §4) — since 2026-10-30 they **share one history**.
3. Run the test suite: `php artisan test`. The expected baseline is **all green** (39 tests). Any failure is new.
4. Work in small, verifiable steps. Do not "fix" unrelated open items (§12) unless the user asks.
5. **Before you stop, run out of context, or hand off:** update `.ai/handoff.md` (done / in progress / next steps / gotchas found). Uncommitted work must be described there.

---

## 1. What this project is

Company-profile website for **Govind Abra Enterprise (GAE)**, a training/program provider in Malang, Jawa Timur.

- **Public site (English UI, single page):** `/` = `resources/views/user/home.blade.php` with sections hero, about, programs (slider of active programs), benefits, services, testimonials (JS slider), contact (form + Leaflet map). Logged-in users with role `user` can register for a program (redirect to WhatsApp), submit a testimonial and send the contact form (redirect to WhatsApp).
- **Admin panel** (`/admin/*`, role `admin`): dashboard with counts/growth/recent activity, CRUD for users, categories, programs, and moderation (edit / show-hide) of testimonials.
- **Auth:** custom login/register pages (Tailwind CDN) built on Laravel Breeze controllers. Roles are a plain string column `users.role` = `admin` | `user`.
- **Production** runs on cPanel shared hosting (MariaDB 10.6). Docker (`compose.yaml`) is **local development only**.
- ⚠️ **The production site runs code that is NOT in this repository** (blog + visitor analytics) — read §11.1 before any deploy.

---

## 2. Tech stack (actual, verified)

| Layer | Details |
|---|---|
| Backend | PHP **`^8.5`** (composer; developed on 8.5.7), **Laravel 13.39.0** (Laravel 11+ slim structure: `bootstrap/app.php`, no `Kernel.php`, no `RouteServiceProvider`), Eloquent, Blade, Carbon 3 |
| Packages | `laravel/tinker` 3 |
| Dev packages | Pest **5.3** (PHPUnit 13) + `pest-plugin-laravel` 5, `laravel/breeze` 2.4 (scaffolding origin of `Auth/*` controllers; not used at runtime), Pail, Pint, Sail (installed but **not** used — Docker setup is our own, §3), Collision, Faker, Mockery |
| DB | MySQL/MariaDB in production (MariaDB 10.6.28) & Docker (MariaDB 10.6.27); **SQLite in-memory for tests** |
| Frontend | Standalone Blade pages styled with the **Tailwind Play CDN** (`https://cdn.tailwindcss.com`, inline `tailwind.config`) + CDN Alpine 3 (admin), AOS 2.3.4, Leaflet 1.9.4, Google Fonts (Poppins/Aboreto/Inter). Shared JS: `public/js/script.js` (Leaflet map + mobile menu) |
| Vite / Tailwind build | `vite.config.js`, `tailwind.config.js`, `postcss.config.js`, `resources/css|js` exist (Breeze leftovers) but **no view uses `@vite`** — nothing is compiled, Node.js is not needed |
| Local toolchain seen | Windows 11, PHP CLI 8.5.7 (XAMPP, runs the app directly), Composer 2.8.12, Docker 29.9 (stack in `compose.yaml`) |

---

## 3. Commands

```bash
# install
composer install
cp .env.example .env && php artisan key:generate      # .env is git-ignored; none is committed
#   or, with the Docker stack: php scripts/make-local-env.php  (local .env from .env.example + .env.docker, see §11)
php artisan storage:link                              # uploads are served from public/storage

# run (no Vite / Node needed)
php artisan serve

# tests (SQLite :memory:, forced in phpunit.xml + guard in tests/TestCase.php)
php artisan test
php artisan test --filter=AuthenticationTest

# inspection
php artisan route:list --except-vendor
php artisan migrate:status
php artisan about
```

After pulling dependency changes run `php artisan optimize:clear`. `php artisan optimize` (config/route/view/event caches) works; a test (`RegressionTest`) keeps every Blade view compilable.

Seeder (`php artisan db:seed`, **local only**): creates `admin@example.com` (phone `08123456789`) / `user@example.com` (phone `08123456780`), password `12345`, and 3 testimonials. There are no category/program seeders or factories.

### Docker (local only)

```bash
cp .env.docker.example .env.docker      # fill passwords + GOVIND_APP_KEY
docker compose --env-file .env.docker up -d --build
docker compose --env-file .env.docker exec app php artisan migrate
# app http://localhost:8083 (PHP 8.5.7 + Apache) · MariaDB 10.6.27 on 127.0.0.1:3308 · Mailpit UI http://localhost:8026 (SMTP 1026)
docker compose --env-file .env.docker exec app php artisan test   # safe: tests are forced onto SQLite :memory:
```
Ports differ from the RRCONS stack (8082/3307/1025/8025) so both can run together. No `node` service (nothing to compile).
Native mode (no PHP container): `docker compose --env-file .env.docker up -d db mailpit` + `php artisan serve` with `.env` `DB_HOST=127.0.0.1`, `DB_PORT=3308` (see `.env.example`). `public/storage` is a **relative** symlink (`../storage/app/public`; the container entrypoint creates it) that works in both modes. Load a production dump into Docker with `scripts/import-db.ps1 -File dump.sql -Migrate` (`-Native` for XAMPP). Upload limits in Docker: `docker/php/custom.ini` 8M/16M. See `README-Docker.md`.

---

## 4. Git & release workflow (IMPORTANT)

Two GitHub remotes with **one shared history** (unified on 2026-10-30, see `.ai/handoff.md`) and **identical file content**:

| Remote | URL | Local branches |
|---|---|---|
| `origin` | https://github.com/hafizhfalasyah/govind.git | `main` → `origin/main`, `staging` → `origin/staging` |
| `solveit` | https://github.com/solveit-id/govind.git (user is a collaborator) | `staging` is also pushed here (`solveit/staging`) |

- Before 2026-10-30 the two repos had **unrelated** histories (`origin` root `228b808 Deploy v1.0`, `solveit` root from the team's PR flow). They were joined with one `--allow-unrelated-histories` merge (`cc66ca8`). Both `main` branches now contain both histories; do **not** re-run that merge.
- Each repo merges PRs with its own merge commit, so `origin/main` and `solveit/main` have different tip hashes but must have **identical trees**: after every release `git diff origin/main solveit/main` must print nothing.
- `solveit` also has an old branch `Front-End-v1.0` (2025-11-20 upload) — leave it alone.
- Tag `backup/laravel12-final` (both remotes) = last Laravel 12 / PHP 8.2 code (`ac046cf`).

**Release flow used for every change set:**
1. `git fetch --all --prune`; `git switch staging && git merge --ff-only origin/main` (staging starts from the latest main).
2. Commit on `staging` (explicit `git add <paths>`, review `git diff --staged --stat`).
3. `git push origin staging` and `git push solveit staging`.
4. Open PR `staging → main` on **both** repos (`gh pr create --repo hafizhfalasyah/govind …` and `--repo solveit-id/govind …`), check `mergeable`/`mergeStateStatus`, merge with `gh pr merge <n> --merge` (merge commit). If `solveit/main` is not an ancestor of `staging` the PR is still clean (same trees); if GitHub reports a conflict, merge that repo's `main` into `staging`, keep the `staging` side, push, retry.
5. `git switch main && git merge --ff-only origin/main`; verify `git diff origin/main solveit/main` is empty.

**Commit message convention** (lowercase, imperative, no trailing period, **no co-author trailers**):
```
(add) ...      new feature/file
(update) ...   change to existing behaviour/UI/deps
(fix) ...      bug fix
(merge) ...    history/branch merges
(test) ...     tests
(chore) ...    tooling/config
(docs) ...     documentation only
```
Example: `(update) remove channel pending tabs and align delete confirmation modal`.
Do **not** add `Co-Authored-By` lines or "Generated with" lines to commits or PR bodies. Commit/push only when the user asks.

---

## 5. Directory map

```
app/
  Http/Controllers/
    AdminController.php      ALL admin pages + CRUD (home, user, category, program, testimonial)
    UserController.php       public home, register-program (WhatsApp), testimonial form/submit, contact (WhatsApp)
    Auth/*                   Breeze controllers (login customised, register customised with phone/address/img)
  Http/Middleware/RoleMiddleware.php   alias 'role' (bootstrap/app.php): ->middleware('role:admin')
  Http/Requests/Auth/LoginRequest.php  Breeze login (5 attempts / email+IP rate limit)
  Http/Requests/ProfileUpdateRequest.php   unused (no profile routes)
  Models/                    User, Category, Program, Testimonial
  View/Components/           GuestLayout -> layouts/guest.blade.php (Breeze account pages); AppLayout -> layouts.app (unused, view absent)
bootstrap/app.php            routing, 'role' alias, AuthenticationException -> redirect login with flash
config/                      Laravel defaults; database.php uses Pdo\Mysql::ATTR_SSL_CA (PHP 8.5); services.php whatsapp.number (WHATSAPP_NUMBER)
database/migrations          6 migrations (users/sessions/reset tokens, cache, jobs, categories, programs, testimonials)
database/seeders/DatabaseSeeder.php  2 users + 3 testimonials (local only)
lang/en.json                 Laravel 13 pin: keeps Laravel 12 mail subjects (§12a)
public/                      index.php, .htaccess, img/ (logo, hero, choose*), js/script.js, maintenance.html
resources/views/
  user/home.blade.php        the whole public site (~1750 lines, standalone HTML)
  user/testimonial.blade.php testimonial form (role user)
  auth/login|register        custom standalone pages (Tailwind CDN, AOS)
  auth/forgot-password|reset-password|confirm-password|verify-email   Breeze pages in <x-guest-layout> (layouts/guest + components/*)
  layouts/guest.blade.php    card layout in the login page style for the Breeze account pages
  components/                auth-session-status, input-label, text-input, input-error, primary-button (brand-styled)
  admin/testimonial-edit.blade.php   standalone edit page (route admin.testimonial.edit)
  admin/partials/validation-errors.blade.php   validation error banner (category, program, testimonial pages)
  admin/layouts/main.blade.php   admin shell (sidebar, header, flash)
  admin/home|user|category|program|testimonial.blade.php   admin pages (Alpine modals)
  errors/minimal.blade.php   Laravel 13 pin: Laravel 12 error layout (§12a)
routes/web.php               app routes; routes/auth.php Breeze auth routes; routes/console.php 'inspire'
storage/app/public/programs  one committed sample image (1765089399-69352077788c1.jpg)
tests/                       Pest: Feature/Auth/*, ProgramManagementTest, TestimonialTest, RegressionTest, ExampleTests; TestCase.php DB guard
docker/, Dockerfile, compose.yaml, .env.docker.example, README-Docker.md   local dev only
scripts/ (build-release.ps1, import-db.ps1, make-local-env.php, stubs/web-installer.php), docs/DEPLOY-SHARED-HOSTING.md   deploy kit + local env helper
.ai/ (guidelines, handoff.md), .claude/ (settings, skills, agents), AGENTS.md, CLAUDE.md   agent docs
```

---

## 6. Architecture & request flow

### Bootstrap / middleware
- `bootstrap/app.php`: `web` + `console` routes, health route `/up`; middleware alias `role` → `App\Http\Middleware\RoleMiddleware`.
- Exception rendering: `AuthenticationException` → JSON 401 for `expectsJson()`, otherwise `redirect()->guest(route('login'))` with flash `error` = "Please login first to submit a testimonial." (routes `testimonial`, `submit-testimonial`) or "Please login first.".
- CSRF: Laravel 13 `PreventRequestForgery` (default). All forms use `@csrf`.

### `RoleMiddleware` (`role:<role>`)
Not logged in → `login`. Role matches → continue. Otherwise: an **admin** → `admin.home` with error "You cannot access that page as admin."; anyone else → `home` with error "You have no access to that page.".

### Routes (`php artisan route:list`: 41 incl. `/up` and 2 framework `storage/*` routes)

| Method & URI | Name | Action | Middleware |
|---|---|---|---|
| GET `/` | — | `UserController@userHome` | web (public) |
| GET `admin/home` | `admin.home` | `AdminController@home` | auth, role:admin |
| GET `admin/user` · POST `admin/user/store` · PUT `admin/user/update/{id}` · DELETE `admin/user/delete/{id}` | `admin.user[.store/.update/.delete]` | `user`, `userStore`, `userUpdate`, `userDestroy` | auth, role:admin |
| GET `admin/category` · POST `…/store` · PUT `…/update/{id}` · DELETE `…/delete/{id}` | `admin.category[...]` | `category*` | auth, role:admin |
| GET `admin/program` · POST `…/store` · PUT `…/update/{id}` · DELETE `…/delete/{id}` | `admin.program[...]` | `program*` (`findOrFail($id)`) | auth, role:admin |
| GET `admin/testimonial` · GET `admin/testimonial/{id}/edit` · PUT `admin/testimonial/{id}` · PATCH `admin/testimonial/{id}/toggle` | `admin.testimonial[.edit/.update/.toggle]` | `testimonial*` (`.edit` = standalone edit page) | auth, role:admin |
| GET `home` | `home` | `UserController@userHome` (same page as `/`) | auth, role:user |
| GET `register-program/{program:slug}` | `register-program` | redirect to `wa.me/<services.whatsapp.number>?text=…` | auth, role:user |
| GET `testimonial` · POST `submit-testimonial` | `testimonial`, `submit-testimonial` | form / store | auth, role:user |
| GET `submit-contact?name&email&message` | `submit-contact` | redirect to WhatsApp | auth, role:user |
| GET|POST `login`, `register`; GET|POST `forgot-password`; GET `reset-password/{token}`; POST `reset-password` | `login`, `register`, `password.*` | Breeze | guest |
| GET `verify-email`, `verify-email/{id}/{hash}`; POST `email/verification-notification`; GET|POST `confirm-password`; PUT `password`; POST `logout` | `verification.*`, `password.confirm`, `password.update`, `logout` | Breeze (redirect to the role home, `User::homeRoute()`) | auth |
| GET `up` | — | `HealthCheck` | — |
| GET/PUT `storage/{path}` | `storage.local[.upload]` | framework (local disk `serve => true`, signed URLs only) | — |

### Role matrix

| Area | guest | user | admin |
|---|---|---|---|
| `/` public page | ✓ | ✓ | ✓ (navbar shows "Dashboard") |
| `/home` | → login | ✓ | → `admin.home` + error |
| program register (WhatsApp), testimonial form, contact form | → login (contact/program) | ✓ | → `admin.home` + error |
| `/admin/*` | → login | → `home` + error | ✓ |

### Login / register flow
- `AuthenticatedSessionController@store`: on failure **always** returns error "Email atau password salah." (Indonesian, replaces throttle/validation messages). On success: `redirect()->intended(route($user->homeRoute()))` — `User::homeRoute()` = `admin.home` for admins, `home` for everyone else (also used by the email-verification and password-confirmation controllers).
- Login page links to `password.request` ("Forgot password?") and shows `session('status')` (e.g. after a password reset). The Breeze account pages (forgot/reset/confirm password, verify email) render in `layouts/guest` with the brand components.
- `RegisteredUserController@store`: validates img (≤2 MB), name, email unique, phone `^[0-9]{10,15}$` unique, address, password confirmed (`Password::defaults()`); stores img under `storage/app/public/users/<time>-<uniqid>.<ext>`; creates role `user`; logs in; redirects to `home`.
- Logout → `/`.

---

## 7. Domain model & database

### Tables (repo migrations)

| Table | Columns | Notes |
|---|---|---|
| `users` | id, img (nullable filename), name, email **unique**, phone (nullable, *not* unique in DB), address, role (string, default `user`), email_verified_at, password, remember_token, timestamps | `User` casts `password` hashed; `isAdmin()` helper; does **not** implement `MustVerifyEmail` |
| `categories` | id, name **unique**, description (text, nullable), timestamps | `Category hasMany Program` |
| `programs` | id, img (nullable filename), name, slug **unique**, category_id FK → categories (**cascadeOnDelete**, cascadeOnUpdate), short_desc, long_desc, duration, price decimal(12,2) default 0, is_active bool default true, timestamps; utf8mb4_unicode_ci | `Program belongsTo Category`; casts is_active bool, price `decimal:2`; accessor `image_url` (storage URL or ui-avatars fallback); `$fillable` includes `category_id`; controllers assign attributes directly |
| `testimonials` | id, name, occupation (nullable since migration `2026_10_30_000000_make_occupation_nullable_on_testimonials_table`), text **varchar(255)**, is_visible bool default true, img (nullable), timestamps | **no FK to users**: name/img are copied from the user at submit time; `scopeVisible()` |
| `sessions`, `password_reset_tokens`, `cache`, `cache_locks`, `jobs`, `job_batches`, `failed_jobs` | Laravel defaults | sessions/cache/queue use the `database` driver per `.env.example` |

Relationships: **Category 1—N Program** (deleting a category deletes its programs). Nothing else is related (testimonials and users are independent).

### Production database (dump `../deployment/database/govindab_govind_30-10-2026.sql`, 2026-10-30)
Same definitions for all repo tables, plus tables the repo knows nothing about:

| Table | Rows | Columns (summary) |
|---|---|---|
| `page_visits` | 6,449 | user_id FK→users, path, ip, visited_date, hits; unique (path, ip, visited_date) — migration `2026_01_10_202159_create_page_visits_table` (batch 2) |
| `section_visits` | 1,400 | user_id FK→users, path, section, ip, visited_date, hits; unique (path, section, ip, visited_date) — migration `2026_01_10_202210_create_section_visits_table` |
| `blogs` | 2 | category_id FK→categories, user_id, title, slug unique, excerpt, content, image, status enum, views, published_at |
| `comments` | 1 | blog_id FK→blogs, user_id, comment, is_approved |

Other prod counts: users 6, categories 6, programs 23, testimonials 8. The migrations table has the 6 repo migrations (batch 1) + the 2 visit migrations (batch 2); `blogs`/`comments` were created **without** a migration. See §11.1.

---

## 8. Key behaviours & flows

### Public page (`UserController@userHome`, view `user.home`)
- Programs: `Program::with('category')->where('is_active', true)->latest('created_at')->take(10)` → slider (`[data-program-slide]`, first visible). Image: `image_url` accessor (`storage/programs/<img>` or ui-avatars). Price `Rp 1.500.000` format. "Register" → `route('register-program', slug)`.
- Testimonials: visible only, newest first → `$testimonialsJs` (`@json`) for the JS slider (`#testimonial-text/-name/-role/-date/-photo`); `date` = `translatedFormat('d F Y')` (locale `en`); initial = first letter of the name; `photo` = `asset('storage/users/'.$t->img)`.
- Navbar: guest → Login/Register; role user → avatar dropdown (`storage/users/<img>` or initials) with testimonial link + logout; admin → "Dashboard" button.
- Contact form is **GET** to `submit-contact` (role user only) → WhatsApp message with name/email/message.
- SEO head: canonical/hreflang (all pointing at `/`), OG/Twitter (image `public/img/og-govind.jpg`, 1200×630, built from `hero1.png` + hero copy), JSON-LD Organization/WebSite.
- WhatsApp number: `config('services.whatsapp.number')` (env `WHATSAPP_NUMBER`, default `6282245975553`).

### Admin (`AdminController`)
- Dashboard `home()`: totals + this-month counts and growth % (`calculateGrowth`: 0→0 = 0, 0→n = 100), active programs, last 7 activities merged from latest 5 users/programs/testimonials, a "health score" (100; 70 if no programs; 85 if <50 % active).
- Lists: search `?q=` (LIKE on name/email · name · name/slug/category name · name/occupation/text), `orderBy created_at desc`, `paginate(10)->withQueryString()`, default Tailwind pagination view.
- Users: create (img ≤2 MB to `storage/app/public/users`, `bcrypt`, role `user|admin`), update (no password change; replaces img), delete (cannot delete yourself; deletes img). Phone must be 10–15 digits and unique (validation).
- Categories: create/update (unique name), delete (cascades to programs!).
- Programs: create/update (slug = given or `Str::slug(name)`, img ≤4 MB to `storage/app/public/programs`, old image removed on replace; `is_active` = checkbox, unticked/absent = inactive), delete (removes image). Update/delete use `Program::findOrFail($id)`.
- Testimonials: list/search, toggle visibility (`PATCH …/toggle`, checkbox `is_visible`, redirect keeps query string), update via modal or the standalone page `admin.testimonial.edit` (`PUT`, name/occupation (nullable)/text ≤255, `is_visible` = checkbox present). No delete.
- UI: Alpine `x-data` page objects (`programPage()` etc.) with create/edit modals; edit URLs built from `route(..., ['id' => '__ID__'])`; delete forms use `onsubmit="return confirm(...)"` (browser dialog — avoid in browser automation). Flash `success`/`error` banners dismissible; validation errors are listed by `admin/partials/validation-errors` (category, program, testimonial pages; the user page shows per-field errors). Messages are mostly Indonesian (users/categories/programs) and English (testimonials).

### Testimonial submission (`UserController@userSubmitTestimonial`)
Role user only. Validates `occupation` nullable ≤255 and `text` required; `text` is cut to 255 chars (`Str::limit`); name and img copied from the user; `is_visible` defaults to **true** (visible immediately). Occupation may be empty (stored as NULL). The form has `enctype=multipart` but no file input is processed.

### Uploads
Disk `public` (`storage/app/public`), filenames `time()-uniqid().ext`, DB stores the **filename only**; views build `asset('storage/users/'.$img)` / `asset('storage/programs/'.$img)`. Old files are deleted with `unlink(storage_path(...))`. Needs `php artisan storage:link` (`public/storage`).

---

## 9. Frontend rules

- Every page is a **standalone HTML document** (no shared public layout): `user/home`, `user/testimonial`, `auth/login`, `auth/register`. Admin pages share `admin/layouts/main.blade.php` (`@section('title')`, `page_title`, `page_subtitle`, `content`).
- Styling = Tailwind **Play CDN** with inline config (brand teal `#285E5E`, `#7EC6C4`, `#A6DCD3`, …). Classes are generated in the browser — there is no build step and no compiled CSS. Do not add `@vite` unless the user asks for a build pipeline.
- Responsive design is done with Tailwind breakpoints (`md:`, `lg:`); mobile menu toggled by `public/js/script.js` (`#navbarToggle` / `#mobileMenu`). Check desktop + ~390 px mobile after UI changes.
- Libraries via CDN: Alpine 3.17.5 (admin, pinned), AOS 2.3.4, Leaflet 1.9.4 (map centred on Malang `-7.9797, 112.6304`).
- `public/maintenance.html`: standalone bilingual maintenance page (status card, live clock) — not wired to Laravel's `down` command; served as a static file.
- Escape output with `{{ }}`; JS data with `@json` / `@js`.

---

## 10. Testing

- Pest 5 (PHPUnit 13). `tests/Pest.php` binds `Tests\TestCase` + `RefreshDatabase` to `Feature`.
- **Safety:** `phpunit.xml` forces `DB_CONNECTION=sqlite`, `DB_DATABASE=:memory:` (`<env force>` + `<server>` entries) and `tests/TestCase.php::createApplication()` throws unless the connection is SQLite `:memory:` → tests can never wipe the MariaDB in Docker or a real DB. Never remove these. Needs `pdo_sqlite`.
- **Baseline (2026-10-30): 39 tests, 100 assertions, all passing** (natively and in Docker).
  - `Auth/*` — Breeze tests adapted to this app (role-based redirects via `User::homeRoute()`, registration with phone/address, login page links to password reset). `ProfileTest` was removed (the app has no profile feature).
  - `ProgramManagementTest` — update changes the row (no new row), unticking "Active" deactivates, delete removes, missing id → 404, users can't manage, validation errors visible.
  - `TestimonialTest` — submit without occupation, 255-char truncation, home photo path, admin edit page + update without occupation, admin 255-char validation error visible.
  - `RegressionTest` — every Blade view compiles (`view:cache`), OG image exists, WhatsApp number from config, category validation errors visible, admin password-confirmation redirect.
- With every bug fix or new behaviour add a Pest test in `tests/Feature` (`User::factory()->create(['role' => 'admin'])` — the factory defaults to role `user`; create categories/programs/testimonials directly with models — only `UserFactory` and an empty `TestimonialFactory` exist).

---

## 11. Environment & deployment

Important `.env` keys: `APP_KEY`, `APP_URL`, `APP_LOCALE` (keep `en`: the mail-subject pin in `lang/en.json` only covers `en`), `DB_*`, `SESSION_DRIVER/CACHE_STORE/QUEUE_CONNECTION=database`, `FILESYSTEM_DISK`, `MAIL_*`, `WHATSAPP_NUMBER`. No `.env` is committed. `../deployment/{local,prod}/.env*` (outside the repo) hold the maintainer's env files — never read, print or commit them.

Local `.env`: `php scripts/make-local-env.php` builds it from `.env.example` + `.env.docker` (APP_KEY, DB on 127.0.0.1:3308), moves any existing `.env` (e.g. a production one) to `../deployment/prod/.env.project-root-<timestamp>` and copies the result to `../deployment/local/.env`. It never prints secrets. Agents cannot run it themselves (`.env*` is denied in `.claude/settings.json`) — ask the user to run it.
⚠️ Until a local `.env` exists, do not run DB-touching artisan commands natively: the root `.env` may point at production.

### 11.1 ⚠️ Production differs from this repository
The production database contains `page_visits`, `section_visits`, `blogs`, `comments` (+ 2 migrations) that no branch of either remote contains. So the code currently deployed on the hosting has **extra features (visitor analytics, blog)** — the README's "real-time analytics / dynamic charts" refer to them. Deploying this repository as-is would **remove those features** from the live site (data would stay, unused). Before any deploy:
1. Download the current production code from the hosting (File Manager → compress the app folder) and keep it as a backup.
2. Ask the user whether that code should be brought into the repo first (diff it against `main`), or whether dropping those features is intended.

### 11.2 Hosting facts
cPanel shared hosting (CloudLinux, `cll-lve`), MariaDB **10.6.28**, PHP **8.4.27** at the time of the dump. `composer.json` requires PHP **^8.5** → switch the domain to PHP 8.5 *before* deploying this code (otherwise "Composer detected issues in your platform"). Production `.htaccess` = standard Laravel rules (kept as `../htaccess`).

**Full guide: `docs/DEPLOY-SHARED-HOSTING.md`.** Release package: `scripts/build-release.ps1` (git archive of HEAD + tests + `composer install --no-dev`; `-UseDocker`; `-WithWebInstaller`; output in the git-ignored `release/` folder, created on the first build). Rehearsal: `scripts/import-db.ps1 -File dump.sql -Migrate [-Native]`. Short version (server on **PHP 8.5**):
```bash
# back up the database + storage/app/public + current code from the hosting panel first
composer install --no-dev --optimize-autoloader
php artisan optimize:clear           # on a brand-new empty DB run migrate first (cache driver = database)
php artisan migrate --force          # 1 pending migration: 2026_10_30_000000_make_occupation_nullable_on_testimonials_table
php artisan storage:link             # once
php artisan config:cache && php artisan route:cache && php artisan view:cache
```
No Node, no queue worker needed (queue connection `database` is configured but nothing is dispatched), no cron.

---

## 12. Known issues & tech debt (updated 2026-10-30)

Fixed on 2026-10-30 (with tests): program update/delete binding (update created a new row, delete did nothing) and the "Active" checkbox that could never be unticked; testimonial without occupation → 500 (column now nullable); admin testimonial text > 255 → DB error (now validated); validation errors invisible on category/program/testimonial pages; broken Breeze account pages + `dashboard` redirects (→ `view:cache`/`optimize` failed); missing `admin.testimonial-edit` view; login sent users to `/admin/home`; wrong home testimonial photo path; missing `img/og-govind.jpg`; `Program::$fillable` `category`; seeder duplicate phone; missing `storage/*/.gitignore` placeholders; hard-coded WhatsApp number; unpinned Alpine; "Undefined array key" 500s when `slug`/`occupation` are omitted from a request.

Still open (by design or needing a decision):
1. **Production code drift** (§11.1) — blog/analytics code is not in the repo; README advertises those features.
2. `users.phone` is unique only through validation (no DB index; production data not checked for duplicates).
3. Contact form uses GET (name/email/message end up in the URL, then go to WhatsApp anyway) and requires role `user` — guests are sent to login and the typed message is lost.
4. Login always answers "Email atau password salah." — also when the real reason is the rate limit (5 attempts).
5. `hreflang` `en` and `id` both point to `/` although the site is English only.
6. Unused: Vite/Tailwind build files, `resources/css|js`, `ProfileUpdateRequest`, `View/Components/AppLayout`, Sail (dev dep).
7. No `pint.json`; don't mass-format.

## 12a. Laravel 12 → 13 upgrade (2026-10-30) — what was pinned to stay 1:1

Upgrade changed only framework/PHP versions (`composer.json`: php ^8.5, laravel/framework ^13.39, tinker ^3, Pest ^5, Breeze ^2.4, Pail, Pint, Sail, Collision, Faker bumps). Verified identical with a 70-step before/after scenario (status, redirects, flash, auth, exceptions, final DB rows + schema, rendered HTML), route table, test results and a real `php artisan serve` smoke test. Pins — **do not remove unless the user wants Laravel 13 behaviour**:

| Item | Why |
|---|---|
| `resources/views/errors/minimal.blade.php` (copy of Laravel 12's) | Laravel 13 restyled the built-in 401/403/404/419/429/500/503 pages |
| `lang/en.json` (`"Reset your password"` → `"Reset Password Notification"`, `"Verify your email address"` → `"Verify Email Address"`) | Laravel 13 renamed the default mail subjects |
| `config/database.php` `Pdo\Mysql::ATTR_SSL_CA` | `PDO::MYSQL_ATTR_SSL_CA` is deprecated in PHP 8.5 (same value) |

Accepted, non-visible differences: `@js()` emits raw UTF-8 (`Ü`) instead of `\u00dc` (same JS string; HTML-special chars still escaped); `/up` health page restyled; new signed-only `PUT storage/{path}` route (unsigned → 403/404); CSRF middleware is now `PreventRequestForgery` (requests with `Sec-Fetch-Site: same-origin` pass without token, everything else is token-checked as before — rrcons pins token-only CSRF, govind does not). Session serialization stays `php`, cache prefix / session cookie unchanged (config files define them).

---

## 13. Rules for agents

**Do**
- Match surrounding style: Laravel 11+ slim structure, controller-per-area (`AdminController`, `UserController`), validation arrays inline in controllers, Indonesian/English messages as already used in that module, `// ===== SECTION =====` banners in controllers.
- Keep role checks consistent: `routes/web.php` middleware ↔ `RoleMiddleware` ↔ views (`@auth` / `role` checks in `user/home`).
- Store uploads with `storeAs('<dir>', time().'-'.uniqid().'.'.$ext, 'public')`, save the filename only, render with `asset('storage/<dir>/'.$img)`, delete the old file on replace.
- Escape output (`{{ }}`, `@json`, `@js`); keep `@csrf` on every form.
- Run `php artisan test` before declaring work done; report the pass/fail counts honestly (baseline: all green).
- Add a Pest test with every bug fix or new behaviour.
- Update `.ai/handoff.md` before ending a session; update this file + `.ai/guidelines/*` when conventions change.

**Don't**
- Don't run `migrate:fresh|reset|refresh`, `db:wipe` or `db:seed` against anything but a throwaway local DB; never touch the production DB; never read/print/commit `.env*` or `../deployment/**`.
- Don't deploy without reading §11.1.
- Don't edit an already-run migration; add a new one.
- Don't remove the Laravel 13 pins (§12a) or the test DB guard (§10).
- Don't re-merge the remotes' histories; don't force-push `main`.
- Don't add `Co-Authored-By` trailers; follow the `(type) summary` commit format.
- Don't mass-reformat files or upgrade dependencies/framework without an explicit request.
- Don't trigger `confirm()` dialogs (admin delete buttons) when automating a browser.
