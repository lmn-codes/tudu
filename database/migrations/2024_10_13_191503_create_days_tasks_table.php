<?php

use App\Models\Day;
use App\Models\Task;
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
        Schema::create('days_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Task::class);
            $table->foreignIdFor(Day::class);
            $table->integer('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days_tasks');
    }
};
