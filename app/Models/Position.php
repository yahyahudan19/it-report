<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
