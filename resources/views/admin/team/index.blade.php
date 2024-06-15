@extends('layouts.master')
@section('title', 'Team')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Team"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.teams.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['name', 'designation','status', 'Actions']"/>

                        <tbody id="tablecontents">
                        @forelse ($teams as $team)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$team->name}}</x-table.td>

                                <x-table.td>{{$team->designation}}</x-table.td>

                                <x-table.switch :model="$team"/>

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        <x-table.view_btn route-view="{{route('admin.teams.show', ':id')}}" id="{{$team->id}}" model="Team" name="team"/>

                                        <x-table.edit_btn route-edit="{{route('admin.teams.edit', $team->id) }}"/>

                                        <x-table.delete_btn route-destroy="{{route('admin.teams.destroy', $team->id ) }}"/>
                                    </div>
                                </td>
                            </tr>

                            <x-table.show_modal id="{{$team->id}}" model="Team"/>

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
    @include('_helpers.modal_script',['name' => 'team', 'route' => route('admin.teams.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-team')])
    @include('_helpers.swal_delete')
@endpush
