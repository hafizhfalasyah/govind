## GOVIND — auth & roles

- Login: `AuthenticatedSessionController@store` + `LoginRequest` (rate limit 5 per email+IP); any failure shows "Email atau password salah."; success → `redirect()->intended(route('admin.home'))` for every role (users then get bounced to `/home` with an error flash — known issue).
- Register: `RegisteredUserController@store` requires name, unique email, phone `^[0-9]{10,15}$` (unique), address, confirmed password, optional img (≤2 MB → `storage/app/public/users`); role is always `user`; auto-login → `home`.
- `RoleMiddleware` (`role:admin` / `role:user`): guest → login; wrong role → admin to `admin.home` ("You cannot access that page as admin."), others to `home` ("You have no access to that page.").
- Unauthenticated access is rendered in `bootstrap/app.php`: JSON 401, or redirect to login with flash `error` ("Please login first to submit a testimonial." for the testimonial routes, otherwise "Please login first.").
- Broken Breeze screens (forgot/reset/confirm password, verify email) use missing `<x-*>` components and a missing `dashboard` route; `POST /forgot-password` works. `User` does not implement `MustVerifyEmail`.
- Mail subjects are pinned to the Laravel 12 wording via `lang/en.json`; keep `APP_LOCALE=en`.
