@extends('layouts.master')
@section('title', 'Create Service')
@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.services.index')}}" model="Service" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.services.store')}}" method="POST" enctype="multipart/form-data">
                <x-form.row>
                    <x-form.input type="text" col="6" label="Title" id="title" name="title" :req="true" value="{{ old('title') }}" />
                    <x-form.input type="text" col="6" label="Slug" id="slug" name="slug" :req="true" value="{{ old('slug') }}" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="file" col="6" :req="true" label="Image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')" />
                    <div class="col-md-6">
                        <label for="type" class="form-label mt-2">Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">Select</option>
                            @foreach( \App\Enums\ServiceType::cases() as $servicetype)
                            <option value="{{ $servicetype->name }}" {{ old('type') == $servicetype->name ? 'selected' : '' }}>{{ $servicetype->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </x-form.row>
                <x-form.single_preview id="image-thumb" />
                <x-form.row>
                    <div class="col-md-3">
                        <label for="type" class="form-label mt-2">Rate Type</label>
                        <select name="rate_type" id="rate_type" class="form-select">
                            <option value="">Select</option>
                            @foreach( \App\Enums\RateType::cases() as $ratetype)
                            <option value="{{ $ratetype->name }}" {{ old('type') == $ratetype->name ? 'selected' : '' }}>{{ $ratetype->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-form.input type="text" col="3" label="price" id="price" name="price"  value="{{ old('price') }}" placeholder="$80 or Rs.8000" />
                    <x-form.input type="text" col="6" label="location" id="location" name="location"  value="{{ old('location') }}" />
                </x-form.row>

                <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>

        </div>
    </div>
</div>

@endsection

@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\ServiceRequest') !!}
@include('_helpers.previewer_image_single',['name' => 'image'])
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@endpush