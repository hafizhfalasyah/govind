<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Program;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // ================================= HOME CONTROLLERS =================================
    public function userHome()
    {
        $programs = Program::with('category')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // HANYA AMBIL TESTIMONIAL YANG VISIBLE
        $testimonials = Testimonial::where('is_visible', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $testimonialsJs = $testimonials->map(function ($t) {
            $initial = collect(explode(' ', $t->name))
                ->filter()
                ->take(2)
                ->map(fn ($part) => mb_substr($part, 0, 1))
                ->implode('');

            return [
                'text'    => $t->text,
                'name'    => $t->name,
                'role'    => $t->occupation,
                'photo'   => $t->img ? asset($t->img) : null,
                'date'    => $t->created_at->translatedFormat('d F Y'),
                'initial' => \Illuminate\Support\Str::upper(substr($initial, 0, 1)),
            ];
        })->values();

        return view('user.home', [
            'testimonialsJs' => $testimonialsJs,
            'testimonials'   => $testimonials,
            'programs'       => $programs,
        ]);
    }

    // ================================= PROGRAM CONTROLLERS =================================
    public function userRegisterProgram(Program $program) {
        $user = Auth::user();

        $nomorTujuan = '6282245975553';

        $message  = "🌟 *Pendaftaran Program Govind Abra Enterprise* 🌟\n\n";
        $message .= "Halo Admin,\n";
        $message .= "Perkenalkan, saya *{$user->name}*.\n\n";
        $message .= "Saya ingin mendaftarkan diri pada program:\n";
        $message .= "👉 *{$program->name}*\n\n";
        $message .= "Mohon informasinya terkait jadwal dan prosedur selanjutnya.\n";
        $message .= "Terima kasih 🙏";

        $url = "https://wa.me/{$nomorTujuan}?text=" . urlencode($message);

        return redirect()->away($url);
    }

    // ================================= TESTIMONIAL CONTROLLERS =================================
    public function userTestimonial() {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login')->with('error', 'Please login first to submit a testimonial.');
        }

        return view('user.testimonial', compact('user'));
    }
    public function userSubmitTestimonial(Request $request) {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login')->with('error', 'Please login first to submit a testimonial.');
        }

        $data = $request->validate([
            'occupation' => 'nullable|string|max:255',
            'text'       => 'required|string',
        ]);

        $imgPath = $user->img;

        $maxLength = 255;
        $data['text'] = \Illuminate\Support\Str::limit($data['text'], $maxLength, '');

        Testimonial::create([
            'name'       => $user->name,
            'occupation' => $data['occupation'],
            'text'       => $data['text'],
            'img'        => $imgPath,
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Thank you for your testimonial!');
    }

    // ================================= CONTACT CONTROLLERS =================================
    public function userSubmitContact(Request $request) {
        $nomorTujuan = '6282245975553';

        $message  = "📩 *Pesan Kontak dari Website Govind Abra Enterprise* 📩\n\n";
        $message .= "Halo Admin,\n";
        $message .= "Saya ingin menyampaikan pesan melalui form kontak.\n\n";
        $message .= "🧑 Nama : *{$request->get('name')}*\n";
        $message .= "📧 Email : *{$request->get('email')}*\n\n";
        $message .= "💬 Pesan:\n";
        $message .= "{$request->get('message')}\n\n";
        $message .= "Mohon tindak lanjutnya. Terima kasih 🙏";

        $url = "https://wa.me/{$nomorTujuan}?text=" . urlencode($message);

        return redirect()->away($url);
    }

}
