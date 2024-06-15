@extends('layouts.master')
@section('title', 'Site Setting')
@section('content')
<div class="container-xxl">
    <x-breadcrumb model="Site Setting"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <x-form.wrapper action="{{ isset($siteSettings) && isset($siteSettings->id) ? route('admin.setting.company.update', $siteSettings->id) : route('admin.setting.company.update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')

                <x-form.row>
                    <x-form.input type="text" col="12" :req="true" label="Company Name" id="name" name="name" value="{{ $siteSettings ? $siteSettings->name : '' }}" />
                </x-form.row>
                <hr>

                <x-form.row>
                    <x-form.input type="file" col="6" :req="false" label="Logo" :tooltip="true" tooltip_text="Upload less than 1 MB" id="logo" name="logo" accept="image/*" onchange="previewLogo(this,'featured-logo')" />
                    <x-form.settinglogopreview col="6" id="featured-logo" url="{{ $siteSettings->logo_path ?? '' }}" />
                </x-form.row>
                <hr>

                <x-form.row>
                    <x-form.input type="file" col="6" :req="false" label="Favicon" :tooltip="true" tooltip_text="Upload less than 1 MB" id="favicon" name="favicon" accept="image/*" onchange="previewFavicon(this,'featured-favicon')" />
                    <x-form.settingfaviconpreview col="6" id="featured-favicon" url="{{ $siteSettings->favicon_path ?? '' }}" />
                </x-form.row>
                <hr>

                <x-form.row>
                    <x-form.input type="email" col="6" :req="false" label="Email" id="email" name="email" value="{{ $siteSettings ? $siteSettings->email : '' }}" />
                    <x-form.input type="text" col="6" :req="false" label="Phone" id="phone" name="phone" value="{{ $siteSettings ? $siteSettings->phone : '' }}" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="text" col="6" :req="false" label="Contact Address" id="contact_address" name="contact_address" value="{{ $siteSettings ? $siteSettings->contact_address : '' }}" />
                    <x-form.input type="text" col="6" :req="false" label="Working hours" id="working_hours" name="working_hours" value="{{ $siteSettings ? $siteSettings->working_hours : '' }}" />
                </x-form.row>
                <x-form.row>
                    <x-form.input type="text" col="12" :req="false" label="Copyright" id="copyright_text" name="copyright_text" value="{{ $siteSettings ? $siteSettings->copyright_text : '' }}" />
                </x-form.row>
                <hr>
                <x-form.row>
                    <x-form.input type="color" col="6" :req="false" label="Primary Color 1" id="primary1_color" name="primary1_color" value="{{ $siteSettings ? $siteSettings->primary1_color : '' }}" />
                    <x-form.input type="color" col="6" :req="false" label="Secondary Color 1" id="secondary1_color" name="secondary1_color" value="{{ $siteSettings ? $siteSettings->secondary1_color : '' }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="color" col="6" :req="false" label="Primary Color 2" id="primary2_color" name="primary2_color" value="{{ $siteSettings ? $siteSettings->primary2_color : '' }}" />
                    <x-form.input type="color" col="6" :req="false" label="Secondary Color 2" id="secondary2_color" name="secondary2_color" value="{{ $siteSettings ? $siteSettings->secondary2_color : '' }}" />
                </x-form.row>
                <hr>
                <x-form.row>
                    <x-form.input type="text" col="12" :req="false" label="Map URL (Go To Google Map to generate embed map link)" id="map_url" name="map_url" value="{{ $siteSettings ? $siteSettings->map_url : '' }}" class="mb-2" />
                </x-form.row>
                <x-form.row>
                    <iframe src="{{$siteSettings ? $siteSettings->map_url : ''}}" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </x-form.row>

                <x-form.button class="mt-4 btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                    Save
                </x-form.button>

            </x-form.wrapper>
        </div>
    </div>

</div>
@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\SiteSettingUpdateRequest') !!}
@include('_helpers.site_setting_image_preview')
@endpush