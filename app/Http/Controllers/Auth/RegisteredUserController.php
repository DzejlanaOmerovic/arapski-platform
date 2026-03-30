<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'min:3', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'     => ['required', 'in:student,teacher'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:255'],
            'password' => [
                'required', 'confirmed', 'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&]).{8,}$/'
            ],
        ]);

        // Generisanje usernamea
        $base = strtolower(explode(' ', $request->name)[0]) . '.' . $request->role;
        $count = User::where('username', 'like', $base . '%')->count() + 1;
        $username = $base . '.' . str_pad($count, 3, '0', STR_PAD_LEFT);

        $user = User::create([
            'name'     => $request->name,
            'username' => $username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'phone'    => $request->phone,
            'location' => $request->location,
            'status'   => 'pending', // čeka admin odobrenje
        ]);

        // Sačuvaj lozinku u historiju
        \App\Models\PasswordHistory::create([
            'user_id'       => $user->id,
            'password_hash' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Ne logujemo odmah — čeka admin odobrenje
        return redirect()->route('login')
            ->with('status', 'Zahtjev za registraciju je poslan! Sačekajte odobrenje administratora. Vaše korisničko ime je: ' . $username);
    }
}