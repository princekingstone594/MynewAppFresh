@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Projects</h1>

        <a href="{{ route('projects.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + New Project
        </a>
    </div>

    <!-- FLASH -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- GRID -->
    <div class="grid md:grid-cols-3 gap-4">

        @forelse($projects as $project)
            <div class="bg-white shadow rounded p-4 border hover:shadow-lg transition">

                <h2 class="text-lg font-semibold">
                    {{ $project->name }}
                </h2>

                <p class="text-gray-600 text-sm mt-2">
                    {{ Str::limit($project->description, 80) }}
                </p>

                <div class="mt-3 text-xs text-gray-500">
                    Status: <span class="font-semibold">{{ $project->status }}</span>
                </div>

                <div class="flex gap-2 mt-4">

                    <a href="{{ route('projects.show', $project) }}"
                       class="text-blue-600 text-sm">View</a>

                    <a href="{{ route('projects.edit', $project) }}"
                       class="text-yellow-600 text-sm">Edit</a>

                    <form method="POST" action="{{ route('projects.destroy', $project) }}">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-600 text-sm"
                                onclick="return confirm('Delete this project?')">
                            Delete
                        </button>
                    </form>

                </div>

            </div>
        @empty
            <p class="text-gray-500">No projects yet.</p>
        @endforelse

    </div>
</div>
@endsection