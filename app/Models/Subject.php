<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $primaryKey = 'subject_id';

    protected $fillable = ['subject_name'];

     /**
     * Get the classroom that owns the section.
     */
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id', 'class_id');
    }


    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subjects', 'subject_id', 'teacher_id');
    }
    

}
