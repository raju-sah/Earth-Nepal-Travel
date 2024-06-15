@extends('layouts.master')
@section('title', 'Create Role')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.roles.index')}}" model="Role" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.roles.store')}}" method="POST" enctype="multipart/form-data">
                    <x-form.input type="text" :req="true" label="Title" id="title" name="title" value="{{ old('title') }}"/>
                    <x-form.input type="text" :req="true" label="Slug" id="slug" name="slug" value="{{ old('slug') }}"/>

                    <div class="form-group mt-2 col-md-12">
                        <label class="required" for="permissions">Add Permissions <span class="text-danger">*</span></label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-sm btn-primary select-all" style="border-radius: 0">Select All</span>
                            <span class="btn btn-sm btn-danger deselect-all" style="border-radius: 0">Remove All</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>{{ $permission->title }}</option>
                            @endforeach
                        </select>

                        @if($errors->has('permissions'))
                            <span class="text-danger small">{{ $errors->first('permissions') }}</span>
                        @endif
                    </div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\RoleRequest') !!}
    @include('_helpers.slugify',['title' => 'title'])
    @include('_helpers.role_selector')
@endpush
