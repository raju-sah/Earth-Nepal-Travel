@extends('layouts.master')
@section('title', 'Edit Menu')
@section('content')

    @include('_helpers.errors')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.base-menus.menus.index',$base_menu->id)}}" model="Sub Menu" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.base-menus.menus.update', [$base_menu->id,$menu->id])}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')

                    <x-form.row>
                        <x-form.checkbox label="Is Top Level Menu" col="6" id="is_parent" name="is_parent" value="1" :isChecked="$menu->parent_id ? '' : 'checked'"
                                         class="top_checkbox form-check-input"/>
                        <div class="form-group col-md-6" id="parent_select">
                            <label for="parent_id">Select Parent Menu</label>

                            <select class="form-control select_two_model" name="parent_id" id="parent_id">
                                <option value="" disabled selected>select parent</option>
                                @foreach($menu_tree as $menuItem)
                                    @include('common_blade.menu-item-edit', ['menuItem' => $menuItem, 'level' => 0, 'parentId' => $menu->parent_id])
                                @endforeach
                            </select>
                        </div>
                    </x-form.row>

                    <x-form.row>
                        <x-form.checkbox label="Is Clickable" id="is_clickable" name="is_clickable" value="1" class="form-check-input" isEditMode="yes" :isChecked="$menu->is_clickable ? 'checked' : ''"/>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Title" id="title" :req="true" col="6" name="title" value="{{ old('title', $menu->title) }}"/>
                        <x-form.input type="number" label="Order" id="order" :req="true" col="6" name="order" value="{{ old('order', $menu->order) }}"/>
                    </x-form.row>
                    <div class="col-md-12">
                        <label for="menu_type" class="col-form-label">Menu Type </label>
                        <select name="menu_type" class="form-control" id="menu_type">
                            @foreach(\App\Enums\MenuType::cases() as $menu_type)
                                <option value="{{ $menu_type->value }}" {{$menu_type->value === $menu->menu_type ? 'selected' : ''}}>{{ $menu_type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-form.row>
                        <x-form.input :col="6" type="text" label="Classes" id="classes" name="classes" value="{{ old('classes', $menu->classes) }}"/>
                        <x-form.select :col="6" label="Target" :options="['_self' => 'Same Page', '_target' => 'Next Page']" name="target"
                                       :model="$menu->target"></x-form.select>
                    </x-form.row>

                    <div class="show_url" style="display: none">
                        <x-form.input type="text" label="Url" :req="true" id="url" name="url" value="{{ $menu->url }}"/>
                    </div>

                    <div id="model_select" style="display: none;">
                        <label for="model_data_select" class="form-label">Select Data</label>
                        <select class="form-select form-control" id="model_data_select" name="menuable_id">
                        </select>
                    </div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Update</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\MenuUpdateRequest') !!}

    @include('_helpers.parentChildSelect2', ['model' => 'Menu'])

    <script>
        $(document).ready(function () {
            let currentUrl = $('#menu_type').val() === 'Custom' ? '{{ $menu->url }}' : '';

            function updateFieldsBasedOnMenuType() {
                const showUrl = $('.show_url');
                const modelSelect = $('#model_select');
                const menuTypeValue = $('#menu_type').val();
                const urlField = $('#url');

                //for other menu type
                showUrl.hide();
                modelSelect.hide();
                urlField.val('');

                if (menuTypeValue === 'Custom') {
                    showUrl.show();
                    urlField.val(currentUrl);
                } else if (menuTypeValue !== 'Default') {
                    getModelData(menuTypeValue);
                    modelSelect.show();
                }
            }

            updateFieldsBasedOnMenuType();
            $('#menu_type').on('change', updateFieldsBasedOnMenuType);

            function getModelData(modelName) {
                const menuableId = "{{ $menu->menuable_id ?? '' }}";
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('admin.get-data-by-model') }}",
                    data: {
                        modelName: modelName,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        const select = $('#model_data_select').empty();
                        $.each(response.data, function (index, data) {
                            const isSelected = data._id == menuableId;
                            const option = $('<option>', {
                                value: data._id,
                                selected: isSelected,
                                text: data.title
                            });
                            select.append(option);
                        });
                    },
                    error: console.log
                });
            }

            $('#url').on('input', function () {
                currentUrl = $(this).val();
            });
        });

    </script>
@endpush
