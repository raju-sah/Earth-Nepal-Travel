@extends('layouts.master')

@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.pages.index')}}" model="Page" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.pages.update', $page->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')

                <x-form.row>
                    <x-form.input type="file"  label="Banner_image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="banner_image" name="banner_image" alt="image" accept="image/*" onchange="previewThumb('banner_image','banner_image-thumb')" />
                    <x-form.preview for="banner_image" id="banner_image-thumb" url="{{$page->banner_image_path}}" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="file" label="Image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb('image','image-thumb')" />
                    <x-form.preview for="image" id="image-thumb" url="{{$page->image_path}}" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="text" :req="true" label="Name" id="name" name="name" value="{{$page->name}}" col="6" />
                    <x-form.input type="text" :req="true" label="Slug" id="slug" name="slug" value="{{$page->slug}}" col="6" />
                </x-form.row>
                <x-form.textarea label="Description" id="description" name="description" value="{!! $page->description !!}" rows="5" cols="5" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$page->status ? 'checked' : ''" col="6" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>

@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\PageUpdateRequest') !!}
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@include('_helpers.image_preview')
@endpush