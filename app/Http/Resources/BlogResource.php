<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'description' => $this->description,
            'is_popular' => $this->is_popular === 1 ? 'Yes' : 'No',
            'status' => $this->formatted_status,
            'user_id' => $this->user_id
        ];
    }
}
