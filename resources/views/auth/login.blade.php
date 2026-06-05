@extends('layouts.guest')

@section('content')

<h2 class="text-2xl font-bold mb-4">Login</h2>

<form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf

    <input type="email" name="email" placeholder="Email"
        class="w-full border p-2 rounded" required>

    <input type="password" name="password" placeholder="Password"
        class="w-full border p-2 rounded" required>

    <div class="flex items-center justify-between">
        <label class="flex items-center gap-2">
            <input type="checkbox" name="remember">
            Remember me
        </label>

        <a href="/register" class="text-indigo-600 text-sm">
            Create account
        </a>
    </div>

    <button class="w-full bg-indigo-600 text-white py-2 rounded">
        Login
    </button>
</form>

@endsection