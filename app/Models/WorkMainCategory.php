<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Database\Eloquent\Model;

class WorkMainCategory extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'description'];	

    public function categories()
    {
        return $this->hasMany(WorkCategory::class, 'main_category_id');
    }
}
