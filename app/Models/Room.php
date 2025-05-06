<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasUuids;

    protected $fillable = ['floor_id', 'name'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }
}
