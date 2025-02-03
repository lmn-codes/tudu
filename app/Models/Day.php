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

    public function dayTasks(): HasMany
    {
        return $this->hasMany(DayTask::class);
    }
}
