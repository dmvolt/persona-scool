/*
*****************************************************
*	CUSTOM JS DOCUMENT                              *
*	Single window load event                        *
*   "use strict" mode on                            *
*****************************************************
*/
$(window).load(function() {
	
		 
// ============================================
// PreLoader On window Load
// =============================================
		if($('.preloader').length) {	 
		 $('.preloader').addClass('loaderout');
	    }
         

//========================================
// LightBox / Fancybox
//======================================== 	
	
	if($('.fancybox').length) {
		 $('.fancybox').fancybox();
	}


	if($('.fancybox-iframe').length) {
		$('.fancybox-iframe').fancybox({
			type: "iframe",
			// other API options
		});
}
//========================================
// Accordion functions Calling
//======================================== 	
 
 	if($('#faq').length){   
		$('#faq').accordion();
	}


//========================================
// Owl Carousel functions Calling
//======================================== 	
 
	owlCarouselInit();  	

	if($('#coming-soon-timer').length){
		comingsoonInt();
	}
});



//========================================
// Owl Carousel functions
//======================================== 	

function owlCarouselInit() {
	
	"use strict";	
	
//========================================
// owl carousels settings
//======================================== 		
		
	var nextNav = 'Next';
	var prevNav = 'Prev';
	
		if($('#main-slider').length) {	
		 $('#main-slider').owlCarousel({
				 loop:true,
				margin:0,
				nav:true,
				navText:[prevNav,nextNav],
				dots:false,
				autoplay:false,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
		}
		
		if($('#about-us-slider').length) {	
			$('#about-us-slider').owlCarousel({
				loop:true,
				margin:0,
				nav:true,
				navText:[prevNav,nextNav],
				dots:false,
				autoplay:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
			
		}
		
		if( $('#facilities-slider').length) {	
			 $('#facilities-slider').owlCarousel({
				loop:true,
				margin:0,
				nav:false,
				dots:true,
				autoplay:true,
				stopOnHover : false,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
			
		}
		
		if($('#blog-slider').length) {	
			$('#blog-slider').owlCarousel({
				loop:true,
				margin:0,
				nav:true,
				navText:[prevNav,nextNav],
				dots:false,
				autoplay:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
			
		}
		
		if($('#blog-slider-sm').length) {	
			$('#blog-slider-sm').owlCarousel({
				loop:true,
				margin:0,
				nav:true,
				navText:[prevNav,nextNav],
				dots:false,
				autoplay:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
			
		}
		
		if($('#partener-slider').length) {	
			$('#partener-slider').owlCarousel({
				loop:true,
				margin:0,
				nav:true,
				navText:[prevNav,nextNav],
				dots:false,
				autoplay:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:3
					},
					1000:{
						items:4
					}
				}
			});
			
		}
		
		

}



function comingsoonInt(){
// Set the date we're counting down to
var countDownDate = new Date("dec 24, 2017 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("days").innerHTML = days ;
	
	 document.getElementById("hours").innerHTML = hours ;
	
	 document.getElementById("seconds").innerHTML = seconds ;
	
	 document.getElementById("minutes").innerHTML = minutes ;
	 
    
}, 1000);

}

/*
*****************************************************
*	END OF THE JS 									*
*	DOCUMENT                       					*
*****************************************************
*/