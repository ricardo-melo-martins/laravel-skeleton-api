<?php

namespace App\Modules\Authentication\Handlers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'password' => ['required']
        ];
    }

}
