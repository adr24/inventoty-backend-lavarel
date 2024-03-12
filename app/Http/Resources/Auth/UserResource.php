<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = "user";

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'email'  => $this->email,
          'createdAt' => $this->created_at,
          'updatedAt' => $this->updated_at,
        ];
    }
}
