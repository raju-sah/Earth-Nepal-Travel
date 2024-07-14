@extends('layouts.master')
@section('title', 'Create Team')
@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.teams.index')}}" model="Team" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{route('admin.teams.store')}}" method="POST" enctype="multipart/form-data">
                <x-form.row>
                    <x-form.input type="file" col="3" label="Avatar" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" :req="true" name="image" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')" />
                    <x-form.input type="text" col="3" label="Full Name" :req="true" id="name" name="name" value="{{ old('name') }}" />
                    <x-form.input type="text" col="3" label="Designation" id="designation" :req="true" name="designation" value="{{ old('designation') }}" />
                    <x-form.enum-select :req="true" col="3" label="Team Type" :options="App\Enums\TeamType::cases()" name="team_type"></x-form.enum-select>
                </x-form.row>
                <x-form.single_preview id="image-thumb" />

                <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" rows="5" cols="5" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="'checked'" />



                {{-- Repeater Code--}}
                <x-form.button class="btn btn-primary float-end js-add--field-row btn-sm mt-3 mb-2" col="2"><i class='bx bx-plus'></i>Add Social Media</x-form.button>
                <div class="row mt-5" style="width: 100%; max-width: 1000px;">
                    <x-form.input type="text" col="7" class="social_link" label="Social Media Link" id="social_link" name="social_link[]" placeholder="https://facebook.com/username or 98123345678" />
                </div>
                <div id="form-variations-list"></div>
                <template id="template-form">
                    <div class="row" style="width: 100%; max-width: 1000px;">

                        <x-form.input type="text" col="7" class="social_link" label="Social Media Link" id="social_link" name="social_link[]" placeholder="https://facebook.com/username or 98123345678" />
                    </div>
                </template>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
            </x-form.wrapper>

        </div>
    </div>
</div>

@endsection

@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\TeamRequest')->ignore("input:hidden:not(input:hidden.required), [contenteditable='true']"); !!}
@include('_helpers.previewer_image_single',['name' => 'image'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@include('_helpers.repeater')
@endpush