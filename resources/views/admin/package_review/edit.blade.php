@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.package-reviews.index')}}" model="PackageReview" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.package-reviews.update', $package_review->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        <x-form.input type="text" label="Fullname" id="fullname" name="fullname" value="{{$package_review->fullname}}"/>
<x-form.input type="text" label="Email" id="email" name="email" value="{{$package_review->email}}"/>
<x-form.textarea label="Review_text" id="review_text" name="review_text" value="{{$package_review->review_text}}" rows="5" cols="5" />
<x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$package_review->status ? 'checked' : ''"/>
<x-form.input type="text" label="Package_id" id="package_id" name="package_id" value="{{$package_review->package_id}}"/>

                        <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\PackageReviewUpdateRequest') !!}
    
@endpush
