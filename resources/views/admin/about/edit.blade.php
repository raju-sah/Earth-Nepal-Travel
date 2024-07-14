@extends('layouts.master')
@section('title', 'Edit About')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Update About Us"></x-breadcrumb>

        <div class="card">
            <div class="card-body">
                @include('common_blade.icon_modal')

                <x-form.wrapper action="{{route('admin.abouts.update', $about->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <label for="banner_image_input" class="col-form-label">Banner Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control text-14" id="banner_image_input" name="banner_image" accept="image/*"/>
                    @error('image') <span class="text-danger small">{{ $message }}</span> @enderror

                    <div class="banner-thumb mt-3" style="width: 150px; aspect-ratio: 4/3; position: relative;" id="banner_image">
                        <img src="{{$about->banner_path}}" alt="title" class="w-100 card-img">
                        <button type="button" id="resetBannerBtn" class="btn btn-xs btn-danger position-absolute top-0 end-0 position-relative">
                            <i class='bx bx-x bx-xs bx-tada-hover'></i>
                        </button>
                    </div>

                    <x-form.input type="text" label="Page_title" id="page_title" name="page_title" value="{{$about->page_title}}"/>
                    <x-form.input type="file" label="Extra Image" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb" url="{{$about->image_path}}"/>
                    <x-form.input type="text" label="Content_title" id="content_title" name="content_title" value="{{$about->content_title}}"/>
                    <x-form.textarea label="Description" id="description" name="description" value="{!! $about->description !!}" rows="5" cols="5"/>
                    <span class="btn btn-sm btn-success js-add--field-row" style="margin-top: 34px;"><i class="bx bx-plus"></i>Add</span>

                    @php
                        $iconTitles = json_decode($about->icon_title);
                    @endphp

                    @foreach ($iconTitles->icon as $key => $value)
                        <div class="input-container   d-flex mt-3">
                            <div class="col-md-4">
                                <label for="icon" class="col-form-label">Icon <span class="text-danger">*</span></label>
                                <select id="icon" name="icon[]" required class="icon form-control">
                                    <option value="" disabled selected>Select Icon</option>
                                    @foreach($icons as $icon)
                                        <option value="{{ $icon->image }}"
                                                data-image="{{ asset('uploaded-images/icon-images/'.$icon->image) }}" {{ $value === $icon->image ? 'selected' : '' }}>
                                            {{ $icon->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <img id="selected-image" src="{{ asset('uploaded-images/icon-images/'.$iconTitles->icon[$key]) }}" alt="Selected Icon" style="display: block;"
                                     height="50px" width="50px">
                            </div>
                            <input type="text" name="title[]" required value="{{ $iconTitles->title[$key] ?? '' }}" class="form-control ms-2 me-2" style="height: 38.95px;
  margin-top: 34px;" placeholder="Enter name">
                            <button class="btn btn-danger btn-sm js-remove--field-row" style="height: 38.95px;
  margin-top: 34px;"><i class="bx bx-xs bx-x" style="display: inline-block;"></i></button>
                        </div>
                    @endforeach

                    <div id="form-variations-list"></div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

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
                        <input type="text" name="title[]" class="form-control ms-2 me-2" placeholder="Enter name" style="margin-top: 34px;">
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
