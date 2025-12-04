<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'img'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required|regex:/^[0-9]{10,15}$/|unique:users,phone',
            'address'   => 'required|string|max:255',
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $filename = null;

        if ($request->hasFile('img')) {
            $file = $request->file('img');

            // Nama file unik
            $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan ke disk 'public' di folder 'users'
            // => storage/app/public/users/xxx.jpg
            Storage::disk('public')->putFileAs('users', $file, $filename);
        }

        $user = User::create([
            'img'      => $filename,
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'address'  => $data['address'],
            'role'     => 'user',
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
