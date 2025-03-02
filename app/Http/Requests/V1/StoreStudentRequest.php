<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|integer|exists:users,id',
            'class_id' => 'required|exists:classrooms,id',
            'name' => 'required|string|max:255',
            'section' => 'required|string|max:1', // Assuming section is a single letter
            'roll_number' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'parent_id' => 'nullable|exists:users,id', // Assuming parent is also a user
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'admission_date' => 'required|date',
        ];
    }

       /**
     * Customize the error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'User ID is required.',
            'class_id.required' => 'Class ID is required.',
            'section.required' => 'Section is required.',
            'roll_number.required' => 'Roll number is required.',
            'date_of_birth.required' => 'Date of birth is required.',
            'admission_date.required' => 'Admission date is required.',
            // Add other custom messages as needed
        ];
    }
}
