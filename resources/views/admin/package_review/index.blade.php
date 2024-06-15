@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Package Review"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['full name','email', 'rating', 'package name','status', 'Actions']"/>

                        <tbody id="tablecontents"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    @include('_helpers.modal_script',['name' => 'packagereview', 'route' => route('admin.package-reviews.show', ':id')])
    @include('_helpers.yajra',['url' => route('admin.package-reviews.index'), 'columns' => $columns])
    @include('_helpers.swal_delete')
    @include('_helpers.status_change', ['url' => url('admin/status-change-package_review')])
@endpush
