@extends('layouts.master')
@section('title', 'Create Destination')
@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.destinations.index')}}" model="Destination" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.destinations.store')}}" method="POST" enctype="multipart/form-data">

                <x-form.row>
                    <x-form.checkbox label="Is Parent Destination" col="6" id="is_parent" name="is_parent" value="1" checked class="form-check-input" />
                    <div class="form-group col-md-6" id="parent_select">
                        <label for="parent_id">Select Parent Destination</label>
                        <select class="form-control select_two_model" name="parent_id" id="parent_id">
                            <option value="" disabled selected>select parent</option>
                            @foreach($destinations_tree as $destination)
                            <option value="{{ $destination->id }}" {{ old('parent_id') === $destination->id ? 'selected' : '' }}>{{ strtoupper($destination->title) }}</option>
                            @foreach($destination->children as $childDestination)
                            <option value="{{ $childDestination->id }}" {{ old('parent_id') === $childDestination->id ? 'selected' : '' }}>
                                &nbsp; &nbsp; &#8227; &nbsp; {{ ucfirst($childDestination->title) }}</option>
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" label="Title" id="title" name="title" :req="true" value="{{ old('title') }}" />
                    <x-form.input type="text" col="6" label="Slug" id="slug" name="slug" :req="true" value="{{ old('slug') }}" />
                </x-form.row>

                <x-form.row>

                    <x-form.input type="file" :tooltip="true" tooltip_text="Upload less than 1 MB" col="6" label="Image" id="image" name="image" accept="image/*" :req="true" onchange="previewThumb(this,'image-thumb')" />
                    <x-form.input type="text" col="6" label="Image Caption" id="image_caption" name="image_caption" value="{{ old('image_caption') }}" />
                </x-form.row>

                <x-form.single_preview id="image-thumb" />

                <x-form.row>
                    <x-form.select label="Destination Category" col="6" :req="true" :options="$destinationCategories" name="destination_category_id"></x-form.select>
                    <x-form.select label="Country" :req="true" col="6" :option-display="false" id="select_two_countries" :options="$countries" name="country"></x-form.select>
                </x-form.row>

                <x-form.row>
                    <x-form.select label="Activities" multiple="multiple" :option-display="false" class="select_two_activities" :req="true" col="6" :options="$activities" name="activities[]">
                    </x-form.select>

                    <x-form.select label="Featured" :options="[1 => 'Yes', 0 => 'No']" name="is_featured" col="6"></x-form.select>
                </x-form.row>

                <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5" />

                <x-form.row>
                    <x-form.input type="number" col="6" label="Longitude" id="longitude" name="longitude" value="{{ old('longitude') }}" />
                    <x-form.input type="number" col="6" label="Latitude" id="latitude" name="latitude" value="{{ old('latitude') }}" />
                </x-form.row>

                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>

            <div style="max-width:100%;" class="row mt-3 mb-3 me-3 ms-3 justify-content-center">
                <div class="col">
                    <input type="text" class="form-control mt-2" placeholder="Search The Location To Add Latitude and Longitude Above" id="search" name="search">
                </div>
            </div>
            <div id='map' style="width: 100%; height: 400px;"></div>
        </div>
    </div>
</div>

@endsection

@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\DestinationRequest') !!}
@include('_helpers.previewer_image_single',['name' => 'image'])
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@include('_helpers.parentChildSelect2', ['model' => 'Destination'])
@include('_helpers.map_helpers.leaflet_map')
@include('_helpers.map_helpers.search_location')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select_two_activities').select2({
            allowClear: true,
            placeholder: 'Select Activities'
        });
        $('#select_two_countries').select2({
            placeholder: 'Select Country'
        });


    });
</script>
@endpush