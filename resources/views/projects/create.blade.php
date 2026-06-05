@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Create Project</h1>

    <form method="POST" action="{{ route('projects.store') }}" class="space-y-4">
        @csrf

        <!-- NAME -->
        <div>
            <label class="text-sm font-medium">Project Name</label>
            <input type="text" name="name"
                   class="w-full border p-2 rounded"
                   required>
        </div>

        <!-- DESCRIPTION -->
        <div>
            <label class="text-sm font-medium">Description</label>
            <textarea name="description"
                      class="w-full border p-2 rounded"></textarea>
        </div>

        <!-- STATUS -->
        <div>
            <label class="text-sm font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="pending">Pending</option>
                <option value="active">Active</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <!-- BUTTONS -->
        <div class="flex justify-between">
            <a href="{{ route('projects.index') }}"
               class="text-gray-600">Cancel</a>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Create
            </button>
        </div>

    </form>

</div>
@endsection