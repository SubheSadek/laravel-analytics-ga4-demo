<?php

namespace App\Http\Controllers\Admin\Manage\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserListRequest extends FormRequest
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
            'pageSize' => ['required', 'integer', 'min:1'],
            'page' => ['required', 'integer', 'min:1'],
            'searchTxt' => ['nullable', 'string', 'max:255'],
        ];
    }
}
