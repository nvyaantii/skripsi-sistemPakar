<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Livewire\Article\Detail;
use App\Http\Controllers\RiwayatDiagnosaController;
use App\Livewire\Diagnosa;
use App\Livewire\HasilDiagnosaComponent;
use App\Livewire\TentangPakar;

// ---------------------
// Home
// ---------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// ---------------------
// Artikel
// ---------------------
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

// ---------------------
// Diagnosa (Livewire)
// ---------------------
Route::get('/diagnosa', Diagnosa::class)->name('diagnosa');
Route::get('/hasil-diagnosa', HasilDiagnosaComponent::class)->name('hasil.diagnosa');

// ---------------------
// Tentang Pakar (Livewire)
// ---------------------
Route::get('/tentang-pakar', TentangPakar::class)->name('tentang.pakar');

// ---------------------
// Authenticated Routes (Profile, Riwayat, Logout)
// ---------------------
Route::middleware('auth')->group(function () {
    // Halaman profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Update profile
    Route::post('/profile/update', function (Request $request) {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    })->name('profile.update');

    // ✅ Halaman Riwayat Diagnosa
    Route::get('/riwayat-diagnosa', [RiwayatDiagnosaController::class, 'index'])
        ->name('riwayat.diagnosa');

    // Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    })->name('logout');
});

// ---------------------
// Guest Routes (Login & Register)
// ---------------------
Route::middleware('guest')->group(function () {
    // Halaman Login (GET)
    Route::get('/login', function () {
        return view('livewire.pages.auth.login');
    })->name('login');

    // Login (POST)
    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    })->name('login.post');

    // Halaman Register (GET)
    Route::get('/register', function () {
        return view('livewire.pages.auth.register');
    })->name('register');

    // Register (POST)
    Route::post('/register', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    })->name('register.post');
});
