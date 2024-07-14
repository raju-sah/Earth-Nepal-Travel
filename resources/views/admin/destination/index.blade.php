@extends('layouts.master')
@section('title', 'Destination')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Destination"></x-breadcrumb>

        <div class="card">

            <div class="card-body">


                <div class="d-flex justify-content-between mb-3">

                    <x-modal.import-excel download_path="/excel/destinations-sample.xlsx" route="{{route('admin.destinations.import-excel')}}"/>

                    @can('add-destination')
                        <a href="{{route('admin.destinations.create')}}" class="btn btn-sm btn-dark"><i class='bx bx-xs bx-plus'> </i>Create</a>
                    @endcan
                </div>
                @include('_helpers.excel_import_error')

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['title','slug', 'destination category','status','Actions']"/>

                        <tbody id="tablecontents"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ImportExcelRequest') !!}
    @include('_helpers.modal_script',['name' => 'destination', 'route' => route('admin.destinations.show', ':id')])
    @include('_helpers.yajra',['url' => route("admin.destinations.index"), 'columns' => $columns])
    @include('_helpers.status_change', ['url' => url('admin/status-change-destination')])
    @include('_helpers.swal_delete')

@endpush
