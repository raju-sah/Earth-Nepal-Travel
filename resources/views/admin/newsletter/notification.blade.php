@extends('layouts.master')
@section('title', 'Newsletter Notification')

@section('content')

<div class="container-xxl">

    <x-breadcrumb listRoute="{{route('admin.newsletters.index')}}" model="Newsletter" item="Notification of"></x-breadcrumb>

    <div>
        <div class="card">
            <div class="card-body">
                @include('admin.newsletter.show')

                @include('common_blade.email_template_modal', ['model' => $newsletter])
            </div>
        </div>
    </div>
</div>
@endsection