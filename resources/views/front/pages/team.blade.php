@extends('layouts.front_master')
@section('title', 'Team')
@section('content')
<section class="team_content py-5">
    <div class="container">
        <h1 class="section_title"> Our Team </h1>
        <div class="row justify-content-center row-gap-5 my-5">
            @foreach($teams as $team)
            <div class="col col-6 col-sm-4 col-md-3">
                <figure class="team_img img-circle"> <img src="{{$team->image_path}}" alt=""> </figure>
                <figcaption class="team_caption">
                    <h4>{{$team->name}}</h4>
                    <span>{{$team->designation}}</span>
                    <ul class="team-social-icons d-flex">
                        @php
                        $social_datas = json_decode($team->social_media,true);
                        @endphp
                        <li><a href="{{ $social_datas[0] ?? ''}}" title=""><i class="fab fa-facebook-f"></i> </a></li>
                        <li><a href="{{ $social_datas[1] ?? ''}}" title=""><i class="fab fa-twitter"></i> </a></li>
                        <li><a href="{{ $social_datas[2] ?? ''}}" title=""><i class="fab fa-instagram"> </i> </a></li>
                    </ul>
                </figcaption>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection