@extends('layouts.master')
@section('title', 'Travel Diary')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="TravelDiary"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.travel-diaries.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['title','image', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($travel_diaries as $travel_diary)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$travel_diary->title}}</x-table.td>
                        
                        <x-table.table_image name="{{$travel_diary->image }}" url="{{$travel_diary->image_path }}"/>

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.travel-diaries.show', ':id')}}" id="{{$travel_diary->id}}" model="TravelDiary" name="travel_diary"/>

                                <x-table.edit_btn route-edit="{{route('admin.travel-diaries.edit', $travel_diary->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.travel-diaries.destroy', $travel_diary->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$travel_diary->id}}" model="TravelDiary" />

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
    @include('_helpers.modal_script',['name' => 'travel_diary', 'route' => route('admin.travel-diaries.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
