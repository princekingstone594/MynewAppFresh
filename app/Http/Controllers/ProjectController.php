<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects()->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required'
        ]);

        $project = Project::create([
            ...$data,
            'user_id' => Auth::id()
        ]);

        // Attach creator as OWNER
        $project->users()->attach(Auth::id(), ['role' => 'owner']);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        $this->authorizeAccess($project);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorizeAccess($project);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeAccess($project);

        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required'
        ]);

        $project->update($data);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $this->authorizeAccess($project);

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted!');
    }

    // 🔥 Invite user
    public function invite(Request $request, Project $project)
    {
        $this->authorizeAccess($project);

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        // Prevent duplicate
        if ($project->users->contains($user->id)) {
            return back()->with('warning', 'User already in project.');
        }

        $project->users()->attach($user->id, ['role' => 'member']);

        return back()->with('success', 'User invited successfully!');
    }

    // 🔐 Security check
    private function authorizeAccess(Project $project)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403);
        }
    }
}