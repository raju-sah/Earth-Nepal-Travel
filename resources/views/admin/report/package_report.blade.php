@extends('layouts.master')
@section('title', 'Package Report')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Package Reports"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.package-reports.index') }}" method="GET">
                    <div class="d-flex align-items-end">
                        <x-form.select label="Select Package" col="10" :option-display="false" class="select_two_packages" :options="$packages" name="package" required
                                       value="{{ $filtered_package?->id }}" selected/>
                        <div class="col-md-2">
                            <x-form.button class="btn btn-dark ms-3" type="submit"><i class='bx bx-xs bxs-report'></i> Generate Report</x-form.button>
                        </div>
                    </div>
                </x-form.wrapper>
            </div>
        </div>
        @if($filtered_package)

            <div class="card mt-2">

                <div class="card-body">

                    <form action="{{route('admin.package.generate-pdf', $filtered_package->id )}}" method="GET">
                        <input type="hidden" name="package_id" value="{{ $filtered_package->id }}">
                        <button type="submit" class="btn btn-sm btn-warning"><i class='bx bx-xs bxs-file-pdf'></i>Download PDF</button>
                    </form>

                    <div class="title-section d-flex align-items-center justify-content-between mb-2">
                        <span class="fw-bold fs-3">{{ $filtered_package->title }}</span>
                        <span class=" mt-2"><i class="bx bx-show-alt"></i>{{$filtered_package->view_count}} Views</span>
                        <div class="d-flex align-items-end ms-3">
                            <span>Average Rating:
                                @for($i = 0; $i < $filtered_package->reviews_avg_rating; $i++)
                                    <i class='bx bxs-star' style="color: #ffc700;"></i>
                                @endfor
                            </span>
                            <span>({{ $filtered_package->reviews_avg_rating }} {{ Str::plural('Star', $filtered_package->reviews_avg_rating) }})</span>
                        </div>
                    </div>

                    <div class="row border-top py-3">
                        <div class="col-xl-3 col-md-3">
                            <div class="card-content">
                                <b class="d-block text-uppercase text-14">Banner image</b>
                                <x-table.table_image name="{{$filtered_package->id }}" url="{{$filtered_package->banner_path}}" height="100px" width="200px"/>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-2">
                            <div class="card-content">
                                <b class="d-block text-uppercase text-14">Package Type</b>
                                <span class="badge bg-primary">{{ $filtered_package->journey_type ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-2">
                            <div class="card-content">
                                <b class="d-block text-uppercase text-14">Highlight</b>
                                <span class="badge bg-primary">{{ $filtered_package->highlight }}</span>
                            </div>
                        </div>


                        <div class="col-xl-2 col-md-2">
                            <div class="card-content">
                                <b class="d-block text-uppercase text-14">Itineraries</b>
                                <span>({{ $filtered_package->itineraries_count }})</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-2">
                            <div class="card-content">
                                <b class="d-block text-uppercase text-14">Equipments</b>
                                <span>({{$filtered_package->equipments_count }})</span>
                            </div>
                        </div>
                    </div>
                    <!--------------------Inquiries------------------->
                    <div class="row border-top py-3">
                        <h3 class="border-bottom py-3">Inquiries ({{$filtered_package->inquiries_count }})</h3>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Created at</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($inquiries as $inquiry)
                                <tr>
                                    <td>{{$inquiry->name}}</td>
                                    <td>{{$inquiry->email}}</td>
                                    <td>{{$inquiry->phone}}</td>
                                    <td>{{$inquiry->subject}}</td>
                                    @php
                                        $formattedDate = (new DateTime($inquiry->created_at))
                                        ->setTimezone(new DateTimeZone('Asia/Kathmandu'))
                                        ->format('dS M Y g:i A');
                                    @endphp
                                    <td>{{$formattedDate}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>


                    <div class="row border-top py-3">
                        <h3>Reviews ({{$filtered_package->reviews_count }})</h3>
                        <!--------------------Highest Ratings------------------->
                        <div class=" border-top py-3 border-bottom">
                            <div class=" d-flex align-items-center border-bottom mb-2 ">
                                <span class="fw-bold fs-5">Top (3) Highest Ratings:</span>
                                @for($i = 0; $i < $filtered_package->highest_rating; $i++)
                                    <i class='bx bxs-star' style="color: #ffc700;"></i>
                                @endfor
                                <span>({{ $filtered_package->highest_rating }} {{ Str::plural('Star', $filtered_package->highest_rating) }})</span>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Rating</th>
                                    <th>Created at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($highest_ratings as $highest_rating)
                                    <tr>
                                        <td>{{$highest_rating->fullname}}</td>
                                        <td>{{$highest_rating->email}}</td>
                                        <td>{{$highest_rating->rating}}/5 {{ Str::plural('Star', $highest_rating->rating) }}</td>
                                        @php
                                            $formattedDate = (new DateTime($highest_rating->created_at))
                                            ->setTimezone(new DateTimeZone('Asia/Kathmandu'))
                                            ->format('dS M Y g:i A');
                                        @endphp
                                        <td>{{$formattedDate}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--------------------Lowest Ratings------------------->
                        <div class="border-top py-3 border-bottom">
                            <div class="d-flex align-items-center border-bottom mb-2">
                                <span class="fw-bold fs-5">Top (3) Lowest Ratings:</span>
                                @for($i = 0; $i < $filtered_package->lowest_rating; $i++)
                                    <i class='bx bxs-star' style="color: #ffc700;"></i>
                                @endfor

                                <span>({{ $filtered_package->lowest_rating }} {{ Str::plural('Star', $filtered_package->lowest_rating) }})</span>

                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Rating</th>
                                    <th>Created at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lowest_ratings as $lowest_rating)
                                    <tr>
                                        <td>{{$lowest_rating->fullname}}</td>
                                        <td>{{$lowest_rating->email}}</td>
                                        <td>{{$lowest_rating->rating}}/5 {{ Str::plural('Star', $lowest_rating->rating) }}</td>
                                        @php
                                            $formattedDate = (new DateTime($lowest_rating->created_at))
                                            ->setTimezone(new DateTimeZone('Asia/Kathmandu'))
                                            ->format('dS M Y g:i A');
                                        @endphp
                                        <td>{{$formattedDate}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!---------------Latest Ratings------------------->
                        <div class="border-top py-3 border-bottom">
                            <div class="d-flex align-items-center border-bottom mb-2">
                                <span class="fw-bold fs-5">Top (5) Latest Ratings:</span>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Rating</th>
                                    <th>Created at</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($latest_ratings as $latest_rating)
                                    <tr>
                                        <td>{{$latest_rating->fullname}}</td>
                                        <td>{{$latest_rating->email}}</td>
                                        <td>{{$latest_rating->rating}}/5 {{ Str::plural('Star', $latest_rating->rating) }}</td>
                                        @php
                                            $formattedDate = (new DateTime($latest_rating->created_at))
                                            ->setTimezone(new DateTimeZone('Asia/Kathmandu'))
                                            ->format('dS M Y g:i A');
                                        @endphp
                                        <td>{{$formattedDate}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('custom_js')
    <script>
        $(document).ready(function () {
            $('.select_two_packages').select2({
                placeholder: 'Select Packages'
            }).val('{{ $filtered_package?->id }}').trigger('change');
        });
    </script>
@endpush
