@extends('layouts.master')
@section('title', 'Season')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Season"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.seasons.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['Season Name','starting month','ending month', 'status', 'Actions']"/>

                        <tbody id="tablecontents">
                        @forelse ($seasons as $season)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$season->type}}</x-table.td>

                                <x-table.td>{{$season->getFormattedMonth($season->starting_month)}}</x-table.td>

                                <x-table.td>{{$season->getFormattedMonth($season->ending_month)}}</x-table.td>

                                <x-table.switch :model="$season"/>

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        <x-table.view_btn route-view="{{route('admin.seasons.show', ':id')}}" id="{{$season->id}}" model="Season" name="season"/>

                                        <x-table.edit_btn route-edit="{{route('admin.seasons.edit', $season->id) }}"/>

                                        <x-table.delete_btn route-destroy="{{route('admin.seasons.destroy', $season->id ) }}"/>
                                    </div>
                                </td>
                            </tr>

                            <x-table.show_modal id="{{$season->id}}" model="Season"/>

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
    @include('_helpers.modal_script',['name' => 'season', 'route' => route('admin.seasons.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.swal_delete')
    @include('_helpers.status_change', ['url' => url('admin/status-change-seasons')])
@endpush
