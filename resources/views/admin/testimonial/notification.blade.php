@extends('layouts.master')
@section('title', 'Testimonial Notification')

@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.testimonials.index')}}" model="Testimonial" item="Notification of"></x-breadcrumb>

    <div>
        <div class="card">
            <div class="card-body">
                @include('admin.testimonial.show')

                @include('common_blade.email_template_modal', ['model' => $testimonial])
            </div>
        </div>
    </div>
</div>
@endsection