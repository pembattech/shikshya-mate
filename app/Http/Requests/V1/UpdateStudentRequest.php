<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Check the request method
        if ($this->isMethod('patch')) {
            return $this->patchRules();
        }

        return $this->putRules();
    }

    private function putRules(): array
    {
        // PUT: Requires all fields (full update)
        return [
            'user_id' => 'nullable|integer|exists:users,id',
            'class_id' => 'required|exists:classrooms,id',
            'name' => 'required|string|max:255',
            'section' => 'required|string|max:1',
            'roll_number' => 'required|string|max:20|unique:students,roll_number,' . $this->student,
            'date_of_birth' => 'required|date',
            'parent_id' => 'nullable|exists:users,id',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'admission_date' => 'required|date',
        ];
    }

    private function patchRules(): array
    {
        // PATCH: Allows partial update (only sent fields will be validated)
        return [
            'user_id' => 'sometimes|nullable|integer|exists:users,id',
            'class_id' => 'sometimes|required|exists:classrooms,id',
            'name' => 'sometimes|required|string|max:255',
            'section' => 'sometimes|required|string|max:1',
            'roll_number' => 'sometimes|required|string|max:20|unique:students,roll_number,' . $this->student,
            'date_of_birth' => 'sometimes|required|date',
            'parent_id' => 'sometimes|nullable|exists:users,id',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'address' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|nullable|string|max:15',
            'admission_date' => 'sometimes|required|date',
        ];
    }
}
