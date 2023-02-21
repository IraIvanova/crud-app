<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'email' => 'required|email',
            'bday' => 'date_format:d-m-Y',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ];
    }
}
