@extends('layouts.front_master')

@section('content')

<div class="trip-wrapper">
    <div class="container">
        <div class="text-center text_caption">
            <h1>“EXPLORE, DREAM, <span>WANDER</span>”</h1>
            <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit</strong>
        </div>
        <form id="package_search_form" action="{{ route('front.search') }}" method="GET" role="form">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav" data-smartmenus-id="171334240746038">
                    <div class="select_dropdown">
                        <figure class="icon"> <i class="fa-solid fa-location-dot"></i> </figure>
                        <select name="destination" id="" class="form-control">
                            <option value="" selected="">Destinations</option>
                            @foreach($destinations as $slug => $title)
                            <option value="{{$slug}}">{{$title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <figure class="icon"> <i class="fa-solid fa-hiking"></i> </figure>
                        <select name="activity" id="" class="form-control">
                            <option value="0" selected="">Activity</option>
                            @foreach($activities as $slug => $title)
                            <option value="{{$slug}}">{{$title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select_dropdown">
                        <figure class="icon"> <i class="fa-solid fa-earth-europe"></i> </figure>
                        <select name="country" id="" class="form-control">
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cabo Verde">Cabo Verde</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
                            <option value="Congo, Republic of the">Congo, Republic of the</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Eswatini">Eswatini</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Greece">Greece</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea, North">Korea, North</option>
                            <option value="Korea, South">Korea, South</option>
                            <option value="Kosovo">Kosovo</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="North Macedonia">North Macedonia</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestine">Palestine</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-Leste">Timor-Leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>

                    <button class="select_dropdown search_dropdown" type="submit"> <i class="fa-solid fa-magnifying-glass"></i> Search </button>
                </ul>
            </nav>
        </form>
    </div>
</div>
<!-- //trip wrapper ends -->

<!-- ===============./BILLBOARD STARTS HERE=======================-->
<section class="billboard mainslider">

    <!-- ===./HOMEPAGE  SLIDER STARTS====-->
    <!-- ===./MAIN SLIDER STARTS====-->
    <div class="container billboard_container">

    </div>
    <div class="owl-carousel owl-theme">
        <div class="item">
            <div class="bg-overlay"></div>
            <figure> <img src="{{asset('front-assets/images/slide01.png')}}" alt=""> </figure>
            <div class="container">
                <div class="card-caption">
                    <div class="card-title">
                        <!-- <h1>Our Top-rated <span> Destinations </span></h1> -->
                        <a href="#" class="btn view_btn">Explore </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="bg-overlay"></div>
            <figure> <img src="{{asset('front-assets/images/slider2.png')}}" alt=""> </figure>
            <div class="container">
                <div class="card-caption">
                    <div class="card-title">
                        <!-- <h1>Our Top-rated <span> Destinations </span></h1> -->
                        <a href="#" class="btn view_btn">Explore </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===./MAIN SLIDER ENDS====-->
    <!-- ====./HOMEPAGE  SLIDER ENDS====-->

</section>
<!-- ===============./BILLBOARD ENDS HERE=======================-->

<!-- HOT TRIP STARTS-->
<section class="hot_trip">
    <div class="container">
        <h1 class="section_title"> HOT TRIPS </h1>
        <div class="row">
            <div class="col col-lg-4 col-md-6 col-sm-6 pulse animatable"> <a href="#">
                    <figure class="trip_img"> <img src="images/trip1.jpg" alt=""> </figure>
                </a>
                <figcaption class="trip_content">
                    <div class="trip_caption top_caption">
                        <h2>Ghorepani - Poon hill Trek</h2>
                        <span class="reviews-stars"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span> <span class="count"> (12 reviews) </span>
                    </div>
                    <div class="divider_caption">
                        <p>Starting from <b>$ 20 </b> per Person</p>
                    </div>
                    <div class="trip_caption bottom_caption">
                        <ul>
                            <li>
                                <figure class="icon"><i class="fa-solid fa-location-dot"></i> </figure>
                                <div class="details"> <span>Annapurna region, Nepal</span> </div>
                            </li>
                            <li>
                                <figure class="icon"><i class="fa-regular fa-clock"></i></figure>
                                <div class="details"> <span>5-7 days</span> </div>
                            </li>
                            <li>
                                <figure class="icon"><i class="fa-solid fa-person-hiking"></i></figure>
                                <div class="details"> <span>Trekking</span> </div>
                            </li>
                            <li> <a href="#" class="btn view_btn">Explore </a> </li>
                        </ul>
                    </div>
                </figcaption>
            </div>



        </div>
    </div>
</section>
<!-- HOT TRIP ENDS -->

<!-- //Thrilling wrapper Starts here-->
<section class="thrilling_wrapper">
    <div class="container mw-none">
        <div class="row align-items-center">
            <div class="col-lg-7 px-2 px-sm-0 fadeInLeft animatable">
                <figure class="thrill_image"> <img src="{{asset('front-assets/images/thrill_banner.png')}}" alt=""> </figure>
            </div>
            <div class="col-lg-5 px-2 px-sm-0 fadeInRight animatable">
                <figcaption class="thrill_caption pl-3 py-4 pl-md-5">
                    <h1 class="section_title"> Our <span>Thrilling activities</span> </h1>
                    <p>Experience Unforgettable Travel Experience</p>
                    <ul class="row mt-5">
                        <li class="col-sm-6">
                            <figure class="icon">
                                <!-- <i class="fa-solid fa-location-dot"></i>-->
                                <img src="images/trek.png" alt="">
                            </figure>
                            <span>Trekking</span>
                        </li>

                        <li class="col-sm-6">
                            <figure class="icon">
                                <!-- <i class="fa-solid fa-person-hiking"></i> -->
                                <img src="images/paragliding.png" alt="">
                            </figure>
                            <span>Paragliding In Nepal</span>
                        </li>
                        <li class="col-sm-6">
                            <figure class="icon">
                                <!-- <i class="fa-solid fa-person-hiking"></i> -->
                                <img src="images/circuit_trek.png" alt="">
                            </figure>
                            <span>Circuit Trek</span>
                        </li>
                    </ul>
                </figcaption>
            </div>
        </div>
    </div>
</section>
<!-- Thrilling wrapper ends here-->

<!-- // Review Section starts-->
<section class="review_section">
    <div class="container">
        <div class="d-flex">
            <figure> <img src="{{asset('front-assets/images/quote_mark.png')}}" alt=""> </figure>
            <figcaption>
                <h1 class="section_title"> Reviews </h1>
                <p class="quote">Share us your Travel Experiences & Stories</p>
            </figcaption>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-6 fadeInLeft animatable">
                <div class="review_form">
                    <form id="testimonial_form" role="form" enctype="multipart/form-data">
                        <input type="text" id="po_p" name="po_p" style="opacity: 0; height: 0;" value="">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="control-label">Full Name<span class="text-danger">*</span> </label>
                                <input class="form-control" type="text" name="name" placeholder="Full Name">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="control-label">Email Address <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" placeholder="Email Id">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="control-label">Nationality <span class="text-danger">*</span> </label>
                                <div class="select_dropdown">
                                    <select name="nationality" class="form-control">
                                        <option value="" selected>Choose Nationality</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cabo Verde">Cabo Verde</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
                                        <option value="Congo, Republic of the">Congo, Republic of the</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Eswatini">Eswatini</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, North">Korea, North</option>
                                        <option value="Korea, South">Korea, South</option>
                                        <option value="Kosovo">Kosovo</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="North Macedonia">North Macedonia</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Sudan">South Sudan</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-Leste">Timor-Leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City">Vatican City</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="control-label">Upload your Photo </label>
                                <div class="file-up-btn form-control">
                                    <span>Upload Photo</span>
                                    <img src="{{ asset('front-assets/images/upload1.png') }}" alt="">
                                    <input type="file" class="file-up" name="image" accept="image/*">
                                </div>
                                <small class="max-size">Max 500 KB file size</small>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="control-label">Rate Us </label>
                                <div class="star-rating">
                                    <input id="star-5" type="radio" name="rating" value="5" />
                                    <label for="star-5" title="5 star">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                    <input id="star-4" type="radio" checked name="rating" value="4" />
                                    <label for="star-4" title="4 stars">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                    <input id="star-3" type="radio" name="rating" value="3" />
                                    <label for="star-3" title="3 stars">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                    <input id="star-2" type="radio" name="rating" value="2" />
                                    <label for="star-2" title="2 stars">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                    <input id="star-1" type="radio" name="rating" value="1" />
                                    <label for="star-1" title="1 star">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="control-label">Review</label>
                                <textarea class="form-control" name="description" placeholder="Write Something" rows="5"></textarea>
                            </div>
                            <div class="form-group col-sm-12">
                                <button class="btn view_btn send_btn" type="submit">SEND</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="offset-lg-2 col-lg-5 col-md-6 fadeInLeft animatable">
                <div class="review_banner d-flex">
                    <figure class="left"> <img src="{{asset('front-assets/images/review1.png')}}" alt=""> </figure>
                    <figure class="right"> <img src="{{asset('front-assets/images/review2.png')}}" alt=""> </figure>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Review Section ends-->

<!-- // Testimonial Section starts-->
<section class="testimonial">
    <div class="container">
        <h1 class="section_title"> What our <span>Travelers </span> Say About Us</h1>
    </div>
    <div class="inner_testimonial">
        <div class="container">
            <div class="carousel-wrap mt-5">
                <div class="owl-carousel owl-theme">

                    @foreach($testimonials as $testimonial)
                    <div class="item pulse animatable">
                        <div class="testimonial_wrapper">
                            <figure class="testi_image"> <img src="{{$testimonial->image_path}}" alt="">
                                <author class="testi_author pl-2">
                                    <h4>{{$testimonial->name}}</h4>
                                    <div class="d-block d-md-flex"> <a href="mailto:{{$testimonial->email}}">{{$testimonial->email}}
                                        </a>
                                        <span class="reviews-stars">
                                            {!! str_repeat('<i class="fa-solid fa-star"></i>', $testimonial->rating) !!}
                                        </span>
                                    </div>
                                </author>
                            </figure>
                            <div class="testi_content text-wrapper">
                                <p>{{$testimonial->description}}</p>
                            </div>
                            <!-- <author class="testi_author"> <span class="author">Jane Doe</span> <span class="post">Lead Intranet Technician</span> </author> -->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Testimonial Section ends here-->

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
                            <figure><img src="{{asset('front-assets/images/t-1.png')}}" alt=""></figure>
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
                            <figure><img src="{{asset('front-assets/images/t-2.png')}}" alt=""></figure>
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
                            <figure><img src="{{asset('front-assets/images/t-3.png')}}" alt=""></figure>
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
<!-- // Table wrapper ends-->

<!-- // pv_gallery starts-->
<section class="pv_gallery">
    <div class="photo_gallery">
        <div class="container">
            <div class="row align-items-sm-center">
                <div class="col-md-6 fadeIn animatable">
                    <figcaption>
                        <h1 class="section_title"> photo Gallery</h1>
                        <p class="quote">View Our Moments captured in pixels, stories told in frames.</p>
                        <a href="#" class="btn view_btn">VIEW GALLERY</a>
                    </figcaption>
                </div>
                <div class="col-md-6 fadeIn animatable">
                    <div class="row gallery_row">
                        <div class="col col-sm-12"> <img src="images/gal1.png" alt=""> </div>
                        <div class="col col-sm-6"> <img src="images/gal2.png" alt=""> </div>
                        <div class="col col-sm-6"> <img src="images/gal3.png" alt=""> </div>
                        <div class="col col-lg-4 col-sm-6"> <img src="images/gal4.png" alt=""> </div>
                        <div class="col col-lg-8 col-sm-6"> <img src="images/gal5.png" alt=""> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="video_gallery">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <figcaption>
                        <h1 class="section_title"> Video Gallery</h1>
                        <p class="quote">Explore our latest video content for an immersive journey into our brand's story, products, and experiences.</p>
                    </figcaption>
                </div>
            </div>
            <div class="row justify-content-center row-gap-3 row-gap-sm-0 mt-4 fadeIn animatable">
                <div class="col col-sm-3 px-2"> <a href="#">
                        <figure class="video_img"> <img src="images/video1.png" alt="">
                            <div class="icon"> <i class="fa-solid fa-circle-play"></i> </div>
                        </figure>
                    </a>
                </div>
                <div class="col col-sm-3 px-2"> <a href="#">
                        <figure class="video_img"> <img src="images/video3.png" alt="">
                            <div class="icon"> <i class="fa-solid fa-circle-play"></i> </div>
                        </figure>
                    </a>
                </div>
                <div class="col-sm-12 d-flex mt-2"> <a href="#" class="btn view_btn">VIEW All videos</a> </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('front_scripts')
<script>
    storeRoute = "{{route('front.testimonial.store')}}";
</script>

@include('_helpers.single_page_table_ajax', ['formId' => '#testimonial_form'])

<script type="text/javascript">
    $(document).ready(function() {

        $('#testimonial_form').on('submit', function(e) {
            e.preventDefault();

            if ($('#po_p').val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Fake Content detected!',
                }).then((result) => {
                    $(this)[0].reset();
                });

            } else {
                saveData();
            }
        });

        $(document).on('fetchEvent', function() {});

    });
</script>

@endpush