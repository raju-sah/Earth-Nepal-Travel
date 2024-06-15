@extends('layouts.master')
@section('title', 'Edit Blog')
@section('content')
<div class="container-xxl">

    <x-breadcrumb listRoute="{{ route('admin.blogs.index') }}" model="Blog" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Title" id="title" name="title" value="{{ $blog->title }}" />
                    <x-form.input type="text" col="6" :req="true" label="Slug" id="slug" name="slug" value="{{ $blog->slug }}" />
                </x-form.row>

                <x-form.textarea label="Description" id="description" :req="true" name="description" value="{!! $blog->description !!}" rows="5" cols="5" />
                <x-form.input type="file" label="Image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')" />
                <x-form.single_preview id="image-thumb" url="{{ $blog->image_path }}" />
                <x-form.checkbox label="Is Popular" id="is_popular" name="is_popular" value="1" class="form-check-input" isEditMode="yes" :isChecked="$blog->is_popular ? 'checked' : ''" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$blog->status ? 'checked' : ''" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                    Save
                </x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\BlogUpdateRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.previewer_image_single', ['name' => 'image'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])

@endpush