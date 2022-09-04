<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationTypes extends Model
{
    protected $table = 'examination_types';

    protected $fillable = [
        'examination_type',
        'active',
    ];
}
