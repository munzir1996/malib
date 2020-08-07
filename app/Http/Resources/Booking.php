<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Booking extends JsonResource
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
            'id' => $this->id,
            'pitch' => $this->pitch->name,
            'customer' => $this->customer->name,
            'pitch_schedule' => new PitchSchedule($this->pitchSchedule),
            'book_date' => $this->book_date,
            'status' => $this->status,
        ];
    }
}
