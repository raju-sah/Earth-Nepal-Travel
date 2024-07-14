<?php

namespace App\Http\Resources;

use App\Models\Journey;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $package_sub_childIDs = json_decode($this->journey_type_childs, true);
        
        if (!is_array($package_sub_childIDs)) {
            $package_sub_childIDs = [];
        }
        
        $package_sub_childs = Journey::whereIn('id', $package_sub_childIDs)->pluck('name');
    
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->banner_path,
            'package_type' => ucfirst($this->journey_type),
            'package_type_childs' => $package_sub_childs,    
            'duration' => $this->duration_value . ' ' . $this->duration_type,
            'highlight' => $this->highlight,
            'status' => $this->formatted_status,
            'view_count' => $this->view_count,
            'price' => $this->price,
        ];
    }
}
