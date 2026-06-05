<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto p-6">
    @include('flash')

    <h1 class="text-2xl font-bold mb-6">Manage Users</h1>

    <!-- SEARCH + FILTER -->
    <form method="GET" class="flex gap-3 mb-6">

        <input type="text" name="search"
            placeholder="Search name/email"
            class="border p-2 rounded w-full">

        <select name="role" class="border p-2 rounded">
            <option value="">All</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button class="bg-blue-600 text-white px-4 rounded">
            Filter
        </button>

    </form>

    <!-- USERS TABLE -->
    <div class="bg-white shadow rounded">

        <table class="w-full text-left">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Role</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="border-b">

                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>

                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-white
                            {{ $user->role == 'admin' ? 'bg-red-500' : 'bg-gray-500' }}">
                            {{ $user->role }}
                        </span>
                    </td>

                    <td class="p-3 flex gap-2">

                        <form method="POST" action="/admin/users/{{ $user->id }}/role">
                            @csrf
                            <select name="role" class="border p-1">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>

                            <button class="bg-green-600 text-white px-2 py-1 rounded">
                                Update
                            </button>
                        </form>

                        <form method="POST" action="/admin/users/{{ $user->id }}/delete">
                            @csrf
                            <button class="bg-red-600 text-white px-2 py-1 rounded">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

</div>

</body>
</html>