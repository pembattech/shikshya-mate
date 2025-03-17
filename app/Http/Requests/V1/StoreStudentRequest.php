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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'class_id' => 'required|exists:classrooms,class_id',
            'section_id' => 'required|exists:sections,section_id',
            'roll_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
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
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'date_of_birth.required' => 'Date of birth is required.',
            'class_id.required' => 'Class ID is required.',
            'section_id.required' => 'Section is required.',
            'roll_number.required' => 'Roll number is required.',
            'address.required' => 'Address is required.',
            'phone.required' => 'Phone number is required.',
            'admission_date.required' => 'Admission date is required.',
        ];
    }
}
