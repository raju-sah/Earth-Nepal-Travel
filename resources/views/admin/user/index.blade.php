@extends('layouts.master')
@section('title', 'User')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="User"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    @can('add-user')
                        <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                    @endcan
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['name','email','image','status', 'Actions']"/>

                        <tbody id="tablecontents">
                        @forelse ($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$user->name}}</x-table.td>

                                <x-table.td>{{$user->email}}</x-table.td>

                                <x-table.table_image name="{{$user->image }}" url="{{$user->image_path }}"/>

                                @can('edit-user')
                                <x-table.switch :model="$user"/>
                                @else
                                    <td>{{$user->formatted_status }}</td>
                                @endcan

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        @can('access-user-page')
                                            <x-table.view_btn route-view="{{route('admin.users.show', ':id')}}" id="{{$user->id}}" model="User" name="user"/>
                                        @endcan
                                        @can('edit-user')
                                            <x-table.edit_btn route-edit="{{route('admin.users.edit', $user->id) }}"/>
                                        @endcan
                                        @can('delete-user')
                                            <x-table.delete_btn route-destroy="{{route('admin.users.destroy', $user->id ) }}"/>
                                        @endcan
                                    </div>
                                </td>
                            </tr>

                            <x-table.show_modal id="{{$user->id}}" model="User"/>

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
    @include('_helpers.modal_script',['name' => 'user', 'route' => route('admin.users.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-admin-user')])
    @include('_helpers.swal_delete')
@endpush
