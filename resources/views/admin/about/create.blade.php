@extends('layouts.master')
@section('title', 'Create About')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Create About"></x-breadcrumb>

        <div class="card">
            <div class="card-body">
                @include('common_blade.icon_modal')

                <x-form.wrapper action="{{route('admin.abouts.store')}}" method="POST" enctype="multipart/form-data">

                    <label for="banner_image_input" class="col-form-label">Banner Image <span class="text-danger">*</span><i class='bx bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="Upload less than 1 MB" style="font-size: 15px;"></i></label>
                    <input type="file" class="form-control text-14" id="banner_image_input" name="banner_image" accept="image/*"/>
                    @error('banner_image') <span class="text-danger small">{{ $message }}</span> @enderror

                    <div class="banner-thumb mt-3" style="display: none; width: 150px; aspect-ratio: 4/3; position: relative;" id="banner_image">
                        <img src="" alt="title" class="w-100 card-img">
                        <button type="button" id="resetBannerBtn" class="btn btn-xs btn-danger position-absolute top-0 end-0 position-relative">
                            <i class='bx bx-x bx-xs bx-tada-hover'></i>
                        </button>
                    </div>

                    <x-form.input type="text" label="Page Title" :req="true" id="page_title" name="page_title" value="{{ old('page_title') }}"/>
                    <x-form.input type="file" label="Extra Image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb"/>
                    <x-form.input type="text" label="Content Title" :req="true" id="content_title" name="content_title" value="{{ old('content_title') }}"/>
                    <x-form.textarea label="Description" :req="true" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5"/>

                    <div class="input-container d-flex mt-3">
                        <div class="col-md-4">
                            <label for="icon" class="col-form-label">Icon <span class="text-danger">*</span></label>
                            <select id="icon" name="icon[]" required class="icon form-control">
                                <option value="" disabled selected>Select Icon</option>
                                @foreach($icons as $icon)
                                    <option value="{{$icon->image}}" data-image="{{asset('uploaded-images/icon-images/'.$icon->image)}}">{{$icon->name}}</option>
                                @endforeach
                            </select>
                            <img id="selected-image" src="" alt="Selected Icon" height="50px" width="50px" style="display: none;">
                        </div>
                        <input type="text" name="title[]" required class="form-control ms-2 me-2" placeholder="Enter name" style="height: 38.95px;
  margin-top: 34px;" placeholder="Enter name">
                        <span class="  rajuspan btn btn-success js-add--field-row" style="margin-top: 34px; height: 38.95px;"><i class="bx bx-plus">Add</i></span>

                    </div>
                    <div id="form-variations-list"></div>


                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
                <br>
                <template id="template-form">
                    <div class="input-container d-flex mt-3">
                        <div class="col-md-4">
                            <label for="icon" class="col-form-label">Icon <span class="text-danger">*</span></label>
                            <select id="icon" name="icon[]" class="icon form-control">
                                <option value="" disabled selected>Select Icon</option>
                                @foreach($icons as $icon)
                                    <option value="{{$icon->image}}" data-image="{{asset('uploaded-images/icon-images/'.$icon->image)}}">{{$icon->name}}</option>
                                @endforeach
                            </select>
                            <img id="selected-image" src="" alt="Selected Icon" height="50px" width="50px" style="display: none;">
                        </div>
                        <input type="text" name="title[]" class="form-control ms-2 me-2" placeholder="Enter name" style="height: 38.95px;
  margin-top: 34px;">
                    </div>
                </template>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    @include('_helpers.previewer_image_single',['name' => 'image'])
    @include('_helpers.ck_editor', ['textarea_id' => 'description'])
    @include('_helpers.banner_image_helper')
    @include('_helpers.repeater')


    <script>
        $(document).on('change', '.icon', function () {
            let selectedImage = $(this).find(':selected').data('image');
            $(this).next('img').attr('src', selectedImage).show();
        });
    </script>
@endpush
