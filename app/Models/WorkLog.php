<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class WorkLog extends Model
{
    use HasUuids;

    protected $fillable = [
        'staff_id',
        'action',
        'related_id',
        'related_type',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function related()
    {
        return $this->morphTo(__FUNCTION__, 'related_type', 'related_id');
    }
}
