---
name: govind-release
description: Commit, push and open/merge pull requests for GOVIND on both GitHub remotes (hafizhfalasyah/govind and solveit-id/govind), which share one history since 2026-10-30. Use only when the user explicitly asks to commit, push, create a PR or merge.
disable-model-invocation: true
---

# GOVIND release flow (dual remote, shared history)

| Remote | Repo | Branches |
|---|---|---|
| `origin` | `hafizhfalasyah/govind` | local `main` → `main`, local `staging` → `staging` |
| `solveit` | `solveit-id/govind` | local `staging` → `staging` |

Both repos contain the same history (unified by merge `cc66ca8`); each merges PRs with its own merge commit, so the `main` tips differ in hash but **must have identical trees**. Never re-merge with `--allow-unrelated-histories`, never force-push `main`.

## 0. Pre-flight
```bash
git fetch --all --prune
git status -sb && git branch -vv
php artisan test     # must be green
git switch staging && git merge --ff-only origin/main
```

## 1. Commit (on `staging`)
- Group changes into logical commits. Format: `(add|update|fix|merge|test|chore|docs) lowercase imperative summary` — e.g. `(update) remove channel pending tabs and align delete confirmation modal`.
- **No `Co-Authored-By` trailer**, no "Generated with" line. No secrets, no `.env*`, no `release/`, nothing from `../deployment/`.
- Stage explicit paths (`git add <paths>`), not `git add -A`, and review `git diff --staged --stat`.

## 2. Push to both remotes
```bash
git push origin staging
git push solveit staging
```

## 3. PR + merge on each repo
```bash
gh pr create --repo hafizhfalasyah/govind --base main --head staging --title "<summary>" --body-file <body.md>
gh pr view <n> --repo hafizhfalasyah/govind --json mergeable,mergeStateStatus
gh pr merge <n> --repo hafizhfalasyah/govind --merge

gh pr create --repo solveit-id/govind --base main --head staging --title "<summary>" --body-file <body.md>
gh pr view <n> --repo solveit-id/govind --json mergeable,mergeStateStatus
gh pr merge <n> --repo solveit-id/govind --merge
```
If a PR is not mergeable: `git merge <remote>/main` into `staging`, resolve so the result equals the intended tree (usually the `staging` side), re-run tests, push, then merge.

## 4. Sync and verify
```bash
git fetch --all --prune
git switch main && git merge --ff-only origin/main
git diff origin/main solveit/main     # must print nothing
```
Return to the branch the user was on. Report PR URLs, merge commits and test results. Prepend an entry to `.ai/handoff.md`.

PR bodies: plain description (what / why / verification), no co-author or tool attribution lines.
