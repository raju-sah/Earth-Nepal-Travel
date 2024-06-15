<?php

namespace App\Http\Resources;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FooterMenuResource extends JsonResource
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
            'url' => $this->url,
            'children' => $this->formatTree($this->id)
        ];
    }
    
    public function formatTree($parentId)
    {
        $children = Menu::where('parent_id', $parentId)->select('id', 'title', 'url')->get();
        foreach ($children as $child) {
            $child->children = $this->formatTree($child->id);
    
            if ($child->children->isEmpty()) {
                unset($child->children); // Remove 'children' key if it has no children
            }
        }
    
        return $children;
    }
    
    }
