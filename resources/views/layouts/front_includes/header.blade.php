<!--../header starts-->
<header class="main_header">
  <div class="topbar">
    <div class="container">
      <address class="top-contact-address topbar-items">
        <ul class="contact">
          <li>
            <figure class="icon"><i class="fa-solid fa-envelope"></i></figure>

            @php
            $emails = explode(',', $setting->email);
            @endphp
            <div class="details"><a href="mailto:{{$emails[0]}}" class="email">{{$emails[0]}}</a> </div>
          </li>
          <li>
            <figure class="icon"><i class="fa-solid fa-phone"></i></figure>
            <div class="details">
              <a href="tel:{{ optional($setting)->phone }}" class="call">{{ optional($setting)->phone }}</a>
            </div>
          </li>
        </ul>
        <ul class="social_icon">
          <li><a href="{{optional($socialMediaSettings[0])->social_link}}" target="_blank"><i class="fa-brands fa-facebook-f"></i> </a></li>
          <li><a href="{{optional($socialMediaSettings[1])->social_link}}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
          <li><a href="{{optional($socialMediaSettings[2])->social_link}}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
          <li><a href="{{optional($socialMediaSettings[3])->social_link}}" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
        </ul>
      </address>
    </div>
  </div>
  <div id="pav-mainnav"><!-- ./pav-mainnav-->
    <div class="navigation-bar"><!-- ./navigation-bar-->
      <div class="container">
        <div class="row nav-row">
          <div class="col col-sm-9 col-md-5">
            <figure class="logo_holder ">
              <a href="{{url('/')}}">
                <img src="{{optional($setting)->logo_path}}" alt="">
              </a>
              <a href="{{route('front.booking.index')}}" class="booking_btn"> <img src="{{asset('front-assets/images/Frame 326.png')}}" alt=""> </a>
            </figure>
          </div>
          <div class="col col-sm-3 col-md-7">
            <div id="mainContent">
              <div id="myCanvasNav" class="overlay3" onclick="closeOffcanvas()" style="width: 0%; opacity: 0;"></div>
              <div id="myOffcanvas" class="offcanvas">
                <div class="navbar navbar-default" role="navigation"> <!--//Navbar -->
                  <div class="side_nav"><!--nav-collapse-->
                    <ul class="nav navbar-nav">
                      <li><a href="{{url('/')}}"> Home </a> </li>
                      <li><a href="#"> About Us <span class="caret"></span> <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="{{route('front.introduction.show')}}">Introduction</a></li>
                          <li><a href="{{route('front.team.index')}}">Our Team </a></li>
                          <li><a href="{{route('front.testimonial.index')}}">Testimonial</a></li>
                          <li><a href="{{route('front.faq.index')}}">FAQ</a></li>
                        </ul>
                      </li>
                      <li><a href="#"> Services <span class="caret"></span> <i class="fa-solid fa-chevron-down"></i> </a>
                        <ul class="dropdown-menu">
                          <li><a href="{{route('front.services.hotel')}}">Hotel Booking</a></li>
                          <li><a href="{{route('front.services.flight')}}">Flight</a></li>
                          <li><a href="{{route('front.services.rafting')}}">Rafting</a></li>
                        </ul>
                      </li>
                      <li><a href="#"> Destinations<span class="caret"></span>
                          <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                          @foreach($destination_parent_menus as $key => $value)
                          <li class="has-child">
                            <a href="{{ route('front.destinations.show', $key) }}">{{ $value }} <span class="caret"></span></a>
                          </li>
                          @endforeach
                        </ul>
                      </li>

                      <li><a href="{{route('front.packages.index')}}"> Packages <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                          @foreach($package_parent_menus as $key => $value)
                          <li><a href="{{ route('front.packages.show', $key) }}">{{ $value }}</a></li>
                          @endforeach
                        </ul>
                      </li>
                      <li><a href="{{route('front.contact.index')}}"> Contact us</a> </li>
                    </ul>
                  </div>
                  <!--/.nav-collapse -->
                </div>
                <!--//Navbar -->
              </div>
              <!--offcanvas-->
              <button type="button" class="navbar-toggle" id="hamburger" data-toggle="collapse" data-target=".navbar-collapse" onclick="openNav3();openOffcanvas()"> <span class="toggle-bar" id="toggle"></span> <span id="close" style="display: none;"><i class="fa-solid fa-xmark"></i></span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ./navigation-bar-->
  </div>
  <!-- ./pav-mainnav-->
</header>
<!--../header ends-->