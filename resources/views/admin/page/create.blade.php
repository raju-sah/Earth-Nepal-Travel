@extends('layouts.master')

@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.pages.index')}}" model="Page" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.pages.store')}}" method="POST" enctype="multipart/form-data">

                <x-form.row>
                    <x-form.input type="file" label="Banner_image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="banner_image" :req="true" name="banner_image" alt="image" accept="image/*" onchange="previewThumb('banner_image','banner_image-thumb')" />
                    <x-form.preview for="banner_image" id="banner_image-thumb" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="file" label="Image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb('image','image-thumb')" />
                    <x-form.preview for="image" id="image-thumb" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="text" label="Name" :req="true" id="name" name="name" value="{{ old('name') }}" col="6" />
                    <x-form.input type="text" label="Slug" id="slug" :req="true" name="slug" value="{{ old('slug') }}" col="6" />
                </x-form.row>
                <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'" col="6" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>

        </div>
    </div>
</div>

@endsection

@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\PageStoreRequest') !!}
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@include('_helpers.image_preview')
@endpush