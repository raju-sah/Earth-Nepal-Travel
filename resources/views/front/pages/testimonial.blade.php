@extends('layouts.front_master')
@section('title', 'Testimonial')
@section('content')
<section class="testimonial_detail py-5">
    <div class="container">
        <h1 class="section_title"> Testimonial </h1>
        @foreach($testimonials as $testimonial)
        <div class="mt-5">
            <div class="testimonial_wrapper">
                <figure class="testi_image"> <img src="{{$testimonial->image_path}}" alt="">
                    <author class="testi_author pl-2">
                        <h4>{{$testimonial->name}}</h4>
                        <div class="d-block d-md-flex"> <a href="mailto:{{$testimonial->email}}">{{$testimonial->email}}</a>
                            <span class="reviews-stars">
                                {!! str_repeat('<i class="fa-solid fa-star"></i>', $testimonial->rating) !!}
                            </span>
                        </div>
                    </author>
                </figure>
                <div class="testi_content text-wrapper">
                    <p>{{$testimonial->description}}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</section>

@endsection