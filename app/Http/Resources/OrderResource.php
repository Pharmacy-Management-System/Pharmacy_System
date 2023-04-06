<?php

namespace App\Http\Resources;
use App\Http\Resources\PharmacyResource;

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
            'user_id' => $this->id,
            'medicines' => MedicineResource::collection($this->medicines),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'pharmacy' => new PharmacyResource($this->pharmacy),
        ];
    }
}
