<?php

namespace App\Modules\Players\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'position' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'jersey_number' => ['required'],
            'college' => ['required'],
            'country' => ['required'],
        ];
    }
}
