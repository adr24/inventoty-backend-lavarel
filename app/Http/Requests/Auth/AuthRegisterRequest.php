<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
            "name" => "required|min:4",
            "email" => "required|mail|unique:users,email",
            "password" => "required|min:8|max:18",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "El campo nombre es requerido",
            "name.min" => "El nombre es muy corto",
            "email.required" => "El campo email es requerido",
            "email.email" => "Ingrese email valido",
            "email.unique" => "Ya se ingreso el email",
            "password.required" => "El password es requerido",
            "password.min" => "contrasena muy corta",
            "password.max" => "contrasena muy larga",
        ];
    }    
}
