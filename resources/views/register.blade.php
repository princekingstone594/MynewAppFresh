<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Tailwind CDN (replaces Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white w-full max-w-md p-8 rounded shadow">

    {{-- FLASH MESSAGES --}}
    @include('partials.flash')

    <h1 class="text-2xl font-bold text-center mb-6">
        Create Account 🚀
    </h1>

    <form method="POST" action="/register" class="space-y-4">
        @csrf

        <!-- NAME -->
        <div>
            <label class="block text-sm font-medium">Name</label>
            <input type="text" name="name"
                   class="w-full border p-2 rounded mt-1"
                   value="{{ old('name') }}"
                   required>
        </div>

        <!-- EMAIL -->
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email"
                   class="w-full border p-2 rounded mt-1"
                   value="{{ old('email') }}"
                   required>
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password"
                   class="w-full border p-2 rounded mt-1"
                   required>
        </div>

        <!-- CONFIRM PASSWORD -->
        <div>
            <label class="block text-sm font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border p-2 rounded mt-1"
                   required>
        </div>

        <!-- SUBMIT -->
        <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Register
        </button>
    </form>

    <p class="text-center text-sm mt-4">
        Already have an account?
        <a href="/login" class="text-blue-600">Login</a>
    </p>

</div>

</body>
</html>