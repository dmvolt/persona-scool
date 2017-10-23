$(document).ready(function() {

	// elevateZoom
	var evParam = {
		zoomType: 'inner',
		cursor: 'crosshair',
		zoomWindowFadeIn: 300,
		zoomWindowFadeOut: 300,
		lensFadeIn: 300,
		lensFadeOut: 300
	}

	// $('.js-zoom').elevateZoom(evParam);

	// slideout
	var slideout = new Slideout({
		panel: document.getElementById('page__panel'),
		menu: document.getElementById('page__side'),
		padding: 200,
		tolerance: 70,
		duration: 500,
		easing: 'ease-in-out',
		side: 'right'
	});

	slideout.on('beforeopen', function() {
		var winTop = $(window).scrollTop();
		$('.page__header--mobile').css('top', winTop + 'px');
	});

	slideout.on('translate', function() {
		var winTop = $(window).scrollTop();
		$('.page__header--mobile').css('top', winTop + 'px');
	});

	slideout.on('beforeclose', function() {
		$('.page__bg').addClass('page__bg--hide');
	});

	slideout.on('close', function() {
		$('.js-header-fixed').css('top', 0);
		$('.page__bg').removeClass('page__bg--hide');
	});

	$('.js-slideout-toggle').click(function(e){
		e.preventDefault();
		slideout.toggle();
	});

	$('.js-slideout-close').click(function(e){
		e.preventDefault();
		slideout.close();
	});

	// scrollIt
	// $.scrollIt();

	// ScrollReveal
	var wWidth = $(window).width();

	if (wWidth > 1200) {
		window.sr = ScrollReveal({
			duration: 1000,
			reset: false
		});
		sr.reveal('.js-sr-left',{
			delay: 0,
			distance: '100px',
			origin: 'left'
		});
		sr.reveal('.js-sr-right',{
			delay: 300,
			distance: '100px',
			origin: 'right'
		});
		sr.reveal('.js-sr-bottom',{
			delay: 200,
			distance: '100px',
			origin: 'bottom'
		});
		sr.reveal('.js-sr-nom', 100);
		sr.reveal('.js-sr-present', 100);
		sr.reveal('.js-sr-logo', 50);
		sr.reveal('.js-sr-photo', 100);
		// sr.reveal('.card');
	}

	// rellax
	if ($('.js-rellax').length) {
		var rellax = new Rellax('.js-rellax');
	}

	//headroom
	if ($('.page__header--headroom').length) {
		var myElement = document.querySelector('.page__header--headroom');
		var headroom  = new Headroom(myElement, {
			offset : 100,
			tolerance : {
				up : 20,
				down : 10
			}
		});
		headroom.init();
	}

	//ripple button effect
	$('.js-ripple').on('click', function(e) {
		// e.preventDefault();
		var btnOffset = $(this).offset(),
		xPos = e.pageX - btnOffset.left - 25,
		yPos = e.pageY - btnOffset.top - 25,
		$div = $('<div class="js-ripple__effect" style="top:' + yPos + 'px; left:' + xPos + 'px;"></div>');
		$div.appendTo($(this));
		window.setTimeout(function(){
			$div.remove();
		}, 2000);
	});

	// swiper
	var swiperSlider1 = new Swiper('.js-swiper-1', {
		initialSlide: 1,
		speed: 500,
		loop: false,
		simulateTouch: false,
		effect: 'fade',
		onSlideChangeStart: function () {
			console.log('move');
			// $('.zoomContainer').remove();
			$('.js-swiper-1 .swiper-slide-active .js-zoom').elevateZoom(evParam);

		}
	});

	var swiperCarousel1 = new Swiper('.js-carousel-1', {
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		slidesPerView: 3,
		initialSlide: 1,
		centeredSlides: true,
		speed: 500,
		spaceBetween: 30,
		loop: false,
		slideToClickedSlide: true
	});

	var swiperSlider2 = new Swiper('.js-swiper-2', {
		initialSlide: 1,
		speed: 500,
		loop: false,
		simulateTouch: false,
		effect: 'fade',
		onSlideChangeStart: function () {
			console.log('move');
			// $('.zoomContainer').remove();
			$('.js-swiper-2 .swiper-slide-active .js-zoom').elevateZoom(evParam);

		}
	});

	var swiperCarousel2 = new Swiper('.js-carousel-2', {
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		slidesPerView: 3,
		initialSlide: 1,
		centeredSlides: true,
		speed: 500,
		spaceBetween: 30,
		loop: false,
		slideToClickedSlide: true
	});

	var swiperCarousel = new Swiper('.js-carousel', {
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		slidesPerView: 3,
		initialSlide: 1,
		centeredSlides: true,
		speed: 500,
		spaceBetween: 30,
		loop: false,
		// simulateTouch: false,
		slideToClickedSlide: true,
		// preventClicks: false,

		breakpoints: {
			1200: {
				slidesPerView: 1
			}
		}
	});

	swiperSlider1.params.control = swiperCarousel1;
	swiperCarousel1.params.control = swiperSlider1;

	swiperSlider2.params.control = swiperCarousel2;
	swiperCarousel2.params.control = swiperSlider2;

	//popup
	$('.js-popup-image').magnificPopup({
		type:'image',
		removalDelay: 300,
		mainClass: 'mfp-fade',
		gallery:{
			enabled:true
		},

		image: {
			markup: '<div class="mfp-figure">'+
			'<div class="mfp-close"></div>'+
			'<div class="mfp-img"></div>'+
			'</div>'
		}
	});

	$('.js-popup-inline').magnificPopup({
		removalDelay: 300,
		mainClass: 'mfp-fade',
		midClick: true
	});

	$('.js-magnific-close').on('click', function(e){
		e.preventDefault();
		$.magnificPopup.close();
	});

	// message agree once
	$('.js-agree-once').on('click', function(e){
		e.preventDefault();

		localStorage.setItem('agree_once', true);
		$('.js-message-once').fadeOut();
	});

	if (!localStorage.getItem('agree_once')) {
		$('.js-message-once').addClass('message--visible');
	}

	// resize handler
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();

	$(window).resize(function() {
		delay(function(){
			var wWidth = $(window).width();

			if (wWidth > 768) {
				slideout.close();
			}
		}, 100);
	});

});
