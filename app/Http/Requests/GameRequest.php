<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
            'team_1' => 'required|exists:teams,id',
            'team_2' => 'required|exists:teams,id',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'team_1' => $this->team_1,
            'team_2' => $this->team_2,
        ]);
    }
}
