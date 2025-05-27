<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class WorkTask extends Model
{
    use HasUuids;

    protected $fillable = [
        'staff_id',
        'title',
        'description',
        'target_quantity',
        'unit',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function categories()
    {
        return $this->belongsToMany(WorkCategory::class, 'task_category', 'task_id', 'category_id');
    }

    public function dailyReports()
    {
        return $this->hasMany(DailyReport::class, 'task_id', 'id');
    }

    public function report_handling()
    {
        // foreign key 'task_id' di tabel report_handlings
        return $this->hasMany(ReportHandling::class, 'task_id', 'id');
    }

}
