<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'class_id', 'section', 'roll_number', 'date_of_birth', 'parent_id', 'father_name', 'mother_name', 'occupation', 'address', 'phone', 'admission_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
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
