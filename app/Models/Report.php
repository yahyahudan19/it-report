<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasUuids;

    protected $fillable = [
        'reporter_id',
        'location_id',
        'report_date',
        'priority',
        'received_by',
        'is_assigned',
    ];

    public function reporter()
    {
        return $this->belongsTo(Staff::class, 'reporter_id');
    }

    public function receivedBy()
    {
        return $this->belongsTo(Staff::class, 'received_by');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'location_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function reportHandlings()
    {
        return $this->hasMany(ReportHandling::class);
    }
}
