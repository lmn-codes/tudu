<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DayTask extends Model
{
    use HasFactory;

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
