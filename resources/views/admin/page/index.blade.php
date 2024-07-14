@extends('layouts.master')

@section('content')

<div class="container-xxl">

  <x-breadcrumb model="Page"></x-breadcrumb>

  <div class="card">

    <div class="card-body">

      <div class="d-flex justify-content-end">
        <a href="{{route('admin.pages.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
      </div>

      <div class="table-responsive no-wrap">
        <table class="table" id="datatable">

          <x-table.header :headers="['name','slug','status', 'Actions']" />

          <tbody id="tablecontents">
            @forelse ($pages as $page)
            <tr>
              <td>{{$loop->iteration}}</td>

              <x-table.td>{{$page->name}}</x-table.td>

              <x-table.td>{{$page->slug}}</x-table.td>

              <x-table.switch :model="$page" />

              <td style="width:150px">
                <div class="actions d-flex">
                  <x-table.view_btn route-view="{{route('admin.pages.show', ':id')}}" id="{{$page->id}}" model="Page" name="page" />

                  <x-table.edit_btn route-edit="{{route('admin.pages.edit', $page->id) }}" />

                  <x-table.delete_btn route-destroy="{{route('admin.pages.destroy', $page->id ) }}" />
                </div>
              </td>
            </tr>

            <x-table.show_modal id="{{$page->id}}" model="Page" />

            @empty
            @endforelse

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

@push('custom_js')
@include('_helpers.modal_script',['name' => 'page', 'route' => route('admin.pages.show', ':id')])
@include('_helpers.datatable')
@include('_helpers.status_change', ['url' => url('admin/status-change-page')])
@include('_helpers.swal_delete')
@endpush