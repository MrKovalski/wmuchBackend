<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role_id,
            'organisation_id' => $this->organisation_id,
            'working_status' => $this->working_status,
            'hour_rate' => $this->hour_rate,

        ];
    }
}
