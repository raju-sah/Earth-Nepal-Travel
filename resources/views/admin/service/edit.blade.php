@extends('layouts.master')
@section('title', 'Edit Service')
@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.services.index')}}" model="Service" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.services.update', $service->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Title" id="title" name="title" value="{{$service->title}}" />
                    <x-form.input type="text" col="6" :req="true" label="Slug" id="slug" name="slug" value="{{$service->slug}}" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="file" label="Image" col="6" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')" />
                    <div class="col-md-6">
                        <label for="type" class="form-label mt-2">Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">Select</option>
                            @foreach( \App\Enums\ServiceType::cases() as $servicetype)
                            <option value="{{ $servicetype->name }}" {{ $service->type == $servicetype->name ? 'selected' : '' }}>{{ $servicetype->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </x-form.row>
                <x-form.single_preview id="image-thumb" url="{{$service->image_path}}" />

                <x-form.row>
                    <div class="col-md-3">
                        <label for="type" class="form-label mt-2">Rate Type</label>
                        <select name="rate_type" id="rate_type" class="form-select">
                            <option value="">Select</option>
                            @foreach( \App\Enums\RateType::cases() as $ratetype)
                            <option value="{{ $ratetype->name }}" {{ $service->rate_type == $ratetype->name ? 'selected' : '' }}>{{ $ratetype->value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-form.input type="text" col="3" label="price" id="price" name="price" value="{{$service->price}}" placeholder="$80 or Rs.8000" />
                    <x-form.input type="text" col="6" label="location" id="location" name="location" value="{{$service->location}}" />
                </x-form.row>

                <x-form.textarea label="Description" id="description" name="description" value="{!! $service->description !!}" rows="5" cols="5" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$service->status ? 'checked' : ''" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>

@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\ServiceUpdateRequest') !!}
@include('_helpers.previewer_image_single',['name' => 'image'])
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@endpush