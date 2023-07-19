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
        'status',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fac_id'); // Update the foreign key column
    }

    public function librarian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lib_id'); // Update the foreign key column
    }

    public function programChair(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pg_id'); // Update the foreign key column
    }
}
