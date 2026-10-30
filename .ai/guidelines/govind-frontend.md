## GOVIND — frontend

- Pages are standalone HTML documents: `user/home`, `user/testimonial`, `auth/login`, `auth/register`; admin pages extend `admin/layouts/main.blade.php` (`@section('title')`, `page_title`, `page_subtitle`, `content`).
- Styling: Tailwind **Play CDN** (`cdn.tailwindcss.com`) with inline `tailwind.config` (brand teal `#285E5E`, `#7EC6C4`, `#A6DCD3`). No build step: `vite.config.js`, `tailwind.config.js`, `resources/css|js` are unused Breeze leftovers; no view uses `@vite`.
- CDN libraries: Alpine 3 (admin modals/flash), AOS 2.3.4, Leaflet 1.9.4 (map in the contact section via `public/js/script.js`, centred on Malang). Mobile menu: `#navbarToggle` / `#mobileMenu` in `public/js/script.js`.
- Home page data: programs slider (`[data-program-slide]`), testimonials JS slider fed by `@json($testimonialsJs)`, contact form = GET `submit-contact` (role user) → WhatsApp.
- Admin UI: per-page Alpine objects (e.g. `programPage()`) with create/edit modals; edit form actions built from `route(..., ['id' => '__ID__'])`; delete forms use `confirm()`.
- Responsive: Tailwind `md:`/`lg:` breakpoints; check desktop and ~390 px mobile after UI changes.
- Escape with `{{ }}`; pass data to JS with `@json` / `@js`. Images: `asset('img/...')` for static files, `asset('storage/<users|programs>/'.$img)` for uploads.
- `public/maintenance.html` is a standalone static maintenance page.
