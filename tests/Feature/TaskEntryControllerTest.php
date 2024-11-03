<?php

namespace Tests\Feature;

use App\Models\TaskEntry;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskEntryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_stop_entry(): void
    {
        $entry = TaskEntry::factory()->create();

        $this->patch("/entries/{$entry->id}/stop");

        $this->assertDatabaseHas('task_entries', [
            'ends_at' => Carbon::now(),
        ]);
    }
}
