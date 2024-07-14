<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image_path,
            'link' => $this->link,
            'type' => $this->type,
            'status' => $this->status === 1 ? 'Active' : 'Inactive',    
            'description' => $this->description,

        ];
    }
}
