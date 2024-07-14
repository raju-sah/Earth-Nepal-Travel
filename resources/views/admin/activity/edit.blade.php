@extends('layouts.master')
@section('title', 'Edit Activity')
@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.activities.index')}}" model="Activity" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.activities.update', $activity->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')

                <x-form.row>
                    <x-form.checkbox label="Is Parent Destination" col="6" id="is_parent" name="is_parent" value="1" isEditMode="yes" :isChecked="$activity->parent_id ? '' : 'checked'" class="form-check-input" />

                    <div class="form-group col-md-6" id="parent_select">
                        <label for="parent_id">Select Parent Destination</label>
                        <select class="form-control select_two_model" name="parent_id" id="parent_id">
                            <option value="" disabled>select parent</option>
                            @foreach($activities_tree as $parentActivity)
                            @if($activity->id !== $parentActivity->id)
                            <option value="{{ $parentActivity->id }}" {{ old('parent_id', $activity->parent_id) === $parentActivity->id ? 'selected' : '' }}>{{ strtoupper($parentActivity->title) }}</option>
                            @foreach($parentActivity->children as $childActivity)
                            @if($activity->id !== $childActivity->id)
                            <option value="{{ $childActivity->id }}" {{ old('parent_id', $activity->parent_id) === $childActivity->id ? 'selected' : '' }}> &nbsp; &nbsp; &#8227; &nbsp; {{ ucfirst($childActivity->title) }}</option>
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                        </select>
                    </div>
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Title" id="title" name="title" value="{{$activity->title}}" />
                    <x-form.input type="text" col="6" :req="true" label="Slug" id="slug" name="slug" value="{{$activity->slug}}" />
                </x-form.row>

                <x-form.input type="text" label="Gallery_caption" id="gallery_caption" name="gallery_caption" value="{{$activity->gallery_caption}}" />

                <x-form.input type="file" :tooltip="true" tooltip_text="Upload less than 1 MB" label="Gallery Images" :req="true" id="images" name="images[]" accept="image/*" multiple onchange="appendImages(this,'images-list')" />

                <div class="images-list row" id="images-list" style="display: flex;">
                    @foreach($activity->images as $image)
                    <div class="col-xl-2 col-lg-4 col-md-3 col-sm-4 col-6 mt-4 dynamic-img position-relative" id="gallery{{$image->id}}">
                        @if($loop->count > 1)
                        <button type="button" data-index="{{$image->id}}" data-image="{{$image->image_name}}" data-id="{{$image->id}}" class="btn-close inline-close deleteGalleryImage"></button>
                        @endif
                        <div class="img-container ratio-4by3">
                            <img src="{{asset('uploaded-images/activity-gallery-images/'.$image->image_name)}}" alt="{{$image->id}}" class="card-img">
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="images-list row" id="images-list" style="display: none;"></div>

                <x-form.textarea label="Description" id="description" name="description" value="{!! $activity->description !!}" rows="5" cols="5" />

                <x-form.select label="Exclusive" col="6" :model="$activity->is_exclusive" :options="[1 => 'Yes', 0 => 'No']" name="is_exclusive"></x-form.select>

                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$activity->status ? 'checked' : ''" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>

@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\ActivityUpdateRequest') !!}
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@include('_helpers.parentChildSelect2', ['model' => 'Activity'])
@include('_helpers.delete_gallery_image', ['folder' => 'activity-gallery-images'])
@include('_helpers.multi_image_view_helper')
@endpush