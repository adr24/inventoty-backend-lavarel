<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'category' => [
                'id' => $category->id,
                'slug' => $category->slug,
                'name' => $category->name,
            ],
            'image' => $this->image,
            'subTotal' => $this->price * $this.quantity * $this->pivot[quantity],
            'quantity' => $this->pivot[quantity],
        ]
    }
}
