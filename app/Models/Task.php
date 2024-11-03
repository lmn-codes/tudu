<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'scheduled_on',
        'priority'
    ];

    public $timestamps = false;

    public function entries(): HasMany
    {
        return $this->hasMany(TaskEntry::class);
    }

    public function day_task(): HasOne
    {
        return $this->hasOne(DayTask::class);
    }

    public function day(): Day
    {
        return $this->dayTask()->day();
    }
}
