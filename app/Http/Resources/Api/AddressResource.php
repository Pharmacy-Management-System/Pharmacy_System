<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'Client_id' => $this->client_id,
            'Client_name' => $this->client->user->name,
            'Postal_code'=>$this->area_id,
            'Address_id'=>$this->id,
            'Street_name' => $this->street_name,
            'Building_no' => $this->building_number,
            'Floor_no' => $this->floor_number,
            'Flat_no' => $this->flat_number,
            'Main_street' => $this->is_main ? "yes" : "no",
        ];
    }
}
