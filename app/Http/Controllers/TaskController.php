<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TaskController extends BaseController
{
    protected $editable_attributes = [
        'title',
        'description',
        'scheduled_on',
    ];

    protected $model = Task::class;

    public function create(Request $request, ?array $initial_data = []) {
        $last_position = Task::max('position') ?? 0;

        return parent::create($request, ['position' => $last_position + 1]);
    }

    public function update(Request $request, int $id) {
        if ($request->input('position')) {
            $task = Task::findOrFail($id);

            $original_position = $task->position;
            //@todo: validate that the position is not < 0
            $new_position = $request->input('position');

            if ($original_position === $new_position) {
                return;
            }

            $last_position = Task::max('position');

            if ($new_position > $last_position) {
                $new_position = $last_position;
            }

            $range = [$original_position, $new_position];
            sort($range);

            $task->update(['position' => 0]);

            $is_moving_up = $original_position > $new_position;

            $tasks_to_update = Task::whereBetween('position', $range)->when($is_moving_up,
                function (Builder $query) {
                    $query->orderBy('position', 'desc');
                }
            )->lockForUpdate();

            $tasks_to_update->chunk(100, function (Collection $tasks) use ($original_position, $new_position, $is_moving_up) {
                foreach ($tasks as $task) {
                    $task->update(['position' => $task->position + ($is_moving_up ? 1 : -1)]);
                }
            });

            $task->update(['position' => $new_position]);
        }

        return parent::update($request, $id);
    }
}
