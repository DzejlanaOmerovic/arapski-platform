<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */public function update(Request $request): RedirectResponse
{
    $validated = $request->validateWithBag('updatePassword', [
        'current_password' => ['required', 'current_password'],
        'password' => [
            'required',
            'confirmed',
            'min:8',
            'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&]).{8,}$/',
            function ($attribute, $value, $fail) use ($request) {
                $count = \App\Models\AdminSetting::get('password_history_count', 3);
                $history = \App\Models\PasswordHistory::where('user_id', $request->user()->id)
                    ->latest()->take($count)->get();
                foreach ($history as $old) {
                    if (\Illuminate\Support\Facades\Hash::check($value, $old->password_hash)) {
                        $fail('Ne možete koristiti jednu od posljednjih ' . $count . ' lozinki!');
                    }
                }
            },
        ],
    ]);

    $request->user()->update([
        'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
    ]);

    \App\Models\PasswordHistory::create([
        'user_id'       => $request->user()->id,
        'password_hash' => \Illuminate\Support\Facades\Hash::make($validated['password']),
    ]);

    return back()->with('status', 'password-updated');
}
}
