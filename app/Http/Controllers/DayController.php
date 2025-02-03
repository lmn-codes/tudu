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
        $existing_day = Day::whereDate('created_at', $now->toDateString())->first();

        if ($existing_day) {
            return response()->json([
                'message' => 'The day has already started.'
            ], 400);
        }

        DB::beginTransaction();
        $day = Day::create();

        foreach ($request->tasks as $request_task) {
            $task = Task::find($request_task['id']);

            if (!$task) {
                DB::rollBack();
                throw new ModelNotFoundException();
            }

            DayTask::create([
                'day_id' => $day->id,
                'task_id' => $request_task['id'],
                'position' => $request_task['position'] ?? null
            ]);
        }
        DB::commit();

        return response(null, 200);
    }

    public function getToday() {
        $today = Day::whereDate('created_at', Carbon::now()->toDateString())->first();

        if (!$today) {
            return response(null, 404);
        }

        return response(new \App\Http\Resources\Day($today), 200);
    }
}
