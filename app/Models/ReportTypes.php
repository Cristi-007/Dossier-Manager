<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTypes extends Model
{
    protected $table = 'report_types';

    protected $fillable = [
        'report_type',
        'abbreviation',
        'active',
    ];
}
