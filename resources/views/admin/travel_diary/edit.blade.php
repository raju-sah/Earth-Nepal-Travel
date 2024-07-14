@extends('layouts.master')
@section('title', 'Edit Travel Diary')
@section('content')

<div class="container-xxl">

    <x-breadcrumb model="TravelDiary"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.travel-diaries.update', $travel_diary->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <x-form.input type="text" label="Title" id="title" name="title" value="{{$travel_diary->title}}" />

                <x-form.input type="file" label="Gallery Images" :tooltip="true" tooltip_text="Upload less than 1 MB" :req="true" id="images" name="images[]" accept="image/*" multiple onchange="appendImages(this,'images-list')"/>

                <div class="images-list row" id="images-list" style="display: flex;">
                    @foreach($travel_diary->images as $image)
                    <div class="col-xl-2 col-lg-4 col-md-3 col-sm-4 col-6 mt-4 dynamic-img position-relative" id="gallery{{$image->id}}">
                        @if($loop->count > 1)
                        <button type="button" data-index="{{$image->id}}" data-image="{{$image->image_name}}" data-id="{{$image->id}}" class="btn-close inline-close deleteGalleryImage"></button>
                        @endif
                        <div class="img-container ratio-4by3">
                            <img src="{{asset('uploaded-images/traveldiary-images/'.$image->image_name)}}" alt="{{$image->id}}" class="card-img">
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="images-list row" id="images-list" style="display: none;"></div>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>

@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\TravelDiaryUpdateRequest') !!}
@include('_helpers.delete_gallery_image', ['folder' => 'traveldiary-images'])
@include('_helpers.multi_image_view_helper')
@endpush
