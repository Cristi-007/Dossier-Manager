<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertiseTypes extends Model
{
    protected $table = 'expertise_types';

    protected $fillable = [
        'expertise_type',
        'active',
    ];
}
