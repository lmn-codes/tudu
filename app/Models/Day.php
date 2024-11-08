<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Day extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function day_tasks(): HasMany
    {
        return $this->hasMany(DayTask::class);
    }

    public function tasks(): Collection
    {
        return $this->dayTask()->tasks();
    }
}
