@extends('layouts.master')
@section('title', 'Common FAQ')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Common Faq"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    <a href="{{route('admin.common-faqs.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['question','status', 'Actions']"/>

                        <tbody id="tablecontents">
                        @forelse ($common_faqs as $common_faq)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <x-table.td>{{$common_faq->question}}</x-table.td>

                                <x-table.switch :model="$common_faq"/>

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        <x-table.view_btn route-view="{{route('admin.common-faqs.show', ':id')}}" id="{{$common_faq->id}}" model="CommonFaq" name="common_faq"/>

                                        <x-table.edit_btn route-edit="{{route('admin.common-faqs.edit', $common_faq->id) }}"/>

                                        <x-table.delete_btn route-destroy="{{route('admin.common-faqs.destroy', $common_faq->id ) }}"/>
                                    </div>
                                </td>
                            </tr>

                            <x-table.show_modal id="{{$common_faq->id}}" model="CommonFaq"/>

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
    @include('_helpers.modal_script',['name' => 'common_faq', 'route' => route('admin.common-faqs.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-common-faq')])
    @include('_helpers.swal_delete')
@endpush
