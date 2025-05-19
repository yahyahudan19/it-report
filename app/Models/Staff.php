<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Staff extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'position_id',
        'department_id',
        'room_id',
        'whatsapp_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function workTasks()
    {
        return $this->hasMany(WorkTask::class);
    }

    public function dailyReports()
    {
        return $this->hasMany(DailyReport::class);
    }

    public function reportHandlings()
    {
        return $this->hasMany(ReportHandling::class);
    }

    public function workLogs()
    {
        return $this->hasMany(WorkLog::class);
    }

     public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_handling')
                    ->withPivot('status', 'assigned_at', 'resolved_at') // Kolom tambahan di pivot table jika ada
                    ->withTimestamps(); // Jika kamu ingin timestamp di pivot table
    }
}
