<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\BaseController;

class TaskController extends BaseController
{
    protected $editable_attributes = [
        'title',
        'description',
        'scheduled_on',
        'priority'
    ];

    protected $model = Task::class;

    public function index()
    {
        return Task::paginate(25);
    }

    public function show($id)
    {
        return Task::find($id);
    }

    // Delete an existing task 
    public function delete() {}
}
