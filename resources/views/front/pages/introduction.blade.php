@extends('layouts.front_master')
@section('title', 'Introduction')
@section('content')
<section class="introduction_content py-5">
  <div class="container">
    <div class="text-wrapper row">
      <div class="col-sm-12">
        <h1 class="section_title mb-3"> {{ $page->name }} </h1>
        <figure class="float-right ml-md-3 mb-3 mw-sm-50"> <a href="#"><img src="{{$page->image_path}}" alt=""></a> </figure>
        <figcaption>
          <p>{!! $page->description !!}</p>

        </figcaption>
      </div>
    </div>
  </div>
</section>

@endsection