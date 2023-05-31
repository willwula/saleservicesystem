<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getKey(),
            'role'  => $this->role,
            'status' => $this->status,
            'name'  => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'serviceCenter' => ManagerResource::make($this->whenLoaded('serviceCenter')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
