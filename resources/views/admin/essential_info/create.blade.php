@extends('layouts.master')
@section('title', 'Create Essential Info')
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
                <a class="nav-link" href="{{route('admin.packages.packages-gallery.create', $package->id)}}">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.package_faqs.create', $package->id)}}">FAQ's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active">Essential Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.equipment.create', $package->id)}}">Equipments</a>
            </li>
        </ul>

        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{route('admin.packages.essential-infos.store', $package->id)}}" method="POST" enctype="multipart/form-data">

                    <x-form.input type="file" label="Image" id="image" name="image" accept="image/*" onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb"/>

                    <x-form.textarea label="Essential Info" :req="true" id="info" name="info" value="{{ old('info') }}" rows="5" cols="5"/>
                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EssentialInfoRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
    @include('_helpers.ck_editor', ['textarea_id' => 'info'])
    @include('_helpers.previewer_image_single',['name' => 'image'])
@endpush
