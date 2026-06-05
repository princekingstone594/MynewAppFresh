@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white shadow p-6 rounded">

        <h1 class="text-2xl font-bold mb-4">
            {{ $project->name }}
        </h1>

        <p class="text-gray-700 mb-4">
            {{ $project->description }}
        </p>

        <div class="text-sm text-gray-500 mb-4">
            Status:
            <span class="font-semibold">
                {{ $project->status }}
            </span>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('projects.edit', $project) }}"
               class="bg-yellow-500 text-white px-3 py-1 rounded">
                Edit
            </a>

            <a href="{{ route('projects.index') }}"
               class="text-gray-600">
                Back
            </a>

        </div>

    </div>

</div>
@endsection