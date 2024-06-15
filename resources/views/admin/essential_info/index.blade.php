@extends('layouts.master')
@section('title', 'Essential Info')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="EssentialInfo"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.essential-infos.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['info','package_id', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($essential_infos as $essential_info)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$essential_info->info}}</x-table.td>
                        
                        <x-table.td>{{$essential_info->package_id}}</x-table.td>
                        
                        

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.essential-infos.show', ':id')}}" id="{{$essential_info->id}}" model="EssentialInfo" name="essential_info"/>

                                <x-table.edit_btn route-edit="{{route('admin.essential-infos.edit', $essential_info->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.essential-infos.destroy', $essential_info->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$essential_info->id}}" model="EssentialInfo" />

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
    @include('_helpers.modal_script',['name' => 'essential_info', 'route' => route('admin.essential-infos.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
