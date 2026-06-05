@extends('layouts.guest')

@section('content')

<h2 class="text-2xl font-bold mb-4">Create Account</h2>

<form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <input type="text" name="name" placeholder="Full Name"
        class="w-full border p-2 rounded" required>

    <input type="email" name="email" placeholder="Email"
        class="w-full border p-2 rounded" required>

    <input type="password" name="password" placeholder="Password"
        class="w-full border p-2 rounded" required>

    <input type="password" name="password_confirmation" placeholder="Confirm Password"
        class="w-full border p-2 rounded" required>

    <button class="w-full bg-indigo-600 text-white py-2 rounded">
        Register
    </button>

    <p class="text-sm text-center mt-3">
        Already have an account?
        <a href="/login" class="text-indigo-600">Login</a>
    </p>
</form>

@endsection