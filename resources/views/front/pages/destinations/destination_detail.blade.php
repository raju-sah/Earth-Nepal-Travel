@extends('layouts.front_master')

@section('title', optional($destinationDetails)->title)

@push('front_css')
<style>
  .expedition_caption .expedition_wrapper p {
    overflow: hidden;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    text-overflow: ellipsis;
    display: -webkit-box;
  }
</style>
@endpush

@section('content')
<section class="introduction_content pt-5">
  <div class="container">
    <div class="text-wrapper row">
      <div class="col-sm-12">
        <h1 class="section_title mb-3">{{ optional($destinationDetails)->title }}</h1>
        <figure class="float-right ml-md-3 mb-2 mb-sm-3 mw-sm-50"> <a href="#"><img src="{{optional($destinationDetails)->image_path}}" alt=""></a> </figure>
        <figcaption>
          <p>{!! optional($destinationDetails)->description !!}</p>
        </figcaption>
      </div>
    </div>
  </div>
</section>
<section class="deal-section">
  <div class="container">
    <h2 class="section_title mb-3"> Related Packages </h2>
    <div class="row">
      @foreach($relatedPackages as $related_package)
      <div class="col-md-3 col-sm-6 mb-5"> <a href="#">
          <figure class="expedition_img"> <img src="{{optional($related_package)->banner_path}}" alt="{{optional($related_package)->title}}">
            <div class="tour-review"> <span class="reviews-stars">
                {!! str_repeat('<i class="fa-solid fa-star"></i>', optional($related_package)->reviews_avg_rating) !!}
              </span> <span class="reviews-count ml-1">({{optional($related_package)->reviews_avg_rating}})</span>
            </div>
            <div class="price_box circle_box"> <span>From {{optional($related_package)->price}}</span> </div>
          </figure>
        </a>
        <figcaption class="expedition_caption">
          <div class="expedition_wrapper">
            <h4>{{optional($related_package)->title}}</h4>
            {!! $related_package->overview !!}

          </div>
        </figcaption>
      </div>
      @endforeach
    </div>
  </div>
</section>
<section class="destination-section">
  <div class="container">
    <h2 class="section_title mb-3"> Destinations </h2>
    <div class="row">
      @foreach($otherDestinations as $other_destination)
      <div class="col-md-3 col-sm-4 mb-5"> <a href="{{route('front.destinations.show', optional($other_destination)->slug)}}">
          <figure class="expedition_img"> <img src="{{optional($other_destination)->image_path}}" alt="{{optional($other_destination)->title}}">
            <figcaption class="expedition_caption">
              <div class="box_caption">
                <h3>{{optional($other_destination)->title}}</h3>
              </div>
            </figcaption>
          </figure>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- // Table wrapper starts-->
<section class="table_wrapper">
  <div class="container">
    <h1 class="section_title"> Get Heavy Discount This Season </h1>
  </div>
  <div class="table_head">
    <div class="container">
      <table>
        <tbody>
          <tr>
            <th class="image"> </th>
            <th class="destination">Destination</th>
            <th class="price">Price</th>
            <th class="season">SEASon</th>
            <th class="night">Nights</th>
            <th class="discount">Discount</th>
            <th class="explore">Action</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="table_inner">
    <div class="container">
      <table>
        <tbody>
          <tr>
            <td class="image">
              <figure><img src="images/t-1.png" alt=""></figure>
            </td>
            <td class="destination"><span>10 days Trekking & Active Tour</span></td>
            <td class="price"><span class="us">US $ 575</span> <span class="npr">Rs.47,749</span></td>
            <td class="season"><span>15 Sep-15 Jun</span></td>
            <td class="night"><span>2N Kathmandu, 2N Pokhara, 5N Himalayas</span></td>
            <td class="discount"><a href="#" class="btn discount_btn">30% Discount</a></td>
            <td class="explore"><a href="#" class="btn view_btn">EXPLORE</a></td>
          </tr>
          <tr>
            <td class="image">
              <figure><img src="images/t-2.png" alt=""></figure>
            </td>
            <td class="destination"><span>10 days Trekking & Active Tour</span></td>
            <td class="price"><span class="us">US $ 575</span> <span class="npr">Rs.47,749</span></td>
            <td class="season"><span>15 Sep-15 Jun</span></td>
            <td class="night"><span>2N Kathmandu, 2N Pokhara, 5N Himalayas</span></td>
            <td class="discount"><a href="#" class="btn discount_btn">30% Discount</a></td>
            <td class="explore"><a href="#" class="btn view_btn">EXPLORE</a></td>
          </tr>
          <tr>
            <td class="image">
              <figure><img src="images/t-3.png" alt=""></figure>
            </td>
            <td class="destination"><span>10 days Trekking & Active Tour</span></td>
            <td class="price"><span class="us">US $ 575</span> <span class="npr">Rs.47,749</span></td>
            <td class="season"><span>15 Sep-15 Jun</span></td>
            <td class="night"><span>2N Kathmandu, 2N Pokhara, 5N Himalayas</span></td>
            <td class="discount"><a href="#" class="btn discount_btn">30% Discount</a></td>
            <td class="explore"><a href="#" class="btn view_btn">EXPLORE</a></td>
          </tr>
          <tr>
            <td class="image">
              <figure><img src="images/t-2.png" alt=""></figure>
            </td>
            <td class="destination"><span>10 days Trekking & Active Tour</span></td>
            <td class="price"><span class="us">US $ 575</span> <span class="npr">Rs.47,749</span></td>
            <td class="season"><span>15 Sep-15 Jun</span></td>
            <td class="night"><span>2N Kathmandu, 2N Pokhara, 5N Himalayas</span></td>
            <td class="discount"><a href="#" class="btn discount_btn">30% Discount</a></td>
            <td class="explore"><a href="#" class="btn view_btn">EXPLORE</a></td>
          </tr>
          <tr>
            <td class="image">
              <figure><img src="images/t-3.png" alt=""></figure>
            </td>
            <td class="destination"><span>10 days Trekking & Active Tour</span></td>
            <td class="price"><span class="us">US $ 575</span> <span class="npr">Rs.47,749</span></td>
            <td class="season"><span>15 Sep-15 Jun</span></td>
            <td class="night"><span>2N Kathmandu, 2N Pokhara, 5N Himalayas</span></td>
            <td class="discount"><a href="#" class="btn discount_btn">30% Discount</a></td>
            <td class="explore"><a href="#" class="btn view_btn">EXPLORE</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

@endsection