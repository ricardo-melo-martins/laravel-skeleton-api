<?php

namespace App\Modules\Teams\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTeamsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // FIXME: Habilitar Auth:check
        return true; // Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'conference' => ['required'],
            'division' => ['required'],
            'city' => ['required'],
            'name' => ['required'],
            'full_name' => ['required'],
            'abbreviation' => ['required'],
        ];
    }
}
