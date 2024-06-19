<?php

namespace App\Modules\Games\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGamesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'date' => ['required'],
            'season' => ['required'],
            'status' => ['required'],
            'period' => ['integer'],
            'time' => ['string'],
            'postseason' => ['boolean'],
            'home_team_score' => ['integer'],
            'visitor_team_score' => ['integer'],
        ];
    }
}
