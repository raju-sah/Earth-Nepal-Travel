@extends('layouts.master')
@section('title', 'Create Icon')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.icons.index')}}" model="Icon" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.icons.store')}}" method="POST" enctype="multipart/form-data">
                    <x-form.input type="text" label="Name" :req="true" id="name" name="name" value="{{ old('name') }}"/>
                    <x-form.input type="file" label="Image" :req="true" id="image" name="image" alt="image" accept="image/*" :tooltip="true" tooltip_text="Please Upload SVG Icon"
                                  onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb"/>
                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\IconRequest') !!}
    @include('_helpers.previewer_image_single',['name' => 'image'])
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
