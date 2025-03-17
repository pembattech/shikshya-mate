<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
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
            'class_name' => 'required|string|max:255',
            'teacher_id' => 'required|string|exists:users,id'
        ];
    }

    public function message()
    {
        return [
            'class_name.required' => 'Class is required.',
            'teacher.required' => 'Teacher is required.'
        ];
    }
}
