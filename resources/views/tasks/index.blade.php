<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-4">Task Manager</h1>

    <form method="GET" action="/">
        <select name="project_id" onchange="this.form.submit()" class="border rounded p-2 mb-4">
            <option value="">All Projects</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ $projectId == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>

        <a href="{{ route('projects.store') }}" class="border rounded p-2 mb-4" id="project-btn">Create Projects</a>
    </form>

    <form action="{{ route('tasks.store') }}" method="POST" class="mb-4 flex gap-2">
        @csrf
        <input type="text" name="name" placeholder="Task name" class="border p-2 flex-1" required>
        <select name="project_id" class="border p-2">
            <option value="">No Project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Add</button>
    </form>

    <ul id="task-list" class="space-y-2">
        @foreach($tasks as $task)
            <li class="bg-gray-50 border p-3 rounded flex justify-between items-center" data-id="{{ $task->id }}">
                <span>{{ $task->name }} (Priority: {{ $task->priority }})</span>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>

<script>
    const list = document.getElementById('task-list');
    new Sortable(list, {
        animation: 150,
        onEnd: () => {
            let order = Array.from(list.children).map(li => li.dataset.id);
            fetch('{{ route('tasks.reorder') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ order })
            });
        }
    });
</script>

<style>
  
</style>
</body>
</html>
