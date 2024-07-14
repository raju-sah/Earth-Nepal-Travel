@extends('layouts.master')
@section('title', 'Edit Equipment')
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
                <a class="nav-link" href="{{route('admin.packages.include-excludes.create', $package->id)}}">Include Exclude</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.packages-gallery.create', $package->id)}}">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.package-faqs.create', $package->id)}}">FAQ's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.essential-infos.create', $package->id)}}">Essential Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active">Equipments</a>
            </li>
        </ul>

        @include('_helpers.errors')

        <div class="card">
            <div class="card-body">

                @include('common_blade.icon_modal')

                <x-form.wrapper action="{{route('admin.packages.equipment.update',$package->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')

                    @foreach($package->equipments as $index => $equipment)
                        <div class="form-control my-2">
                            <x-form.row>
                                <div class="col-md-6">
                                    <label for="icon" class="col-form-label">Icon <span class="text-danger">*</span></label>
                                    <select name="icon[]" class="icon form-control" required>
                                        <option value="" disabled selected>Select Icon</option>
                                        @foreach($icons as $icon)
                                            <option value="{{$icon->image}}" data-image="{{asset('uploaded-images/icon-images/'.$icon->image)}}"
                                                    @if($equipment->icon === $icon->image) selected @endif
                                            >{{$icon->name}}</option>
                                        @endforeach
                                    </select>
                                    <img id="selected-image" src="{{asset('uploaded-images/icon-images/'.$equipment->icon)}}" alt="Selected Icon" height="50px" width="50px">
                                </div>

                                <x-form.input col="6" type="text" label="Title" name="title[]" value="{{$equipment->title}}" :req="true" required/>
                            </x-form.row>

                            <x-form.textarea label="Description" name="description[]" rows="3" cols="3" value="{{$equipment->description}}"/>

                            <button class="btn btn-danger btn-sm mt-2 js-remove--field-row delete-repeating-item" data-item-id="{{$equipment->id}}"><i class='bx bx-xs bx-x'></i>
                            </button>
                        </div>
                    @endforeach

                    <div id="form-variations-list"></div>

                    <div class="btn-wrapper text-end position-relative">
                        <x-form.button class="btn btn-sm btn-dark position-absolute top-0 end-0" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                    </div>

                    <div class="d-flex">
                        <button class="btn btn-primary mb-2 btn-sm js-add--field-row mt-3"><i class='bx bx-xs bx-plus'></i> Add Field</button>
                    </div>

                    <template id="template-form">
                        <div class="form-control" id="template-input-field">
                            <x-form.row>
                                <div class="col-md-6">
                                    <label for="icon" class="col-form-label">Icon <span class="text-danger">*</span></label>
                                    <select name="icon[]" class="form-control icon" required>
                                        <option value="" disabled selected>Select Icon</option>
                                        @foreach($icons as $icon)
                                            <option value="{{$icon->image}}" data-image="{{asset('uploaded-images/icon-images/'.$icon->image)}}">{{$icon->name}}</option>
                                        @endforeach
                                    </select>
                                    <img id="selected-image" src="" alt="Selected Icon" height="50px" width="50px" style="display: none;">
                                </div>

                                <x-form.input col="6" type="text" label="Title" name="title[]" :req="true" required/>
                            </x-form.row>
                            <x-form.textarea label="Description" name="description[]" rows="3" cols="3"/>

                        </div>
                    </template>

                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\IconRequest') !!}
    @include('_helpers.repeater')
    @include('_helpers.delete_repeating_item', ['model' => 'Equipment'])
    @include('_helpers.previewer_image_single',['name' => 'image'])

    <script>
        $(document).on('change', '.icon', function () {
            let selectedImage = $(this).find(':selected').data('image');
            $(this).next('img').attr('src', selectedImage).show();
        });
    </script>
@endpush
