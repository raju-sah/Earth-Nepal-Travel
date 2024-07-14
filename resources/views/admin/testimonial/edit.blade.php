@extends('layouts.master')
@section('title', 'Edit Testimonial')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.testimonials.index')}}" model="Testimonial" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.testimonials.update', $testimonial->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <x-form.input type="text" label="Name" id="name" :req="true" name="name" value="{{$testimonial->name}}"/>
                    <x-form.input type="text" label="email" :req="true" id="email" name="email" value="{{ $testimonial->email }}"/>

                    <x-form.input type="file" label="Image" id="image" name="image" :req="true" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb" url="{{$testimonial->image_path}}"/>
                    <x-form.row>
                        <x-form.input type="text" label="Designation" col="6" :req="true" id="designation" name="designation" value="{{$testimonial->designation}}"/>
                        <x-form.input type="number" col="6" label="rating" id="rating" name="rating" value="{{ $testimonial->rating }}"/>
                    </x-form.row>
                    <x-form.textarea label="Description" :req="true" id="description" name="description" value="{!! $testimonial->description !!}" rows="5" cols="5"/>
                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes"
                                     :isChecked="$testimonial->status ? 'checked' : ''"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\TeamUpdateRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
    @include('_helpers.previewer_image_single',['name' => 'image'])
    @include('_helpers.ck_editor', ['textarea_id' => 'description'])
@endpush
