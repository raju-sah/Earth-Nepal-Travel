@extends('layouts.master')
@section('title', 'Edit Social Media Setting')
@section('content')
<div class="container-xxl">

    <x-breadcrumb listRoute="{{ route('admin.setting.social-media-settings.index') }}" model="Social Media Setting" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{ route('admin.setting.social-media-settings.update', $social_media_setting->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <x-form.row>
                    <x-form.input type="text" col="6" :req="false" label="Name" id="name" name="name" value="{{ $social_media_setting->name }}" />
                    <x-form.input type="text" col="6" :req="true" label="Slug" id="slug" name="slug" value="{{ $social_media_setting->slug }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="file" col="6" :req="true" label="Social Icon" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="social_icon" alt="image" accept="image/*" onchange="previewThumb(this,'featured-thumb')" />
                    <x-form.single_preview id="featured-thumb" url="{{ $social_media_setting->icon_path }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="12" :req="true" label="Social_link" id="social_link" name="social_link" value="{{ $social_media_setting->social_link }}" />
                </x-form.row>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                    Save
                </x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\SocialMediaSettingUpdateRequest') !!}
@include('_helpers.slugify', ['title' => 'name'])
@include('_helpers.previewer_image_single',['name' => 'social_icon'])


@endpush
