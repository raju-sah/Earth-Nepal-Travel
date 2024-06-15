@extends('layouts.master')

@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.journeys.index')}}" model="Journey" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.journeys.store')}}" method="POST" enctype="multipart/form-data">
            <x-form.row>
                    <x-form.input type="file" label="Img" id="img" name="img" alt="image" accept="image/*" onchange="previewThumb('img','img-thumb')" col="6" />
                    <x-form.enum-select label="Journey Type" :req="true" id="journey_type" name="type" :options="App\Enums\JourneyType::cases()" class="form-select" col="6" />
                </x-form.row>
                <x-form.preview for="img" id="img-thumb" /> 
                <x-form.row>
                    <x-form.input type="text" label="Name" :req="true" id="name" name="name" value="{{ old('name') }}" col="6" />
                    <x-form.input type="text" label="Slug" :req="true" id="slug" name="slug" value="{{ old('slug') }}" col="6" />
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
{!! JsValidator::formRequest('App\Http\Requests\Admin\JourneyStoreRequest') !!}
@include('_helpers.image_preview')
@include('_helpers.slugify',['title' => 'name'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@endpush