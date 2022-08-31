<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = [
        'expert_name',
        'expert_surname',
        'function',
        'active',
        'novice',
        'user_id'
    ];

            
}
