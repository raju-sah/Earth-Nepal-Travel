@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Email Template"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.email-templates.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['name', 'Actions']"/>

                        <tbody id="tablecontents">
                        @forelse ($email_templates as $email_template)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$email_template->name}}</x-table.td>

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        <x-table.view_btn route-view="{{route('admin.email-templates.show', ':id')}}" id="{{$email_template->id}}" model="EmailTemplate"
                                                          name="email_template"/>

                                        <x-table.edit_btn route-edit="{{route('admin.email-templates.edit', $email_template->id) }}"/>

                                        <x-table.delete_btn route-destroy="{{route('admin.email-templates.destroy', $email_template->id ) }}"/>
                                    </div>
                                </td>
                            </tr>

                            <x-table.show_modal id="{{$email_template->id}}" model="EmailTemplate"/>

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
    @include('_helpers.modal_script',['name' => 'email_template', 'route' => route('admin.email-templates.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.swal_delete')
@endpush
