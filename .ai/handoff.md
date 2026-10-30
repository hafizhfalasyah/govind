# Handoff log

Shared work log for every agent (Claude Code, Codex, Cursor, …) and human working on GOVIND.
**Newest entry first.** Read it at the start of a session; prepend an entry before you stop.
Template and rules: `.claude/skills/govind-handoff/SKILL.md` (plain Markdown — usable by any agent).

---

## 2026-10-30 — Claude Code — post-upgrade audit, agent handoff docs, Docker stack, deploy kit, backup tidy-up
- **Branch / HEAD:** `staging` → PR to `hafizhfalasyah/govind` main and to `solveit-id/govind` main (same branch pushed to both).
- **Goal:** deep audit after the Laravel 13 upgrade; create `AGENTS.md`, `CLAUDE.md`, `.claude/`, `.ai/` (Laravel Boost) and Docker/deploy structure consistent with `rrcons/rrcons_v2`; tidy the backup like `rrcons/rrcons_v1`.
- **Done:**
  - Docs: `AGENTS.md` (canonical), `CLAUDE.md`, `.ai/README.md`, `.ai/guidelines/govind-*.md`, this log; `.claude/settings.json`, skills `govind-{handoff,verify,admin-crud,release}`, agent `govind-reviewer`.
  - Docker (replaces the unused Sail `compose.yaml`): `Dockerfile` (php:8.5.7-apache-trixie), `compose.yaml` (app :8083, MariaDB 10.6.27 127.0.0.1:3308, Mailpit 1026/8026), `docker/{apache,php,scripts}`, `.dockerignore`, `.env.docker.example`, `README-Docker.md`; `.env.example` DB defaults → Docker MariaDB.
  - Test safety: `phpunit.xml` forces SQLite `:memory:` (`<env force>` + `<server>`), `tests/TestCase.php` guard.
  - Deploy kit: `docs/DEPLOY-SHARED-HOSTING.md`, `scripts/build-release.ps1`, `scripts/import-db.ps1`, `scripts/stubs/web-installer.php` (no `view:cache`).
  - `.gitignore`: `.env.docker`, `/.claude/settings.local.json`, `CLAUDE.local.md`, `/release`.
  - Backup (outside repo): `D:\PROYEK\PROYEK SOLVE IT\WEB\govind\govind_backup\pre-laravel13-20261030-100208\` (README.txt, `govind-all-branches.bundle`, `govind-project-laravel12.tar.gz`; restore-tested); loose zip removed. Tag renamed `backup/laravel-12-php-8.2` → `backup/laravel12-final` (pushed to both remotes).
- **In progress (uncommitted):** none.
- **Verification:** `php artisan test` 12 passed / 13 failed (known Breeze set) natively, with a hostile `DB_CONNECTION=mysql` env, and inside the Docker `app` container (MariaDB untouched). Docker: image builds, PHP 8.5.7 / Laravel 13.39.0, `public/storage` relative link created, upload limits 8M/16M, migrations on empty MariaDB OK. Production dump imported with `scripts/import-db.ps1 -Migrate` → "Nothing to migrate" for repo migrations, counts users 6 / categories 6 / programs 23 / testimonials 8 / page_visits 6449; `/`, `/login`, `/register`, `/up`, assets and uploaded images 200; no new log errors.
- **Audit findings (not fixed — ask the user before picking one up):** see AGENTS.md §12. Most important: (1) program update inserts a new row / delete does nothing (route `{id}` vs `Program $program`); (2) testimonial without occupation → 500; (3) **production runs code that is not in the repo** (`page_visits`, `section_visits`, `blogs`, `comments` tables + 2 migrations) — deploying this repo would drop those features; (4) hosting was on PHP 8.4.27, code needs 8.5; (5) login sends users to `/admin/home` → bounced with an error flash; (6) home testimonial photo path wrong; (7) `img/og-govind.jpg` missing.
- **Next steps (user):** decide about the production-only features before any deploy (AGENTS.md §11.1); pick bugs to fix from §12.
- **Gotchas / decisions:** Sail stays installed (dev dep) but its compose file was replaced; ports chosen so the RRCONS stack can run at the same time. Local `.env.docker` was generated (random secrets, git-ignored) and the Docker DB now holds a copy of production data — do not expose port 3308 beyond 127.0.0.1. `build-release.ps1` needs `-SkipTests` until the Breeze tests are fixed.

## 2026-10-30 — Claude Code — Laravel 12.43 → 13.39 and PHP ^8.2 → ^8.5 upgrade (1:1)
- **Branch / HEAD:** `staging` → PR #1 (`hafizhfalasyah/govind`, merge `0878414`); history unification merge `cc66ca8` → PR #5 (`solveit-id/govind`, merge `83c3030`) and PR #2 (`hafizhfalasyah/govind`, merge `e751c47`).
- **Goal:** run natively on local PHP 8.5.7 (no Docker needed); change nothing but versions.
- **Done:** `composer.json`/`lock` (php ^8.5, laravel/framework ^13.39, tinker ^3, Pest ^5.3 + plugin ^5, Breeze ^2.4, Pail ^1.2.7, Pint ^1.32, Sail ^1.69, Collision ^8.9, Faker ^1.24); `config/database.php` `Pdo\Mysql::ATTR_SSL_CA`; pins `lang/en.json` (mail subjects) and `resources/views/errors/minimal.blade.php` (Laravel 12 error layout).
- **Verification:** Laravel 12 baseline vs Laravel 13 on identical seeded SQLite: 70 scenario steps (guest/admin/user, all CRUD, validation, pagination, CSRF 419) identical in status/redirect/flash/auth/exception/DB rows+schema/HTML except `/up` and `@js` unicode escaping; route table identical (+ signed-only `PUT storage/{path}`); test results identical; real `php artisan serve` smoke test identical; `composer audit` clean.
- **Gotchas / decisions:** `origin` and `solveit` had unrelated histories; the user chose to unify them (one `--allow-unrelated-histories` merge, conflicts resolved to the newer files). solveit `main` thereby also received the README updates and `public/maintenance.html`.
