<?php

namespace Tests\Feature;

use App\Models\Day;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DayApiTest extends TestCase
{
    use RefreshDatabase;
    public function test_error_when_day_exists(): void
    {
        Day::factory()->create();

        $response = $this->post('/days');

        $response->assertStatus(400);
    }

    public function test_error_task_not_exist(): void
    {
        $response = $this->post('/days', [
            'task' => [
                'id' => -1,
            ]
        ]);

        $response->assertStatus(500);
    }
}
