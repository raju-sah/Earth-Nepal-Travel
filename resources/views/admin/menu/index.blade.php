@extends('layouts.master')
@section('title', 'Menu')
@section('content')

    <style>

    </style>
    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.base-menus.index')}}" model="Menu" item="Sub"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <button class="btn btn-sm btn-info mb-2" data-bs-toggle="modal" data-bs-target="#tree"> View Menu Tree<i class="bx bx-xs bx-sitemap"></i></button>
                    <a href="{{route('admin.base-menus.menus.create',$base_menu->id)}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                </div>

                @include('common_blade.menu_tree_modal')

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['title','order', 'Actions']"/>

                        <tbody id="tablecontents">

                        @forelse ($menus_list as $menu)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$menu->title}}</x-table.td>
                                <x-table.td>{{$menu->order}}</x-table.td>

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        <x-table.edit_btn route-edit="{{route('admin.base-menus.menus.edit', [$base_menu->id,$menu->id]) }}"/>

                                        <x-table.delete_btn route-destroy="{{route('admin.base-menus.menus.destroy', [$base_menu->id,$menu->id] ) }}"/>
                                    </div>
                                </td>
                            </tr>

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
    @include('_helpers.datatable')
    @include('_helpers.swal_delete')
@endpush
