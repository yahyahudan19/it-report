<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class WorkCategory extends Model
{
    use HasUuids;

    protected $fillable = ['name'];

    public function workTasks()
    {
        return $this->belongsToMany(WorkTask::class, 'task_category', 'category_id', 'task_id');
    }
}
