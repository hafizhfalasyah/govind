---
name: govind-handoff
description: Resume or hand off work on the GOVIND Laravel project. Use at the start of a session, when continuing another agent's (Claude Code, Codex, …) unfinished work, or before stopping / when context is nearly full to write the handoff log in .ai/handoff.md.
---

# GOVIND handoff

## A. Resuming (start of session)

1. Read `AGENTS.md` (canonical guide) and `.ai/handoff.md` (latest work log). The newest entry is at the top.
2. Inspect the real state — trust git over the log if they disagree:
   ```bash
   git status -sb
   git branch -vv
   git log --oneline -10
   git stash list
   ```
   Remember: `origin` (hafizhfalasyah/govind) and `solveit` (solveit-id/govind) share one history since 2026-10-30; `main` tracks `origin/main`, `staging` is pushed to both remotes.
3. If there are uncommitted changes, read them (`git diff`, `git diff --staged`) and match them to the "In progress" section of the log before editing anything.
4. Establish a baseline: `php artisan test` → expected **all green** (39 tests, AGENTS.md §10). Note any failure in the log instead of silently "fixing" unrelated code.
5. If Docker is used: `docker compose --env-file .env.docker ps` (app :8083, db 127.0.0.1:3308, mailpit :8026).
6. Summarise to the user in a few lines: branch, last commit, what is in progress, what you will do next.

## B. Handing off (before stopping)

Prepend a new entry to `.ai/handoff.md` using this template (keep older entries; trim entries older than ~10 sessions into one summary line):

```markdown
## YYYY-MM-DD — <agent name> — <short task title>
- **Branch / HEAD:** <branch> @ <short sha> (pushed? yes/no, which remotes)
- **Goal:** <what the user asked for>
- **Done:** <bullets, with file paths>
- **In progress (uncommitted):** <files + state, or "none">
- **Next steps:** <ordered, concrete>
- **Verification:** <tests run + pass/fail counts, manual checks, Docker?>
- **Gotchas / decisions:** <anything the next agent must know>
```

Rules:
- Facts only; do not claim tests passed unless you ran them in this session.
- Never paste secrets, `.env*` values or anything from `../deployment/` into the log.
- If you changed project behaviour or conventions, also update `AGENTS.md` (and the matching file in `.ai/guidelines/`) so the docs stay the source of truth.
