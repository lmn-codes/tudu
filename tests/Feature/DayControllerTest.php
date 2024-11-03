<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DayControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_day_create(): void
    {
        $task = Task::factory()->create();

        $this->post('/days', [
            'tasks' => [
                ['id' => $task->id],
            ]
        ]);

        $this->assertDatabaseCount('days', 1);
        $this->assertDatabaseCount('day_tasks', 1);
    }
}
