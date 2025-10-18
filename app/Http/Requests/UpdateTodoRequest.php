<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
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
            'title' => 'required|string',
            'deadline' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'deadline.required' => 'Deadline is required',
            'user_id.required' => 'User ID is required (please log in first)'
        ];
    }
}
