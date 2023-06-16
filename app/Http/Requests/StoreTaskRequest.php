<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:tasks', 'max:255'],
            'description' => 'max:255',
            'status_id' => 'required',
            'assigned_to_id' => ['nullable', 'exists:users,id'],
        ];
    }
}
