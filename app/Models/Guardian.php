<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    // Table name (if not following Laravel conventions)
    protected $table = 'parents'; // You can still keep the 'parents' table

    // Fillable fields
    protected $fillable = [
        'user_id',
        'student_id',
        'contact_info',
        'father_name',
        'mother_name',
        'occupation',
        'address',
        'phone',

    ];

    // Relationship with User (One-to-One)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Students (Many-to-Many)
    public function students()
    {
        return $this->belongsToMany(Student::class, 'parent_student');
    }
}
