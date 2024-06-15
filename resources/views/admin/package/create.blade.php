@extends('layouts.master')
@section('title', 'Package')
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
            <a class="nav-link disabled">Itinerary</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">Itinerary Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">Include Exclude</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">Gallery</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">FAQ's</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">Essential Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled">Equipments</a>
        </li>
    </ul>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.packages.store')}}" method="POST" enctype="multipart/form-data">

                <label for="banner_image_input" class="col-form-label">Banner Image <span class="text-danger">*</span>
                    <i class='bx bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="Upload less than 1 MB" style="font-size: 15px;"></i>
                </label>
                <input type="file" class="form-control text-14" id="banner_image_input" name="image" alt="image" accept="image/*" />
                @error('image') <span class="text-danger small">{{ $message }}</span> @enderror

                <div class="banner-thumb mt-3" style="display: none; width: 150px; aspect-ratio: 4/3; position: relative;" id="banner_image">
                    <img src="" alt="title" class="w-100 card-img">
                    <button type="button" id="resetBannerBtn" class="btn btn-xs btn-danger position-absolute top-0 end-0 position-relative">
                        <i class='bx bx-x bx-xs bx-tada-hover'></i>
                    </button>
                </div>

                <x-form.row>
                    <x-form.input type="text" :req="true" col="6" label="Title" id="title" name="title" value="{{ old('title') }}" />
                    <x-form.input type="text" :req="true" col="6" label="Slug" id="slug" name="slug" value="{{ old('slug') }}" />
                </x-form.row>
                <x-form.row>
                    <div class="col-md-6">
                        <label for="journey_type" class="col-form-label">Package Type</label>
                        <select class="form-select" id="journey_type" name="journey_type">
                            <option value="">Select</option>
                            @foreach(App\Enums\JourneyType::cases() as $jtype)
                            <option value="{{ $jtype->value }}">{{ $jtype->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="journey_type_childs" class="col-form-label">Package Sub-Type</label>
                        <select class="form-select mt-4 select_two_journey" id="journey_type_childs" multiple name="journey_type_childs[]">
                        </select>
                    </div>
                </x-form.row>

                <x-form.row>
                    <x-form.enum-select :req="true" col="3" label="Duration Type" :options="\App\Enums\DurationType::cases()" name="duration_type"></x-form.enum-select>
                    <x-form.input type="number" :req="true" col="3" label="Total Duration" id="duration_value" name="duration_value" value="{{ old('duration_value') }}" />

                    <div class="col-md-3">
                        <label for="difficulty_level_icon" class="col-form-label">Difficulty Icon<span class="text-danger">*</span></label>
                        <select id="difficulty_level_icon" name="difficulty_level_icon" class="form-select">
                            <option value="" disabled="" selected="">Select Icon</option>
                            <option value="beginner.svg" data-image="{{asset('assets/img/difficultyLevels/beginner.svg')}}">Beginner Icon</option>
                            <option value="easy.svg" data-image="{{asset('assets/img/difficultyLevels/easy.svg')}}">Easy Icon</option>
                            <option value="intermediate.svg" data-image="{{asset('assets/img/difficultyLevels/intermediate.svg')}}">Intermediate Icon</option>
                            <option value="difficult.svg" data-image="{{asset('assets/img/difficultyLevels/difficult.svg')}}">Difficult Icon</option>
                            <option value="extreme.svg" data-image="{{asset('assets/img/difficultyLevels/extreme.svg')}}">Extreme Icon</option>
                        </select>
                        <img id="selected-image" src="" alt="Selected Icon" height="50px" width="50px" style="display: none;">
                    </div>

                    <x-form.enum-select :req="true" col="3" label="Difficulty Level" :options="\App\Enums\DifficultyLevelType::cases()" name="difficulty_level"></x-form.enum-select>
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" :req="true" col="3" label="Starting Location" id="starting_location" name="starting_location" value="{{ old('starting_location') }}" />
                    <x-form.input type="text" :req="true" col="3" label="Ending Location" id="ending_location" name="ending_location" value="{{ old('ending_location') }}" />
                    <x-form.input type="number" min="1" :req="true" col="3" label="Min Age" id="min_age" name="min_age" value="{{ old('min_age') }}" />
                    <x-form.input type="number" min="1" :req="true" col="3" label="Max Age" id="max_age" name="max_age" value="{{ old('max_age') }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" label="price range" id="price" name="price" value="{{ old('price') }}" placeholder="Enter Price Range.eg. $1000-$2000" />
                    <x-form.input type="number" min="1" col="3" label="Max Altitude (In Meters)" id="max_altitude" name="max_altitude" value="{{ old('max_altitude') }}" />
                    <x-form.enum-select col="3" label="Highlight" :options="\App\Enums\PackageHighlightType::cases()" name="highlight"></x-form.enum-select>
                </x-form.row>

                <x-form.row>
                    <div class="col-md-6" id="parent_select">
                        <label for="activities" class="col-form-label">Activities <span class="text-danger text-small">*</span></label>
                        <select class="form-control select_two_activities" name="activities[]" id="activities" multiple>
                            @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}" {{ old('activity_id') === $activity->id ? 'selected' : '' }}>
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
                            <option value="{{ $destination->id }}" {{ old('activity_id') === $destination->id ? 'selected' : '' }}>
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
                    <x-form.textarea col="6" label="Iframe" id="iframe" name="iframe" value="{{ old('iframe') }}" />
                </x-form.row>
                <div class="d-flex justify-content-between mt-3">
                    <x-form.single_preview col="6" id="road_map-thumb" />
                    <div class="col-md-6  ms-5" id="map_view">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56516.27776835177!2d85.28493282484301!3d27.709030242098493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198a307baabf%3A0xb5137c1bf18db1ea!2sKathmandu%2044600!5e0!3m2!1sen!2snp!4v1716463832058!5m2!1sen!2snp" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <x-form.row>
                    <x-form.select label="Best Seasons" col="6" multiple="multiple" :option-display="false" class="select_two_seasons" :req="true" :options="$seasons" name="seasons[]" />
                    <x-form.select col="6" label="Services" multiple="multiple" :option-display="false" class="select_two_services" :req="true" :options="$services" name="services[]">
                    </x-form.select>
                </x-form.row>

                <x-form.textarea label="Overview" :req="true" id="overview" name="overview" value="{{ old('overview') }}" rows="5" cols="5" />
                <br>

                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'" />

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>

        </div>
    </div>
</div>

@endsection

@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\PackageRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
@include('_helpers.ck_editor', ['textarea_id' => 'overview'])
@include('_helpers.slugify',['title' => 'title'])
@include('_helpers.previewer_image_single',['name' => 'road_map'])
@include('_helpers.banner_image_helper')

<script>
    $(document).ready(function() {
        $('.select_two_journey').select2({
            allowClear: true,
            placeholder: 'Select Journey'
        });
        $('.select_two_seasons').select2({
            allowClear: true,
            placeholder: 'Select Seasons'
        });

        $('.select_two_activities').select2({
            allowClear: true,
            placeholder: 'Select Activities'
        });

        $('.select_two_services').select2({
            allowClear: true,
            placeholder: 'Select Services'
        });

        $('.select_two_destinations').select2({
            allowClear: true,
            placeholder: 'Select Destinations'
        });

        $('#difficulty_level_icon').change(function() {
            let selectedImage = $(this).find(':selected').data('image');
            $('#selected-image').attr('src', selectedImage).show();
        });

        // dependent dropdown
        $('#journey_type').change(function() {
            var journeyType = $(this).val();
            if (journeyType) {
                $.ajax({
                    url: 'get-journey/' + journeyType,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#journey_type_childs').empty();
                        $.each(data, function(key, value) {
                            $('#journey_type_childs').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#journey_type_childs').empty();
            }
        });

        // map preview
        $('#iframe').on('input', function() {
            var iframeURL = $(this).val();
            $('#map_view').html(iframeURL);
        });

    });
</script>



@endpush