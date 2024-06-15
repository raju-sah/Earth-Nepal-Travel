@extends('layouts.master')
@section('title', 'Menu')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Menu"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['title', 'Actions']" />

                        <tbody id="tablecontents">
                        @forelse ($base_menus as $menu)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$menu->title}}</x-table.td>

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        <a href="{{route('admin.base-menus.menus.index', $menu->id)}}" class="btn btn-sm btn-default" title="Create Menu Item"><i class="bx bx-list-plus"></i></a>
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
@endpush
