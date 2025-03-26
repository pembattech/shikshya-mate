<?php 

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Classroom;
use App\Models\Section;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // Modify the request data before validation
    protected function prepareForValidation()
    {

        if ($this->has("class_name")) {
            $classroom = Classroom::where('class_name', $this->class_name)->first();
            if ($classroom) {
                $this->merge(['class_id' => $classroom->class_id]);
            }
        }

        if ($this->has('section_name')) {
            $section = Section::where('section_name', $this->section_name)->first();
            if ($section) {
                $this->merge(['section_id' => $section->section_id]);
            }
        }

    }

    public function rules(): array
    {
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
            'class_id' => 'required|integer|exists:classrooms,class_id',
            'section_id' => 'required|integer|exists:sections,section_id',
            'roll_number' => 'required|string|max:20|unique:students,roll_number,' . $this->student,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'gender' => 'required|in:male,female,other',
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
            'class_id' => 'sometimes|required|integer|exists:classrooms,class_id',
            'section_id' => 'sometimes|required|integer|exists:sections,section_id',
            'roll_number' => 'sometimes|required|string|max:20|unique:students,roll_number,' . $this->student,
            'address' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|nullable|string|max:15',
            'gender' => 'sometimes|required|in:male,female,other',
            'admission_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:pending,approved,rejected',
        ];
    }

    public function message()
    {
        return [
            'class_id.required' => 'Class is required.',
            'class_id.exists' => 'The selected class is invalid.',
            'section_id.required' => 'Section is required.',
            'section_id.exists' => 'The selected section does not exist in our records. Please choose a valid section.',
        ];
    }
}
