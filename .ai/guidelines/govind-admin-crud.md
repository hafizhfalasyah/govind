## GOVIND — admin CRUD modules

- One controller (`AdminController`) handles every admin area: `user*`, `category*`, `program*`, `testimonial*` methods. Each list method = search `?q=` (LIKE), `orderBy('created_at', 'desc')`, `paginate(10)->withQueryString()`.
- Routes live in the `Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')` group: `GET /{area}`, `POST /{area}/store`, `PUT /{area}/update/{id}`, `DELETE /{area}/delete/{id}` (testimonials: `PUT /testimonial/{id}`, `PATCH /testimonial/{id}/toggle`, no delete).
- Write methods: `validate([...])`, assign attributes explicitly, `save()`, wrap in `try/catch (QueryException)` → `back()->withInput()->with('error', ...)`; success → `redirect()->route('admin.<area>')->with('success', ...)`.
- Use `findOrFail($id)` with `{id}` routes. Do **not** type-hint a model whose variable name differs from the route parameter (that is the existing program update/delete bug).
- Relations: `Category hasMany Program` (FK cascade on delete — deleting a category deletes its programs); testimonials are not linked to users (name/img are copied).
- Admin views: `resources/views/admin/<area>.blade.php`, an Alpine page object with `openCreateModal()` / `openEditModal({...})`, flash banners for `session('success'|'error')`, pagination via `$items->links()`.
- New field = new migration file + model `$fillable`/casts + validation in store/update + create/edit modal inputs + list column + public view if shown.
