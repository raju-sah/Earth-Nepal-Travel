@extends('layouts.master')
@section('title', 'Booking Form')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="BookingForm"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.booking-forms.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['page_title','banner_image','content_title','description','image', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($booking_forms as $booking_form)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$booking_form->page_title}}</x-table.td>
                        
                        <x-table.td>{{$booking_form->banner_image}}</x-table.td>
                        
                        <x-table.td>{{$booking_form->content_title}}</x-table.td>
                        
                        <x-table.td>{{$booking_form->description}}</x-table.td>
                        
                        <x-table.table_image name="{{$booking_form->image }}" url="{{$booking_form->image_path }}"/>

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.booking-forms.show', ':id')}}" id="{{$booking_form->id}}" model="BookingForm" name="booking_form"/>

                                <x-table.edit_btn route-edit="{{route('admin.booking-forms.edit', $booking_form->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.booking-forms.destroy', $booking_form->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$booking_form->id}}" model="BookingForm" />

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
    @include('_helpers.modal_script',['name' => 'booking_form', 'route' => route('admin.booking-forms.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
