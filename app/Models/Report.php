<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_number',
        'current_year',
        'lib_id',
        'pg_id',
        'course_id',
        'status',
        'program_id',
        'verified_at',
    ];
}
