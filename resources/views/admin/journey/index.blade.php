@extends('layouts.master')

@section('content')

<div class="container-xxl">

     <x-breadcrumb model="Package Type"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.journeys.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['name','slug', 'type','status', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($journeys as $journey)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$journey->name}}</x-table.td>
                        
                        <x-table.td>{{$journey->slug}}</x-table.td>
                                                
                        <x-table.td>{{ucfirst($journey->type)}}</x-table.td>
                        
                        <x-table.switch :model="$journey" />

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.journeys.show', ':id')}}" id="{{$journey->id}}" model="Journey" name="journey"/>

                                <x-table.edit_btn route-edit="{{route('admin.journeys.edit', $journey->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.journeys.destroy', $journey->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$journey->id}}" model="Journey" />

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
    @include('_helpers.modal_script',['name' => 'journey', 'route' => route('admin.journeys.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-journey')])
    @include('_helpers.swal_delete')
@endpush
