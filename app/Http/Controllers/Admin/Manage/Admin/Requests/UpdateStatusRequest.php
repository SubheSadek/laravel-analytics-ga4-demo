<?php

namespace App\Http\Controllers\Admin\Manage\Admin\Requests;

use App\Http\Controllers\Admin\Manage\User\UserService;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
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
        $status = (new UserService)->convertUserStatusToTxt();

        return [
            'status' => ['required', 'string', 'in:'.$status],
        ];
    }
}
