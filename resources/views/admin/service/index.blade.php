@extends('layouts.master')
@section('title', 'Service')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Service"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.services.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['title','slug', 'type', 'price', 'status', 'Actions']"/>

                        <tbody id="tablecontents">
                        @forelse ($services as $service)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$service->title}}</x-table.td>

                                <x-table.td>{{$service->slug}}</x-table.td>

                                <x-table.td>{{$service->type}}</x-table.td>

                                <x-table.td>{{$service->price}} / {{$service->rate_type}}</x-table.td>

                                <x-table.switch :model="$service"/>

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        <x-table.view_btn route-view="{{route('admin.services.show', ':id')}}" id="{{$service->id}}" model="Service" name="service"/>

                                        <x-table.edit_btn route-edit="{{route('admin.services.edit', $service->id) }}"/>

                                        <x-table.delete_btn route-destroy="{{route('admin.services.destroy', $service->id ) }}"/>
                                    </div>
                                </td>
                            </tr>

                            <x-table.show_modal id="{{$service->id}}" model="Service"/>

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
    @include('_helpers.modal_script',['name' => 'service', 'route' => route('admin.services.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-service')])
    @include('_helpers.swal_delete')
@endpush
