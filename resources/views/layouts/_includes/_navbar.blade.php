<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center ">
                <h1 class="display-6 mb-0">Admin Dashboard </h1>
            </div>
        </div>
        <!-- /Search -->
        @php
        $unreadNotifications = auth()->user()->unreadNotifications;
        $unreadNotificationsCount = $unreadNotifications->count();
        @endphp

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item lh-1 me-2">
                <div class="notification position-relative">
                    <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-bell"></i>
                    </button>
                    @if($unreadNotificationsCount > 0)
                    <p style="font-size: 12px; min-height: 20px;min-width: 20px; justify-content: center;top:-3px;right: -7px;" class="position-absolute bg-danger text-white p-1 d-flex align-items-center rounded-circle text-center ">
                        {{$unreadNotificationsCount}}
                    </p>
                    @endif
                    <ul class="dropdown-menu dropdown-menu-end" style="min-width: 28rem;">
                        @forelse($unreadNotifications as $notification)
                        @if($notification->type === 'App\Notifications\InquiryNotification')
                        <li style="border-bottom: 1px solid #eee">
                            <a class="dropdown-item d-flex px-3 mark-as-read" data-notification-id="{{ $notification->id }}" data-redirect-url="{{ route('admin.inquiry-notification', $notification->data['inquiry']['id']) }}" href="#" style="white-space: pre-wrap">
                                <i class="bx bx-phone-incoming" style="line-height:18px"></i>
                                <span style="padding-left:7px;font-size: 14px;">{{ $notification->data['inquiry']['name'] }} has contacted you on {{ date('dS F Y', strtotime($notification['created_at'])) }}</span>
                            </a>
                        </li>
                        @endif
                        @if($notification->type === 'App\Notifications\BookingNotification')
                        <li style="border-bottom: 1px solid #eee">
                            <a class="dropdown-item d-flex px-3 mark-as-read" data-notification-id="{{ $notification->id }}" data-redirect-url="{{ route('admin.booking-notification', $notification->data['booking']['id']) }}" href="#" style="white-space: pre-wrap">
                                <i class="bx bx-phone-incoming" style="line-height:18px"></i>
                                <span style="padding-left:7px;font-size: 14px;">{{ $notification->data['booking']['name'] }} has sent booking request on {{ date('dS F Y', strtotime($notification['created_at'])) }}</span>
                            </a>
                        </li>
                        @endif
                        @if($notification->type === 'App\Notifications\NewsLetterSubscribedNotification')
                        <li style="border-bottom: 1px solid #eee">
                            <a class="dropdown-item d-flex px-3 mark-as-read" data-notification-id="{{ $notification->id }}" data-redirect-url="{{ route('admin.newsletters-notification', $notification->data['news_letter']['id']) }}" href="#" style="white-space: pre-wrap">
                                <i class="bx bx-phone-incoming" style="line-height:18px"></i>
                                <span style="padding-left:7px;font-size: 14px;">{{ $notification->data['news_letter']['email'] }} has sent newsletter request on {{ date('dS F Y', strtotime($notification['created_at'])) }}</span>
                            </a>
                        </li>
                        @endif

                        @if($notification->type === 'App\Notifications\TestimonialSubmittedNotification')
                        <li style="border-bottom: 1px solid #eee">
                            <a class="dropdown-item d-flex px-3 mark-as-read" data-notification-id="{{ $notification->id }}" data-redirect-url="{{ route('admin.testimonials-notification', $notification->data['testimonial']['id']) }}" href="#" style="white-space: pre-wrap">
                                <i class="bx bx-phone-incoming" style="line-height:18px"></i>
                                <span style="padding-left:7px;font-size: 14px;">{{ $notification->data['testimonial']['name'] }} has sent feedback on {{ date('dS F Y', strtotime($notification['created_at'])) }}</span>
                            </a>
                        </li>
                        @endif

                        @empty
                        <div class="px-2">
                            <p class="text-center pt-3">No notifications</p>
                            <a class="btn btn-sm btn-outline-success mt-2 d-flex justify-content-center" href="{{route('admin.all-notifications')}}">View All Notifications</a>
                        </div>
                        @endforelse
                        @if($unreadNotificationsCount > 0)
                        <div class="d-flex justify-content-between px-4">
                            <a class="btn btn-sm btn-outline-danger mt-2" href="{{route('mark_all_as_read')}}"> Mark All As Read</a>
                            <a class="btn btn-sm btn-outline-success mt-2" href="{{route('admin.all-notifications')}}">View All Notifications</a>
                        </div>
                        @endif
                    </ul>

                </div>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{auth()->user()->image_path}}" alt="user image" class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profiles.index') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle"> My Profile&nbsp;({{auth()->user()->name}})</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>