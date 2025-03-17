<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicRecord extends Model
{
    use HasFactory;

    protected $table = 'academic_records';

    protected $primaryKey = 'academic_record_id';

    protected $fillable = [
        'student_id',
        'grade_level',
        'subject',
        'marks',
        'grade',
        'academic_year',
    ];

    // Relationship to Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
