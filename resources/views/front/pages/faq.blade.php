@extends('layouts.front_master')
@section('title', 'FAQ')
@section('content')

<section class="faq py-5">
  <div class="container">
    <h1 class="section_title"> FAQ </h1>

    <div class="my-5">
      @foreach($faqs as $faq)
      <div id="accordion">
        <div class="card">
          <div class="card-header" id="heading{{ $faq->id }}">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}"> {{$faq->question}}</button>
            </h5>
          </div>
          <div id="collapse{{ $faq->id }}" class="collapse show" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordion">
            <div class="card-body"> {!! $faq->answer !!}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

</section>

@endsection