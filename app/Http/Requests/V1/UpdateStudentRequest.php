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
            'user_id' => 'nullable|integer|exists:users,user_id',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'class_id' => 'required|exists:classrooms,class_id',
            'section_id' => 'required|exists:sections,section_id',
            'roll_number' => 'required|string|max:20|unique:students,roll_number,' . $this->student,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'admission_date' => 'required|date',
        ];
    }

    private function patchRules(): array
    {
        // PATCH: Allows partial update (only sent fields will be validated)
        return [
            'user_id' => 'sometimes|nullable|integer|exists:users,user_id',
            'first_name' => 'sometimes|required|string|max:50',
            'last_name' => 'sometimes|required|string|max:50',
            'date_of_birth' => 'sometimes|required|date',
            'class_id' => 'sometimes|required|exists:classrooms,class_id',
            'section_id' => 'sometimes|required|exists:sections,section_id',
            'roll_number' => 'sometimes|required|string|max:20|unique:students,roll_number,' . $this->student,
            'address' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|nullable|string|max:15',
            'admission_date' => 'sometimes|required|date',
        ];
    }
}
