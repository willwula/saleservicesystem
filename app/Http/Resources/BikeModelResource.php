<?php

namespace App\Http\Resources;

use App\Models\BikeBrand;
use Illuminate\Http\Resources\Json\JsonResource;

class BikeModelResource extends JsonResource
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
            'id'              => $this->id,
            'name'            => $this->name,
            'bike_brand_id'   => $this->bike_brand_id,
        ];
    }
}
