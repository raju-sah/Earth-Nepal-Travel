@extends('layouts.master')
@section('title', 'Travel Diary')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="TravelDiary"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.travel-diaries.store')}}" method="POST" enctype="multipart/form-data">
                    <x-form.input type="text" label="Title" :req="true" id="title" name="title" value="{{ old('title') }}"/>

                    <x-form.input type="file" label="Gallery Images" :tooltip="true" tooltip_text="Upload less than 1 MB" :req="true" id="images" name="images[]" accept="image/*" multiple onchange="appendImages(this,'images-list')"/>
                    <div class="images-list row" id="images-list" style="display: none;"></div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\TravelDiaryRequest') !!}
    @include('_helpers.multi_image_view_helper')
@endpush
