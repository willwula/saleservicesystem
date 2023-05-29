<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCenterResource extends JsonResource
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
            'role'  => $this->role,
            'status' => $this->status,
            'name'  => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'serviceCenter_id' => $this->serviceCenter_id,
            'created_at' => $this->created_at,
        ];
    }
}
