<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">

        <div class="p-6 text-xl font-bold border-b border-gray-800">
            ⚡ SaaS Admin
        </div>

        <nav class="flex-1 p-4 space-y-2 text-sm">

            <a href="/admin"
               class="block px-4 py-2 rounded bg-gray-800 font-semibold">
                📊 Dashboard
            </a>

            <a href="/admin/users"
               class="block px-4 py-2 rounded hover:bg-gray-800">
                👥 Manage Users
            </a>

            <a href="/dashboard"
               class="block px-4 py-2 rounded hover:bg-gray-800">
                🧑 User View
            </a>

        </nav>

        <form method="POST" action="/logout" class="p-4 border-t border-gray-800">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 py-2 rounded text-sm">
                Logout
            </button>
        </form>

    </aside>

    <!-- MAIN -->
    <div class="flex-1">

        <header class="bg-white shadow-sm p-4 flex justify-between items-center">
            <div>
                <h1 class="text-lg font-semibold">Admin Dashboard</h1>
                <p class="text-sm text-gray-500">Welcome {{ $user->name }}</p>
            </div>

            <div class="text-sm bg-gray-100 px-3 py-1 rounded-full">
                Role: {{ $user->role }}
            </div>
        </header>

        <main class="p-6 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white p-6 rounded-xl shadow border">
                    <p class="text-gray-500 text-sm">Total Users</p>
                    <h2 class="text-3xl font-bold mt-2">{{ $userCount }}</h2>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border">
                    <p class="text-gray-500 text-sm">Status</p>
                    <h2 class="text-3xl font-bold mt-2 text-green-600">Active</h2>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border">
                    <p class="text-gray-500 text-sm">Role</p>
                    <h2 class="text-3xl font-bold mt-2">{{ $user->role }}</h2>
                </div>

            </div>

            <div class="bg-white p-6 rounded-xl shadow border">
                <h2 class="font-semibold mb-3">Latest Users</h2>

                <div class="space-y-2">
                    @foreach($latestUsers as $u)
                        <div class="flex justify-between text-sm border-b pb-2">
                            <span>{{ $u->name }}</span>
                            <span class="text-gray-500">{{ $u->email }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

        </main>

    </div>

</div>

</body>
</html>