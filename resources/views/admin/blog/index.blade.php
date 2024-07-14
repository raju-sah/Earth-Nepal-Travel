@extends('layouts.master')
@section('title', 'Blog')
@section('content')
<div class="container-xxl">

    <x-breadcrumb model="Blog"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'>
                    </i>Create</a>
            </div>

            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">

                    <x-table.header :headers="['user', 'title', 'slug', 'is_popular', 'status', 'Actions']" />

                    <tbody id="tablecontents">
                        @forelse ($blogs as $blog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <x-table.td>{{ $blog->user->name }}</x-table.td>

                            <x-table.td>{{ $blog->title }}</x-table.td>

                            <x-table.td>{{ $blog->slug }}</x-table.td>
                            <x-table.td><span class="badge bg-{{ $blog->is_popular === 1 ? 'success' : 'danger' }}">{{ $blog->is_popular === 1 ? 'Yes' : 'No' }}</span></x-table.td>

                            <x-table.switch :model="$blog" />

                            <td style="width:150px">
                                <div class="actions d-flex">
                                    <x-table.view_btn route-view="{{ route('admin.blogs.show', ':id') }}" id="{{ $blog->id }}" model="Blog" name="blog" />

                                    <x-table.edit_btn route-edit="{{ route('admin.blogs.edit', $blog->id) }}" />

                                    <x-table.delete_btn route-destroy="{{ route('admin.blogs.destroy', $blog->id) }}" />
                                </div>
                            </td>
                        </tr>

                        <x-table.show_modal id="{{ $blog->id }}" model="Blog" />

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
@include('_helpers.modal_script', ['name' => 'blog', 'route' => route('admin.blogs.show', ':id')])
@include('_helpers.datatable')
@include('_helpers.status_change', ['url' => url('admin/status-change-blog')])
@include('_helpers.swal_delete')
@endpush