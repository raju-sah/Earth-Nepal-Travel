@extends('layouts.master')
@section('title', 'Edit Package')
@push('custom_css')
<style>
    iframe {
        width: 400px;
        height: 200px;
    }
</style>
@endpush

@section('content')

<div class="container-xxl">
    <ul class="nav nav-pills nav-fill mb-3">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="javascript:void(0)">Package</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{route('admin.packages.itineraries.create', $package->id)}}>Itinerary</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{route('admin.packages.itinerary-details.create', $package->id)}}>Itinerary Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.packages.include-excludes.create', $package->id)}}">Include Exclude</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.packages.packages-gallery.create', $package->id)}}">Gallery</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.packages.package_faqs.create', $package->id)}}">FAQ's</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.packages.essential-infos.create', $package->id)}}">Essential Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.packages.equipment.create', $package->id)}}">Equipments</a>
        </li>
    </ul>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.packages.update', $package->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')

                <label for="banner_image_input" class="col-form-label">Banner Image <span class="text-danger">*</span>
                    <i class='bx bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="Upload less than 1 MB" style="font-size: 15px;"></i>
                </label>
                <input type="file" class="form-control text-14" id="banner_image_input" name="image" alt="image" accept="image/*" />
                @error('image') <span class="text-danger small">{{ $message }}</span> @enderror

                <div class="banner-thumb mt-3" style="width: 150px; aspect-ratio: 4/3; position: relative;" id="banner_image">
                    <img src="{{$package->banner_path}}" alt="title" class="w-100 card-img">
                    <button type="button" id="resetBannerBtn" class="btn btn-xs btn-danger position-absolute top-0 end-0 position-relative">
                        <i class='bx bx-x bx-xs bx-tada-hover'></i>
                    </button>
                </div>

                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Title" id="title" name="title" value="{{$package->title}}" />
                    <x-form.input type="text" col="6" :req="true" label="Slug" id="slug" name="slug" value="{{$package->slug}}" />
                </x-form.row>

                <x-form.row>
                    <div class="col-md-6">
                        <label for="journey_type" class="col-form-label">Journey Type</label>
                        <select class="form-select" id="journey_type" name="journey_type">
                            <option value="">Select</option>
                            @foreach(App\Enums\JourneyType::cases() as $jytype)
                            <option value="{{ $jytype->value }}" @if($package->journey_type == $jytype->value) selected @endif>
                                {{ $jytype->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="journey_type_childs" class="col-form-label">Journey Childs</label>
                        <select class="form-select mt-4 select_two_journey" id="journey_type_childs" multiple name="journey_type_childs[]">
                            @if(isset($package->journey_type))
                            @foreach($journies as $key => $value)
                            <option value="{{ $key }}" @if(in_array($key, $journey_type_childs ? $journey_type_childs : [])) selected @endif>
                                {{ $value }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </x-form.row>

                <x-form.row>
                    <x-form.enum-select label="Duration Type" :req="true" col="3" :model="$package->duration_type" :options="\App\Enums\DurationType::cases()" name="duration_type"></x-form.enum-select>
                    <x-form.input type="number" :req="true" col="3" label="Total Duration" id="duration_value" name="duration_value" value="{{ $package->duration_value }}" />

                    <div class="col-md-3">
                        <label for="difficulty_level_icon" class="col-form-label">Difficulty Icon<span class="text-danger">*</span></label>
                        <select id="difficulty_level_icon" name="difficulty_level_icon" class="form-control form-control">
                            <option value="" disabled="" selected="">Select Icon</option>
                            <option value="beginner.svg" data-image="{{asset('assets/img/difficultyLevels/beginner.svg')}}" {{$package->difficulty_level_icon === 'beginner.svg' ? 'selected' : ''}}>
                                Beginner Icon
                            </option>
                            <option value="easy.svg" data-image="{{asset('assets/img/difficultyLevels/easy.svg')}}" {{$package->difficulty_level_icon === 'easy.svg' ? 'selected' : ''}}>Easy
                                Icon
                            </option>
                            <option value="intermediate.svg" data-image="{{asset('assets/img/difficultyLevels/intermediate.svg')}}" {{$package->difficulty_level_icon === 'intermediate.svg' ? 'selected' : ''}}>
                                Intermediate Icon
                            </option>
                            <option value="difficult.svg" data-image="{{asset('assets/img/difficultyLevels/difficult.svg')}}" {{$package->difficulty_level_icon === 'difficult.svg' ? 'selected' : ''}}>
                                Difficult Icon
                            </option>
                            <option value="extreme.svg" data-image="{{asset('assets/img/difficultyLevels/extreme.svg')}}" {{$package->difficulty_level_icon === 'extreme.svg' ? 'selected' : ''}}>
                                Extreme Icon
                            </option>
                        </select>
                        <img id="selected-image" src="{{ asset('assets/img/difficultyLevels/' . $package->difficulty_level_icon) }}" alt="Selected Icon" height="50px" width="50px">
                    </div>

                    <x-form.enum-select :req="true" col="3" label="Difficulty Level" :model="$package->difficulty_level" :options="\App\Enums\DifficultyLevelType::cases()" name="difficulty_level"></x-form.enum-select>

                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" :req="true" col="3" label="Starting Location" id="starting_location" name="starting_location" value="{{ $package->starting_location }}" />
                    <x-form.input type="text" :req="true" col="3" label="Ending Location" id="ending_location" name="ending_location" value="{{ $package->ending_location }}" />

                    <x-form.input type="number" min="1" :req="true" col="3" label="Min Age" id="min_age" name="min_age" value="{{ $package->min_age }}" />
                    <x-form.input type="number" min="1" :req="true" col="3" label="Max Age" id="max_age" name="max_age" value="{{ $package->max_age }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" :req="true" placeholder="Enter Price Range. Ex: $1000-$2000" col="6" label="price range" id="price" name="price" value="{{ $package->price }}" />
                    <x-form.input type="number" min="1" col="3" label="Max Altitude (In Meters)" id="max_altitude" name="max_altitude" value="{{ $package->max_altitude }}" />
                    <x-form.enum-select col="3" label="Highlight" :model="$package->highlight" :options="\App\Enums\PackageHighlightType::cases()" name="highlight"></x-form.enum-select>
                </x-form.row>

                <x-form.row>
                    <div class="col-md-6" id="parent_select">
                        <label for="activities" class="col-form-label">Activities <span class="text-danger text-small">*</span></label>
                        <select class="form-control select_two_activities" name="activities[]" id="activities" multiple>
                            @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}" {{ in_array($activity->id, old('activities', []), true) || $package->activities->contains($activity->id) ? 'selected' : '' }}>
                                @if ($activity->parentActivity)
                                @if ($activity->parentActivity->parentActivity)
                                {{ $activity->parentActivity->parentActivity->title }} /
                                @endif
                                {{ $activity->parentActivity->title }} /
                                @endif
                                {{ $activity->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6" id="parent_select">
                        <label for="destinations" class="col-form-label">Destinations <span class="text-danger text-small">*</span></label>
                        <select class="form-control select_two_destinations" name="destinations[]" id="destinations" multiple>
                            @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ in_array($destination->id, old('destinations', []), true) || $package->destinations->contains($destination->id) ? 'selected' : '' }}>
                                @if ($destination->parentDestination)
                                @if ($destination->parentDestination->parentDestination)
                                {{ $destination->parentDestination->parentDestination->title }} /
                                @endif
                                {{ $destination->parentDestination->title }} /
                                @endif
                                {{ $destination->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                </x-form.row>

                <x-form.row>
                    <x-form.input type="file" col="6" label="Road Map Image" :tooltip="true" tooltip_text="Upload less than 1MB" id="road_map" name="road_map" alt="road_map" accept="image/*" onchange="previewThumb(this,'road_map-thumb')" />
                    <x-form.textarea col="6" label="Iframe" id="iframe" name="iframe" value="{{ $package->iframe }}" rows="2" cols="2" />
                </x-form.row>
                <div class="d-flex justify-content-between mt-3">
                    <x-form.single_preview id="road_map-thumb" url="{{$package->image_path}}" />
                    <div class="col-md-6  ms-5" id="map_view">
                        {!! $package->iframe ? $package->iframe : '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56516.27776835177!2d85.28493282484301!3d27.709030242098493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198a307baabf%3A0xb5137c1bf18db1ea!2sKathmandu%2044600!5e0!3m2!1sen!2snp!4v1716543860150!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                    </div>
                </div>
                <x-form.row>
                    <div class="col-md-6" id="parent_select">
                        <label for="seasons" class="col-form-label">Seasons <span class="text-danger text-small">*</span></label>
                        <select class="form-control select_two_seasons" name="seasons[]" id="seasons" multiple>
                            @foreach($seasons as $season)
                            <option value="{{ $season->id }}" {{ in_array($season->id, old('activities', []), true) || $package->seasons->contains($season->id)? 'selected' : '' }}>{{ $season->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6" id="parent_select">
                        <label for="services" class="col-form-label">Services <span class="text-danger text-small">*</span></label>
                        <select class="form-control select_two_services" name="services[]" id="services" multiple>
                            @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ in_array($service->id, old('services', [])) || $package->services->contains($service->id)? 'selected' : '' }}>
                                {{ $service->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </x-form.row>
                <x-form.textarea label="Overview" :req="true" id="overview" name="overview" value="{!! $package->overview !!}" rows="5" cols="5" />

                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$package->status ? 'checked' : ''" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>

@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\PackageUpdateRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
@include('_helpers.previewer_image_single',['name' => 'road_map'])
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.ck_editor', ['textarea_id' => 'overview'])
@include('_helpers.banner_image_helper')



<script>
    $(document).ready(function() {

        $('.select_two_seasons').select2({
            allowClear: true,
            placeholder: 'Select Seasons'
        });
        $('.select_two_journey').select2({
            allowClear: true,
            placeholder: 'Select Package Sub Type'
        });
        $('.select_two_activities').select2({
            allowClear: true,
            placeholder: 'Select Services'
        });
        $('.select_two_destinations').select2({
            allowClear: true,
            placeholder: 'Select Services'
        });
        $('.select_two_services').select2({
            allowClear: true,
            placeholder: 'Select Services'
        });
        $('#difficulty_level_icon').change(function() {
            let selectedImage = $(this).find(':selected').data('image');
            $('#selected-image').attr('src', selectedImage).show();
        });

        // Function to populate journey_type_childs dropdown
        function populateJourneyTypeChilds(journeyType) {
            if (journeyType) {
                $.ajax({
                    url: 'get-edit-journey/' + journeyType,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var selectedChilds = @json($journey_type_childs) || []; // Ensure selectedChilds is an array
                        $('#journey_type_childs').empty();
                        $.each(data, function(key, value) {
                            var isSelected = selectedChilds.includes(key.toString()) ? 'selected' : '';
                            $('#journey_type_childs').append('<option value="' + key + '" ' + isSelected + '>' + value + '</option>');
                        });
                        $('#journey_type_childs').trigger('change'); // Ensure Select2 updates
                    },
                    error: function() {
                        console.error('Error fetching journey childs data');
                    }
                });
            } else {
                $('#journey_type_childs').empty();
            }
        }

        // Initial population on page load
        var initialJourneyType = $('#journey_type').val();
        if (initialJourneyType) {
            populateJourneyTypeChilds(initialJourneyType);
        }

        // Populate journey_type_childs dropdown on journey_type change
        $('#journey_type').change(function() {
            var journeyType = $(this).val();
            populateJourneyTypeChilds(journeyType);
        });

        // map preview
        $('#iframe').on('input', function() {
            var iframeURL = $(this).val();
            $('#map_view').html(iframeURL);
        });
    });
</script>

@endpush