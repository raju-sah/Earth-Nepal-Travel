<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationPageResource extends JsonResource
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
            'is_exclusive' => $this->is_exclusive === 1 ? 'Yes' : 'No',
            'status' => $this->status === 1 ? 'Active' : 'Inactive',
            'gallery_caption' => $this->gallery_caption,
            'banner_image' => $this->image_path,
            'country' => $this->country,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'view_count' => $this->view_count,
            'activities' => $this->activities->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'title' => $activity->title,
                    'slug' => $activity->slug,
                    'image' => asset('uploaded-images/activity-gallery-images/' . $activity->images->first()->image_name),
                ];
            }),
            'packages' => $this->packages->map(function ($package) {
                return [
                    'id' => $package->id,
                    'title' => $package->title,
                    'slug' => $package->slug,
                    'image' => $package->banner_path,
                ];
            }),
        ];
    }
}
