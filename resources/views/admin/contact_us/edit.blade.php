@extends('layouts.master')
@section('title', 'Contact Us')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="ContactUs"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.contact-uses.update', $contact_us->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <label for="banner_image_input" class="col-form-label">Banner Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control text-14" id="banner_image_input" name="banner_image" accept="image/*"/>
                    @error('image') <span class="text-danger small">{{ $message }}</span> @enderror

                    <div class="banner-thumb mt-3" style="width: 150px; aspect-ratio: 4/3; position: relative;" id="banner_image">
                        <img src="{{$contact_us->banner_path}}" alt="title" class="w-100 card-img">
                        <button type="button" id="resetBannerBtn" class="btn btn-xs btn-danger position-absolute top-0 end-0 position-relative">
                            <i class='bx bx-x bx-xs bx-tada-hover'></i>
                        </button>
                    </div>
                    <x-form.input type="text" label="Page_title" :req="true" id="page_title" name="page_title" value="{{$contact_us->page_title}}"/>
                    <x-form.input type="file" label="Image" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb" url="{{$contact_us->image_path}}"/>
                    <x-form.input type="text" label="Content_title" id="content_title" name="content_title" value="{{$contact_us->content_title}}"/>
                    <x-form.textarea label="Description" id="description" :req="true" name="description" value="{!! $contact_us->description !!}" rows="5" cols="5"/>
                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ContactUsUpdateRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
    @include('_helpers.previewer_image_single',['name' => 'image'])
    @include('_helpers.ck_editor', ['textarea_id' => 'description'])
    @include('_helpers.banner_image_helper')
@endpush
