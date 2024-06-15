@extends('layouts.master')
@section('title', 'Create Menu')
@section('content')

    @include('_helpers.errors')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.base-menus.menus.index',$base_menu->id)}}" model="Sub Menu" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.base-menus.menus.store',$base_menu->id)}}" method="POST" enctype="multipart/form-data">

                    <x-form.row>
                        <x-form.checkbox label="Is  Top Level Menu" col="6" id="is_parent" name="is_parent" value="1" checked class="top_checkbox form-check-input"/>
                        <div class="form-group col-md-6" id="parent_select">
                            <label for="parent_id">Select Parent Menu</label>

                            <select class="form-control select_two_model" name="parent_id" id="parent_id">
                                <option value="" disabled selected>select parent</option>
                                @foreach($menu_tree as $menu)
                                    @include('common_blade.menu-item-create', ['menuItem' => $menu, 'level' => 0])
                                @endforeach
                            </select>
                        </div>
                    </x-form.row>

                    <x-form.row>
                        <x-form.checkbox label="Is Clickable" id="is_clickable" name="is_clickable" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'"/>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Title" id="title" :req="true" col="6" name="title" value="{{ old('title') }}"/>
                        <x-form.input type="number" label="Order" id="order" :req="true" col="6" name="order" value="{{ old('order') }}"/>
                    </x-form.row>
                    <div class="col-md-12">
                        <label for="menu_type" class="col-form-label">Menu Type </label>
                        <select name="menu_type" class="form-control" id="menu_type">
                            @foreach(\App\Enums\MenuType::cases() as $menu_type)
                                <option value="{{ $menu_type->value }}" {{$menu_type->value === 'Default' ? 'selected' : ''}}>{{ $menu_type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-form.row>
                        <x-form.input :col="6" type="text" label="Classes" id="classes" name="classes" value="{{ old('classes') }}"/>
                        <x-form.select :col="6" label="Target" :options="['_self' => 'Same Page', '_target' => 'Next Page']" name="target"></x-form.select>
                    </x-form.row>

                    <div class="show_url" style="display: none">
                        <x-form.input type="text" label="Url" :req="true" id="url" name="url" value="{{ old('url') }}"/>
                    </div>

                    <div id="model_select" style="display: none;">
                        <label for="model_data_select" class="form-label">Select Data</label>
                        <select class="form-select form-control" id="model_data_select" name="menuable_id">
                        </select>
                    </div>


                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\MenuRequest') !!}
    @include('_helpers.parentChildSelect2', ['model' => 'Menu'])

    <script>
        $(document).ready(function () {

            $('#menu_type').on('change', function () {
                const show_url = $('.show_url');
                const model_select = $('#model_select');

                let value = $(this).val();

                if (value === 'Default') {
                    show_url.hide();
                    model_select.hide();
                } else if (value === 'Custom') {
                    show_url.show();
                    model_select.hide();
                } else {
                    show_url.hide();
                    getModelData(value);
                    model_select.show();
                }
            });

            function getModelData($modelName) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{route('admin.get-data-by-model')}}",
                    data: {
                        modelName: $modelName,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        let select = $('#model_data_select');
                        select.empty();
                        $.each(response.data, function (index, data) {
                            let options = '<option value="' + data._id + '">' + data.title + '</option>';
                            select.append(options);
                        });
                    }, error: function (xhr) {
                        console.log(xhr);
                    }
                });
            }
        });
    </script>
@endpush
