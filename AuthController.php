<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // =========================
    // REGISTER VIEW
    // =========================
    public function showRegister()
    {
        return view('auth.register');
    }

    // =========================
    // REGISTER USER
    // =========================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    // =========================
    // LOGIN VIEW
    // =========================
    public function showLogin()
    {
        return view('auth.login');
    }

    // =========================
    // LOGIN LOGIC (ROLE-BASED REDIRECT)
    // =========================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 🔥 ROLE REDIRECT SYSTEM
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    // =========================
    // USER DASHBOARD
    // =========================
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 🔥 FORCE ROLE SEPARATION
        if (Auth::user()->role === 'admin') {
            return redirect('/admin');
        }

        return view('auth.dashboard', [
            'user' => Auth::user(),
            'userCount' => User::count(),
        ]);
    }

    // =========================
    // ADMIN DASHBOARD
    // =========================
    public function admin()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('auth.admin', [
            'user' => Auth::user(),
            'userCount' => User::count(),
            'latestUsers' => User::latest()->take(5)->get(),
        ]);
    }

    // =========================
    // USER MANAGEMENT (ADMIN ONLY)
    // =========================
    public function users(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('auth.users', compact('users', 'search'));
    }

    // =========================
    // TOGGLE ROLE (ADMIN ONLY)
    // =========================
    public function updateRole($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($id);

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back();
    }

    // =========================
    // DELETE USER (ADMIN ONLY)
    // =========================
    public function deleteUser($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete yourself');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}