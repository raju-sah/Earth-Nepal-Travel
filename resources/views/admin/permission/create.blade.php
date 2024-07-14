@extends('layouts.master')
@section('title', 'Create Permission')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.permissions.index')}}" model="Permission" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.permissions.store')}}" method="POST">
                    <x-form.input type="text" :req="true" label="Title" id="title" name="title" value="{{ old('title') }}"/>
                    <x-form.input type="text" :req="true" label="Slug" id="slug" name="slug" value="{{ old('slug') }}"/>
                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\PermissionRequest') !!}
    @include('_helpers.slugify',['title' => 'title'])
@endpush
