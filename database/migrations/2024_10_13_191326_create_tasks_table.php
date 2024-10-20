<?php

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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250);
            $table->text('description')->nullable();
            $table->enum('status', ['done', 'in_progress', 'cold'])->default('cold');
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('scheduled_on')->nullable();
            $table->integer('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
