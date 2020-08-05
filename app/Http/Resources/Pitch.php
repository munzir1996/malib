<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pitch extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'location' => $this->location,
            'discription' => $this->discription,
            'price' => $this->price,
            'area' => $this->area->name,
            'owner' => $this->owner->name,
        ];
    }
}
