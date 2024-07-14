@extends('layouts.master')
@section('title', 'Destination Category')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Destination Category"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    @can('add-destination-category')
                        <a href="{{route('admin.destination-categories.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                    @endcan
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['title','slug', 'status', 'Actions']"/>

                        <tbody id="tablecontents"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    @include('_helpers.modal_script',['name' => 'destinationcategory', 'route' => route('admin.destination-categories.show', ':id')])
    @include('_helpers.yajra',['url' => route("admin.destination-categories.index"), 'columns' => $columns])
    @include('_helpers.status_change', ['url' => url('admin/status-change-destination_category')])
    @include('_helpers.swal_delete')
@endpush
