## GOVIND — uploads

- Disk `public` (`storage/app/public`). Users: `users/`, max 2 MB, `jpg,jpeg,png,webp`. Programs: `programs/`, max 4 MB. Filename `time().'-'.uniqid().'.'.$ext`; the DB stores the filename only.
- Render with `asset('storage/users/'.$img)` / `asset('storage/programs/'.$img)` (or `Program::image_url`). Requires `php artisan storage:link`; in Docker the entrypoint creates a relative `public/storage` link.
- On replace/delete remove the old file (`unlink(storage_path('app/public/<dir>/'.$img))`; programs use `@unlink`).
- Testimonials store the submitting user's `img` filename; it is rendered from `storage/users/` (admin list and home slider).
- Docker PHP limits: `docker/php/custom.ini` 8M/16M. On the hosting check *Select PHP Version → Options* if uploads over 2 MB fail.
