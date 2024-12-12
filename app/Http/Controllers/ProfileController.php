<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'student' => $request->user()->role == 'admin' ? null : $request->user()->student,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $fields = $request->validate([
            'age' => ['required', 'numeric', 'min:1', 'max:150'],
            'address' => ['required', 'string', 'max:254'],
            'course' => ['required', 'string', 'max:254'],
            'year' => ['required', 'numeric', 'max:254'],
            'sex' => ['required', 'max:254'],
        ]);
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        if($request->user()->role == 'student') {
            $request->user()->student->update($fields);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated')->with('message', 'Profile updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
