<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/owl.carouselv2.3.4.js"></script> 
<script type="text/javascript">
$('.mainslider .owl-carousel').owlCarousel({
  loop: true,
  autoplay: true,
  margin:0,
  center: false,
  autoHeight:true,
  dots:false,
 
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
      items:1
    }
  }
}),




$('.testimonial .owl-carousel').owlCarousel({
  loop: true,
  rewind:true,
  margin:0,
  center: false,
  autoHeight:true,
  dots:true,
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
      items:3
    }
  }
});
 
 
</script> 
<script type="text/javascript" src="js/fixed-nav.js"></script> 
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/Push_up_jquery.js"></script> 
<!--<script type="text/javascript" src="lightbox/js/lightbox.js"></script>  --> 
<script type="text/javascript" src="SmartDroddownMenus/smart_dropdown.js"></script> 
<script type="text/javascript" src="js/annimatable_jquery.js"></script> 
<script type="text/javascript" src="js/side_nav.js"></script> 
<!--<script type="text/javascript" src="js/navbar.js"></script>--> 


<!-- //Custom Upload Button JS starts --> 

<script type="text/javascript">

  var UpBtn = document.querySelector(".file-up-btn");
  var UpOrgBtn = document.querySelector(".file-up");
  UpBtn.addEventListener("click", () => {
  UpOrgBtn.click();
  });
  UpOrgBtn.addEventListener("change", (e) => {
  UpBtn.innerHTML = UpOrgBtn.files[0].name;
  UpBtn.classList.add("uploaded");
  let fsize = UpOrgBtn.files[0].size;
  if (fsize > 2000000) {
  e.preventDefault();
  UpBtn.innerHTML = "maximum filesize should upder 2MB ";
  }
  });
  </script> 

<!-- //Custom Upload Button JS ends -->