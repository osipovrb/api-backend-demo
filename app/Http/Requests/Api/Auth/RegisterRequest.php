<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'min:3', 'max:20', 'alpha_dash', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ];
    }
}
