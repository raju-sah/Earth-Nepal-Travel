@extends('layouts.master')
@section('title', 'Itinerary')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="Itinerary"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.itineraries.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['title','slug','day','description','max_altitude','meals','accommodation','transportation','order', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($itineraries as $itinerary)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$itinerary->title}}</x-table.td>
                        
                        <x-table.td>{{$itinerary->slug}}</x-table.td>
                        
                        <x-table.td>{{$itinerary->day}}</x-table.td>
                        
                        <x-table.td>{{$itinerary->description}}</x-table.td>
                        
                        <x-table.td>{{$itinerary->max_altitude}}</x-table.td>
                        
                        <x-table.td>{{$itinerary->meals}}</x-table.td>
                        
                        <x-table.td>{{$itinerary->accommodation}}</x-table.td>
                        
                        <x-table.td>{{$itinerary->transportation}}</x-table.td>
                        
                        <x-table.td>{{$itinerary->order}}</x-table.td>
                        
                        

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.itineraries.show', ':id')}}" id="{{$itinerary->id}}" model="Itinerary" name="itinerary"/>

                                <x-table.edit_btn route-edit="{{route('admin.itineraries.edit', $itinerary->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.itineraries.destroy', $itinerary->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$itinerary->id}}" model="Itinerary" />

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
    @include('_helpers.modal_script',['name' => 'itinerary', 'route' => route('admin.itineraries.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
