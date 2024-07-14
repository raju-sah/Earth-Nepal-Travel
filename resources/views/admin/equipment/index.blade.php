@extends('layouts.master')
@section('title', 'Equipment')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="Equipment"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.equipment.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['title','icon','description','package_id', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($equipment as $equipment)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$equipment->title}}</x-table.td>
                        
                        <x-table.td>{{$equipment->icon}}</x-table.td>
                        
                        <x-table.td>{{$equipment->description}}</x-table.td>
                        
                        <x-table.td>{{$equipment->package_id}}</x-table.td>
                        
                        

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.equipment.show', ':id')}}" id="{{$equipment->id}}" model="Equipment" name="equipment"/>

                                <x-table.edit_btn route-edit="{{route('admin.equipment.edit', $equipment->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.equipment.destroy', $equipment->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$equipment->id}}" model="Equipment" />

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
    @include('_helpers.modal_script',['name' => 'equipment', 'route' => route('admin.equipment.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
