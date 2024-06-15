@extends('layouts.master')

@section('title', 'About')

@section('content')

<div class="container-xxl">

     <x-breadcrumb model="About"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.abouts.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['page_title','banner_image','image','content_title','description', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($abouts as $about)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$about->page_title}}</x-table.td>
                        
                        <x-table.td>{{$about->banner_image}}</x-table.td>
                        
                        <x-table.table_image name="{{$about->image }}" url="{{$about->image_path }}"/><x-table.td>{{$about->content_title}}</x-table.td>
                        
                        <x-table.td>{{$about->description}}</x-table.td>
                        
                        

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.abouts.show', ':id')}}" id="{{$about->id}}" model="About" name="about"/>

                                <x-table.edit_btn route-edit="{{route('admin.abouts.edit', $about->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.abouts.destroy', $about->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$about->id}}" model="About" />

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
    @include('_helpers.modal_script',['name' => 'about', 'route' => route('admin.abouts.show', ':id')])
    @include('_helpers.datatable')
    
    @include('_helpers.swal_delete')
@endpush
