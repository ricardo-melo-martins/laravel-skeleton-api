<?php

namespace App\Modules\Players\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindPlayersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // FIXME: Habilitar Auth:check
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'q' => ['string'],
        ];
    }
}
