<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login page
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // Prevent session fixation
            $request->session()->regenerate();

            $user = auth()->user();

            // ✅ ROLE-BASED REDIRECT (FINAL)
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back Admin!');
            }

            return redirect()->route('dashboard')
                ->with('success', 'Welcome back!');
        }

        return back()->with('error', 'Invalid login details');
    }

    /**
     * Logout user (HARDENED)
     */
    public function destroy(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect safely
        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }
}