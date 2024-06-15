@extends('layouts.master')
@section('title', 'Edit Essential Info')
@section('content')

    <div class="container-xxl">

        <ul class="nav nav-pills nav-fill mb-3">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('admin.packages.edit', $package->id)}}">Package</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.itineraries.create', $package->id)}}">Itinerary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.itinerary-details.create', $package->id)}}">Itinerary Detail</a>
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
                <a class="nav-link active">Essential Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.equipment.create', $package->id)}}">Equipments</a>
            </li>
        </ul>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.packages.essential-infos.update', [$package->id,$essential_info->id])}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')

                    <label for="banner_image_input" class="col-form-label"> Image</label>
                    <input type="file" class="form-control text-14" id="banner_image_input" name="image" alt="image" accept="image/*"/>
                    @error('image') <span class="text-danger small">{{ $message }}</span> @enderror

                    <div class="banner-thumb mt-3"
                         style="width: 150px; aspect-ratio: 4/3; position: relative;"
                         id="banner_image">
                        <img src="{{$essential_info->image_path}}" alt="title" class="w-100 card-img">
                        <button type="button" id="deleteImageBtn"
                                class="btn btn-xs btn-danger position-absolute top-0 end-0 position-relative">
                            <i class='bx bx-x bx-xs bx-tada-hover'></i>
                        </button>
                    </div>

                    <x-form.textarea label="Essential Info" :req="true" id="info" name="info" value="{!! $essential_info->info  !!}" rows="5" cols="5"/>

                    <div class="d-flex justify-content-between">
                        <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                        <button class="btn btn-danger btn-sm mt-3 delete-repeating-item" data-item-id="{{$essential_info->id}}"><i class='bx bx-xs bx-trash'></i>Delete</button>
                    </div>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EssentialInfoUpdateRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
    @include('_helpers.ck_editor', ['textarea_id' => 'info'])
    <script>
        document.getElementById("banner_image_input").addEventListener("change", function () {
            previewBannerImage(this, 'banner_image');
        });

        function previewBannerImage(el, _target_el) {
            const target_el = document.getElementById(_target_el);
            const img_url = URL.createObjectURL(el.files[0]);
            target_el.children[0].setAttribute("src", img_url);
            target_el.style.display = "block";
        }

        document.getElementById("deleteImageBtn").addEventListener("click", deleteImage);

        function deleteImage() {
            $.ajax({
                url: "{{route('admin.delete-single-image')}}",
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    model: "EssentialInfo",
                    image_name: "{{$essential_info->image ?? null}}",
                    folder: "package-essential-info-images",
                    id: "{{$essential_info->id}}"
                },
                success: function (response) {
                    const input_el = document.getElementById('banner_image_input');
                    const target_el = document.getElementById("banner_image");

                    input_el.value = "";
                    target_el.style.display = "none";
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        $(document).ready(function () {
            $('.delete-repeating-item').on('click', function (e) {
                e.preventDefault();

                let essentialInfoId = $(this).data('item-id');
                let packageId = "{{ $package->id }}";
                const url = `/admin/packages/${packageId}/essential-infos/${essentialInfoId}`;

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: essentialInfoId,
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            })
        });

    </script>
@endpush
