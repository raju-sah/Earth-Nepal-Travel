@extends('layouts.master')
@section('title', 'Create Social Media Setting')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.setting.social-media-settings.index') }}" model="Social Media Setting" item="Create"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.setting.social-media-settings.store') }}" method="POST" enctype="multipart/form-data">
                    <x-form.row>
                        <x-form.input type="text" col="6" :req="false" label="Name" id="name" placeholder="Facebook" name="name" value="{{ old('name') }}"/>
                        <x-form.input type="text" col="6" :req="true" label="Slug" id="slug" name="slug" value="{{ old('slug') }}"/>
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="file" col="6" :req="false" label="Social Icon" :tooltip="true" tooltip_text="Upload less than 1 MB" id="image" name="social_icon"
                                      accept="image/*" onchange="previewThumb(this,'social_icon-thumb')"/>
                        <x-form.single_preview col="6" id="social_icon-thumb" url=""/>
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="text" col="12" :req="true" label="Social Link" id="social_link" placeholder="https://www.facebook.com/" name="social_link"
                                      value="{{ old('social_link') }}"/>
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\SocialMediaSettingRequest') !!}
    @include('_helpers.slugify', ['title' => 'name'])
    @include('_helpers.previewer_image_single',['name' => 'social_icon'])
@endpush
