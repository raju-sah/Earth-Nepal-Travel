@extends('layouts.master')
@section('title', 'Create Destination Category')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.destination-categories.index')}}" model="Destination Category" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.destination-categories.store')}}" method="POST" enctype="multipart/form-data">

                    <x-form.row>
                        <x-form.input type="text" col="6" label="Title" id="title" name="title" :req="true" value="{{ old('title') }}"/>
                        <x-form.input type="text" col="6" label="Slug" id="slug" name="slug" :req="true" value="{{ old('slug') }}"/>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="file" col="6" :tooltip="true" tooltip_text="Upload less than 1 MB" label="Image" id="image" name="image" alt="image" accept="image/*" :req="true"
                                      onchange="previewThumb(this,'image-thumb')"/>
                        <x-form.input type="text" col="6" label="Image Caption" id="image_caption" name="image_caption" value="{{ old('image_caption') }}"/>
                    </x-form.row>
                    <x-form.single_preview id="image-thumb"/>

                    <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5"/>

                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\DestinationCategoryRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
    @include('_helpers.previewer_image_single',['name' => 'image'])
    @include('_helpers.slugify',['title' => 'title'])
    @include('_helpers.ck_editor', ['textarea_id' => 'description'])
@endpush
