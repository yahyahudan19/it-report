<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsapp extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'api_key', 'endpoint','type_message' ,'info','status'
    ];
}
