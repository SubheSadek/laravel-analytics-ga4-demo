<?php

namespace App\Http\Controllers\Admin\Manage\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the admin is Authorized to make this request.
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
            'email' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->route('adminId'))],
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ];
    }
}
