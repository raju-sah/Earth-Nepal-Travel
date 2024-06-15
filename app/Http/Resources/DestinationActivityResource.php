<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationActivityResource extends JsonResource
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
            'status' => $this->formatted_status,
            'images' => $this->images()->get()->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image' => asset('uploaded-images/activity-gallery-images/' . $image->image_name),
                ];
            }),

        ];
    }
}
