<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkingHoursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'hours_worked' => $this->hours_worked,
            'user_id' => $this->user_id
        ];
    }
}
