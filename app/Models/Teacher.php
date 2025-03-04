<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'subject', 'phone', 'address', 'position', 'hire_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classes()
    {
        return $this->hasMany(Classroom::class);
    }
}
