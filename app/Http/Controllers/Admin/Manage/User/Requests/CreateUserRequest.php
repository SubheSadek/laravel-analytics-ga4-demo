<?php

namespace App\Http\Controllers\Admin\Manage\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is Authorized to make this request.
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', Rule::unique('users')],
            'phone' => ['nullable', 'string', 'size:14', 'regex:/^\+8801[3-9]\d{8}$/', Rule::unique('users')],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }
}
