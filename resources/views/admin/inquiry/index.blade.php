@extends('layouts.master')
@section('title', 'Inquiry')
@section('content')
<div class="container-xxl">

    <x-breadcrumb model="Inquiry"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

            @include('common_blade.status_notice_text_modal')

            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">

                    <x-table.header :headers="['name', 'email', 'type', 'phone', 'created at', 'status', 'Actions']" />

                    <tbody id="tablecontents"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
@include('_helpers.modal_script', ['name' => 'inquiry','route' => route('admin.inquiries.show', ':id'),])
@include('_helpers.swal_delete')
@include('_helpers.dropdown_status_change', ['options' => App\Enums\StatusType::toSelectArray(),'route' => route('admin.inquiry-update-status', ':id'),])
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
                url: "{{ route('admin.inquiries.index') }}",
                data: function(d) {
                    d.contact_type = $('#contact_type').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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

        $('#contact_type').change(function() {
            table.draw();
        });
    });
</script>

@endpush