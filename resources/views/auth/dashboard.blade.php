<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            MyApp
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="/dashboard" class="block px-4 py-2 rounded bg-gray-700">Dashboard</a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">Profile</a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">Settings</a>
        </nav>

        <form method="POST" action="/logout" class="p-4 border-t border-gray-700">
            @csrf
            <button class="w-full bg-red-500 py-2 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- TOP BAR -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">Dashboard</h1>
            <div class="text-gray-600">
                {{ auth()->user()->name }}
            </div>
        </header>

        <!-- CONTENT -->
        <main class="p-6 overflow-y-auto">

            <h2 class="text-2xl font-bold mb-6">
                Welcome back, {{ auth()->user()->name }} 👋
            </h2>

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-gray-500">Total Users</h3>
                    <p class="text-3xl font-bold mt-2">{{ $userCount }}</p>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-gray-500">Projects</h3>
                    <p class="text-3xl font-bold mt-2">3</p>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-gray-500">Tasks</h3>
                    <p class="text-3xl font-bold mt-2">7</p>
                </div>

            </div>

            <!-- LATEST USERS -->
            <div class="bg-white p-6 rounded shadow mb-6">
                <h3 class="text-lg font-semibold mb-4">Latest Users</h3>

                <ul class="space-y-2 text-gray-600">
                    @foreach($latestUsers as $user)
                        <li>👤 {{ $user->name }} - {{ $user->email }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- ACTIVITY -->
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-4">Activity</h3>

                <ul class="space-y-2 text-gray-600">
                    <li>✅ Logged in</li>
                    <li>📝 Viewed dashboard</li>
                    <li>🚀 System active</li>
                </ul>
            </div>

        </main>
    </div>

</div>

</body>
</html>