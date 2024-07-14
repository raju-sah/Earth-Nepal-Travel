@extends('layouts.master')
@section('title', 'Create Equipment')
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
                <span class="ms-3">
                  <x-modal.import-excel download_path="/excel/equipments-sample.xlsx" route="{{route('admin.packages.equipment.import-excel')}}"/>
                </span>
                <a class="btn btn-sm btn-dark      float-end " href="{{route('admin.packages.create')}}"><i class="bx bx-xs bx-plus"></i>Add More Package</a>


                @include('_helpers.excel_import_error')

                <form id="equipment-form">

                    <div class="form-control my-2">
                        <x-form.row>
                            <div class="col-md-6">
                                <label for="icon" class="col-form-label">Icon <span class="text-danger">*</span></label>
                                <select name="icon" class="icon form-control" required>
                                    <option value="" disabled selected>Select Icon</option>
                                    @foreach($icons as $icon)
                                        <option value="{{$icon->image}}" data-image="{{asset('uploaded-images/icon-images/'.$icon->image)}}">{{$icon->name}}</option>
                                    @endforeach
                                </select>
                                <img id="selected-image" src="" alt="Selected Icon" height="30px" width="30px" style="display: none;">
                            </div>

                            <x-form.input col="6" type="text" label="Title" name="title" :req="true" required/>
                        </x-form.row>

                        <x-form.textarea label="Description" name="description" rows="2" cols="2"/>
                    </div>

                    <div class="d-flex justify-content-between" style="margin-top: -15px;">
                        <x-form.button id="add-to-table" class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                        <x-form.button id="reset-table" class="btn btn-sm btn-primary"><i class='bx bx-reset bx-xs'></i> Reset</x-form.button>
                    </div>
                </form>

            </div>

            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <i class='bx bx-sm bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="Drag and Drop to Reorder Equipments" style="font-size: 30px;"></i>
                    <button class="btn btn-sm btn-danger bulk-delete" id="bulk-delete"><i class="bx bx-trash"></i> Bulk Delete</button>
                </div>
                <table id="equipment-table" class="table">
                    <thead>
                    <tr>
                        <th>Order</th>
                        <th>Icon</th>
                        <th>title</th>
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
            padding: 1rem 1.25rem 0.25rem 1.25rem;
        }
    </style>
@endpush

