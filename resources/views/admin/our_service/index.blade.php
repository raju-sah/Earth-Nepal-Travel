@extends('layouts.master')
@section('title', 'Our Service')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="OurService"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.our-services.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['page_title','banner_image','image','content_title','description', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($our_services as $our_service)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$our_service->page_title}}</x-table.td>
                        
                        <x-table.td>{{$our_service->banner_image}}</x-table.td>
                        
                        <x-table.table_image name="{{$our_service->image }}" url="{{$our_service->image_path }}"/><x-table.td>{{$our_service->content_title}}</x-table.td>
                        
                        <x-table.td>{{$our_service->description}}</x-table.td>
                        
                        

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.our-services.show', ':id')}}" id="{{$our_service->id}}" model="OurService" name="our_service"/>

                                <x-table.edit_btn route-edit="{{route('admin.our-services.edit', $our_service->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.our-services.destroy', $our_service->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$our_service->id}}" model="OurService" />

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
    @include('_helpers.modal_script',['name' => 'our_service', 'route' => route('admin.our-services.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
