<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            //validacion de campos
            "name"          => "required|unique:products,name",
            "description"   => "required",
            "stock"         => "required|integer",
            "price"         => "required",
            "category_id"   => "required|exists:categories,id",
        ];
    }

    public function messages(): array
    {
        return [
        "name.required" => "El campo nombre es obligatorio",
        "name.unique" => "El nombre del producto ya esta registrado",
        "description.required" => "El campo descripcion es obligatorio",
        "stock.required" => "El campo stock es obligatorio",
        "stock.integer" => "Ingrese un numero valido para el Stock",
        "category_id.required" => "El campo categoria es obligatorio",
        "category_id.exists" => "No se encontro la categoria",
        ];
    }

}
