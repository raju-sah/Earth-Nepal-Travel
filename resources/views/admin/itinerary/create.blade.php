@extends('layouts.master')
@section('title', 'Itinerary')
@section('content')

    <div class="container-xxl">

        <ul class="nav nav-pills nav-fill mb-3">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('admin.packages.edit', $package->id)}}">Package</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active">Itinerary</a>
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
                <a class="nav-link" href="{{route('admin.packages.essential-infos.create', $package->id)}}">Essential Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.equipment.create', $package->id)}}">Equipments</a>
            </li>
        </ul>

        <div class="card">
            <div class="card-body">

                @include('common_blade.icon_modal')
                <span class="ms-3">
            <x-modal.import-excel download_path="/excel/itineraries-sample.xlsx" route="{{route('admin.packages.itineraries.import-excel')}}"/>
            </span>
                @include('_helpers.excel_import_error')

                <form id="itinerary-form">
                    <x-form.row>
                        <div class="col-md-4">
                            <label for="icon" class="col-form-label">Icon <span class="text-danger">*</span></label>
                            <select id="icon" name="icon" class="icon form-control">
                                <option value="" disabled selected>Select Icon</option>
                                @foreach($icons as $icon)
                                    <option value="{{$icon->image}}" data-image="{{asset('uploaded-images/icon-images/'.$icon->image)}}">{{$icon->name}}</option>
                                @endforeach
                            </select>
                            <img id="selected-image" src="" alt="Selected Icon" height="30px" width="30px" style="display: none;">
                        </div>
                        <x-form.input col="6" :req="true" type="text" label="Title" id="title" name="title" value="{{ old('title') }}"/>
                        <x-form.input col="2" :req="true" min="0" type="number" label="Day" id="day" name="day" value="{{ old('day') }}"/>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" col="3" label="Max Altitude (in Meters)" id="max_altitude" name="max_altitude" value="{{ old('max_altitude') }}"/>
                        <x-form.input type="text" col="3" label="Meals" id="meals" name="meals" value="{{ old('meals') }}"/>
                        <x-form.input type="text" col="3" label="Accommodation" id="accommodation" name="accommodation" value="{{ old('accommodation') }}"/>
                        <x-form.input type="text" col="3" label="Transportation" id="transportation" name="transportation" value="{{ old('transportation') }}"/>
                    </x-form.row>

                    <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" rows="2" cols="2"/>

                    <div class="d-flex justify-content-between" style="margin-top: -8px;">
                        <x-form.button id="add-to-table" class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                        <x-form.button id="reset-table" class="btn btn-sm btn-primary"><i class='bx bx-reset bx-xs'></i> Reset</x-form.button>
                    </div>
                </form>
            </div>


            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <i class='bx bx-sm bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="Drag and Drop to Reorder Itineraries"
                       style="font-size: 30px;"></i>
                    <button class="btn btn-sm btn-danger bulk-delete" id="bulk-delete"><i class="bx bx-trash"></i> Bulk Delete</button>
                </div>
                <table id="itinerary-table" class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Order</th>
                        <th>Day</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody id="tablecontents">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('custom_css')
    <style>
        .card-body {
            padding: 0.75rem 1.25rem 0.25rem 1.25rem;
        }
    </style>
@endpush

