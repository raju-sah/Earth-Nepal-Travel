@extends('layouts.master')
@section('title', 'Activity')
@section('content')

<div class="container-xxl">

    <x-breadcrumb model="Activity"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-end">
                <a href="{{route('admin.activities.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
            </div>

            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">

                    <x-table.header :headers="['title', 'slug', 'is exclusive', 'status', 'Actions']" />

                    <tbody id="tablecontents">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom_js')
@include('_helpers.modal_script',['name' => 'activity', 'route' => route('admin.activities.show', ':id')])
@include('_helpers.yajra',['url' => route("admin.activities.index"), 'columns' => $columns])
@include('_helpers.status_change', ['url' => url('admin/status-change-activity')])
@include('_helpers.swal_delete')
@endpush
