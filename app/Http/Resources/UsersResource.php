<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $relationship['rented'] = isset($this->rented) ? $this->rented : null;
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'email' => $this->email,
            'user_name' => $this->user_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'id_card_number' => $this->id_card_number,
            'phone_number' => $this->phone_number,
            'relationship'=> $relationship,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at ? $this->updated_at->format('d-m-Y') : null,
        ];
    }
}
