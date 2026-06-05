<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <!-- FLASH MESSAGES -->
    @include('partials.flash')

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Admin Dashboard 👑</h1>

        <p>Welcome Admin, {{ auth()->user()->name }}!</p>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logoout</button?>
        </form>
        
        <span class="text-sm text-gray-500">
            Logged in as: {{ auth()->user()->name }}
        </span>
    </div>

    <p class="mb-6 text-gray-600">
        Welcome Admin — manage your system below.
    </p>

    <!-- QUICK STATS (READY FOR EXPANSION) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-blue-50 p-4 rounded">
            <h3 class="text-gray-500 text-sm">Total Users</h3>
            <p class="text-2xl font-bold">
                {{ $userCount ?? 0 }}
            </p>
        </div>

        <div class="bg-green-50 p-4 rounded">
            <h3 class="text-gray-500 text-sm">Admins</h3>
            <p class="text-2xl font-bold">
                {{ $adminCount ?? 0 }}
            </p>
        </div>

        <div class="bg-purple-50 p-4 rounded">
            <h3 class="text-gray-500 text-sm">System Status</h3>
            <p class="text-2xl font-bold text-green-600">
                Active
            </p>
        </div>

    </div>

    <!-- ACTIONS -->
    <div class="space-y-3">

        <a href="/admin/users"
           class="block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Manage Users
        </a>

        <a href="/dashboard"
           class="block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            View User Dashboard
        </a>

        <form method="POST" action="/logout">
            @csrf
            <button class="w-full bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Logout
            </button>
        </form>

    </div>

</div>

</body>
</html>