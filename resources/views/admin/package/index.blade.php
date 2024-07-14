@extends('layouts.master')
@section('title', 'Package')
@section('content')

<div class="container-xxl">

    <x-breadcrumb model="Package"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">

                <x-modal.import-excel download_path="/excel/packages-sample.xlsx" route="{{route('admin.packages.import-excel')}}" />

                <div class=" col-md-6 d-flex justify-content-start mb-3 ">
                    <select id="package_type" class="form-select">
                        <option value="" >Select</option>
                        @foreach(\App\Enums\JourneyType::cases() as $journey)
                        <option value="{{ $journey->value }}">{{ $journey->name }}</option>
                        @endforeach
                    </select>
                </div>

                <a href="{{route('admin.packages.create')}}" class="btn btn-sm btn-dark" style="height: 38px; line-height: 28px;"><i class='bx bx-xs bx-plus'> </i>Create</a>
            </div>

            @include('_helpers.excel_import_error')

            <div class="table-responsive no-wrap">

                <table class="table" id="datatable">

                    <x-table.header :headers="['title','slug', 'package type', 'status', 'Actions']" />

                    <tbody id="tablecontents"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom_css')
<style>
    .btn-outline-primary {
        height: 38px;
    }
</style>
@endpush

@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\ImportExcelRequest') !!}
@include('_helpers.modal_script',['name' => 'package', 'route' => route('admin.packages.show', ':id')])
@include('_helpers.status_change', ['url' => url('admin/status-change-package')])
@include('_helpers.swal_delete')

<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'throw';

        var table = $('#datatable').DataTable({
            data: {
                "_token": "{{ csrf_token() }}"
            },
            deferRender: true,
            responsive: true,
            pageLength: 10,
            pagingType: "full_numbers",
            lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, 'All']
            ],
            searchDelay: 600,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.packages.index') }}",
                data: function(d) {
                    d.package_type = $('#package_type').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'journey_type',
                    name: 'journey_type'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });

        $('#package_type').change(function() {
            table.draw();
        });
    });
</script>
@endpush