@push('custom_js')
    <script>
        let storeRoute = "{{ route('admin.packages.itineraries.store', $package->id) }}";
        let updateRoute = "{{ route('admin.packages.itineraries.update', ['package' => $package->id, 'itinerary' => ':id'])}}";
        let deleteRoute = "{{route('admin.packages.itineraries.destroy', ['package' => $package->id, 'itinerary' => ':id'])}}";
        let bulkDeleteRoute = "{{ route('admin.packages.itineraries.bulk-delete', ['package' => $package->id, 'itinerary' => ':id']) }}";
        let rowReorderRoute = "{{route('admin.packages.itineraries.row-reorder', $package->id)}}";
    </script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\IconRequest', '#icon-form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ImportExcelRequest', '#excel-import-form') !!}

    @include('_helpers.single_page_table_ajax', ['formId' => '#itinerary-form'])
    @include('_helpers.row_reorder')


    <script>
        $(document).on('change', '.icon', function () {
            let selectedImage = $(this).find(':selected').data('image');
            $(this).next('img').attr('src', selectedImage).show();
        });

        $(document).ready(function () {
            //--------------------------------------------------- Global Variables
            const form = $('#itinerary-form');

            let isEditing = false;
            let editingModelId;

            fetchItineraries();

            //--------------------------------------------------- Modes that gets triggered from single_page_table_ajax
            $(document).on('fetchEvent', function (event, response) {
                let itinerary = response.data;

                let row = '<tr class="row1" data-id="' + itinerary.id + '">' +
                    '<td><input type="checkbox" class="itinerary-checkbox" data-itinerary-id="' + itinerary.id + '"></td>' +
                    '<td>' + itinerary.order + '</td>' +
                    '<td>' + itinerary.day + '</td>' +
                    '<td><img src="{{ asset('uploaded-images/icon-images/') }}' + '/' + itinerary.icon + '" alt="Icon" height="30px" width="30px"></td>' +
                    '<td>' + itinerary.title + '</td>' +
                    '<td><button class="btn btn-sm edit-itinerary" data-itinerary-id="' + itinerary.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                    '<td><button class="btn btn-sm  delete-itinerary"  data-itinerary-id="' + itinerary.id + '"  ><i class="bx bx-trash"></i></button></td>' +
                    '</tr>';

                $('#itinerary-table tbody').append(row);
                $('#day').val(parseInt(itinerary.day) + 1);
            });

            $(document).on('click', '.bulk-delete', function () {
                let checkedItineraryIds = [];
                $('.itinerary-checkbox:checked').each(function () {
                    checkedItineraryIds.push($(this).data('itinerary-id'));
                });

                if (checkedItineraryIds.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            bulkDelete(checkedItineraryIds);
                            checkedItineraryIds = [];
                        }
                    });
                } else {
                    swalMessage('error', 'Please select at least one itinerary');
                }
            });

            $(document).on('bulkDeleteEvent', function (event, response) {
                event.preventDefault();
                let tableBody = $('#itinerary-table tbody');

                $.each(response.data, function (index, id) {
                    tableBody.find('tr[data-id="' + id + '"]').remove();
                });
            });

            $(document).on('deleteEvent', function (event, response) {
                event.preventDefault();
                let itineraryId = response.deleted_data_id;
                $('#itinerary-table tbody').find('tr[data-id="' + itineraryId + '"]').remove();
            });

            $(document).on('updateEvent', function (event, response) {
                let tableBody = $('#itinerary-table tbody');
                let itinerary = response.update_data;

                tableBody.find('tr[data-id="' + itinerary.id + '"]').replaceWith(function () {
                    return '<tr data-id="' + itinerary.id + '">' +
                        '<td><input type="checkbox" class="itinerary-checkbox" data-itinerary-id="' + itinerary.id + '"></td>' +
                        '<td>' + itinerary.order + '</td>' +
                        '<td>' + itinerary.day + '</td>' +
                        '<td><img src="{{ asset('uploaded-images/icon-images/') }}' + '/' + itinerary.icon + '" alt="Icon" height="30px" width="30px"></td>' +
                        '<td>' + itinerary.title + '</td>' +
                        '<td><button class="btn btn-sm edit-itinerary" data-itinerary-id="' + itinerary.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                        '<td><button class="btn btn-sm  delete-itinerary"  data-itinerary-id="' + itinerary.id + '"  ><i class="bx bx-trash"></i></button></td>' +
                        '</tr>';
                });
            });

            $(document).on('disableEditing', function () {
                isEditing = false;
            });

            //--------------------------------------------------- Click methods for the form
            $('#add-to-table').on('click', function (e) {
                e.preventDefault();
                if (isEditing) {
                    updateData(editingModelId);
                } else {
                    saveData();
                }
            });

            $('#itinerary-table').on('click', '.edit-itinerary', function () {
                let itineraryId = $(this).data('itinerary-id');
                editingModelId = itineraryId;
                editItinerary(itineraryId);
                $('html, body').animate({scrollTop: 0}, 'fast');
                $('input:visible:enabled:first').focus();
            });

            $(document).on('click', ".delete-itinerary", function () {
                let itineraryId = $(this).data('itinerary-id');
                deleteData(itineraryId);
            });

            $(document).on('click', "#reset-table", function (e) {
                e.preventDefault();
                resetForm();
                isEditing = false;
            });

            //--------------------------------------------------- Fetching the itineraries
            function fetchItineraries() {
                $.ajax({
                    url: "{{route('admin.packages.itineraries.index', $package->id)}}",
                    type: 'GET',
                    success: function (response) {
                        let tableBody = $('#itinerary-table tbody');
                        tableBody.empty();
                        $.each(response.itineraries, function (index, itinerary) {
                            let row = '<tr class="row1" data-id="' + itinerary.id + '">' +
                                '<td><input type="checkbox" class="itinerary-checkbox" data-itinerary-id="' + itinerary.id + '"></td>' +
                                '<td>' + itinerary.order + '</td>' +
                                '<td>' + itinerary.day + '</td>' +
                                '<td><img src="{{ asset('uploaded-images/icon-images/') }}' + '/' + itinerary.icon + '" alt="Icon" height="30px" width="30px"></td>' +
                                '<td>' + itinerary.title + '</td>' +
                                '<td><button class="btn btn-sm edit-itinerary" data-itinerary-id="' + itinerary.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                                '<td><button class="btn btn-sm  delete-itinerary" data-itinerary-id="' + itinerary.id + '"><i class="bx bx-trash"></i></button></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    }
                });
            }

            //--------------------------------------------------- Fills the edit form
            function editItinerary(itineraryId) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.packages.itineraries.edit', ['package' => $package->id, 'itinerary' => ':id']) }}".replace(':id', itineraryId),
                    type: 'GET',
                    success: function (response) {
                        isEditing = true;
                        $('#day').val(response.itinerary.day);
                        $('#title').val(response.itinerary.title);
                        $('#max_altitude').val(response.itinerary.max_altitude);
                        $('#meals').val(response.itinerary.meals);
                        $('#accommodation').val(response.itinerary.accommodation);
                        $('#transportation').val(response.itinerary.transportation);
                        $('#description').val(response.itinerary.description);
                        let iconDropdown = $('.icon');
                        iconDropdown.val(response.itinerary.icon).change();
                        $('#selected-image').attr('src', iconDropdown.find(':selected').data('image')).show();
                        $('#itinerary-form').attr('action', "{{ route('admin.packages.itineraries.update', ['package' => $package->id, 'itinerary' => ':id']) }}".replace(':id', itineraryId));
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endpush
