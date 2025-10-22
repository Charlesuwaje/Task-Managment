<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService,
        protected ProjectService $projectService
    ) {}

    public function index(Request $request)
    {
        $projectId = $request->query('project_id');
        $tasks = $this->taskService->all($projectId);
        $projects = $this->projectService->all();

        return view('tasks.index', compact('tasks', 'projects', 'projectId'));
    }

    public function store(TaskRequest $request)
    {
        $this->taskService->create($request->validated());
        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->taskService->update($task, $request->validated());
        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $this->taskService->delete($task);
        return redirect()->back()->with('success', 'Task deleted!');
    }

    public function reorder(Request $request)
    {
        $this->taskService->reorder($request->input('order'));
        return response()->json(['message' => 'Tasks reordered successfully']);
    }
}
