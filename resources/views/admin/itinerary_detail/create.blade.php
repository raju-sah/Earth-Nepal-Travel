@extends('layouts.master')
@section('title', 'Itinerary Detail')
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
                <a class="nav-link active">Itinerary Detail</a>
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

                <form id="itinerary-detail-form">
                    <x-form.row>
                        <div class="col-md-3">
                            <label for="icon" class="col-form-label">Icon <span class="text-danger">*</span></label>
                            <select id="icon" name="icon" class="icon form-control">
                                <option value="" disabled selected>Select Icon</option>
                                @foreach($icons as $icon)
                                    <option value="{{$icon->image}}" data-image="{{asset('uploaded-images/icon-images/'.$icon->image)}}">{{$icon->name}}</option>
                                @endforeach
                            </select>
                            <img id="selected-image" src="" alt="Selected Icon" height="30px" width="30px" style="display: none;">
                        </div>

                        <div class="col-md-3">
                            <label for="itinerary_id" class="col-form-label">Itinerary <span class="text-danger">*</span></label>
                            <select id="itinerary_id" name="itinerary_id" class="itinerary_id itinerary-detail form-control">
                                <option value="" disabled selected>Select Itinerary</option>
                                @foreach($itineraries as $itinerary)
                                    <option value="{{$itinerary->id}}">Day {{$itinerary->day}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="duration_unit" class="col-form-label">Duration Unit <span class="text-danger">*</span></label>
                            <select id="duration_unit" name="duration_unit" class="duration_unit form-control">
                                <option value="" disabled selected>Select Duration Unit</option>
                                @foreach($duration_units as $duration_unit)
                                    <option value="{{$duration_unit->value}}">{{$duration_unit->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-form.input type="number" min="1" col="3" :req="true" label="Duration Value" id="duration_value" name="duration_value"
                                      value="{{ old('duration_value') }}"/>

                    </x-form.row>

                    <x-form.textarea label="Description" id="description" name="description" rows="2" cols="2" :req="true"/>

                    <div class="d-flex justify-content-between" style="margin-top: -8px;">
                        <x-form.button id="add-to-table" class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                        <x-form.button id="reset-table" class="btn btn-sm btn-primary"><i class='bx bx-reset bx-xs'></i> Reset</x-form.button>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <i class='bx bx-sm bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="Drag and Drop to Reorder Itineraries Details"
                       style="font-size: 30px;"></i>
                    <button class="btn btn-sm btn-danger bulk-delete" id="bulk-delete"><i class="bx bx-trash"></i> Bulk Delete</button>
                </div>
                <table id="itinerary-details-table" class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Order</th>
                        <th>Day</th>
                        <th>Icon</th>
                        <th>Duration</th>
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
            padding: 1rem 1.25rem 0.5rem 1.25rem;
        }
    </style>
@endpush

@push('custom_js')

    <script>
        let storeRoute = "{{ route('admin.packages.itinerary-details.store', $package->id) }}";
        let updateRoute = "{{ route('admin.packages.itinerary-details.update', ['package' => $package->id, 'itinerary_detail' => ':id'])}}";
        let deleteRoute = "{{route('admin.packages.itinerary-details.destroy', ['package' => $package->id, 'itinerary_detail' => ':id'])}}";
        let bulkDeleteRoute = "{{route('admin.packages.itinerary-details.bulk-delete', ['package' => $package->id, 'itinerary_detail' => ':id'])}}";
        let rowReorderRoute = "{{route('admin.packages.itinerary-details.row-reorder', $package->id)}}";
    </script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\IconRequest') !!}

    @include('_helpers.single_page_table_ajax', ['formId' => '#itinerary-detail-form'])
    @include('_helpers.row_reorder')

    <script>
        $(document).on('change', '.icon', function () {
            let selectedImage = $(this).find(':selected').data('image');
            $(this).next('img').attr('src', selectedImage).show();
        });

        $(document).ready(function () {
            //--------------------------------------------------- Global Variables
            const form = $('#itinerary-detail-form');

            let isEditing = false;
            let editingModelId;

            fetchItineraryDetail();

            //--------------------------------------------------- Modes that gets triggered from single_page_table_ajax
            $(document).on('fetchEvent', function (event, response) {
                event.preventDefault();
                let tableBody = $('#itinerary-details-table tbody');
                let detail = response.detail_data;

                let row = '<tr class="row1" data-id="' + detail.id + '">' +
                    '<td><input type="checkbox" class="itinerary-checkbox" data-itinerary-id="' + detail.id + '"></td>' +
                    '<td>' + detail.order + '</td>' +
                    '<td>' + detail.itinerary.day + '</td>' +
                    '<td><img src="{{ asset('uploaded-images/icon-images/') }}' + '/' + detail.icon + '" alt="Icon" height="30px" width="30px"></td>' +
                    '<td>' + detail.duration_value + ' ' + detail.duration_unit + '</td>' +
                    '<td><button class="btn btn-sm edit-itinerary-detail" data-itinerary-detail-id="' + detail.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                    '<td><button class="btn btn-sm delete-itinerary-detail" data-itinerary-detail-id="' + detail.id + '"><i class="bx bx-trash"></i></button></td>' +
                    '</tr>';
                tableBody.append(row);
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
                let tableBody = $('#itinerary-details-table tbody');

                $.each(response.data, function (index, id) {
                    tableBody.find('tr[data-id="' + id + '"]').remove();
                });
            });


            $(document).on('deleteEvent', function (event, response) {
                event.preventDefault();
                let itineraryId = response.deleted_data_id;
                $('#itinerary-details-table tbody').find('tr[data-id="' + itineraryId + '"]').remove();
            });

            $(document).on('updateEvent', function (event, response) {
                let detail = response.update_data;

                $('#itinerary-details-table tbody').find('tr[data-id="' + detail.id + '"]').replaceWith(function () {
                    return '<tr class="row1" data-id="' + detail.id + '">' +
                        '<td><input type="checkbox" class="itinerary-checkbox" data-itinerary-id="' + detail.id + '"></td>' +
                        '<td>' + detail.order + '</td>' +
                        '<td>' + detail.itinerary.day + '</td>' +
                        '<td><img src="{{ asset('uploaded-images/icon-images/') }}' + '/' + detail.icon + '" alt="Icon" height="30px" width="30px"></td>' +
                        '<td>' + detail.duration_value + ' ' + detail.duration_unit + '</td>' +
                        '<td><button class="btn btn-sm edit-itinerary-detail" data-itinerary-detail-id="' + detail.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                        '<td><button class="btn btn-sm delete-itinerary-detail" data-itinerary-detail-id="' + detail.id + '"><i class="bx bx-trash"></i></button></td>' +
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

            $('#itinerary-details-table').on('click', '.edit-itinerary-detail', function () {
                let itineraryDetailId = $(this).data('itinerary-detail-id');
                editingModelId = itineraryDetailId;
                editItineraryDetail(itineraryDetailId);
                $('html, body').animate({scrollTop: 0}, 'fast');
                $('input:visible:enabled:first').focus();
            });

            $(document).on('click', ".delete-itinerary-detail", function () {
                let itineraryDetailId = $(this).data('itinerary-detail-id');
                deleteData(itineraryDetailId);
            });

            $(document).on('click', "#reset-table", function (e) {
                e.preventDefault();
                resetForm();
                isEditing = false;
            });

            //--------------------------------------------------- Fetching the itineraries

            function fetchItineraryDetail() {
                $.ajax({
                    url: "{{route('admin.packages.itinerary-details.index', $package->id)}}",
                    type: 'GET',
                    success: function (response) {
                        let tableBody = $('#itinerary-details-table tbody');
                        tableBody.empty();
                        $.each(response.itinerary_details, function (index, detail) {
                            let row = '<tr class="row1" data-id="' + detail.id + '">' +
                                '<td><input type="checkbox" class="itinerary-checkbox" data-itinerary-id="' + detail.id + '"></td>' +
                                '<td>' + detail.order + '</td>' +
                                '<td>' + detail.itinerary.day + '</td>' +
                                '<td><img src="{{ asset('uploaded-images/icon-images/') }}' + '/' + detail.icon + '" alt="Icon" height="30px" width="30px"></td>' +
                                '<td>' + detail.duration_value + ' ' + detail.duration_unit + '</td>' +
                                '<td><button class="btn btn-sm edit-itinerary-detail" data-itinerary-detail-id="' + detail.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                                '<td><button class="btn btn-sm delete-itinerary-detail" data-itinerary-detail-id="' + detail.id + '"><i class="bx bx-trash"></i></button></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    }
                });
            }

            //--------------------------------------------------- Fills the edit form
            function editItineraryDetail(itineraryDetailId) {
                console.log(itineraryDetailId)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.packages.itinerary-details.edit', ['package' => $package->id, 'itinerary_detail' => ':id']) }}".replace(':id', itineraryDetailId),
                    type: 'GET',
                    success: function (response) {
                        isEditing = true;
                        $('#description').val(response.itinerary_detail.description);
                        $('#duration_value').val(response.itinerary_detail.duration_value);

                        let durationDropdown = $('.duration_unit');
                        durationDropdown.val(response.itinerary_detail.duration_unit).change();

                        let iconDropdown = $('.icon');
                        iconDropdown.val(response.itinerary_detail.icon).change();

                        let itiDropdown = $('.itinerary-detail');
                        itiDropdown.val(response.itinerary_detail.itinerary_id).change();

                        $('#selected-image').attr('src', iconDropdown.find(':selected').data('image')).show();
                        $('#itinerary-detail-form').attr('action', "{{ route('admin.packages.itinerary-details.update', ['package' => $package->id, 'itinerary_detail' => ':id']) }}".replace(':id', itineraryDetailId));
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endpush
