@extends('layouts.master')

@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.partners.index')}}" model="Partner" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.partners.store')}}" method="POST" enctype="multipart/form-data">
                <x-form.row>
                    <x-form.input type="file" label="Image" col="6" id="image" :req="true" name="image" alt="image" accept="image/*" onchange="previewThumb('image','image-thumb')" />
                    <x-form.input type="text" label="Name" id="name" col="6" :req="true" name="name" value="{{ old('name') }}" />
                    <x-form.preview for="image" id="image-thumb" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="text" label="Link" col="6" id="link" name="link" value="{{ old('link') }}" />
                    <x-form.enum-select :options="$partnerTypes" :model="\App\Enums\PartnerType::Affiliate->value" col="6" label="Partner" name="type"></x-form.enum-select>
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
{!! JsValidator::formRequest('App\Http\Requests\Admin\PartnerStoreRequest') !!}
@include('_helpers.image_preview')
@endpush