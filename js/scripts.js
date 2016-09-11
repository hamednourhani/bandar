
jQuery(document).ready(function($){
	

	$('a#searchToggler').click(function(event) {
		$('div#menuSearchArea').fadeToggle();
	});
	
	$('.searchform span.searchButton').click(function(event){
		console.log("search query");
		$(this).parent().parent(".searchform").trigger("submit");
	});
	
	$('a#menu-toggler').click(function(event){
		event.preventDefault();
		// event.stopPropagation();
		var menu_toggler = $(this);
		console.log('click on menu toggler');
		var responsive_container = $('div#responsive-menu');
		var close_button = responsive_container.children('a#close-responsive');
		var body = $('body');
		var menu_width = responsive_container.width();
		var window_height = $(window).height();
		var window_width = $(window).width();
		
		
		responsive_container.addClass('show-menu').css({
									'height' : window_height,
									'width' : window_height,
								});
		body.css({
			'overflow' : 'hidden',
		});
		menu_toggler.hide();
		

		close_button.click(function(event){
			// event.stopPropagination();
			
			body.css({
					'overflow' : 'auto',
				});
			responsive_container.css({
										'width' : menu_width,
									}).removeClass('show-menu');

			menu_toggler.show();
	

		});


	});

	if(typeof $.fn.owlCarousel !== 'undefined') {
		
		var best_owl = $('.best-owl').owlCarousel({
			margin:1,
			responsiveClass: true,
			nav: false,
			loop: true,
			mouseDrag: true,
			touchDrag: true,
			autoplayTimeout : 2000,
			autoplay : true,
			autoplayHoverPause : true,
			autoplaySpeed : 1000,
			responsive: {
				0: {
					items: 1,
				},
				400: {
					items: 3,
				},
				700: {
					items: 4,
				},
				1000: {
					items: 4,
				},

			}
		});

		var last_owl = $('.last-owl').owlCarousel({
			margin:1,
			responsiveClass: true,
			nav: false,
			loop: true,
			mouseDrag: true,
			touchDrag: true,
			autoplayTimeout : 2000,
			autoplay : true,
			autoplayHoverPause : true,
			autoplaySpeed : 1000,
			responsive: {
				0: {
					items: 1,
				},
				400: {
					items: 3,
				},
				700: {
					items: 4,
				},
				1000: {
					items: 4,
				},

			}
		});

		$('#NextPageBtnBest').click(function(e) {
			e.preventDefault();
			best_owl.trigger('next.owl.carousel');
		});

		// Go to the previous item
		$('#PrevPageBtnBest').click(function(e) {
			e.preventDefault();
			best_owl.trigger('prev.owl.carousel', [300]);
		});

		$('#NextPageBtnLast').click(function(e) {
			e.preventDefault();
			last_owl.trigger('next.owl.carousel');
		});

		// Go to the previous item
		$('#PrevPageBtnLast').click(function(e) {
			e.preventDefault();
			last_owl.trigger('prev.owl.carousel', [300]);
		});



	}
});	
		