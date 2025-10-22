<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService) {}

    public function index()
    {
        $projects = $this->projectService->all();
        return view('projects.index', compact('projects'));
    }

    public function store(ProjectRequest $request)
    {
        $this->projectService->create($request->validated());
        return redirect()->back()->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $this->projectService->update($project, $request->validated());
        return redirect()->back()->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $this->projectService->delete($project);
        return redirect()->back()->with('success', 'Project deleted!');
    }
}
