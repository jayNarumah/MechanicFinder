<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MechanicResource extends JsonResource
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
            'name' => $this->name,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'experiance_year' => $this->experiance_year,

        ];
    }
}
