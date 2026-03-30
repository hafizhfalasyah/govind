<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Category;
use App\Models\Program;
use App\Models\Testimonial;

class AdminController extends Controller
{
    // ================================= HOME CONTROLLERS =================================
    public function home() {
        $today         = now();
        $startOfMonth  = $today->copy()->startOfMonth();
        $prevMonthFrom = $today->copy()->subMonth()->startOfMonth();
        $prevMonthTo   = $today->copy()->subMonth()->endOfMonth();

        // ========= USERS =========
        $totalUsers        = User::count();
        $usersThisMonth    = User::whereBetween('created_at', [$startOfMonth, $today])->count();
        $usersPrevMonth    = User::whereBetween('created_at', [$prevMonthFrom, $prevMonthTo])->count();

        $userGrowthPercent = $this->calculateGrowth($usersPrevMonth, $usersThisMonth);

        // ========= PROGRAMS =========
        $totalPrograms         = Program::count();
        $activePrograms        = Program::where('is_active', true)->count();
        $programsThisMonth     = Program::whereBetween('created_at', [$startOfMonth, $today])->count();
        $programGrowthPercent  = $this->calculateGrowth(
            Program::whereBetween('created_at', [$prevMonthFrom, $prevMonthTo])->count(),
            $programsThisMonth
        );

        // ========= TESTIMONIALS =========
        $totalTestimonials     = Testimonial::count();
        $testimonialsThisMonth = Testimonial::whereBetween('created_at', [$startOfMonth, $today])->count();

        // ========= RECENT ACTIVITY (COMBINED) =========
        $recentUsers = User::latest()->take(5)->get();
        $recentPrograms = Program::with('category')->latest()->take(5)->get();
        $recentTestimonials = Testimonial::latest()->take(5)->get();

        $activities = collect();

        foreach ($recentUsers as $u) {
            $activities->push([
                'type'       => 'user',
                'title'      => 'New user registered',
                'subtitle'   => $u->name . ' (' . ($u->email) . ')',
                'label'      => 'USER',
                'created_at' => $u->created_at,
            ]);
        }

        foreach ($recentPrograms as $p) {
            $activities->push([
                'type'       => 'program',
                'title'      => 'Program updated/created',
                'subtitle'   => $p->name . ' – ' . ($p->category->name ?? 'Uncategorized'),
                'label'      => 'PROGRAM',
                'created_at' => $p->created_at,
            ]);
        }

        foreach ($recentTestimonials as $t) {
            $activities->push([
                'type'       => 'testimonial',
                'title'      => 'New testimonial submitted',
                'subtitle'   => $t->name . ' – ' . ($t->occupation ?: 'Participant'),
                'label'      => 'TESTIMONIAL',
                'created_at' => $t->created_at,
            ]);
        }

        // sort by time desc, ambil 7 terakhir
        $activities = $activities
            ->sortByDesc('created_at')
            ->values()
            ->take(7);

        // Simple “health score” kecil-kecilan (0–100)
        $healthScore = 100;
        if ($totalPrograms === 0) {
            $healthScore = 70;
        } elseif ($activePrograms < $totalPrograms * 0.5) {
            $healthScore = 85;
        }

        return view('admin.home', compact(
            'totalUsers',
            'usersThisMonth',
            'userGrowthPercent',
            'totalPrograms',
            'activePrograms',
            'programsThisMonth',
            'programGrowthPercent',
            'totalTestimonials',
            'testimonialsThisMonth',
            'activities',
            'healthScore'
        ));
    }
    private function calculateGrowth(int $prev, int $current): ?float {
        if ($prev === 0 && $current === 0) {
            return 0;
        }
        if ($prev === 0 && $current > 0) {
            return 100;
        }

        return (($current - $prev) / max(1, $prev)) * 100;
    }

