@extends('layouts.master')
@section('title', 'Package Review Notification')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.package-reviews.index')}}" model="Package Review" item="Notification of"></x-breadcrumb>

        <div>
            <div class="card">
                <div class="card-body">
                    @include('admin.package_review.show')
                </div>
            </div>
        </div>
    </div>
@endsection
