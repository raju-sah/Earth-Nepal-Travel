<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsPageResource extends JsonResource
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
            'page_title' => $this->page_title,
            'banner_image' => $this->banner_path,
            'image' => $this->image_path,
            'content_title' => $this->content_title,
            'description' => $this->description,
        ];
    }
}
