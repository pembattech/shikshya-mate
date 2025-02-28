<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_Result extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'exam_id', 'marks_obtained', 'grade', 'remarks'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
