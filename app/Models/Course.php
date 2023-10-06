<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_title',
        'course_group',
        'course_level',
        'assigned_program',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'assigned_program', 'name');
    }
    public function group(): BelongsTo
    {
        return $this->belongsTo(CourseGroup::class, 'course_group', 'course_group');
    }
}
