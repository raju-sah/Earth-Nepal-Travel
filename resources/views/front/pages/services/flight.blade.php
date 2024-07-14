@extends('layouts.front_master')
@section('title', 'Flight')
@section('content')
<section class="services_content py-4"><!-- ./trips_event-->
  <div class="container">
    <h1 class="section_title">Flight</h1>
    <div class="row mt-4 row-gap-4">
      @foreach($flights as $flight )
      <div class="col col-md-3 col-sm-4 col-6">
        <figure class="box-wrap"> <a href="{{route('front.booking.index')}}"><img src="{{ $flight->image_path }}" alt=""></a> </figure>
        <div class="btm_fixed-box">
          <h5><a href="{{route('front.booking.index')}}">{{ $flight->title }}</a></h5>
          <span>{{ $flight->location }}</span> <a href="{{route('front.booking.index')}}" class="btn  book_btn">Book now</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection