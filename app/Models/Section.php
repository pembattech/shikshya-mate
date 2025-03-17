<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $primaryKey = 'section_id';

    protected $fillable = [
        'section_name',
        'class_id',
        'teacher_id',
    ];

    /**
     * Get the classroom that owns the section.
     */
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    /**
     * Get the teacher that owns the section.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
