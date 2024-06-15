<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TravelDiaryRequest;
use App\Http\Requests\admin\TravelDiaryUpdateRequest;
use App\Models\TravelDiary;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TravelDiaryController extends Controller
{

    public function index() : View
    {
        return view('admin.travel_diary.index', [
            'travel_diaries' => TravelDiary::query()->select(['id', 'title','image'])->latest()->get()
        ]);
    }

    public function create() : View
    {
        $travel_diary= TravelDiary::first();
        if (!is_null($travel_diary)) {
            return view('admin.travel_diary.edit', compact('travel_diary'));
        }
        return view('admin.travel_diary.create');
    }

    public function store(TravelDiaryRequest $request) : RedirectResponse
    {

        $travel_diary = TravelDiary::create($request->except('images'));
        if($request->has('images')){
            foreach ($request->images as $image) {
                $travel_diary->storeMultiImage($image, 'traveldiary-images');
            }
        }

        return redirect()->route('admin.travel-diaries.edit',$travel_diary)->with('success', 'TravelDiary Created Successfully!');
    }

    public function show(TravelDiary $travel_diary) : View
    {
        return view('admin.travel_diary.show', compact('travel_diary'));
    }

    public function edit(TravelDiary $travel_diary) : View
    {
        return view('admin.travel_diary.edit', compact('travel_diary'));
    }

    public function update(TravelDiaryUpdateRequest $request, TravelDiary $travel_diary) : RedirectResponse
    {

        $travel_diary->update($request->safe()->except('images'));

        if($request->has('images')) {
            foreach ($request->images as $image) {
                $travel_diary->storeMultiImage($image, 'traveldiary-images');
            }
        }

        return redirect()->route('admin.travel-diaries.edit', $travel_diary)->with('success', 'TravelDiary Updated Successfully!');
    }

    public function destroy(TravelDiary $travel_diary) : RedirectResponse
    {
        $this->authorize('delete-travel-diary');

        foreach ($travel_diary->images as $image){
            @unlink('uploaded-images/traveldiary-images/' . $image->image_name);
        }
        $travel_diary->images()->delete();
        $travel_diary->delete();

        return redirect()->route('admin.travel-diaries.index')->with('error', 'TravelDiary Deleted Successfully!');
    }


}
