<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasUuids;

    protected $fillable = [
        'attachmentable_id',
        'attachmentable_type',
        'file_path',
        'file_type',
    ];

    public function attachmentable()
    {
        return $this->morphTo();
    }
}
