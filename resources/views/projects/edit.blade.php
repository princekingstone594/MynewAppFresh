@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Edit Project</h1>

    <form method="POST"
          action="{{ route('projects.update', $project) }}"
          class="space-y-4">

        @csrf
        @method('PUT')

        <!-- NAME -->
        <div>
            <label class="text-sm font-medium">Project Name</label>
            <input type="text" name="name"
                   value="{{ $project->name }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- DESCRIPTION -->
        <div>
            <label class="text-sm font-medium">Description</label>
            <textarea name="description"
                      class="w-full border p-2 rounded">{{ $project->description }}</textarea>
        </div>

        <!-- STATUS -->
        <div>
            <label class="text-sm font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded">

                <option value="pending" {{ $project->status == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>
        </div>

        <!-- BUTTONS -->
        <div class="flex justify-between">
            <a href="{{ route('projects.index') }}"
               class="text-gray-600">
                Cancel
            </a>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>

    </form>

</div>
@endsection