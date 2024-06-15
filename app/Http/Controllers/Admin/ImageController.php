<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function destroy(Request $request): bool
    {
        Image::where('id', $request->gallery_id)->delete();
        return @unlink('uploaded-images/' . $request->folder . '/' . $request->image_name);
    }

    public function deleteRepeaterItem(Request $request): JsonResponse
    {
        $model = "App\\Models\\" . $request->model;
        $model::query()->where('id', $request->id)->delete();
        return response()->json(true);
    }

    public function destroySingleImage(Request $request): bool
    {
        $model = "App\\Models\\" . $request->model;
        $model::query()->where('id', $request->id)->update(['image' => null]);
        return @unlink('uploaded-images/' . $request->folder . '/' . $request->image_name);
    }
}
