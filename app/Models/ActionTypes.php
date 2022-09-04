<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionTypes extends Model
{
    protected $table = 'action_types';

    protected $fillable = [
        'action_type',
        'abbreviation',
        'active',
    ];
}
