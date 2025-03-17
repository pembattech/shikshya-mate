<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'class_name' => 'nullable|string|max:255',
            'teacher_id' => 'nullable|integer|exists:users,id'
        ];
    }

    private function patchRules(): array
    {
        // PATCH: Allows partial update (only sent fields will be validated)
        return [
            'class_name' => 'sometimes|nullable|string|max:255',
            'teacher_id' => 'sometimes|nullable|integer|exists:users,id',
        ];
    }
}