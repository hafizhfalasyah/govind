<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Category;
use App\Models\Program;

class AdminController extends Controller
{
    // ================================= HOME CONTROLLERS =================================
    public function home() {
        return view('admin.home');
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
                $request->img->storeAs('public/users', $filename);
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
                $request->img->storeAs('public/users', $filename);
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
                $request->img->storeAs('public/programs', $filename);
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
                $request->img->storeAs('public/programs', $filename);
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

}
