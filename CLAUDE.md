# CLAUDE.md — GOVIND

The full, canonical project guide is `AGENTS.md` (shared with Codex and other agents) and is imported below.
Keep project knowledge in `AGENTS.md` / `.ai/guidelines/`; keep this file for Claude Code specifics only.

@AGENTS.md

---

## Claude Code specifics

### Session start / handoff
- Run the `govind-handoff` skill (or follow AGENTS.md §0): read `.ai/handoff.md`, check `git status -sb` / `git branch -vv`, run `php artisan test` (expected baseline: all 39 tests green).
- Before ending a session or when context is getting full, update `.ai/handoff.md` so another agent (Claude Code, Codex, …) can continue.

### Project skills (`.claude/skills/`)
| Skill | Use it when |
|---|---|
| `govind-handoff` | Starting a session, resuming someone else's work, or writing the handoff log before stopping |
| `govind-verify` | Before saying a change is done (tests vs. baseline, route/role checks, upload paths, view checks) |
| `govind-admin-crud` | Adding/changing an admin CRUD module or field (migration, model, `AdminController`, routes, admin view modal, public view) |
| `govind-release` | The user asks to commit / push / open or merge PRs on both remotes (user-invoked only) |

### Project subagents (`.claude/agents/`)
- `govind-reviewer` — read-only review of the current diff against the rules in AGENTS.md §13.

### Settings (`.claude/settings.json`)
- Allowed without prompting: tests, route list, `about`, read-only git, `docker compose ps/logs`.
- Asks first: `git push`, `gh pr *`, any `php artisan migrate*`, `docker compose down`.
- Denied: reading `.env*` / `../deployment/**` secrets, `migrate:fresh|reset|refresh`, `db:wipe`, `db:seed`, `docker compose down -v`.
- Personal overrides go in `.claude/settings.local.json` (git-ignored).

### Environment notes
- Windows host; both PowerShell and Git Bash are available. Paths contain spaces (`D:\PROYEK\PROYEK SOLVE IT\WEB\govind\govind_v1`) — always quote them. In Git Bash use `tar --force-local` for `D:/…` archives; GNU `sed` treats `\S` as a class (escape backslashes in PHP namespaces).
- Laravel 13.39 on PHP 8.5.7 runs natively (`php artisan serve`, XAMPP PHP at `C:\xampp\php\php.exe`) or fully in Docker (http://localhost:8083, MariaDB 127.0.0.1:3308, Mailpit http://localhost:8026). After dependency changes run `php artisan optimize:clear`.
- `.env*` reads are denied by `.claude/settings.json`; inspect config with `php artisan tinker --execute="echo config('...');"` instead. The local `.env` is created by the user with `php scripts/make-local-env.php` (it moves a production `.env` out of the project); until then the root `.env` may be production — run DB-touching artisan commands only in Docker (compose env overrides `DB_*`).
- Production code on the hosting is ahead of this repo (blog + analytics tables) — AGENTS.md §11.1. Never deploy without asking.
- Deploy to shared hosting: `docs/DEPLOY-SHARED-HOSTING.md` (`scripts/build-release.ps1 [-UseDocker] [-WithWebInstaller]`, `scripts/import-db.ps1 [-Native]`). Never print or commit web-installer keys (`release/` is git-ignored).
- Commit messages: `(type) lowercase summary`, **no `Co-Authored-By` trailer and no "Generated with" line in PR bodies** (explicit user preference).
