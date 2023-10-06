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
        'availability',
        'program_hide_request',
        'program_hidden',
    ];

    // Scope to retrieve only available books
    public function scopeAvailable($query)
    {
        return $query->where('availability', true);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_book');
    }

    
}
