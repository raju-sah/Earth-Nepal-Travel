@extends('layouts.master')
@section('title', 'Create Our Services')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Create Our Services"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.our-services.store')}}" method="POST" enctype="multipart/form-data">
                    <label for="banner_image_input" class="col-form-label">Banner Image <span class="text-danger">*</span><i class='bx bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="Upload less than 1 MB" style="font-size: 15px;"></i></label>
                    <input type="file" class="form-control text-14" id="banner_image_input" name="banner_image" accept="image/*"/>
                    @error('banner_image') <span class="text-danger small">{{ $message }}</span> @enderror

                    <div class="banner-thumb mt-3"
                         style="display: none; width: 150px; aspect-ratio: 4/3; position: relative;"
                         id="banner_image">
                        <img src="" alt="title" class="w-100 card-img">
                        <button type="button" id="resetBannerBtn"
                                class="btn btn-xs btn-danger position-absolute top-0 end-0 position-relative">
                            <i class='bx bx-x bx-xs bx-tada-hover'></i>
                        </button>
                    </div>

                    <x-form.input type="text" label="Page Title" :req="true" id="page_title" name="page_title" value="{{ old('page_title') }}"/>
                    <x-form.input type="file" label="Extra Image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb"/>
                    <x-form.input type="text" label="Content Title" id="content_title" name="content_title" value="{{ old('content_title') }}"/>
                    <x-form.textarea label="Description" :req="true" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\OurServiceRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
    @include('_helpers.previewer_image_single',['name' => 'image'])
    @include('_helpers.ck_editor', ['textarea_id' => 'description'])
    @include('_helpers.banner_image_helper')
@endpush
