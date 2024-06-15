<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityPageResource extends JsonResource
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
            'banner_image' => asset('uploaded-images/activity-gallery-images/' . $this->images->first()->image_name),
            'images' => collect($this->images->slice(1)->all())->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image' => asset('uploaded-images/activity-gallery-images/' . $image->image_name),
                ];
            }),
            'destinations' => $this->destinations->map(function ($destination) {
                return [
                    'id' => $destination->id,
                    'title' => $destination->title,
                    'slug' => $destination->slug,
                    'image' => $destination->image_path,
                    'status' => $destination->formatted_status
                ];
            }),
           'packages' => $this->packages->map(function ($package) {
                return [
                    'id' => $package->id,
                    'title' => $package->title,
                    'slug' => $package->slug,
                    'image' => $package->banner_path,
                    'status' => $package->formatted_status
                ];
            }),

            'featured_destinations' => $this->destinations->map(function ($destination) {
                return [
                    'id' => $destination->id,
                    'title' => $destination->title,
                    'slug' => $destination->slug,
                    'active' => $destination->formatted_status
                ];
            }),
        ];
    }
}
