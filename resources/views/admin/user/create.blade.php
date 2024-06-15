@extends('layouts.master')
@section('title', 'Create User')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.users.index')}}" model="User" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">

                    <x-form.input type="file" label="User Image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb"/>

                    <x-form.row>
                        <x-form.input type="text" col="6" :req="true" label="Name" id="name" name="name" value="{{ old('name') }}"/>
                        <x-form.input type="text" col="6" :req="true" label="Email" id="email" name="email" value="{{ old('email') }}"/>
                    </x-form.row>

                    <x-form.row class="mt-2">
                        <x-form.password col="6" :req="true" label="Password" id="password" name="password"/>
                        <x-form.password col="6" :req="true" label="Confirm Password" id="confirm_password" name="password_confirmation"/>
                    </x-form.row>

                    <x-form.select name="role_id" :options="$roles" label="Role"></x-form.select>
                    <br>

                    <div id="permissions_box">
                        <label for="roles">Select Permissions</label>

                        <div id="permissions_checkbox_list" class="d-flex flex-wrap"></div>
                        @error('permissions') <span class="text-danger">{{$message}}</span> @enderror

                    </div>
                    <br>

                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UserRequest') !!}
    @include('_helpers.previewer_image_single',['name' => 'image'])

    <script>
        $(document).ready(function () {
            let permissions_box = $('#permissions_box');
            let permissions_checkbox_list = $('#permissions_checkbox_list');

            permissions_box.hide(); // hide all boxes

            $('#role_id').on('change', function () {

                let role_id = $(this).find(':selected').val();
                permissions_checkbox_list.empty();

                $.ajax({
                    url: "{{url('admin/get-role-based-permissions')}}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                    }
                }).done(function (data) {
                    permissions_box.show();

                    $.each(data, function (index, element) {
                        $(permissions_checkbox_list).append(
                            '<div class="form-check mx-1 my-2">' +
                            '<input class="form-check-input" style="margin-right:5px" type="checkbox" name="permissions[]" checked id="' + element.title + '" value="' + element.id + '">' +
                            '<label class="form-check-label" for="' + element.title + '">' + element.title + '</label>' +
                            '</div>'
                        );
                    });
                });
            });
        });

    </script>
@endpush
