<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => "required|exists:users,email",
            "password" => "required",
        ];
    }
    public function messages(): array
    {
        return [
            "email.required" => "El campo email es requerido",
            "email.exists" => "el email no existe",
            "password.required" => "El password es requerido",
        ];
    }    

}
