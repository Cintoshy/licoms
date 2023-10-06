<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestedBooks extends Model
{
    protected $fillable = [
        'book_id',
        'fac_id',
        'lib_id',
        'pg_id',
        'course_id',
        'status',
        'program_id',
        'verified_at',
    ];
    protected $casts = [
        'approved_at' => 'datetime:Y-m-d h:i A', 
        'updated_at' => 'datetime:Y-m-d h:i A', 
    ];
    
    
    public $timestamps = true;

    
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fac_id');
    }

    public function librarian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lib_id');
    }

    public function programChair(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pg_id');
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_code')->select(['course_code', 'course_title', 'course_group', 'course_level']);
    }
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_name', 'name')->select(['name', 'department']);
    }


}
