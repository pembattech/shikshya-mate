<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'user_id' => 'nullable|integer|exists:users,id',
            'subject' => 'required|string|max:15',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'position' => 'required|string|in:principal,assistant teacher,substitute teacher,teacher',
            'hire_date' => 'required|date',
        ];
    }

    private function patchRules(): array
    {
        // PATCH: Allows partial update (only sent fields will be validated)
        return [
            'name' => 'sometimes|required|string|max:255',
            'user_id' => 'sometimes|nullable|integer|exists:users,id',
            'subject' => 'sometimes|required|string|max:15',
            'phone' => 'sometimes|required|string|max:15',
            'address' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|in:principal,assistant teacher,substitute teacher,teacher',
            'hire_date' => 'sometimes|required|date',
        ];
    }
}
