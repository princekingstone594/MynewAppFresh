<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">All Users</h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">ID</th>
                <th class="p-2">Name</th>
                <th class="p-2">Email</th>
                <th class="p-2">Role</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr class="border-t">
                <td class="p-2">{{ $user->id }}</td>
                <td class="p-2">{{ $user->name }}</td>
                <td class="p-2">{{ $user->email }}</td>
                <td class="p-2">{{ $user->role }}</td>

                <td class="p-2 space-x-2">

                    <!-- CHANGE ROLE -->
                    <form method="POST" action="/admin/users/{{ $user->id }}/role" class="inline">
                        @csrf
                        <select name="role" onchange="this.form.submit()" class="border p-1">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </form>

                    <!-- DELETE -->
                    <form method="POST" action="/admin/users/{{ $user->id }}/delete" class="inline">
                        @csrf
                        <button class="bg-red-500 text-white px-2 py-1 rounded">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/admin" class="inline-block mt-4 text-blue-600">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>