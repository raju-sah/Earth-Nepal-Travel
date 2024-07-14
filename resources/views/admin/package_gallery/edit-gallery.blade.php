@extends('layouts.master')
@section('title', 'Edit Package Gallery')
@section('content')

    <div class="container-xxl">

        <ul class="nav nav-pills nav-fill mb-3">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('admin.packages.edit', $package->id)}}">Package</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.itineraries.create', $package->id)}}">Itinerary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.itinerary-details.create', $package->id)}}">Itinerary Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.include-excludes.create', $package->id)}}">Include Exclude</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.package_faqs.create', $package->id)}}">FAQ's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.essential-infos.create', $package->id)}}">Essential Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.equipment.create', $package->id)}}">Equipments</a>
            </li>
        </ul>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.packages.packages-gallery.update', $package->id)}}" method="POST" enctype="multipart/form-data">

                    @method('PATCH')

                    <x-form.input type="file" label="Gallery Images" :tooltip="true" tooltip_text="Upload less than 1 MB" :req="true" id="images" name="images[]" accept="image/*" multiple onchange="appendImages(this,'images-list')"/>

                    <div class="images-list row" id="images-list" style="display: flex;">
                        @foreach($package->images as $img)
                            <div class="col-xl-2 col-lg-4 col-md-3 col-sm-4 col-6 mt-4 dynamic-img position-relative" id="gallery{{$img->id}}">
                                <button type="button" data-index="{{$img->id}}" data-image="{{$img->image_name}}" data-id="{{$img->id}}"
                                        class="btn-close inline-close deleteGalleryImage"></button>
                                <div class="img-container ratio-4by3">
                                    <img src="{{asset('uploaded-images/package-gallery-images/'.$img->image_name)}}" alt="{{$img->id}}" class="card-img">
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\PackageRequest')!!}
    @include('_helpers.multi_image_view_helper')
    @include('_helpers.delete_gallery_image', ['folder' => 'package-gallery-images'])
@endpush
