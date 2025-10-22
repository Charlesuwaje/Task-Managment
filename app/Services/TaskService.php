<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function all($projectId = null)
    {
        $query = Task::orderBy('priority');
        if ($projectId) {
            $query->where('project_id', $projectId);
        }
        return $query->get();
    }

    public function create(array $data): Task
    {
        $maxPriority = Task::where('project_id', $data['project_id'] ?? null)->max('priority') ?? 0;
        $data['priority'] = $maxPriority + 1;
        return Task::create($data);
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }

    public function reorder(array $orderedIds): void
    {
        DB::transaction(function () use ($orderedIds) {
            foreach ($orderedIds as $index => $id) {
                Task::where('id', $id)->update(['priority' => $index + 1]);
            }
        });
    }
}
