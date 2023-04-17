<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>['required', 'string', 'min:8'],
            'isSuperAdmin' => ['nullable'],
            'email' => ['required', 'unique:admin_users', 'email'],
            'password' => ['sometimes', 'min:8', 'confirmed'],
        ];
    }
}
