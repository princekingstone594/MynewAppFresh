<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW AUTH PAGES
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER USER
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect('/login')->with('success', 'Account created successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN USER (ROLE-BASED REDIRECT)
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT USER
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        return view('dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function admin()
    {
        return view('admin');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - VIEW USERS
    |--------------------------------------------------------------------------
    */

    public function users()
    {
        $users = User::latest()->get();

        return view('admin.users', compact('users'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - UPDATE USER ROLE
    |--------------------------------------------------------------------------
    */

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'User role updated successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DELETE USER
    |--------------------------------------------------------------------------
    */

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }
}