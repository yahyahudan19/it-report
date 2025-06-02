<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ReportHandling extends Model
{
    use HasUuids;

    protected $table = 'report_handling';

    protected $fillable = [
        'report_id',
        'staff_id',
        'task_id',
        'category_id',
        'action_taken',
        'room_id',
        'handling_time',
        'response_time',
        'status',
        'quantity',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function task()
    {
        return $this->belongsTo(WorkTask::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(WorkCategory::class, 'category_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function team()
    {
        return $this->belongsToMany(Staff::class, 'handling_team', 'report_handling_id', 'staff_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
}
