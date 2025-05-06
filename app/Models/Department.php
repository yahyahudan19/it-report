<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasUuids;

    protected $fillable = ['name'];

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
