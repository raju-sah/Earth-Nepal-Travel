 


		//----------------------fix nav on scroll----------------------//
		
		var $r = jQuery.noConflict();

	var stickyNavOffsetTop = $r('#pav-mainnav').offset().top;
	//console.log(stickyNavOffsetTop);
	var stickyNav = function(){
		var scrollTop = $r(window).scrollTop();
	
	if( scrollTop > stickyNavOffsetTop ){
			$r('#pav-mainnav').stop().addClass('fixNav');
		} else {
			$r('#pav-mainnav').stop().removeClass('fixNav');
		}
	};	
	// run our function on load
	stickyNav();
	
	// and run it again every time you scroll
	$r(window).scroll(function() {
		 stickyNav();
	});
 