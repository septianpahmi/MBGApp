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
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        if (Hash::check($validated['password'], $request->user()->password)) {
            return back()->with('error', 'The new password cannot be the same as the current password.');
        } elseif (!Hash::check($validated['current_password'], $request->user()->password)) {
            return back()->with('error', 'The current password is incorrect.');
        } elseif (!Hash::check($validated['password_confirmation'], $request->user()->password)) {
            return back()->with('error', 'The password confirmation does not match.');
        } else {
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            return back()->with('success', 'Password updated successfully.');
        }
    }
}
