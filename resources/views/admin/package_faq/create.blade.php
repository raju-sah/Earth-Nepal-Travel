@extends('layouts.master')
@section('title', 'Create Package FAQ')
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
                <a class="nav-link active">FAQ's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.essential-infos.create', $package->id)}}">Essential Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.packages.equipment.create', $package->id)}}">Equipments</a>
            </li>
        </ul>

        @include('_helpers.errors')

        <div class="card">
            <div class="card-body">

                <x-form.wrapper id="package-faq-common-faqs" action="{{route('admin.packages.package-faq.store-common-faqs', $package->id)}}" method="POST">
                    <div class="col-md-12">
                        <label for="common_faqs" class="col-form-label">Common Faqs</label>
                        <select id="common_faqs" name="common_faqs[]" class="common_faqs form-control" multiple>
                            @foreach($common_faqs as $key => $common_faq)
                                <option
                                    value="{{ $key }}" {{ in_array($key, old('common_faqs', []), true) || $package->common_faqs->contains($key)? 'selected' : '' }}>{{$common_faq}}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>Save</x-form.button>

                </x-form.wrapper>

                <x-form.wrapper id="package-faq-form" action="{{route('admin.packages.package_faqs.store', $package->id)}}" method="POST">

                    <div class="form-control my-2">
                        <x-form.input type="text" label="Question" name="question" value="{{ old('question.${count}') }}" :req="true" required/>
                        <x-form.textarea label="Answer" name="answer" value="{{ old('answer.${count}') }}" rows="3" cols="3" :req="true" required/>
                        <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'"/>
                    </div>

                    <div id="form-variations-list"></div>

                    <div class="d-flex justify-content-between" style="margin-top: -15px;">
                        <x-form.button id="add-to-table" class="btn btn-sm btn-dark save-itinerary" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                        <x-form.button id="reset-table" class="btn btn-sm btn-primary"><i class='bx bx-reset bx-xs'></i> Reset</x-form.button>
                    </div>
                </x-form.wrapper>
            </div>

            <div class="card-body">
                <div class="d-flex mt-3 justify-content-between">
                    <i class='bx bx-sm bxs-info-circle' data-bs-toggle="tooltip" data-bs-placement="right" title="Drag and Drop to Reorder FAQs" style="font-size: 30px;"></i>
                    <button class="btn btn-sm btn-danger bulk-delete" id="bulk-delete"><i class="bx bx-trash"></i> Bulk Delete</button>
                </div>
                <table id="package-table" class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Order</th>
                        <th>Question</th>
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
            padding: 0 1.25rem 0.25rem 1.25rem;
        }
    </style>
@endpush

