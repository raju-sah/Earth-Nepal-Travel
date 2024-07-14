@extends('layouts.master')

@section('content')

<div class="container-xxl">

    <x-breadcrumb model="All Notifications"></x-breadcrumb>

    <div class="card">

        <div class="card-body">

            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">

                    <x-table.header :headers="['name', 'type', 'view', 'created at', 'read at']" />

                    <tbody id="tablecontents">
                        @forelse ($notifications as $notification)
                        <tr>
                            <td>{{$loop->iteration}}</td>

                            @if($notification->type === 'App\Notifications\InquiryNotification')
                            <x-table.td>{{ $notification->data['inquiry']['name'] }}</x-table.td>
                            <x-table.td>{{ 'inquiry notification' }}</x-table.td>
                            <x-table.td>
                                <a class="mark-as-read" data-notification-id="{{ $notification->id }}" data-redirect-url="{{ route('admin.inquiry-notification', $notification->data['inquiry']['id']) }}" href="#">View Notification
                                </a>
                            </x-table.td>
                            @endif

                            @if($notification->type === 'App\Notifications\BookingNotification')
                            <x-table.td>{{ $notification->data['booking']['name'] }}</x-table.td>
                            <x-table.td>{{ 'booking notification' }}</x-table.td>
                            <x-table.td>
                                <a class="mark-as-read" data-notification-id="{{ $notification->id }}" data-redirect-url="{{ route('admin.booking-notification', $notification->data['booking']['id']) }}" href="#">View Notification
                                </a>
                            </x-table.td>
                            @endif

                            @if($notification->type === 'App\Notifications\NewsLetterSubscribedNotification')
                            <x-table.td>{{ $notification->data['news_letter']['email'] }}</x-table.td>
                            <x-table.td>{{ 'newsletter notification' }}</x-table.td>
                            <x-table.td>
                                <a class="mark-as-read" data-notification-id="{{ $notification->id }}" data-redirect-url="{{ route('admin.newsletters-notification', $notification->data['news_letter']['id']) }}" href="#">View Notification
                                </a>
                            </x-table.td>
                            @endif
                            @if($notification->type === 'App\Notifications\TestimonialSubmittedNotification')
                            <x-table.td>{{ $notification->data['testimonial']['name'] }}</x-table.td>
                            <x-table.td>{{ 'testimonial notification' }}</x-table.td>
                            <x-table.td>
                                <a class="mark-as-read" data-notification-id="{{ $notification->id }}" data-redirect-url="{{ route('admin.testimonials-notification', $notification->data['testimonial']['id']) }}" href="#">View Notification
                                </a>
                            </x-table.td>
                            @endif

                            <x-table.td>{{ $notification->created_at->format('Y-m-d') }}</x-table.td>
                            <x-table.td>{{ $notification->read_at ? $notification->read_at->format('Y-m-d') : 'Not read' }}</x-table.td>
                        </tr>

                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom_js')
@include('_helpers.datatable')
@endpush