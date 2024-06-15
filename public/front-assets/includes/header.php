<?php $active[ $current ]='class=current';?>
<!--../header starts-->
<header class="main_header">
  <div class="topbar">
    <div class="container">
      <address class="top-contact-address topbar-items">
      <ul class="contact">
        <li>
          <figure class="icon"><i class="fa-solid fa-envelope"></i></figure>
          <div class="details"><a href="mailto:rae@xyztz.com" class="email">rae@xyztz.com</a> </div>
        </li>
        <li>
          <figure class="icon"><i class="fa-solid fa-phone"></i></figure>
          <div class="details"> <a href="tel:+977 -01- 4373396" class="call">( +977 ) 9800000000</a> </div>
        </li>
      </ul>
      <ul class="social_icon">
        <li><a href="#"><i class="fa-brands fa-facebook-f"></i> </a></li>
        <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
        <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
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
               <a href="index.php"> 
              <img src="images/main_logo.png" alt=""> 
            </a> 
            <a href="booking_form.php" class="booking_btn"><img src="images/Frame 326.png" alt=""></a>
           </figure>
          </div>
          <div class="col col-sm-3 col-md-7">
            <div id="mainContent">
              <div id="myCanvasNav" class="overlay3" onclick="closeOffcanvas()" style="width: 0%; opacity: 0;"></div>
              <div id="myOffcanvas" class="offcanvas" >
                <div class="navbar navbar-default" role="navigation"> <!--//Navbar -->
                  <div class="side_nav"><!--nav-collapse-->
                    <ul class="nav navbar-nav">
                      <li><a href="index.php" <?php if(isset($active[1])) echo $active[1]; ?>> Home </a> </li>
                      <li><a href="#" <?php if(isset($active[2])) echo $active[2]; ?>> About Us <span class="caret"></span> <i class="fa-solid fa-chevron-down"></i>
                      </a>
                        <ul class="dropdown-menu">
                          <li><a href="introduction.php">Introduction</a></li>
                          <li><a href="team.php">Our Team </a></li>
                          <li><a href="testimonial.php">Testimonial</a></li>
                          <li><a href="faq.php">FAQ</a></li>
                        </ul>
                      </li>
                      <li><a href="services.php" <?php if(isset($active[3])) echo $active[3]; ?>> Services <span class="caret"></span> <i class="fa-solid fa-chevron-down"></i> </a>
                        <ul class="dropdown-menu">
                          <li><a href="booking.php">Hotel Booking</a></li>
                          <li><a href="flight.php">Flight</a></li>
                          <li><a href="rafting.php">Rafting</a></li>
                        </ul>
                      </li>
                      <li><a href="#" <?php if(isset($active[4])) echo $active[4]; ?>> Destinations<span class="caret"></span> 
                      <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                          <li class="has-child"> <a href="nepal.php">Nepal <span class="caret"></span></a>
                            <ul class="sub-dropdown-menu">
                              <li class="has-child third-child"> <a href="#">Tour</a>
                                <ul class="third-dropdown-menu">
                                  <li><a href="mustang.php">Mustang tour</a></li>
                                  <li><a href="lumbini.php">Lumbini tour</a></li>
                                </ul>
                              </li>
                              <li class="has-child third-child"> <a href="#">Trekking </a>
                                <ul class="third-dropdown-menu">
                                  <li><a href="annapurna.php">Annapurna Region Trek</a></li>
                                  <li><a href="dhaulagiri.php">Dhaulagiri Trek</a></li>
                                </ul>
                              </li>
                              <li><a href="rafting.php">Rafting</a></li>
                              <li><a href="expedition.php">Expedition</a></li>
                              <li><a href="booking_form.php">Hotel Booking</a></li>
                              <li><a href="booking_form.php">Flight Booking</a></li>
                            </ul>
                          </li>
                          <li> <a href="tibet.php">Tibet </a>
                            <!-- <i class="fa-solid fa-chevron-right"></i>  --> 
            
                          </li>
                          <li><a href="bhutan.php">Bhutan </a></li>
                            <!-- <ul class="sub-dropdown-menu">
                              <li><a href="#">Drop down menu</a></li>
                            </ul> -->
                          
                          <li> <a href="india.php">India </a></li>
                          
                        </ul>
                      </li>
  
                      <li><a href="packages.php" <?php if(isset($active[5])) echo $active[5]; ?>> Packages <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="everest_package.php">Everest Trekking Package</a></li>
                          <li><a href="annapurna_package.php">Annapurna Trekking Package</a></li>
                          <li><a href="langtang_package.php">Langtang Trekking Package</a></li>
                          <li><a href="dolpo_package.php">Dolpo Trekking Package</a></li>
                        </ul>
                      </li>
                      <li><a href="contact.php" <?php if(isset($active[6])) echo $active[6]; ?>> Contact us</a> </li>
                    </ul>
                  </div>
                  <!--/.nav-collapse --> 
                </div>
                <!--//Navbar --> 
              </div>
              <!--offcanvas-->
              <button type="button" class="navbar-toggle" id="hamburger" data-toggle="collapse"
data-target=".navbar-collapse"  onclick="openNav3();openOffcanvas()"> <span
class="toggle-bar" id="toggle"></span> <span id="close" style="display: none;"><i class="fa-solid fa-xmark"></i></span></button>
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