@extends('layouts.master')
@section('title', 'Package FAQ')
@section('content')

<div class="container-xxl">

     <x-breadcrumb model="PackageFaq"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

          <div class="d-flex justify-content-end">
            <a href="{{route('admin.package-faqs.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
          </div>

        <div class="table-responsive no-wrap">
          <table class="table" id="datatable">

           <x-table.header :headers="['question','answer','status','package_id', 'Actions']" />

             <tbody id="tablecontents">
                @forelse ($package_faqs as $package_faq)
                    <tr>
                      <td>{{$loop->iteration}}</td>

                      <x-table.td>{{$package_faq->question}}</x-table.td>
                        
                        <x-table.td>{{$package_faq->answer}}</x-table.td>
                        
                        <x-table.switch :model="$package_faq" /><x-table.td>{{$package_faq->package_id}}</x-table.td>
                        
                        

                      <td style="width:150px">
                            <div class="actions d-flex">
                                <x-table.view_btn route-view="{{route('admin.package-faqs.show', ':id')}}" id="{{$package_faq->id}}" model="PackageFaq" name="package_faq"/>

                                <x-table.edit_btn route-edit="{{route('admin.package-faqs.edit', $package_faq->id) }}"/>

                                <x-table.delete_btn route-destroy="{{route('admin.package-faqs.destroy', $package_faq->id ) }}"/>
                            </div>
                      </td>
                    </tr>

                    <x-table.show_modal id="{{$package_faq->id}}" model="PackageFaq" />

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
    @include('_helpers.modal_script',['name' => 'package_faq', 'route' => route('admin.package-faqs.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-package_faq')])
    @include('_helpers.swal_delete')
@endpush
