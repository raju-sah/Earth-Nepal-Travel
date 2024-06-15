@extends('layouts.master')
@section('title', 'Contact Us')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="ContactUs"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.contact-uses.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['page_title','banner_image','content_title','description','image', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($contact_uses as $contact_us)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$contact_us->page_title}}</x-table.td>
                        
                        <x-table.td>{{$contact_us->banner_image}}</x-table.td>
                        
                        <x-table.td>{{$contact_us->content_title}}</x-table.td>
                        
                        <x-table.td>{{$contact_us->description}}</x-table.td>
                        
                        <x-table.table_image name="{{$contact_us->image }}" url="{{$contact_us->image_path }}"/>

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.contact-uses.show', ':id')}}" id="{{$contact_us->id}}" model="ContactUs" name="contact_us"/>

                                <x-table.edit_btn route-edit="{{route('admin.contact-uses.edit', $contact_us->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.contact-uses.destroy', $contact_us->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$contact_us->id}}" model="ContactUs" />

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
    @include('_helpers.modal_script',['name' => 'contact_us', 'route' => route('admin.contact-uses.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
