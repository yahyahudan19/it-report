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

    public function task()
    {
        return $this->belongsTo(WorkTask::class);
    }

    public function category()
    {
        return $this->belongsTo(WorkCategory::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
}
