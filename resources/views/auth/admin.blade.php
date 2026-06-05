<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

    <p class="mb-4">Welcome Admin 👑</p>

    <div class="space-y-3">
        <a href="/admin/users" class="block bg-blue-600 text-white px-4 py-2 rounded">
            Manage Users
        </a>

        <form method="POST" action="/logout">
            @csrf
            <button class="bg-red-500 text-white px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </div>

</div>

</body>
</html>