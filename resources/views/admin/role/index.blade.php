@extends('layouts.master')
@section('title', 'Role')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Role"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    @can('add-role')
                        <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                    @endcan
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['title','slug', 'Actions']"/>

                        <tbody id="tablecontents">
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$role->title}}</x-table.td>

                                <x-table.td>{{$role->slug}}</x-table.td>


                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        @can('access-role-page')
                                            <x-table.view_btn route-view="{{route('admin.roles.show', ':id')}}" id="{{$role->id}}" model="Role" name="role"/>
                                        @endcan

                                        @can('edit-role')
                                            <x-table.edit_btn route-edit="{{route('admin.roles.edit', $role->id) }}"/>
                                        @endcan

                                        @can('delete-role')
                                            <x-table.delete_btn route-destroy="{{route('admin.roles.destroy', $role->id ) }}"/>
                                        @endcan
                                    </div>
                                </td>
                            </tr>

                            <x-table.show_modal id="{{$role->id}}" model="Role"/>

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
    @include('_helpers.modal_script',['name' => 'role', 'route' => route('admin.roles.show', ':id')])
    @include('_helpers.datatable')

    @include('_helpers.swal_delete')
@endpush
