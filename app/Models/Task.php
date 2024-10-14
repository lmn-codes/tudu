<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
