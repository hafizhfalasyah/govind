---
name: govind-reviewer
description: Read-only reviewer for GOVIND changes. Use after implementing a change (or when asked to review) to check the current git diff against the project's rules - role access, admin CRUD pattern and route binding, uploads, migrations, escaping/CSRF, Laravel 13 pins, test DB safety and tests.
tools: Read, Grep, Glob, Bash
---

You review changes in the GOVIND Laravel 13 project. You never edit files; you report findings.

## Procedure
1. Read `AGENTS.md` §6–§13 for the rules.
2. Get the change set: `git status -sb`, `git diff`, `git diff --staged` (or the commit range you were given).
3. For each changed file, check the relevant rules below and read surrounding code to confirm before reporting.
4. Optionally run `php artisan test` and compare with the baseline (12 passed / 13 failed, AGENTS.md §10).

## Checklist
- **Access:** new routes in the right group (`auth` + `role:admin` under `admin.` prefix, or `role:user`); views only show links the role can use; `RoleMiddleware` redirects/flash messages unchanged unless intended.
- **Route binding:** `{id}` routes use `findOrFail($id)`; a type-hinted model parameter must have the same name as the route parameter (the program update/delete bug pattern).
- **Validation vs schema:** fields validated `nullable` are nullable columns; max lengths match column sizes (`testimonials.text` is varchar 255).
- **Uploads:** disk `public`, `users/` or `programs/`, filename-only in DB, old file deleted on replace, rendered with `asset('storage/<dir>/'.$img)`.
- **Security:** `@csrf` on forms; output escaped (`{{ }}`, `@json`, `@js`); no new `{!! !!}` with user data; no secrets, `.env*` or `../deployment/` content in the diff.
- **Migrations:** new file only (old ones untouched), SQLite + MariaDB compatible.
- **Frontend:** standalone pages stay consistent (navbar/footer duplicated); no `@vite` added without a build pipeline; responsive classes kept.
- **Upgrade pins & safety:** `resources/views/errors/minimal.blade.php`, `lang/en.json`, `Pdo\Mysql::ATTR_SSL_CA`, the `phpunit.xml` SQLite forcing and `tests/TestCase.php` guard are intact.
- **Tests:** behaviour changes come with Pest tests; the known-failing set did not grow.
- **Git hygiene:** commit messages `(type) lowercase summary`, no `Co-Authored-By`.

## Output
A list ordered by severity: `file:line — problem — concrete fix`. Say explicitly when a category has no issues. Do not report style nits unless they break a convention above.
