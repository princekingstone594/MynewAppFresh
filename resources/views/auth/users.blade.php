<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

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
               class="block px-4 py-2 rounded hover:bg-gray-800">
                📊 Dashboard
            </a>

            <a href="/admin/users"
               class="block px-4 py-2 rounded bg-gray-800 font-semibold">
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
    <div class="flex-1 p-6">

        <div class="flex justify-between items-center mb-6">

            <div>
                <h1 class="text-2xl font-bold">User Management</h1>
                <p class="text-gray-500 text-sm">Manage all system users</p>
            </div>

        </div>

        <!-- SEARCH -->
        <form method="GET" class="mb-4">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Search users..."
                class="w-1/3 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
            >
        </form>

        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow border overflow-hidden">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-4">Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-right pr-6">Actions</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($users as $u)
                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-4 font-medium">{{ $u->name }}</td>
                        <td class="text-gray-600">{{ $u->email }}</td>

                        <td>
                            <span class="px-2 py-1 text-xs rounded-full
                                {{ $u->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-200 text-gray-700' }}">
                                {{ $u->role }}
                            </span>
                        </td>

                        <td class="text-right pr-6 space-x-2">

                            <form method="POST" action="/admin/users/{{ $u->id }}/role" class="inline">
                                @csrf
                                <button class="text-blue-600 hover:underline text-sm">
                                    Toggle Role
                                </button>
                            </form>

                            <form method="POST"
                                  action="/admin/users/{{ $u->id }}/delete"
                                  class="inline"
                                  onsubmit="return confirm('Delete this user?')">

                                @csrf

                                <button class="text-red-600 hover:underline text-sm">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>

            <!-- PAGINATION -->
            <div class="p-4">
                {{ $users->links() }}
            </div>

        </div>

    </div>

</div>

</body>
</html>