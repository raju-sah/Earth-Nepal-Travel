<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityDestinationResource extends JsonResource
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
                    'title' => $this->title,
                    'slug' => $this->slug,
                    'image' => $this->image_path,
                    'image_caption' => $this->image_caption,
                    'status' => $this->formatted_status,
         ];
    }
}
