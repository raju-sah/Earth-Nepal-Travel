@extends('layouts.master')
@section('title', 'Create Activity')
@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.activities.index')}}" model="Activity" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.activities.store')}}" method="POST" enctype="multipart/form-data">

                <x-form.row>
                    <x-form.checkbox label="Is Parent Activity" col="6" id="is_parent" name="is_parent" value="1" checked class="form-check-input" />

                    <div class="form-group col-md-6" id="parent_select">
                        <label for="parent_id">Select Parent Destination</label>
                        <select class="form-control select_two_model" name="parent_id" id="parent_id">
                            <option value="" disabled selected>select parent</option>
                            @foreach($activities_tree as $activity)
                            <option value="{{ $activity->id }}" {{ old('parent_id') === $activity->id ? 'selected' : '' }}>{{ strtoupper($activity->title) }}</option>
                            @foreach($activity->children as $childActivity)
                            <option value="{{ $childActivity->id }}" {{ old('parent_id') === $childActivity->id ? 'selected' : '' }}>
                                &nbsp; &nbsp; &#8227; &nbsp; {{ ucfirst($childActivity->title) }}</option>
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" label="Title" id="title" name="title" :req="true" value="{{ old('title') }}" />
                    <x-form.input type="text" col="6" label="Slug" id="slug" name="slug" :req="true" value="{{ old('slug') }}" />
                </x-form.row>

                <x-form.input type="text" label="Gallery_caption" id="gallery_caption" name="gallery_caption" value="{{ old('gallery_caption') }}" />

                <x-form.input type="file" :tooltip="true" tooltip_text="Upload less than 1 MB" label="Gallery Images" :req="true" id="images" name="images[]" accept="image/*" multiple onchange="appendImages(this,'images-list')" />
                <div class="images-list row" id="images-list" style="display: none;"></div>

                <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5" />

                <x-form.select label="Exclusive" :options="[1 => 'Yes', 0 => 'No']" name="is_exclusive" col="6"></x-form.select>

                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>

        </div>
    </div>
</div>

@endsection

@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\ActivityRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@include('_helpers.parentChildSelect2', ['model' => 'Activity'])
@include('_helpers.multi_image_view_helper')
@endpush