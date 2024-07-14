@extends('layouts.master')
@section('title', 'Booking Notification')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.bookings.index')}}" model="Booking" item="Notification of"></x-breadcrumb>

        <div>
            <div class="card">
                <div class="card-body">
                    @include('admin.booking.show')
                    @include('common_blade.email_template_modal', ['model' => $booking])

                </div>
            </div>
        </div>
    </div>
@endsection

