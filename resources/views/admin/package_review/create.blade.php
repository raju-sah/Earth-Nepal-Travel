@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.package-reviews.index')}}" model="PackageReview" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.package-reviews.store')}}" method="POST" enctype="multipart/form-data">
                        <x-form.input type="text" label="Fullname" id="fullname" name="fullname" value="{{ old('fullname') }}"/>
<x-form.input type="text" label="Email" id="email" name="email" value="{{ old('email') }}"/>
<x-form.textarea label="Review_text" id="review_text" name="review_text" value="{{ old('review_text') }}" rows="5" cols="5" />
<x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="true"/>
<x-form.input type="text" label="Package_id" id="package_id" name="package_id" value="{{ old('package_id') }}"/>

                        <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\PackageReviewRequest') !!}
    
@endpush
