<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SaaS App') }}</title>

    <!-- Tailwind CDN (SAFE - no build tools) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-indigo-700 text-white p-5 space-y-6">
        <h1 class="text-xl font-bold">My SaaS</h1>

        <nav class="space-y-2">
            <a href="/dashboard" class="block p-2 rounded hover:bg-indigo-600">Dashboard</a>
            <a href="/projects" class="block p-2 rounded hover:bg-indigo-600">Projects</a>
        </nav>

        <div class="pt-6 border-t border-indigo-500">
            <span class="block mb-2 text-sm">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-6">

        @include('partials.flash')

        @yield('content')

    </main>

</div>

</body>
</html>