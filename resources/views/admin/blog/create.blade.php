@extends('layouts.master')
@section('title', 'Create Blog')
@section('content')
<div class="container-xxl">

    <x-breadcrumb listRoute="{{ route('admin.blogs.index') }}" model="Blog" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Title" id="title" name="title" value="{{ old('title') }}" />
                    <x-form.input type="text" col="6" :req="true" label="Slug" id="slug" name="slug" value="{{ old('slug') }}" />
                </x-form.row>
                <x-form.textarea :req="true" label="Description" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5" />

                <x-form.input col="12" :req="false" :tooltip="true" tooltip_text="Upload less than 1 MB" type="file" label="Image" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')" />
                <x-form.single_preview id="image-thumb" />

                <x-form.checkbox label="Is Popular" id="is_popular" name="is_popular" value="1" class="form-check-input mt-2" isEditMode="yes" :isChecked="''" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input mt-2" isEditMode="yes" :isChecked="'checked'" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                    Save
                </x-form.button>
            </x-form.wrapper>

        </div>
    </div>
</div>
@endsection

@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\BlogRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
@include('_helpers.previewer_image_single', ['name' => 'image'])
@include('_helpers.slugify', ['title' => 'title'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@endpush