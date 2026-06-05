<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * SECURITY HELPER (VERY IMPORTANT)
     */
    private function authorizeProject($project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Display all projects
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->latest()->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store new project
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Project::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active',
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully');
    }

    /**
     * Show single project
     */
    public function show(Project $project)
    {
        $this->authorizeProject($project);

        return view('projects.show', compact('project'));
    }

    /**
     * Show edit form
     */
    public function edit(Project $project)
    {
        $this->authorizeProject($project);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update project
     */
    public function update(Request $request, Project $project)
    {
        $this->authorizeProject($project);

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }

    /**
     * Delete project
     */
    public function destroy(Project $project)
    {
        $this->authorizeProject($project);

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}