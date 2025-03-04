<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'user_id' => 'nullable|integer|exists:users,id',
            'subject' => 'required|string|max:15',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'position' => 'required|string|in:principal,assistant teacher,substitute teacher,teacher',
            'hire_date' => 'required|date',
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
            'name.required' => 'Name is required',
            'subject.required' => 'Subject is required.',
            'phone.required' => 'Phone is required',
            'address.required' => 'Address is required',
            'position.required' => 'Position is required',
            'position.in' => 'Position must be one of the following: Principal, Assistant Teacher, Substitute Teacher or Teacher.',
            'hire_date.required' => 'Hire date is required.',
        ];
    }
}
