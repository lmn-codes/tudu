<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::paginate(25);
    }

    public function show($id)
    {
        return Task::find($id);
    }

    // Create a new task
    public function create(Request $request)
    {
        $task = new Task;

        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->scheduled_on = $request->input('scheduled_on');
        $task->priority = $request->input('priority');

        $task->save();

        return response()->json($task);
    }

    // Edit an existing task 
    public function update(Request $request) {}

    // Delete an existing task 
    public function delete() {}
}
