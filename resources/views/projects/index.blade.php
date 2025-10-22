<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-4">Projects</h1>

    <form action="{{ route('projects.store') }}" method="POST" class="flex gap-2 mb-4">
        @csrf
        <input type="text" name="name" placeholder="Project name" class="border p-2 flex-1" required>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Add</button>
    </form>

    <ul class="space-y-2">
        @foreach($projects as $project)
            <li class="border p-3 rounded flex justify-between items-center">
                <span>{{ $project->name }}</span>
                <form action="{{ route('projects.destroy', $project) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <div class="mt-6 text-right">
        <a href="{{ route('tasks.index') }}" class="text-blue-600 underline">Go to Tasks</a>
    </div>
</div>
</body>
</html>
