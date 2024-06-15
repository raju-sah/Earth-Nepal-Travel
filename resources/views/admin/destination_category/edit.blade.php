@extends('layouts.master')
@section('title', 'Edit Destination Category')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.destination-categories.index')}}" model="Destination Category" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.destination-categories.update', $destinationCategory->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <x-form.row>
                        <x-form.input type="text" col="6" :req="true" label="Title" id="title" name="title" value="{{$destinationCategory->title}}"/>
                        <x-form.input type="text" col="6" :req="true" label="Slug" id="slug" name="slug" value="{{$destinationCategory->slug}}"/>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="file" :tooltip="true" tooltip_text="Upload less than 1 MB" col="6" :req="true" label="Image" id="image" name="image" alt="image" accept="image/*"
                                      onchange="previewThumb(this,'image-thumb')"/>
                        <x-form.input type="text" col="6" label="Image Caption" id="image_caption" name="image_caption" value="{{$destinationCategory->image_caption}}"/>
                    </x-form.row>

                    <x-form.single_preview id="image-thumb" url="{{$destinationCategory->image_path}}"/>

                    <x-form.textarea label="Description" id="description" name="description" value="{!! $destinationCategory->description  !!}" rows="5" cols="5"/>

                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes"
                                     :isChecked="$destinationCategory->status ? 'checked' : ''"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\DestinationCategoryUpdateRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
    @include('_helpers.slugify',['title' => 'title'])
    @include('_helpers.ck_editor', ['textarea_id' => 'description'])
    @include('_helpers.previewer_image_single',['name' => 'image'])
@endpush
