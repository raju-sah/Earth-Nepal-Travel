@extends('layouts.master')
@section('title', 'Itinerary Detail')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="ItineraryDetail"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.itinerary-details.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['icon','duration_value','duration_unit','order','package_id','itinerary_id', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($itinerary_details as $itinerary_detail)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$itinerary_detail->icon}}</x-table.td>
                        
                        <x-table.td>{{$itinerary_detail->duration_value}}</x-table.td>
                        
                        <x-table.td>{{$itinerary_detail->duration_unit}}</x-table.td>
                        
                        <x-table.td>{{$itinerary_detail->order}}</x-table.td>
                        
                        <x-table.td>{{$itinerary_detail->package_id}}</x-table.td>
                        
                        <x-table.td>{{$itinerary_detail->itinerary_id}}</x-table.td>
                        
                        

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.itinerary-details.show', ':id')}}" id="{{$itinerary_detail->id}}" model="ItineraryDetail" name="itinerary_detail"/>

                                <x-table.edit_btn route-edit="{{route('admin.itinerary-details.edit', $itinerary_detail->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.itinerary-details.destroy', $itinerary_detail->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$itinerary_detail->id}}" model="ItineraryDetail" />

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
    @include('_helpers.modal_script',['name' => 'itinerary_detail', 'route' => route('admin.itinerary-details.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
