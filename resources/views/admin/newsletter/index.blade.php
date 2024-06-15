@extends('layouts.master')
@section('title', 'News Letter')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="NewsLetter"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['email', 'Actions']" />

                        <tbody id="tablecontents">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    @include('_helpers.yajra',['url' => route("admin.newsletters.index"), 'columns' => $columns])
    @include('_helpers.swal_delete')
@endpush
