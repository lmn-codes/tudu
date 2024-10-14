<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskEntry;
use Carbon\Carbon;

class TaskEntryController extends Controller
{
    public function index(int $task_id)
    {
        $task = Task::findOrFail($task_id);

        return $task->entries()->paginate(25);
    }

    public function create(int $task_id)
    {
        $task = Task::findOrFail($task_id);

        return $task->entries()->save(new TaskEntry);
    }

    public function stopEntry(int $id)
    {
        $entry = TaskEntry::find($id);

        $entry->ends_at = Carbon::now();

        $entry->save();
    }
}
