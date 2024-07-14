<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelDiaryPageResource extends JsonResource
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
          'images' => $this->images()->get()->map(function ($image) {
              return [
                  'id' => $image->id,
                  'image' => asset('uploaded-images/traveldiary-images/' . $image->image_name),
              ];
          }),
        ];
    }
}
