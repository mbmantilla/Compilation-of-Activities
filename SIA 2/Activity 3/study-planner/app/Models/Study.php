<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $fillable = [
    'title',
    'subject',
    'priority',
    'deadline',
    'status',
    'notes',
    'image'
];
}
