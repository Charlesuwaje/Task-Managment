<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">{{ $project->name }}</h1>

    <div class="mb-6">
        <p class="text-gray-600">Project ID: {{ $project->id }}</p>
        <p class="text-gray-600">Created at: {{ $project->created_at->format('Y-m-d H:i') }}</p>
        <p class="text-gray-600">Updated at: {{ $project->updated_at->format('Y-m-d H:i') }}</p>
    </div>

    <h2 class="text-xl font-semibold mb-2">Tasks under this project:</h2>
    @if($project->tasks->count())
        <ul class="space-y-2 mb-6">
            @foreach($project->tasks as $task)
                <li class="border p-3 rounded">
                    {{ $task->name }} <span class="text-gray-500 text-sm">(Priority: {{ $task->priority }})</span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500 mb-6">No tasks added yet.</p>
    @endif

    <div class="flex justify-between">
        <a href="{{ route('projects.index') }}" class="text-blue-600 underline">← Back to Projects</a>
        <a href="{{ route('tasks.index', ['project_id' => $project->id]) }}" class="text-blue-600 underline">
            View Tasks
        </a>
    </div>
</div>

</body>
</html>
