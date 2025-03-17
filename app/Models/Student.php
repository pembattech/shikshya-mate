<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'class_id',
        'section_id',
        'roll_number',
        'address',
        'phone',
        'admission_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Automatically delete the associated user when a student is deleted
        static::deleting(function ($student) {
            if ($student->user_id) {
                User::find($student->user_id)->delete(); // Delete the related user account
            }
        });
    }

}
