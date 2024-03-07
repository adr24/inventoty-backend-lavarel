<?php

namespace App\Http\Resources\Product;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public static $wrap = "product";
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $category = Category::find($this->category_id);


        return [
            'id' => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "stock" => $this->stock,
            "price" => $this->price,
            "image" => $this->image,
            // "category" => $category,
            "category" => [
                "id" => $category->id,
                "name" => $category->name,
                "slug" => $category->slug,

            ],
            "createdAt" => $this->created_at,
        ];
    }
}
