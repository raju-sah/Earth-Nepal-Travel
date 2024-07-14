@extends('layouts.front_master')
@section('title', 'Hotel Booking')
@section('content')
<section class="services_content py-4"><!-- ./trips_event-->
  <div class="container">
    <h1 class="section_title">Hotel Booking</h1>
    <div class="row mt-4 row-gap-4">
      @foreach($hotels as $hotel )
      <div class="col col-md-3 col-sm-4 col-6">
        <figure class="box-wrap">
          <div class="top_rgt_box">{{ $hotel->price }}/{{ $hotel->rate_type }} </div>
          <a href="{{route('front.booking.index')}}"><img src="{{ $hotel->image_path }}" alt=""></a>
        </figure>
        <div class="btm_fixed-box">
          <h5><a href="{{route('front.booking.index')}}">{{ $hotel->title }}</a></h5>
          <span>{{ $hotel->location }}</span> <a href="{{route('front.booking.index')}}" class="btn  book_btn">Book now</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection