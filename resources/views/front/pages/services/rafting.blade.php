@extends('layouts.front_master')
@section('title', 'Rafting')
@section('content')
<section class="services_content py-4"><!-- ./trips_event-->
  <div class="container">
    <h1 class="section_title">Rafting</h1>
    <div class="row mt-4 row-gap-4">
      @foreach($raftings as $rafting )
      <div class="col col-md-3 col-sm-4 col-6">
        <figure class="box-wrap"> <a href="{{route('front.booking.index')}}"><img src="{{ $rafting->image_path }}" alt=""></a> </figure>
        <div class="btm_fixed-box">
          <h5><a href="{{route('front.booking.index')}}">{{ $rafting->title }}</a></h5>
          <span>{{ $rafting->location }}</span> <a href="{{route('front.booking.index')}}" class="btn  book_btn">Book now</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!-- ./trips_event-->

@endsection