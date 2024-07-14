@extends('layouts.master')
@section('title', 'Include Exclude')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="IncludeExclude"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.include-excludes.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['includes','excludes', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($include_excludes as $include_exclude)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$include_exclude->includes}}</x-table.td>
                        
                        <x-table.td>{{$include_exclude->excludes}}</x-table.td>
                        
                        

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.include-excludes.show', ':id')}}" id="{{$include_exclude->id}}" model="IncludeExclude" name="include_exclude"/>

                                <x-table.edit_btn route-edit="{{route('admin.include-excludes.edit', $include_exclude->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.include-excludes.destroy', $include_exclude->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$include_exclude->id}}" model="IncludeExclude" />

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
    @include('_helpers.modal_script',['name' => 'include_exclude', 'route' => route('admin.include-excludes.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
