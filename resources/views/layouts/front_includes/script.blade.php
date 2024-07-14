<script type="text/javascript" src="{{asset('front-assets/js/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/owl.carouselv2.3.4.js')}}"></script>
<script type="text/javascript">
  $('.mainslider .owl-carousel').owlCarousel({
      loop: true,
      autoplay: true,
      margin: 0,
      center: false,
      autoHeight: true,
      dots: false,

      autoplay: true,
      //autoplayTimeout:5000,
      animateOut: 'fadeOut',
      // lazyLoad: true,
      //autoplayHoverPause: true,

      responsive: {
        0: {
          items: 1
        },

        600: {
          items: 1
        },

        1000: {
          items: 1
        }
      }
    }),




    $('.testimonial .owl-carousel').owlCarousel({
      loop: true,
      rewind: true,
      margin: 0,
      center: false,
      autoHeight: true,
      dots: true,
      nav: false,
      // navText: [
      //   "<i class='fa fa-angle-left'></i>",
      //   "<i class='fa fa-angle-right'></i>"
      // ],
      autoplay: true,
      //autoplayTimeout:5000,
      animateOut: 'fadeOut',
      // lazyLoad: true,
      //autoplayHoverPause: true,

      responsive: {
        0: {
          items: 1
        },

        600: {
          items: 2
        },

        1000: {
          items: 3
        }
      }
    });
</script>
<script type="text/javascript" src="{{asset('front-assets/js/fixed-nav.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/Push_up_jquery.js')}}"></script>
<!--<script type="text/javascript" src="lightbox/js/lightbox.js"></script>  -->
<script type="text/javascript" src="{{asset('front-assets/SmartDroddownMenus/smart_dropdown.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/annimatable_jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/side_nav.js')}}"></script>
<!--<script type="text/javascript" src="js/navbar.js"></script>-->


<!-- //Custom Upload Button JS starts -->

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
    var UpBtn = document.querySelector(".file-up-btn span");
    var UpOrgBtn = document.querySelector(".file-up");

    UpBtn.addEventListener("click", function() {
      UpOrgBtn.click();
    });

    UpOrgBtn.addEventListener("change", function(e) {
      if (UpOrgBtn.files.length > 0) {
        var file = UpOrgBtn.files[0];
        var fsize = file.size;

        if (fsize > 2000000) { // 2MB
          UpBtn.innerHTML = "Maximum file size should be under 2MB";
          UpBtn.classList.remove("uploaded");
          UpOrgBtn.value = ""; // Clear the file input
        } else {
          UpBtn.innerHTML = file.name;
          UpBtn.classList.add("uploaded");
        }
      }
    });
  });
</script>

<!-----------------Sweetalert js------------------------->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function() {
    $('.mark-as-read').click(function(e) {
      e.preventDefault();
      let notificationId = $(this).data('notification-id');
      let redirectUrl = $(this).data('redirect-url');

      $.ajax({
        url: '/notifications/' + notificationId,
        type: 'GET',
        success: function(data) {
          window.location.href = redirectUrl;
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>


@stack('front_scripts')


<!-- //Custom Upload Button JS ends -->