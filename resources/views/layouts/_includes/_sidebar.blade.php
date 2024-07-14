<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        @if (is_object($setting) && isset($setting['logo']))
        <a href="{{ url('home') }}" class="app-brand-link">
            <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}" style="max-width: 50px;max-height:50px;" alt="Logo">
        </a>
        @else
        <a href="{{ url('home') }}" class="app-brand-link">
            <span class="app-brand-text demo text-body fw-bolder text-uppercase">
                LOGO
            </span>
        </a>
        @endif
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <x-sidebar-item route="{{ route('home') }}" name="Dashboard" uri="home">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
        </x-sidebar-item>

        <x-sidebar-multilist-head icon="bx bxs-report" name="Reports" :routes="[
            'admin/package/reports',
            'admin/package/filters',
           ]">

            <x-sidebar-item route="{{route('admin.package-reports.filters')}}" name="Package Filter" uri="admin/package/filters">
            </x-sidebar-item>
            <x-sidebar-item route="{{route('admin.package-reports.index')}}" name="Package Report" uri="admin/package/reports">
            </x-sidebar-item>

        </x-sidebar-multilist-head>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Package Setting</span>
        </li>
        <x-sidebar-multilist-head icon="bx bxl-trip-advisor" name="Package Info" :routes="[
            'admin/packages',
            'admin/journeys',
            'admin/activities',
            'admin/destination-categories',
            'admin/destinations',
            'admin/icons',
            'admin/seasons',
            'admin/common-faqs',
           ]">

            <x-sidebar-item route="{{route('admin.packages.index')}}" name="Package" uri="admin/packages">
            </x-sidebar-item>
            <x-sidebar-item route="{{route('admin.journeys.index')}}" name="Package Types" uri="admin/journeys">
            </x-sidebar-item>

            @can('access-activity-page')
            <x-sidebar-item route="{{ route('admin.activities.index') }}" name="Activity" uri="admin/activities">
            </x-sidebar-item>
            @endcan

            @can('access-destination-page')
            <x-sidebar-item route="{{ route('admin.destinations.index') }}" name="Destination" uri="admin/destinations">
            </x-sidebar-item>
            @endcan

            @can('access-destination-category-page')
            <x-sidebar-item route="{{ route('admin.destination-categories.index') }}" name="Destination Category" uri="admin/destination-categories">
            </x-sidebar-item>
            @endcan

        </x-sidebar-multilist-head>

        <x-sidebar-multilist-head icon="bx bx-donate-heart" name="Package Helpers" :routes="[
            'admin/icons',
            'admin/seasons',
            'admin/common-faqs',
            'admin/services',
           ]">
            <x-sidebar-item route="{{route('admin.common-faqs.index')}}" name="Common Faqs" uri="admin/common-faqs">
            </x-sidebar-item>
            <x-sidebar-item route="{{route('admin.icons.index')}}" name="Icon" uri="admin/icons">
            </x-sidebar-item>
            <x-sidebar-item route="{{route('admin.seasons.index')}}" name="Seasons" uri="admin/seasons">
            </x-sidebar-item>
            <x-sidebar-item route="{{route('admin.services.index')}}" name="Services" uri="admin/services">
            </x-sidebar-item>
        </x-sidebar-multilist-head>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Frontend</span>
        </li>

        <x-sidebar-multilist-head icon="bx bx-group" name="Customer Data" :routes="[
            'admin/inquiries',
            'admin/package-reviews',
            'admin/testimonials',
            'admin/bookings',
           ]">
            <x-sidebar-item route="{{route('admin.bookings.index')}}" name="Bookings" uri="admin/bookings">
            </x-sidebar-item>
            <x-sidebar-item route="{{ route('admin.inquiries.index') }}" name="Inquiry" uri="admin/inquiries">
            </x-sidebar-item>
            <x-sidebar-item route="{{route('admin.package-reviews.index')}}" name="Package Reviews" uri="admin/package-reviews">
            </x-sidebar-item>
            <x-sidebar-item route="{{ route('admin.testimonials.index') }}" name="Testimonial" uri="admin/testimonials">
            </x-sidebar-item>
            <x-sidebar-item route="{{ route('admin.newsletters.index') }}" name="News Letter" uri="admin/newsletters">
            </x-sidebar-item>

        </x-sidebar-multilist-head>



        <x-sidebar-multilist-head icon="bx bx bx-book" name="Pages" :routes="[
              'admin/blogs',
             'admin/abouts/create',
             'admin/our-services/create',
             'admin/booking-forms/create',
             'admin/contact-uses/create',
             'admin/travel-diaries/create',
             'admin/teams',
             'admin/partners',

             ]">

            <x-sidebar-item route="{{ route('admin.abouts.create') }}" name="About Us" uri="admin/abouts/create">
            </x-sidebar-item>
            <x-sidebar-item route="{{ route('admin.blogs.index') }}" name="Blog" uri="admin/blogs">
            </x-sidebar-item>
            <x-sidebar-item route="{{ route('admin.booking-forms.create') }}" name="Booking Form" uri="admin/booking-forms/create">
            </x-sidebar-item>
            <x-sidebar-item route="{{ route('admin.contact-uses.create') }}" name="Contact Us" uri="admin/contact-uses/create">
            </x-sidebar-item>
            <x-sidebar-item route="{{ route('admin.our-services.create') }}" name="Our Services" uri="admin/our-services/create">
            </x-sidebar-item>
            <x-sidebar-item route="{{route('admin.teams.index')}}" name="Our Team" uri="admin/teams">
            </x-sidebar-item>
            <x-sidebar-item route="{{route('admin.partners.index')}}" name="Partners" uri="admin/partners">
            </x-sidebar-item>
            <x-sidebar-item route="{{ route('admin.travel-diaries.create') }}" name="Travel Diary" uri="admin/travel-diaries/create">
            </x-sidebar-item>

        </x-sidebar-multilist-head>

        <x-sidebar-item route="{{route('admin.pages.index')}}" name="Custom Pages" uri="admin/pages">
            <i class='menu-icon tf-icons bx bx-copy-alt'></i>
        </x-sidebar-item>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Settings</span>
        </li>

        @can('access-user-page')
        <x-sidebar-item route="{{route('admin.users.index')}}" name="Admin User" uri="admin/users">
            <i class="menu-icon tf-icons bx bx-user-circle"></i>
        </x-sidebar-item>
        @endcan

        <x-sidebar-item route="{{ route('admin.base-menus.index') }}" name="Menu" uri="admin/base-menus">
            <i class="menu-icon tf-icons bx bx-menu"></i>
        </x-sidebar-item>

        <x-sidebar-multilist-head icon="bx bx bx-cog" name="Settings" :routes="[
            'admin/setting/company-setting',
            'admin/email-templates',
            'admin/setting/seo-setting',
            'admin/setting/social-media-settings',
            'admin/setting/smtp-setting',
           ]">

            <x-sidebar-item route="{{ route('admin.setting.company') }}" name="Site Setting" uri="admin/setting/company-setting" />
            <x-sidebar-item route="{{ route('admin.email-templates.index') }}" name="Email Template" uri="admin/email-templates" />
            <x-sidebar-item route="{{ route('admin.setting.seo') }}" name="SEO Setting" uri="admin/setting/seo-setting" />
            <x-sidebar-item route="{{ route('admin.setting.social-media-settings.index') }}" name="Social Media" uri="admin/setting/social-media-settings" />
            <x-sidebar-item route="{{ route('admin.setting.smtp') }}" name="SMTP Setting" uri="admin/setting/smtp-setting" />
        </x-sidebar-multilist-head>

        @canany(['access-permission-page', 'access-role-page'])
        <x-sidebar-multilist-head icon="bx bx-check-shield" name="Roles & Permissions" :routes="['admin/permissions', 'admin/roles']">

            @can('access-permission-page')
            <x-sidebar-item route="{{ route('admin.permissions.index') }}" name="Permissions" uri="admin/permissions"></x-sidebar-item>
            @endcan
            @can('access-role-page')
            <x-sidebar-item route="{{ route('admin.roles.index') }}" name="Roles" uri="admin/roles"></x-sidebar-item>
            @endcan
        </x-sidebar-multilist-head>
        @endcanany
    </ul>
</aside>