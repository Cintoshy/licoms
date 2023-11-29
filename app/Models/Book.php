<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{   
    use HasFactory;

    protected $fillable = [
        'call_number',
        'title',
        'author',
        'volume',
        'access_no',
        'year',
        'publish',
        'availabilty_program',
        'program_hide_request',
        'program_hidden',
    ];


    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_book');
    }

    
}
