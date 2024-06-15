@extends('layouts.master')
@section('title', 'Icon')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="Icon"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.icons.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['name','image', 'Actions']" />

             <tbody id="tablecontents"></tbody>
          </table>
          </div>
        </div>
    </div>
</div>

@endsection

@push('custom_js')
    @include('_helpers.modal_script',['name' => 'icon', 'route' => route('admin.icons.show', ':id')])
    @include('_helpers.yajra',['url' => route("admin.icons.index"), 'columns' => $columns])
    @include('_helpers.swal_delete')
@endpush
