@extends('layouts.master')
@section('title', 'Create Testimonial')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.testimonials.index')}}" model="Testimonial" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.testimonials.store')}}" method="POST" enctype="multipart/form-data">
                    <x-form.input type="text" label="Name" :req="true" id="name" name="name" value="{{ old('name') }}"/>
                    <x-form.input type="text" label="email" :req="true" id="email" name="email" value="{{ old('email') }}"/>

                    <x-form.input type="file" label="Image" id="image" :req="true" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb"/>
                    <x-form.row>
                        <x-form.input type="text" col="6" label="Designation" id="designation" :req="true" name="designation" value="{{ old('designation') }}"/>
                        <x-form.input type="text" col="6" label="rating" id="rating" name="rating" value="{{ old('rating') }}"/>
                    </x-form.row>

                    <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5"/>
                    <x-form.checkbox label="Status" id="status" name="status" :req="true" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\TeamRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
    @include('_helpers.previewer_image_single',['name' => 'image'])
    @include('_helpers.ck_editor', ['textarea_id' => 'description'])
@endpush
