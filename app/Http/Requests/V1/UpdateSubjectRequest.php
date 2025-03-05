<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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

        if ($this->isMethod('patch')) {
            return $this->patchRules();
        }


        return $this->putRules();
    }


    private function putRules(): array
    {
        // PUT: Requires all fields (full update)
        return [
            'name' => 'required|string|max:255',
            'class_id' => 'nullable|integer|exists:classroom,id',
            'teacher_id' => 'nullable|integer|exists:users,id'
        ];
    }

    private function patchRules(): array
    {
        // PATCH: Allows partial update (only sent fields will be validated)
        return [
            'name' => 'sometimes|required|string|max:255',
            'class_id' => 'sometimes|nullable|integer|exists:classroom,id',
            'teacher_id' => 'sometimes|nullable|integer|exists:users,id',
        ];
    }
}
