<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasUuids;

    protected $fillable = ['name'];

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
}
