<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentsResource extends JsonResource
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
            'name' => $this->name,
            'weight' => $this->weight,
            'color' => $this->color,
            'type' => $this->type,
            'condition' => $this->condition,
            'is_rented' => $this->is_rented,
            'relationship'=> $relationship,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at ? $this->updated_at->format('d-m-Y') : null,
        ];
    }
}
