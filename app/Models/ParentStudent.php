<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentStudent extends Model
{
    use HasFactory;

    protected $primaryKey = 'parent_student_id';  // Custom primary key

    /**
     * Get the parent that owns the ParentStudent.
     */
    public function parent()
    {
        return $this->belongsTo(Parent::class, 'parent_id');
    }

    /**
     * Get the student that owns the ParentStudent.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
