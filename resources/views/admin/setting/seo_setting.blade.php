@extends('layouts.master')
@section('title', 'SEO Setting')
@section('content')
<div class="container-xxl">
    <x-breadcrumb model="SEO Setting"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <x-form.wrapper action="{{ isset($seoSettings) && isset($seoSettings->id) ? route('admin.setting.seo.update', $seoSettings->id) : route('admin.setting.seo.update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')

                <x-form.row>
                    <x-form.input type="text" col="6" :req="true" label="Meta Title" id="meta_title" name="meta_title" value="{{ $seoSettings ? $seoSettings->meta_title : '' }}" />

                    <x-form.input type="text" col="6" :req="true" label="Meta Keywords" id="meta_keywords" name="meta_keywords" value="{{ $seoSettings ? $seoSettings->meta_keywords : '' }}" />
                </x-form.row>

                <x-form.row>
                    <x-form.input type="text" col="6" label="Meta Author" id="meta_author" name="meta_author" value="{{ $seoSettings ? $seoSettings->meta_author : '' }}" />

                    <x-form.input type="text" col="6" label="Meta Robots" id="meta_robots" name="meta_robots" value="{{ $seoSettings ? $seoSettings->meta_robots : '' }}" />
                </x-form.row>

                <x-form.textarea label="Meta Description" id="meta_description" name="meta_description" value="{!! $seoSettings ? $seoSettings->meta_description : '' !!}" rows="5" cols="5" />

                <x-form.button class="mt-4 btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                    Save
                </x-form.button>

            </x-form.wrapper>
        </div>
    </div>

</div>
@endsection
@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\SeoSettingUpdateRequest') !!}
@include('_helpers.ck_editor', ['textarea_id' => 'meta_description'])

@endpush