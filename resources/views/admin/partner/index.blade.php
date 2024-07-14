@extends('layouts.master')

@section('content')

<div class="container-xxl">

    <x-breadcrumb model="Partner"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-end">
                <a href="{{route('admin.partners.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
            </div>

            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">

                    <x-table.header :headers="['name','image', 'type','status','Actions']" />

                    <tbody id="tablecontents"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom_js')
@include('_helpers.modal_script',['name' => 'partner', 'route' => route('admin.partners.show', ':id')])
@include('_helpers.yajra',['url' => route("admin.partners.index"), 'columns' => $columns])
@include('_helpers.status_change', ['url' => url('admin/status-change-partner')])

@include('_helpers.swal_delete')
@endpush