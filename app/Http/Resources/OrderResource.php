<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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

            'id' => $this->id,
            'medicines' => MedicineResource::collection($this->medicines),
            'status' => $this->status,
            'ordered_at' => $this->created_at,
            'assigned_pharmacy' => new PharmacyResource($this->pharmacy),

        ];
    }
}
