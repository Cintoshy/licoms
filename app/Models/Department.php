<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_name',
        'description',
        'logo',
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'department_name', 'department');
    }
}
