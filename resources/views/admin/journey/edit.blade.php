@extends('layouts.master')

@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.journeys.index')}}" model="Journey" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.journeys.update', $journey->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <x-form.row>
                    <x-form.input type="file" :tooltip="true" tooltip_text="Upload less than 1 MB" col="6" label="Image" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')" /> 
                    <x-form.enum-select label="Journey Type" :req="true" col="6" :model="$journey->type" :options="\App\Enums\JourneyType::cases()" name="type"></x-form.enum-select>
                </x-form.row>
                <x-form.single_preview id="image-thumb" url="{{$journey->image_path}}" />

                <x-form.row>
                    <x-form.input type="text" label="Name" id="name" name="name" value="{{$journey->name}}" col="6" />
                    <x-form.input type="text" label="Slug" id="slug" name="slug" value="{{$journey->slug}}" col="6" />
                </x-form.row>

                <x-form.textarea label="Description" id="description" name="description" value="{!! $journey->description !!}" rows="5" cols="5" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$journey->status ? 'checked' : ''" col="6" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>

@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\JourneyUpdateRequest') !!}
@include('_helpers.previewer_image_single',['name' => 'image'])
@include('_helpers.slugify',['title' => 'name'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])

@endpush