@push('custom_js')

    <script>
        let storeRoute = "{{ route('admin.packages.equipment.store', $package->id) }}";
        let updateRoute = "{{ route('admin.packages.equipment.update', ['package' => $package->id, 'equipment' => ':id'])}}";
        let deleteRoute = "{{route('admin.packages.equipment.destroy', ['package' => $package->id, 'equipment' => ':id'])}}";
        let bulkDeleteRoute = "{{route('admin.packages.equipment.bulk-delete', ['package' => $package->id, 'equipment' => ':id'])}}";
        let rowReorderRoute = "{{route('admin.packages.equipment.row-reorder', $package->id)}}";
    </script>


    {!! JsValidator::formRequest('App\Http\Requests\Admin\IconRequest', '#icon-form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ImportExcelRequest', '#excel-import-form') !!}

    @include('_helpers.previewer_image_single',['name' => 'image'])
    @include('_helpers.single_page_table_ajax', ['formId' => '#equipment-form'])
    @include('_helpers.row_reorder')
    @include('_helpers.swal_delete')

    <script>

        $(document).on('change', '.icon', function () {
            let selectedImage = $(this).find(':selected').data('image');
            $(this).next('img').attr('src', selectedImage).show();
        });

        $(document).ready(function () {
            //--------------------------------------------------- Global Variables
            const form = $('#equipment-form');

            let isEditing = false;
            let editingModelId;

            fetchItineraries();

            //--------------------------------------------------- Modes that gets triggered from single_page_table_ajax
            $(document).on('fetchEvent', function (event, response) {
                let equipment = response.data;

                let iconUrl = '{{ asset('uploaded-images/icon-images/') }}' + '/' + equipment.icon;

                let row = '<tr class="row1" data-id="' + equipment.id + '">' +
                    '<td><input type="checkbox" class="equipment-checkbox" data-equipment-id="' + equipment.id + '"></td>' +
                    '<td>' + equipment.order + '</td>' +
                    '<td><img src="' + iconUrl + '" alt="Icon" height="30px" width="30px"></td>' +
                    '<td>' + equipment.title + '</td>' +
                    '<td><button class="btn btn-sm edit-equipment" data-equipment-id="' + equipment.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                    '<td><button class="btn btn-sm  delete-equipment" data-equipment-id="' + equipment.id + '"><i class="bx bx-trash"></i></button></td>' +
                    '</tr>';
                $('#equipment-table tbody').append(row);
            });


            $(document).on('click', '.bulk-delete', function () {
                let checkedequipmentIds = [];

                $('.equipment-checkbox:checked').each(function () {
                    checkedequipmentIds.push($(this).data('equipment-id'));
                });

                if (checkedequipmentIds.length > 0) {
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
                            bulkDelete(checkedequipmentIds);
                            checkedequipmentIds = [];
                        }
                    });
                } else {
                    swalMessage('error', 'Please select at least one equipment');
                }
            });

            $(document).on('bulkDeleteEvent', function (event, response) {
                event.preventDefault();
                let tableBody = $('#equipment-table tbody');

                $.each(response.data, function (index, id) {
                    tableBody.find('tr[data-id="' + id + '"]').remove();
                });
            });

            $(document).on('deleteEvent', function (event, response) {
                event.preventDefault();
                let equipmentId = response.delete_data_id;
                $('#equipment-table tbody').find('tr[data-id="' + equipmentId + '"]').remove();
            });

            $(document).on('updateEvent', function (event, response) {
                let tableBody = $('#equipment-table tbody');
                let equipment = response.update_data;

                tableBody.find('tr[data-id="' + equipment.id + '"]').replaceWith(function () {
                    return '<tr class="row1" data-id="' + equipment.id + '">' +
                        '<td><input type="checkbox" class="equipment-checkbox" data-equipment-id="' + equipment.id + '"></td>' +
                        '<td>' + equipment.order + '</td>' +
                        '<td><img src="{{ asset('uploaded-images/icon-images/') }}' + '/' + equipment.icon + '" alt="Icon" height="30px" width="30px"></td>' +
                        '<td>' + equipment.title + '</td>' +
                        '<td><button class="btn btn-sm edit-equipment" data-equipment-id="' + equipment.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                        '<td><button class="btn btn-sm  delete-equipment" data-equipment-id="' + equipment.id + '"><i class="bx bx-trash"></i></button></td>' +
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

            $('#equipment-table').on('click', '.edit-equipment', function () {
                let equipmentId = $(this).data('equipment-id');
                editingModelId = equipmentId;
                editequipment(equipmentId);
                $('html, body').animate({scrollTop: 0}, 'fast');
                $('input:visible:enabled:first').focus();
            });

            $(document).on('click', ".delete-equipment", function () {
                let equipmentId = $(this).data('equipment-id');
                deleteData(equipmentId);
            });

            $(document).on('click', "#reset-table", function (e) {
                e.preventDefault();
                resetForm();
                isEditing = false;
            });

            //--------------------------------------------------- Fetching the itineraries
            function fetchItineraries() {
                $.ajax({
                    url: "{{route('admin.packages.equipment.index', $package->id)}}",
                    type: 'GET',
                    success: function (response) {
                        let tableBody = $('#equipment-table tbody');
                        tableBody.empty();
                        $.each(response.equipment, function (index, equipment) {
                            let row = '<tr class="row1" data-id="' + equipment.id + '">' +
                                '<td><input type="checkbox" class="equipment-checkbox" data-equipment-id="' + equipment.id + '"></td>' +
                                '<td>' + equipment.order + '</td>' +
                                '<td><img src="{{ asset('uploaded-images/icon-images/') }}' + '/' + equipment.icon + '" alt="Icon" height="30px" width="30px"></td>' +
                                '<td>' + equipment.title + '</td>' +
                                '<td><button class="btn btn-sm edit-equipment" data-equipment-id="' + equipment.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                                '<td><button class="btn btn-sm  delete-equipment" data-equipment-id="' + equipment.id + '"><i class="bx bx-trash"></i></button></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    }
                });
            }

            //--------------------------------------------------- Fills the edit form
            function editequipment(equipmentId) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.packages.equipment.edit', ['package' => $package->id, 'equipment' => ':id']) }}".replace(':id', equipmentId),
                    type: 'GET',
                    success: function (response) {
                        isEditing = true;
                        $('#title').val(response.equipment.title);
                        $('#description').val(response.equipment.description);
                        let iconDropdown = $('.icon');
                        iconDropdown.val(response.equipment.icon).change();
                        $('#selected-image').attr('src', iconDropdown.find(':selected').data('image')).show();
                        $('#equipment-form').attr('action', "{{ route('admin.packages.equipment.update', ['package' => $package->id, 'equipment' => ':id']) }}".replace(':id', equipmentId));
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endpush
