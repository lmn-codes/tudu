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
}
