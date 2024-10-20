<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\DayTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DayController extends Controller
{
    public function create(Request $request)
    {
        $now = Carbon::now();
        $existing_day = Day::whereDate('created_at', $now->toDateString());

        if ($existing_day) {
            return response()->json([
                'message' => 'The day has already started.'
            ], 400);
        }

        $day = Day::create();

        DB::beginTransaction();
        foreach ($request->tasks as $task) {
            $task = Task::find($task->id);

            if (!$task) {
                DB::rollBack();
                throw new ModelNotFoundException();
            }

            $day_task = DayTask::create([
                'day_id' => $day->id,
                'task_id' => $task->id,
                'priority' => $task->priority
            ]);

            $day_task->save();
        }
        DB::commit();
    }
}
