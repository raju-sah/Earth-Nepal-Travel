@extends('layouts.master')
@section('title', 'Edit Icon')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.icons.index')}}" model="Icon" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.icons.update', $icon->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <x-form.input type="text" label="Name" id="name" :req="true" name="name" value="{{$icon->name}}"/>
                    <x-form.input type="file" label="Image" id="image" :req="true" name="image" alt="image" accept="image/*" :tooltip="true" tooltip_text="Please Upload SVG Icon"
                                  onchange="previewThumb(this,'image-thumb')"/>
                    <x-form.single_preview id="image-thumb" url="{{$icon->image_path}}"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\IconUpdateRequest') !!}
    @include('_helpers.previewer_image_single',['name' => 'image'])
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
