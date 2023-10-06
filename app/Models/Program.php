<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'department',
    ];

    /**
     * Define the relationship between Program and User models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'assigned_program', 'name');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department', 'department_name');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'program_book');
    }
}
