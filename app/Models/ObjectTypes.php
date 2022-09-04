<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectTypes extends Model
{
    protected $table = 'object_types';

    protected $fillable = [
        'object_type',
        'abbreviation',
        'active',
    ];
}