    // ================================= USER CONTROLLERS =================================
    public function user(Request $request) {
        $query = User::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $query->orderBy('created_at', 'desc');
        $users = $query->paginate(10)->withQueryString();

        return view('admin.user', compact('users'));
    }
    public function userStore(Request $request) {
        $data = $request->validate([
            'img'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required|regex:/^[0-9]{10,15}$/|unique:users,phone',
            'address'   => 'required|string|max:255',
            'password'  => 'required|string|min:8',
            'role'      => 'required|in:user,admin',
        ]);

        try {
            $user = new User();
            $user->name     = $data['name'];
            $user->email    = $data['email'];
            $user->phone    = $data['phone'];
            $user->address  = $data['address'];
            $user->password = bcrypt($data['password']);
            $user->role     = $data['role'];

            if ($request->hasFile('img')) {
                $filename = time() . '-' . uniqid() . '.' . $request->img->extension();
                $request->file('img')->storeAs('users', $filename, 'public');
                $user->img = $filename;
            }

            $user->save();

            return redirect()
                ->route('admin.user')
                ->with('success', 'Pengguna baru berhasil dibuat.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data pengguna: ' . $e->getMessage());
        }
    }
    public function userUpdate(Request $request, $id) {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'img'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'phone'     => 'required|regex:/^[0-9]{10,15}$/|unique:users,phone,' . $user->id,
            'address'   => 'required|string|max:255',
            'role'      => 'required|in:user,admin',
        ]);

        try {
            $user->name    = $data['name'];
            $user->email   = $data['email'];
            $user->phone   = $data['phone'];
            $user->address = $data['address'];
            $user->role    = $data['role'];

            if ($request->hasFile('img')) {
                if ($user->img && file_exists(storage_path('app/public/users/' . $user->img))) {
                    unlink(storage_path('app/public/users/' . $user->img));
                }

                $filename = time() . '-' . uniqid() . '.' . $request->img->extension();
                $request->file('img')->storeAs('users', $filename, 'public');

                $user->img = $filename;
            }

            $user->save();

            return redirect()
                ->route('admin.user')
                ->with('success', 'Data pengguna berhasil diperbarui.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }
    public function userDestroy($id) {
        $user = User::findOrFail($id);

        try {
            if (Auth::check() && Auth::id() === $user->id) {
                return redirect()
                    ->route('admin.user')
                    ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            }

            if ($user->img && file_exists(storage_path('app/public/users/' . $user->img))) {
                unlink(storage_path('app/public/users/' . $user->img));
            }

            $user->delete();

            return redirect()
                ->route('admin.user')
                ->with('success', 'Data pengguna berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.user')
                ->with('error', 'Gagal menghapus pengguna.');
        }
    }

    // ================================= CATEGORY CONTROLLERS =================================
    public function category(Request $request) {
        $query = Category::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%");
            });
        }

        $query->orderBy('created_at', 'desc');
        $categories = $query->paginate(10)->withQueryString();

        return view('admin.category', compact('categories'));
    }
    public function categoryStore(Request $request) {
        $data = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        try {
            Category::create($data);

            return redirect()
                ->route('admin.category')
                ->with('success', 'Kategori baru berhasil dibuat.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan kategori.');
        }
    }
    public function categoryUpdate(Request $request, $id) {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        try {
            $category->update($data);

            return redirect()
                ->route('admin.category')
                ->with('success', 'Kategori berhasil diperbarui.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui kategori.');
        }
    }

    public function categoryDestroy($id) {
        $category = Category::findOrFail($id);

        try {
            $category->delete();

            return redirect()
                ->route('admin.category')
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.category')
                ->with('error', 'Gagal menghapus kategori.');
        }
    }

    // ================================= PROGRAM CONTROLLERS =================================
    public function program(Request $request) {
        $query = Program::with('category');

        if ($request->filled('q')) {
            $q = $request->q;

            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('slug', 'like', "%{$q}%")
                    ->orWhereHas('category', function ($q2) use ($q) {
                        $q2->where('name', 'like', "%{$q}%");
                    });
            });
        }

        $query->orderBy('created_at', 'desc');
        $programs = $query->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.program', compact('programs', 'categories'));
    }
    public function programStore(Request $request) {
        $data = $request->validate([
            'img'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:programs,slug',
            'category_id' => 'required|exists:categories,id',
            'short_desc'  => 'nullable|string',
            'long_desc'   => 'nullable|string',
            'duration'    => 'nullable|string|max:100',
            'price'       => 'required|numeric|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        try {
            $program = new Program();

            $program->name        = $data['name'];
            $program->slug        = $data['slug'] ?: Str::slug($data['name']);
            $program->category_id = $data['category_id'];
            $program->short_desc  = $data['short_desc'] ?? null;
            $program->long_desc   = $data['long_desc'] ?? null;
            $program->duration    = $data['duration'] ?? null;
            $program->price       = $data['price'];
            $program->is_active   = $request->boolean('is_active', true);

            if ($request->hasFile('img')) {
                $filename = time() . '-' . uniqid() . '.' . $request->img->extension();
                $request->file('img')->storeAs('programs', $filename, 'public');
                $program->img = $filename;
            }

            $program->save();

            return redirect()
                ->route('admin.program')
                ->with('success', 'Program baru berhasil dibuat.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan program: ' . $e->getMessage());
        }
    }
    public function programUpdate(Request $request, Program $program) {
        $data = $request->validate([
            'img'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:programs,slug,' . $program->id,
            'category_id' => 'required|exists:categories,id',
            'short_desc'  => 'nullable|string',
            'long_desc'   => 'nullable|string',
            'duration'    => 'nullable|string|max:100',
            'price'       => 'required|numeric|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        try {
            $program->name        = $data['name'];
            $program->slug        = $data['slug'] ?: Str::slug($data['name']);
            $program->category_id = $data['category_id'];
            $program->short_desc  = $data['short_desc'] ?? null;
            $program->long_desc   = $data['long_desc'] ?? null;
            $program->duration    = $data['duration'] ?? null;
            $program->price       = $data['price'];
            $program->is_active   = $request->boolean('is_active', true);

            if ($request->hasFile('img')) {
                if ($program->img && file_exists(storage_path('app/public/programs/' . $program->img))) {
                    @unlink(storage_path('app/public/programs/' . $program->img));
                }

                $filename = time() . '-' . uniqid() . '.' . $request->img->extension();
                $request->file('img')->storeAs('programs', $filename, 'public');
                $program->img = $filename;
            }

            $program->save();

            return redirect()
                ->route('admin.program')
                ->with('success', 'Program berhasil diperbarui.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui program: ' . $e->getMessage());
        }
    }
    public function programDestroy(Program $program) {
        try {
            if ($program->img && file_exists(storage_path('app/public/programs/' . $program->img))) {
                @unlink(storage_path('app/public/programs/' . $program->img));
            }

            $program->delete();

            return redirect()
                ->route('admin.program')
                ->with('success', 'Program berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.program')
                ->with('error', 'Gagal menghapus program.');
        }
    }

    // ================================= TESTIMONIAL CONTROLLERS =================================
    public function testimonial(Request $request) {
        $query = Testimonial::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('occupation', 'like', "%{$q}%")
                    ->orWhere('text', 'like', "%{$q}%");
            });
        }

        $query->orderBy('created_at', 'desc');

        $testimonials = $query->paginate(10)->withQueryString();

        return view('admin.testimonial', compact('testimonials'));
    }
    public function testimonialEdit($id) {
        $testimonial = Testimonial::findOrFail($id);

        return view('admin.testimonial-edit', compact('testimonial'));
    }
    public function testimonialUpdate(Request $request, $id) {
        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'occupation'  => ['nullable', 'string', 'max:255'],
            'text'        => ['required', 'string'],
            'is_visible'  => ['nullable', 'boolean'],
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        $testimonial->update($validated);

        return redirect()
            ->route('admin.testimonial')
            ->with('success', 'Testimonial has been updated successfully.');
    }
    public function testimonialToggleVisibility(Request $request, $id) {
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->is_visible = $request->has('is_visible');
        $testimonial->save();

        $status = $testimonial->is_visible ? 'visible' : 'hidden';

        return redirect()
            ->route('admin.testimonial', $request->query())
            ->with('success', "Testimonial is now {$status}.");
    }

}
