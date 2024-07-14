@extends('layouts.master')
@section('title', 'Package Report Filters')
@section('content')

<div class="container-xxl">

    <x-breadcrumb model="Package Filters"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

            <form id="filter_form" class="mb-4" method="GET">
                <x-form.row>
                    <x-form.enum-select id="common_filter" col="3" :option-display="false" :options="App\Enums\CommonFilterType::cases()" name="common_filter" required />

                    <div class="col-md-4 d-flex align-items-end mb-4 mt-4">
                        <x-datepicker id="date_range"/>
                    </div>
                    <div class=" col-md-2 mt-4 ">
                        <select id="asc_desc_filter" class="form-select">
                            @foreach(\App\Enums\AscDescType::cases() as $ascDesc)
                            <option value="{{ $ascDesc->value }}">{{ $ascDesc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-2">
                        <x-form.button class="btn btn-sm btn-info w-50 " style="height: 35px;" type="submit"><i class='bx bx-xs bx-filter-alt'></i> Filter</x-form.button>
                    </div>
                </x-form.row>
            </form>

            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">
                    <x-table.header :headers="['title','slug','package type', 'views','Avg Rating','Inquiries','Created at', 'Report']" />
                    <tbody id="tablecontents"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom_js')
@include('_helpers.modal_script',['name' => 'package', 'route' => route('admin.packages.show', ':id')])
@include('_helpers.status_change', ['url' => url('admin/status-change-package')])
@include('_helpers.swal_delete')
@include('_helpers.datepicker')

<script>
    $(document).ready(function() {
        initializeDatepicker('date_range');

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
                url: "{{ route('admin.package-reports.filters') }}",

                data: function(d) {
                    d.common_filter = $('#common_filter').val();
                    d.asc_desc_filter = $('#asc_desc_filter').val();
                    d.from_date = $('#from_date_date_range').val()
                    d.to_date = $('#to_date_date_range').val()
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
                    data: 'view_count',
                    name: 'view_count'
                },
                {
                    data: 'avg_rating',
                    name: 'avg_rating'
                },
                {
                    data: 'inquiries',
                    name: 'inquiries'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'report_button',
                    name: 'report_button'
                },


            ],
        });

        $('#filter_form').on('submit', function(e) {
            e.preventDefault();
            table.draw();
        });
    });
</script>

@endpush
