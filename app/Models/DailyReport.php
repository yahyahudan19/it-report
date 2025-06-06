<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasUuids;

    protected $fillable = [
        'staff_id',
        'task_id',
        'category_id',
        'task_description',
        'start_time',
        'end_time',
        'status',
        'issues',
        'quantity',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function tasks()
    {
        return $this->belongsTo(WorkTask::class, 'task_id');
    }

    public function category()
    {
        return $this->belongsTo(WorkCategory::class, 'category_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
}
