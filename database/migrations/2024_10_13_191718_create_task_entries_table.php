<?php

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Task::class);
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('ends_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_entries');
    }
};
