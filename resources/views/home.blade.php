@extends('layouts.master')
@section('title', 'Dashboard')

@push('custom_css')
    <style>
        .select2-container select2-container--default {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')

    <div class="container-xxl">

        <div class="row">
            <div class="col-sm-6 col-lg-3 mb-4">
                <x-dashboard.stat-card icon="bx bx-user" color="dark" name="Users" count="{{$user_count}}" link="{{route('admin.users.index')}}"/>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <x-dashboard.stat-card icon="bx bx-package" color="primary" name="Packages" count="{{$package_count}}" link="{{route('admin.packages.index')}}"/>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <x-dashboard.stat-card icon="bx bxs-plane-alt" color="danger" name="Destinations" count="{{$destination_count}}" link="{{route('admin.destinations.index')}}"/>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <x-dashboard.stat-card icon="bx bx-walk" color="success" name="Activities" count="{{$activity_count}}" link="{{route('admin.activities.index')}}"/>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-lg-3 mb-4">
                <x-dashboard.stat-card icon="bx bx-buildings" color="warning" name="Services" count="{{$service_count}}" link="{{route('admin.services.index')}}"/>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <x-dashboard.stat-card icon="bx bx-group" color="secondary" name="Teams" count="{{$team_count}}" link="{{route('admin.teams.index')}}"/>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <x-dashboard.stat-card icon="bx bx-phone-incoming" color="info" name="Inquiries" count="{{$inquiry_count}}" link="{{route('admin.inquiries.index')}}"/>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <x-dashboard.stat-card icon="bx bx-star" color="warning" name="Testimonials" count="{{$testimonial_count}}" link="{{route('admin.testimonials.index')}}"/>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Top 5 highest rated packages</h4>
                    </div>
                    <div class="card-body">
                        <div id="top_rated_packages"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Package Based Inquiry Chart</h4>
                        <form id="package_inquiry_form">
                            <div class="row align-items-end mb-2">

                                <div class="col">
                                    <x-form.select label="Select Package" :option-display="false" class="select_two_packages" :options="$packages" name="package_id" required/>
                                </div>

                                <div class="col">
                                    <label for="date_range" class="col-form-label">Select Date </label>
                                    <x-datepicker id="date_range"/>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-info"><i class='bx bx-xs bx-search-alt'></i> Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div id="package_inquiry_chart"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('custom_js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @include('_helpers.datepicker')
    <script>
        $(document).ready(function () {
            $('.select_two_packages').select2({
                placeholder: 'Select Packages'
            }).val(null).trigger('change');

            initializeDatepicker('date_range');

            //--------------------------------------------------------------- Package Inquiry Chart
            $('#package_inquiry_form').on('submit', function (e) {
                e.preventDefault();
                packageInquiryChart();
            });

            function packageInquiryChart() {
                $.ajax({
                    url: '{{route('admin.package-based-inquiries')}}',
                    type: 'GET',
                    data: {
                        package_id: $('#package_id').val(),
                        from_date: $('#from_date_date_range').val(),
                        to_date: $('#to_date_date_range').val()
                    },
                    success: function (response) {
                        updatePackageInquiryChart(response.data);
                    }
                });
            }

            function updatePackageInquiryChart(data) {
                if (window.chartInstance) {
                    window.chartInstance.destroy();
                }

                let options = {
                    series: [{
                        name: "Package Inquiries",
                        data: data.map(function (item) {
                            return {x: item.x, y: item.y};
                        })
                    }],
                    chart: {
                        height: 300, type: 'line',
                        zoom: {type: 'x', enabled: true, autoScaleYaxis: true,},
                        toolbar: {autoSelected: 'zoom', tools: {pan: false, selection: false,}}
                    },
                    xaxis: {
                        type: 'datetime',
                        labels: {
                            datetimeFormatter: {
                                year: 'yyyy',
                                month: 'MMM \'yy',
                                day: 'dd MMM yyyy'
                            }
                        }
                    },
                    yaxis: {title: {text: 'Number of Inquiries'}},
                    stroke: {curve: 'smooth'},
                    markers: {size: 5},
                };

                window.chartInstance = new ApexCharts(document.querySelector("#package_inquiry_chart"), options);
                window.chartInstance.render();
            }

            //--------------------------------------------------------------- Highest Rated Packages Chart
            topRatedPackagesChart();

            function topRatedPackagesChart() {
                $.ajax({
                    url: '{{route('admin.top-rated-packages')}}',
                    type: 'GET',
                    success: function (response) {
                        updateTopRatedPackagesChart(response.data);
                    }
                });
            }

            function updateTopRatedPackagesChart(data) {
                if (window.topRatedChartInstance) {
                    window.topRatedChartInstance.destroy();
                }

                let options = {
                    chart: {
                        type: 'bar',
                        height: '300px',
                    },
                    series: [{
                        name: 'Average Rating',
                        data: data.map(function (item) {
                            return {x: item.x, y: item.y};
                        })
                    }],
                    yaxis: {title: {text: 'Average Rating'}},
                };

                window.topRatedChartInstance = new ApexCharts(document.querySelector("#top_rated_packages"), options);
                window.topRatedChartInstance.render();
            }
        });
    </script>
@endpush
