<?php

namespace App\Http\Resources\Sale;

use App\Models\Sale;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public static $wrap = "sale";

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = User::find($this->user_id);
        $products = Sale::find($this->id)->products;


        return [
            'id'=> $this->id,
            'client' => $this->client,
            'total' => $this->total,

            'user' => $user,
            'products' => new DetailCollection( $products ),

            'createdAt' => $this->created_at,
        ];
    }
}
