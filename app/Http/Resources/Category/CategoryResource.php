<?php

namespace App\Http\Resources\Category;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\ProductCollection;

class CategoryResource extends JsonResource
{
    public static $wrap = "category";


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $products = Category::find($this->id)->products;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "description" => $this->description,
            "products" => new ProductCollection($products),
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }
}
