<?php

namespace App\Models;

use Illuminate\Support\Str;
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
        'gender',
        'admission_date',
        'status'
    ];

    protected $casts = [
        'date_of_birth' => 'date', // Cast 'date_of_birth' to Carbon instance automatically
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

        static::creating(function ($student) {
            $student->slug = $student->generateSlug();
        });
    }

    /**
     * Generate a slug based on student's name and birthdate.
     *
     * @return string
     */
    public function generateSlug()
    {
        
        // Combine first name, last name, and date of birth to generate a unique slug
        return Str::slug($this->getRandomThreeCharacterCombination($this->first_name) . ' ' . $this->getRandomThreeCharacterCombination($this->last_name) . ' ' . $this->date_of_birth->format('Ymd'));
    }

     /**
     * Generate a random 3-character combination from a given word.
     *
     * @param string $word
     * @return string
     */
    public function getRandomThreeCharacterCombination($word)
    {
        // Ensure the word is long enough to get 3 characters
        if (strlen($word) < 3) {
            return "word";
        }

        // Create an array of characters from the word
        $characters = str_split($word);
        
        // Shuffle the array to randomize the order of characters
        shuffle($characters);
        
        // Get the first 3 characters from the shuffled array
        $randomCombination = implode('', array_slice($characters, 0, 3));
        
        return $randomCombination;
    }

    // Scope for filtering students based on status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

}