@push('custom_js')
    <script>
        let storeRoute = "{{ route('admin.packages.package_faqs.store', $package->id) }}";
        let updateRoute = "{{ route('admin.packages.package_faqs.update', ['package' => $package->id, 'package_faq' => ':id'])}}";
        let deleteRoute = "{{route('admin.packages.package_faqs.destroy', ['package' => $package->id, 'package_faq' => ':id'])}}";
        let bulkDeleteRoute = "{{route('admin.packages.package_faqs.bulk-delete', ['package' => $package->id, 'package_faq' => ':id'])}}";
        let rowReorderRoute = "{{route('admin.packages.package_faq.row-reorder', $package->id)}}";
    </script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\PackageFaqRequest') !!}

    @include('_helpers.single_page_table_ajax', ['formId' => '#package-faq-form'])
    @include('_helpers.row_reorder')

    <script>
        $(document).on('change', '.icon', function () {
            let selectedImage = $(this).find(':selected').data('image');
            $(this).next('img').attr('src', selectedImage).show();
        });

        $(document).ready(function () {

            $(function () {
                $('.common_faqs').select2({
                    placeholder: 'Select Common Faqs',
                    tags: false
                });
            });

            //--------------------------------------------------- Global Variables
            const form = $('#package-faq-form');

            let isEditing = false;
            let editingModelId;

            fetchPackageFaqs();

            //--------------------------------------------------- Modes that gets triggered from single_page_table_ajax
            $(document).on('fetchEvent', function (event, response) {
                let tableBody = $('#package-table tbody');
                let package = response.data;

                let row = '<tr class="row1" data-id="' + package.id + '">' +
                    '<td><input type="checkbox" class="package-checkbox" data-package-id="' + package.id + '"></td>' +
                    '<td>' + package.order + '</td>' +
                    '<td>' + package.question + '</td>' +
                    '<td><button class="btn btn-sm edit-package" data-package-id="' + package.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                    '<td><button class="btn btn-sm  delete-package" data-package-id="' + package.id + '"><i class="bx bx-trash"></i></button></td>' +
                    '</tr>';
                tableBody.append(row);
            });

            $(document).on('click', '.bulk-delete', function () {
                let checkedpackageIds = [];
                $('.package-checkbox:checked').each(function () {
                    checkedpackageIds.push($(this).data('package-id'));
                });

                if (checkedpackageIds.length > 0) {
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
                            bulkDelete(checkedpackageIds);
                            checkedpackageIds = [];
                        }
                    });
                } else {
                    swalMessage('error', 'Please select at least one faq');
                }
            });

            $(document).on('bulkDeleteEvent', function (event, response) {
                event.preventDefault();
                let tableBody = $('#package-table tbody');

                $.each(response.data, function (index, id) {
                    tableBody.find('tr[data-id="' + id + '"]').remove();
                });
            });

            $(document).on('deleteEvent', function (event, response) {
                event.preventDefault();
                let packageId = response.deleted_data_id;
                let tableBody = $('#package-table tbody');
                tableBody.find('tr[data-id="' + packageId + '"]').remove();
            });

            $(document).on('updateEvent', function (event, response) {
                let package = response.update_data;

                $('#package-table tbody').find('tr[data-id="' + package.id + '"]').replaceWith(function () {
                    return '<tr class="row1" data-id="' + package.id + '">' +
                        '<td><input type="checkbox" class="package-checkbox" data-package-id="' + package.id + '"></td>' +
                        '<td>' + package.order + '</td>' +
                        '<td>' + package.question + '</td>' +
                        '<td><button class="btn btn-sm edit-package" data-package-id="' + package.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                        '<td><button class="btn btn-sm  delete-package" data-package-id="' + package.id + '"><i class="bx bx-trash"></i></button></td>' +
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

            $('#package-table').on('click', '.edit-package', function () {
                let packageId = $(this).data('package-id');
                editingModelId = packageId;
                editPackageFaq(packageId);
                $('html, body').animate({scrollTop: 0}, 'fast');
                $('#package-faq-form input:visible:enabled:first').focus();
            });

            $(document).on('click', ".delete-package", function () {
                let packageId = $(this).data('package-id');
                deleteData(packageId);
            });

            $(document).on('click', "#reset-table", function (e) {
                e.preventDefault();
                resetForm();
                isEditing = false;
            });

            //--------------------------------------------------- Fetching the itineraries
            function fetchPackageFaqs() {
                $.ajax({
                    url: "{{route('admin.packages.package_faqs.index', $package->id)}}",
                    type: 'GET',
                    success: function (response) {
                        let tableBody = $('#package-table tbody');
                        tableBody.empty();
                        $.each(response.package_faq, function (index, package) {
                            let row = '<tr class="row1" data-id="' + package.id + '">' +
                                '<td><input type="checkbox" class="package-checkbox" data-package-id="' + package.id + '"></td>' +
                                '<td>' + package.order + '</td>' +
                                '<td>' + package.question + '</td>' +
                                '<td><button class="btn btn-sm edit-package" data-package-id="' + package.id + '"><i class="bx bx-edit-alt"></i></button></td>' +
                                '<td><button class="btn btn-sm  delete-package" data-package-id="' + package.id + '"><i class="bx bx-trash"></i></button></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    }
                });
            }

            //--------------------------------------------------- Fills the edit form
            function editPackageFaq(packageId) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.packages.package_faqs.edit', ['package' => $package->id, 'package_faq' => ':id']) }}".replace(':id', packageId),
                    type: 'GET',
                    success: function (response) {
                        isEditing = true;
                        $('#question').val(response.package_faq.question);
                        $('#answer').val(response.package_faq.answer);
                        $('#package-faq-form').attr('action', "{{ route('admin.packages.package_faqs.update', ['package' => $package->id, 'package_faq' => ':id']) }}".replace(':id', packageId));
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endpush
