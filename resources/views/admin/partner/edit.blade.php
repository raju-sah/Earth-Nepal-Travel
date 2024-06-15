@extends('layouts.master')

@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.partners.index')}}" model="Partner" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.partners.update', $partner->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <x-form.row>
                    <x-form.input type="file" :req="true" col="6" label="Image" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb('image','image-thumb')" />
                    <x-form.input type="text" :req="true" col="6" label="Name" id="name" name="name" value="{{$partner->name}}" />
                    <x-form.preview for="image" id="image-thumb" url="{{$partner->image_path}}" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="text" label="Link" col="6" id="link" name="link" value="{{$partner->link}}" />
                    <x-form.enum-select :options="$partnerTypes" :model="$partner->type" col="6" label="Partner" name="type"></x-form.enum-select>
                </x-form.row>
                <x-form.textarea label="Description" id="description" name="description" value="{{$partner->description}}" rows="5" cols="5" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$partner->status ? 'checked' : ''" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>

@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\PartnerUpdateRequest') !!}
@include('_helpers.image_preview')
@endpush