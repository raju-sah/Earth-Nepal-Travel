<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackagePageResource extends JsonResource
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
            'image' => $this->banner_path,
            'duration' => $this->duration_value . ' ' . $this->duration_type,
            'difficulty_level' => $this->difficulty_level,
            'difficulty_icon' => $this->difficulty_icon,
            'min_age' => $this->min_age,
            'max_age' => $this->max_age,
            'overview' => $this->overview,
            'starting_location' => $this->starting_location,
            'ending_location' => $this->ending_location,
            'max_altitude' => $this->max_altitude,
            'road_map' => $this->image_path,
            'iframe' => $this->iframe,
            'status' => $this->status === 1 ? 'Active' : 'Inactive',
            'view_count' => $this->view_count,
            'highlight' => $this->highlight,
            'images' => $this->images->map(function ($image) {
                return
                    [
                        'id' => $image->id,
                        'image' => $image->image_name,
                    ];
            }),
            
            'itineraries' => $this->itineraries()->orderBy('order', 'asc')->get()->map(function ($itinerary) {
                return
                    [
                        'id' => $itinerary->id,
                        'title' => $itinerary->title,
                        'day' => $itinerary->day,
                        'icon' => asset('uploaded-images/icon-images/' . $itinerary->icon),
                        'description' => $itinerary->description,
                        'meals' => $itinerary->meals,
                        'max_altitude' => $itinerary->max_altitude,
                        'accommodation' => $itinerary->accommodation,
                        'transportation' => $itinerary->transportation,
                        'itinerary_details' => $this->itinerary_details()->orderBy('order', 'asc')->get()->map(function ($itinerary_detail) {
                            return
                                [
                                    'id' => $itinerary_detail->id,
                                    'icon' => asset('uploaded-images/icon-images/' . $itinerary_detail->icon),
                                    'duration' => $itinerary_detail->duration_value . ' ' . $itinerary_detail->duration_unit,
                                    'description' => $itinerary_detail->description,
                                ];
                        }),
                    ];
            }),

            'essential_info' => [
                'id' => $this->essential_info->id,
                'info' => $this->essential_info->info,
                'image' =>  $this->essential_info->image_path,
            ],

            'equipments' => $this->equipments()->orderBy('order', 'asc')->get()->map(function ($equipment) {
                return [
                    'id' => $equipment->id,
                    'title' => $equipment->title,
                    'icon' => asset('uploaded-images/icon-images/' . $equipment->icon),
                    'description' => $equipment->description,
                ];
            }),

            'include_exclude'  =>  [
                'id' => $this->include_exclude->id,
                'includes' => $this->include_exclude->includes,
                'excludes' => $this->include_exclude->excludes,
            ],

            'common_faqs' => $this->common_faqs->map(function ($common_faq) {
                return
                    [
                        'id' => $common_faq->id,
                        'question' => $common_faq->question,
                        'answer' => $common_faq->answer,
                        'status' => $common_faq->status === 1 ? 'Active' : 'Inactive',
                    ];
            }),
            'package_faqs' => $this->package_faqs()->orderBy('order', 'asc')->get()->map(function ($package_faq) {
                return
                    [
                        'id' => $package_faq->id,
                        'question' => $package_faq->question,
                        'answer' => $package_faq->answer,
                        'status' => $package_faq->status === 1 ? 'Active' : 'Inactive',
                    ];
            }),
        ];
    }
}
