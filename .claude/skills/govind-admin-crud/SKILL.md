---
name: govind-admin-crud
description: Add or change an admin CRUD module or field in GOVIND (users, categories, programs, testimonials or a new area) - migration, model, AdminController methods, admin routes, admin Blade page with Alpine modals, and the public home page when the data is shown there.
---

# GOVIND admin CRUD change

Follow the existing pattern exactly (see the `AdminController` user/category/program sections).

## 1. Database
- New migration file (`php artisan make:migration ...`); never edit one that already ran in production.
- MariaDB 10.6 in production, SQLite in tests: keep column types portable. If a column is optional in the form, make it `nullable()` (a NOT NULL `testimonials.occupation` with nullable validation caused 500s until 2026-10-30).

## 2. Model (`app/Models/<Name>.php`)
- `use HasFactory;`, `$fillable` with the **real** column names, `$casts` for booleans/decimals, relations (`belongsTo` / `hasMany`).

## 3. Routes (`routes/web.php`, inside the `admin.` group)
```php
Route::get('/<area>', [AdminController::class, '<area>'])->name('<area>');
Route::post('/<area>/store', [AdminController::class, '<area>Store'])->name('<area>.store');
Route::put('/<area>/update/{id}', [AdminController::class, '<area>Update'])->name('<area>.update');
Route::delete('/<area>/delete/{id}', [AdminController::class, '<area>Destroy'])->name('<area>.delete');
```

## 4. Controller (`AdminController`, new `// ===== <AREA> CONTROLLERS =====` section)
- List: `Model::query()`, `if ($request->filled('q'))` LIKE search, `orderBy('created_at', 'desc')`, `paginate(10)->withQueryString()`, `view('admin.<area>', compact(...))`.
- Store/Update: `$request->validate([...])` (max = column size); read optional keys with `$data['x'] ?? null`; checkboxes with `$request->boolean('x')`; for update `Model::findOrFail($id)` (method signature `($request, $id)`); assign fields; uploads via `storeAs('<dir>', time().'-'.uniqid().'.'.$ext, 'public')` and delete the old file; `try { ... } catch (QueryException $e) { return back()->withInput()->with('error', ...); }`; success → `redirect()->route('admin.<area>')->with('success', ...)`.
- Destroy: `findOrFail($id)`, delete file(s), `delete()`, flash.

## 5. Admin view (`resources/views/admin/<area>.blade.php`)
- `@extends('admin.layouts.main')`, `@section('title'|'page_title'|'page_subtitle'|'content')`.
- Copy the structure of `admin/category.blade.php` / `admin/user.blade.php`: flash banners, `@include('admin.partials.validation-errors')`, search form (GET), table, `$items->links()`, Alpine page object with create/edit modals, edit action `route('admin.<area>.update', ['id' => '__ID__'])`, `@csrf` + `@method('PUT'|'DELETE')`.
- Add the sidebar link in `admin/layouts/main.blade.php`.

## 6. Public page (if shown on `/`)
- Load data in `UserController@userHome`, render in `resources/views/user/home.blade.php`, escape output, pass JS data with `@json`.

## 7. Tests + docs
- Pest test in `tests/Feature/<Area>ManagementTest.php`: admin can list/create/update/delete, user and guest are redirected, validation errors.
- Run the `govind-verify` checklist. Update AGENTS.md §6–§8 and `.ai/guidelines/govind-admin-crud.md` if the pattern changed.
