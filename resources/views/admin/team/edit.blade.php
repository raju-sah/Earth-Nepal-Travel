@extends('layouts.master')
@section('title', 'Edit Team')
@section('content')

@push('custom_css')
<style>
    .delete-repeating-item {
        position: relative;
        top: 26px;
        width: 40px;
        height: 37px;
        line-height: 28px;
    }
</style>
@endpush
<div class="container-xxl">
    <x-breadcrumb listRoute="{{ route('admin.teams.index') }}" model="Team" item="Edit"></x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <x-form.wrapper action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <x-form.row>
                    <x-form.input type="file" col="3" label="Image" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="image" :req="true" alt="image" accept="image/*" onchange="previewThumb(this,'image-thumb')" />
                    <x-form.input type="text" col="3" label="Name" id="name" :req="true" name="name" value="{{ $team->name }}" />
                    <x-form.input type="text" label="Designation" col="3" :req="true" id="designation" name="designation" value="{{ $team->designation }}" />
                    <x-form.enum-select :req="true" col="3" label="Team Type" :model="$team->team_type" :options="App\Enums\TeamType::cases()" name="team_type"></x-form.enum-select>
                </x-form.row>
                <x-form.single_preview id="image-thumb" url="{{ $team->image_path }}" />

                <x-form.textarea label="Description" id="description" name="description" value="{!! $team->description !!}" rows="5" cols="5" />
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$team->status ? 'checked' : ''" />

                {{-- Repeater Code --}}
                <span class="btn btn-primary float-end js-add--field-row btn-sm mt-3 mb-1" col="2"><i class='bx bx-plus'></i>Add Social Media</span>

                @foreach ($data as $value)
                <div class="row social-media-entry" style="width: 100%; max-width: 1000px;">
                    <x-form.input type="text" col="7" class="social_link" label="Social Media Link" id="social_link" name="social_link[]" value="{{ $value }}" placeholder="https://facebook.com/username or 98123345678" />
                    <span class="btn btn-danger btn-sm mt-2 delete-repeating-item" data-item-id="{{ $team->id }}"><i class='bx bx-trash bx-xs'></i></span>
                </div>
                @endforeach
                <div id="form-variations-list"></div>
                <template id="template-form">
                    <div class="row" style="width: 100%; max-width: 1000px;">
                        <x-form.input type="text" col="7" class="social_link" label="Social Media Link" id="social_link" name="social_link[]" placeholder="https://facebook.com/username or 98123345678" />
                    </div>
                </template>
                <x-form.button class="btn team_btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                    Save</x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>

@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\TeamUpdateRequest')->ignore(
"input:hidden:not(input:hidden.required), [contenteditable='true']",
) !!}
@include('_helpers.previewer_image_single', ['name' => 'image'])
@include('_helpers.ck_editor', ['textarea_id' => 'description'])
@include('_helpers.repeater')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-repeating-item').forEach(function(deleteButton) {
            deleteButton.addEventListener('click', function() {
                var parentElement = this.closest('.social-media-entry');
                if (parentElement) {
                    if (confirm(
                            'Are you sure to delete this social media entry? dont worry its recoverable when reloaded, but cannot be recovered when saved.'
                        )) {
                        parentElement.remove();
                    }
                }
            });
        });
    });
</script>
@endpush