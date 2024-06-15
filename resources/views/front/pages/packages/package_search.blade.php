@extends('layouts.front_master')
@section('title', 'Packages Search')
@section('content')

<section class="billboard inner-page-banner">
    <figure class="breadCrumbNav-img"><img src="{{asset('front-assets/images/inner_banner.png')}}" alt="inner banner image"></figure>
    <div class="bg-card-img-overlay">
        <div class="breadCrumbNav">
            <div class="container breadcrumb-container">
                <h1 class="breadCrumb_title"> Packages Search </h1>
            </div>
        </div>
    </div>
</section>
<section class="destination_content my-5">
    <div class="container">
        <div class="row">
            @include('front._partials._package_filter_sidebar')
            <div class="col-lg-9 col-md-8">
                <div class="filter_category_wrapper">
                    <div class="filter_item form-group filter_sort">
                        <span>Showing <span id="results">10</span> out of 11</span>
                    </div>
                </div>
                <div class="row special_package row-gap-4">
                    @include('front.pages.packages.package_list')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection