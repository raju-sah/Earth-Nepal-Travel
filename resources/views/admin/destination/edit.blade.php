@extends('layouts.master')
@section('title', 'Edit Destination')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.destinations.index')}}" model="Destination" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.destinations.update', $destination->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')

                    <x-form.row>
                        <x-form.checkbox label="Is Parent Destination" col="6" id="is_parent" name="is_parent" value="1" isEditMode="yes"
                                         :isChecked="$destination->parent_id ? '' : 'checked'" class="form-check-input"/>
                        <div class="form-group col-md-6" id="parent_select">
                            <label for="parent_id">Select Parent Destination</label>
                            <select class="form-control select_two_model" name="parent_id" id="parent_id">
                                <option value="" disabled>select parent</option>
                                @foreach($destinations_tree as $parentDestination)
                                    @if($destination->id !== $parentDestination->id)
                                        <option
                                                value="{{ $parentDestination->id }}" {{ old('parent_id', $destination->parent_id) === $parentDestination->id ? 'selected' : '' }}>{{ strtoupper($parentDestination->title) }}</option>
                                        @foreach($parentDestination->children as $childDestination)
                                            @if($destination->id !== $childDestination->id)
                                                <option
                                                        value="{{ $childDestination->id }}" {{ old('parent_id', $destination->parent_id) === $childDestination->id ? 'selected' : '' }}>
                                                    &nbsp; &nbsp; &#8227; &nbsp; {{ ucfirst($childDestination->title) }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" col="6" :req="true" label="Title" id="title" name="title" value="{{$destination->title}}"/>
                        <x-form.input type="text" col="6" :req="true" label="Slug" id="slug" name="slug" value="{{$destination->slug}}"/>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="file" :tooltip="true" tooltip_text="Upload less than 1 MB" col="6" :req="true" label="Image" id="image" name="image" accept="image/*" onchange="previewThumb(this,'image-thumb')"/>
                        <x-form.input type="text" col="6" label="Image Caption" id="image_caption" name="image_caption" value="{{$destination->image_caption}}"/>
                    </x-form.row>

                    <x-form.single_preview id="image-thumb" url="{{$destination->image_path}}"/>

                    <x-form.row>
                        <x-form.select label="Destination Category" col="6" :req="true" :model="$destination->destination_category_id" :options="$destinationCategories"
                                       name="destination_category_id"></x-form.select>
                        <x-form.select label="Country" :req="true" col="6" :model="$destination->country" :options="$countries" name="country"></x-form.select>
                    </x-form.row>

                    <x-form.row>
                        <div class="col-md-6" id="parent_select">
                            <label for="activities" class="col-form-label">Activities <span class="text-danger text-small">*</span></label>
                            <select class="form-control select_two_activities" name="activities[]" id="activities" multiple>
                                @foreach($activities as $activity)
                                    <option
                                            value="{{ $activity->id }}" {{ in_array($activity->id, old('activities', [])) || $destination->activities->contains($activity->id)? 'selected' : '' }}>
                                        {{ $activity->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-form.select label="Featured" col="6" :model="$destination->is_featured" :options="[1 => 'Yes', 0 => 'No']" name="is_featured"></x-form.select>
                    </x-form.row>


                    <x-form.textarea label="Description" id="description" name="description" value="{!! $destination->description  !!}" rows="5" cols="5"/>

                    <x-form.row>
                        <x-form.input type="number" col="6" label="Longitude" id="longitude" name="longitude" value="{{$destination->longitude}}"/>
                        <x-form.input type="number" col="6" label="Latitude" id="latitude" name="latitude" value="{{$destination->latitude}}"/>
                    </x-form.row>
                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes"
                                     :isChecked="$destination->status ? 'checked' : ''"/>


                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

                <div style="max-width:100%;" class="row mt-3 mb-3 me-3 ms-3 justify-content-center">
                    <div class="col">
                        <input type="text" class="form-control mt-2" placeholder="Search The Location To Add Latitude and Longitude Above" id="search" name="search">
                    </div>
                </div>
                <div id='map'></div>
                <style>
                    #map {
                        width: 100%;
                        height: 400px;
                    }
                </style>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\DestinationUpdateRequest') !!}
    @include('_helpers.slugify',['title' => 'title'])
    @include('_helpers.ck_editor', ['textarea_id' => 'description'])
    @include('_helpers.previewer_image_single',['name' => 'image'])
    @include('_helpers.parentChildSelect2', ['model' => 'Destination'])
    @include('_helpers.map_helpers.leaflet_map')
    @include('_helpers.map_helpers.search_location')

    <script>
        $(function () {
            $('.select_two_activities').select2({
                allowClear: true,
                placeholder: 'Select Activities'
            });
        });
    </script>
@endpush
