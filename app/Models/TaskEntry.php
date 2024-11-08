<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskEntry extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
