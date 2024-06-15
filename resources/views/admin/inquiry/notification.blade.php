@extends('layouts.master')
@section('title', 'Inquiry Notification')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.inquiries.index')}}" model="Inquiry" item="Notification of"></x-breadcrumb>

        <div>
            <div class="card">
                <div class="card-body">
                    @include('admin.inquiry.show')

                    @include('common_blade.email_template_modal', ['model' => $inquiry])
                </div>
            </div>
        </div>
    </div>
@endsection

