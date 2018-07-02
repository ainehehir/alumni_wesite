
// EDIT BELOW THIS LINE FOR CUSTOM EFFECTS, TWEAKS AND INITS

/*--------------------------------------------------

Custom overwiev:

Page scripts
Header scripts
Isotope scripts
---------------------------------------------------*/

(function($){
	
"use strict";

/***************************************************
1. Site functions
***************************************************/
var kleoPage = {
	
	init: function() {
			
		//remove overflow hidden
		kleoPage.removeOverflowHidden();
		
		//image sliders
		$('.kleo-carousel-items').imagesLoaded(function() {
			kleoPage.carouselItems();
			kleoPage.bannerSlider();
		});
		$(".activity").imagesLoaded( function() {
			kleoPage.rtMediaslider();
		});
		
		//activate prettyPhoto
		kleoPage.prettyPhoto();
		
		//activate html5 video/audio player
		if($.fn.kleo_enable_media && $.fn.mediaelementplayer) {
			$(".kleo-video, .kleo-audio", "body").kleo_enable_media();
		}
		
	
		//initialize Pins
		kleoPage.initPins();
		
		if(kleoFramework.goTop == 1) {
			kleoPage.goTop();
		}

		kleoPage.likes();
		
		//Fit videos
		$(".post-content, .activity-inner, .article-media, article").fitVids();

		// Sidebar menu toggle
		if (!isMobile || kleoIsotope.viewport().width > 992) {
			kleoPage.kleoMenuWidget();
		}

		//Accordion/toggle icons
		$('.panel-collapse').on('show.bs.collapse', function () {
			$(".panel-heading a[href='#"+$(this).attr('id')+"'] span.icon-opened").removeClass("hide");
			$(".panel-heading a[href='#"+$(this).attr('id')+"'] span.icon-closed").addClass("hide");
			;
		})
		$('.panel-collapse').on('hide.bs.collapse', function () {
			$(".panel-heading a[href='#"+$(this).attr('id')+"'] span.icon-opened").addClass("hide");
			$(".panel-heading a[href='#"+$(this).attr('id')+"'] span.icon-closed").removeClass("hide");
		})
				
		//Tabs and accordions triggers
		$('a[data-toggle="tab"]').on('shown.bs.tab', function () {
			//carousels
			$('.kleo-carousel').trigger('updateSizes');

			//masonry
			kleoIsotope.init();
		});
		$('.panel-collapse').on('shown.bs.collapse', function () {
			//carousels
			$('.kleo-carousel').trigger('updateSizes');
			//masonry
			kleoIsotope.init();
		});


		// Popover profile
		$('.click-pop').popover({
			trigger: "click"
		}).on('click',  function(e) {e.preventDefault; return false;});
	
		$('.hover-pop').popover({
			trigger: "hover focus",
			html: true
		});
		
		// Tooltip
		$('.hover-tip').tooltip({
			trigger: "hover" 
		});
		$('.click-tip').tooltip({
			trigger: "click"
		});
		
		
		
	},
	
	notReadyInit: function() {
		//Preload logo
		$("#logo_img").imgpreload();
		
		$('.responsive-tabs, .nav-pills, .top-menu > ul, #top-social > ul').tabdrop();
		
	},
	
	// Sidebar menu toggle
	kleoMenuWidget: function() {
			var submenuParent = jQuery(".widget_nav_menu ul.sub-menu").parent('li');
			submenuParent.addClass('parent');
			submenuParent.children("a").append('<span class="caret"></span>');
			submenuParent.find(".caret").click( function() {
				jQuery(this).closest(".parent").children('.sub-menu').stop(true,true).slideToggle('fast');
				jQuery(this).toggleClass('active');
				return false;
			});
		},
	
	adjustHeights: function(elem) {
      var fontstep = 2;
      if ($(elem).height()>$(elem).parent().height() || $(elem).width()>$(elem).parent().width()) {
        $(elem).css('font-size',(($(elem).css('font-size').substr(0,2)-fontstep)) + 'px').css('line-height',(($(elem).css('font-size').substr(0,2))) + 'px');
        adjustHeights(elem);
      }
    },
	
	removeOverflowHidden: function() {
		
		$('body').on('click', function() {
			if ($('#buddypress .tabdrop').hasClass('open'))
			{
				$('#buddypress div#item-nav').css('overflow','hidden');
			}
		});
		
		$('.item-list-tabs .dropdown-toggle').on('click', function() {
			if ($('#buddypress .tabdrop').hasClass('open'))
			{
				$('#buddypress div#item-nav').css('overflow','hidden');
			}
			else {
				$('#buddypress div#item-nav').css('overflow','visible');
			}
		});
		
	},
	
	bannerSlider: function() {
		
		$('.kleo-banner-slider').animate({"opacity": "1"}, 700);
		$('.kleo-banner-slider').each(function() {  
				var $prev = $(this).find(".kleo-banner-prev");
				var $next = $(this).find(".kleo-banner-next");
				$(this).find('.kleo-banner-items').carouFredSel({
						//auto: false,
						responsive: true,
						circular: false,
						infinite: true,
						auto: {
							play : true,
							pauseDuration: 0,
							duration: 2000
						},
						scroll: {
							items: 1,
							duration: 600,
							//fx: "crossfade",
							easing: "easeInOutExpo",
							wipe: true
						},
						//padding: 0,
						prev: $prev,
						next: $next,
						items: {
							height : 'variable',
							visible: 1
						}
				});
		});

	},
	
	carouselItems: function() {
		
		$('.kleo-carousel-items').each(function() {
			// Load Carousel options into variables
			var $currentCrslPrnt = $(this);
			var $currentCrsl = $currentCrslPrnt.children('.kleo-carousel');
			var $prev = $currentCrslPrnt.closest('.kleo-carousel-container').find(".carousel-arrow .carousel-prev");
			var $next = $currentCrslPrnt.closest('.kleo-carousel-container').find(".carousel-arrow .carousel-next");
			var $pagination = $currentCrslPrnt.closest('.kleo-carousel-container').find(".kleo-carousel-pager");

			var $visible,
			$items_height = 'auto',
			$items_width = null,
			$auto_play = false,
			$auto_pauseOnHover = 'resume',
			$scroll_fx = 'scroll',
			$duration = 2000;

			if ($currentCrslPrnt.data("pager")) {
				$pagination = $currentCrslPrnt.closest('.kleo-carousel-container').find($currentCrslPrnt.data("pager"));
			}
			if ($currentCrslPrnt.data("autoplay") && $currentCrslPrnt.data("autoplay" == 'true') ) {
				$auto_play = true;
			}
			if ($currentCrslPrnt.data("speed") ) {
				$duration = parseInt($currentCrslPrnt.data("speed"));
			}
			if ($currentCrslPrnt.data("items-height") ) {
				$items_height = $currentCrslPrnt.data("items-height");
			}
			if ($currentCrslPrnt.data("items-width") ) {
				$items_width = $currentCrslPrnt.data("items-width");
			}
			if ($currentCrslPrnt.data("scroll-fx") ) {
				$scroll_fx = $currentCrslPrnt.data("scroll-fx");
			}
			
			if ($currentCrslPrnt.data("min-items") && $currentCrslPrnt.data("max-items")) {
				$visible = {
						min: $currentCrslPrnt.data("min-items"),
						max: $currentCrslPrnt.data("max-items")
					};
			}

			// Apply common carousel options
			$currentCrsl.carouFredSel({
					responsive: true,
					width: '100%',
					pagination: $pagination,
					prev: $prev,
					next: $next,
					auto: {
						play : $auto_play,
						pauseOnHover: $auto_pauseOnHover
					},
					swipe: {
						onTouch: true
					},
					scroll: {
						items: 1,
						duration: 600,
						fx: $scroll_fx,
						easing: "swing",
						timeoutDuration: $duration,
					},
					items: {
						width: $items_width,
						height: $items_height,
						visible: $visible,
					}
			});
		});

		if($(".kleo-thumbs-carousel").length) {
			$('.kleo-thumbs-carousel').carouFredSel({
				responsive: true,
				circular: false,
				infinite: true,
				auto: false,
				prev: {
					button : function(){
						return $(this).parents('.kleo-gallery').find('.kleo-thumbs-prev')
					}
				},
				next:{
					button : function(){
						return $(this).parents('.kleo-gallery').find('.kleo-thumbs-next')
					}
				},
				swipe: {
					onMouse: true,
					onTouch: true
				},
				scroll: {
					items: 1
				},
				items: {
					height: 'auto',
					visible: 6,
				}
			});
		}

		$('.kleo-thumbs-carousel a').click(function() {
			$(this).closest('.kleo-gallery-container').find('.kleo-gallery-image').trigger('slideTo', '#' + this.href.split('#').pop() );
			$('.kleo-thumbs-carousel a').removeClass('selected');
			$(this).addClass('selected');
			return false;
		});

		if($(".kleo-gallery-image").length) {
			$('.kleo-gallery-image').carouFredSel({
					responsive: true,
					circular: false,
					auto: false,
					items: {
					height: 'variable',
					visible: 1
					},
					scroll: {
						items: 1,
						fx: 'crossfade'
					}
			});
		}
		
	},

	rtMediaslider: function() {
		
			$(".rtmedia-activity-container").append('<div class="activity-feed-prev">&nbsp;</div><div class="activity-feed-next">&nbsp;</div>');
			//jQuery('.rtmedia-activity-container').animate({"opacity": "1"}, 700);
			$('.rtmedia-activity-container').each(function() {  
				var $prev = $(this).find(".activity-feed-prev");
				var $next = $(this).find(".activity-feed-next");
				$(this).find('.large-block-grid-3').carouFredSel({
						//auto: false,
						responsive: true,
						circular: false,
						auto: {
							play : true,
							pauseDuration: 0,
							duration: 2000
						},
						scroll: {
							items: 1,
							duration: 600,
							//fx: "crossfade",
							easing: "easeInOutExpo",
							wipe: true
						},
						swipe: {
							onTouch: true
						},
						//padding: 0,
						prev: $prev,
						next: $next,
						items: {
							height : 'auto',
							visible: {
										min: 1,
										max: 4
								}
						}
				});
			});

	},
	
	initPins: function() {
		
		$( ".kleo-pin-circle, .kleo-pin-poi, .kleo-pin-icon" ).each(function() {
			var $length = "";

			if ($(this).is('[data-top]')) {
				$( this ).css({ "top": $(this).attr('data-top')+$length});
			}
			if ($(this).is('[data-left]')) {
				$( this ).css({ "left": $(this).attr('data-left')+$length});
			}
			if ($(this).is('[data-right]')) {
				$( this ).css({ "right": $(this).attr('data-right')+$length});
			}
			if ($(this).is('[data-bottom]')) {
				$( this ).css({ "bottom": $(this).attr('data-bottom')+$length});
			}

		});
		
	},
	
	/***************************************************
	 Go To Top Link
	***************************************************/
	goTop: function() {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 500) {
					$('.kleo-go-top, .kleo-quick-contact-wrapper').removeClass('off').addClass('on');
			}
			else {
					$('.kleo-go-top, .kleo-quick-contact-wrapper').removeClass('on').addClass('off');
			}
		});

		$('.kleo-go-top, .divider-go-top').click(function () {
				$("html, body").animate({
						scrollTop: 0
				}, 800);
				return false;
		});

		$('.kleo-classic-comments').click(function () {
				$("html, body").animate({
						scrollTop: $('#comments').offset().top
				}, 800);

		});
	 },
	
	/***************************************************
		PrettyPhoto - Replace 'data-rel' with 'rel'
		'rel' attribute it's not a valid tag anymore
	***************************************************/
	prettyPhoto: function() {
		
		$('a[data-rel]').each(function() {
				$(this).attr('rel', $(this).data('rel'));
		});

		//PrettyPhoto settings
		$("a[rel^='prettyPhoto']").prettyPhoto({
				animation_speed: 'fast', /* fast/slow/normal */
				slideshow: false, /* false OR interval time in ms */
				autoplay_slideshow: false, /* true/false */
				opacity: 0.80, /* Value between 0 and 1 */
				show_title: true, /* true/false */
				allow_resize: true, /* Resize the photos bigger than viewport. true/false */
				default_width: 500,
				default_height: 344,
				counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
				theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
				hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
				wmode: 'opaque', /* Set the flash wmode attribute */
				autoplay: true, /* Automatically start videos: True/False */
				modal: false, /* If set to true, only the close button will close the window */
				overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
				keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
				deeplinking: false,
				social_tools: false
		});
		
	},
	
	likes: function() {
		$('.item-likes').live('click',
			function() {
				var link = $(this);
				if(link.hasClass('liked')) return false;

				var id = $(this).attr('id'),
					postfix = link.find('.item-likes-postfix').text();

				$.post(kleoFramework.ajaxurl, { action:'item-likes', likes_id:id, postfix:postfix }, function(data){
					link.html(data).addClass('liked').attr('title',kleoFramework.alreadyLiked);
				});

				return false;
			});

			if( $('body.ajax-item-likes').length ) {
				$('.item-likes').each(function(){
				var id = $(this).attr('id');
				$(this).load(kleoFramework.ajaxurl, { action:'item-likes', post_id:id });
			});
		}
	}
	
};

var bP = {
	
	init: function() {
		//$("#buddypress div#item-nav .responsive-tabs").css('visibility', 'visible');
		$("#buddypress div#item-nav").css('background-image', 'none');

		kleoIsotope.bpAjax();
		//Activity Ajax
		$("body").on('bpActivityLoaded', function() {
			//Init animation
			$('.animate-when-almost-visible').kleo_waypoints({ offset: '90%'});
			//Init slider
			$(".activity").imagesLoaded( function() {
				kleoPage.rtMediaslider();
			});
			//Init fitVids
			$(".activity-inner").fitVids();
		});
	}
	
}


var kleoIsotope = {
	
	container: '.kleo-isotope',
	elContainer: $('.kleo-isotope'),
	init: function() {

		if (kleoIsotope.elContainer.length > 0) {
			kleoIsotope.applyGridIsotpe(kleoIsotope.container);
		}
		
	},
	
	bpAjax: function() {
		
		$("body").on('gridloaded', function() {
			kleoIsotope.applyGridIsotpe(".kleo-isotope");
				$('.animate-when-almost-visible').kleo_waypoints({ offset: '90%'});
		});
		
	},
	
	applyGridIsotpe: function(container, atts) {
		var $container = $(container);
		$container.each(function() {
			var $isoItem = $(this);
			var $isoAtts;
			if($isoItem.data('layout') == 'fitRows') {
				$isoAtts = { layoutMode : 'fitRows' };
			} else {
					$isoAtts = {
					resizable: false, // disable normal resizing
					// set columnWidth to a percentage of container width
					masonry: { columnWidth: kleoIsotope.getWidth($isoItem) }
				};
			}
			atts = typeof atts !== 'undefined' ? true : false;
			if (atts == false) {
				$isoAtts = {};
			}

			$isoItem.imagesLoaded( function(){
				$isoItem.isotope($isoAtts);
			});

			$(window).smartresize(function () {
				// reinit isotope
				$isoItem.isotope($isoAtts);
			});
		});

	},
	getWidth: function(item){
		var $isoWidth;

		if(kleoIsotope.viewport().width < 480) {
			$isoWidth = item.width() / 1;
			
		} else if(kleoIsotope.viewport().width < 768) {
			$isoWidth = item.width() / 2;
			
		} else if(kleoIsotope.viewport().width < 992) {
			$isoWidth = item.width() / 2;
			
		} else if(kleoIsotope.viewport().width < 1200) {
			if (item.closest(".template-page").hasClass('col-sm-12') ) {
				$isoWidth = item.width() / 3;
			} else {
				$isoWidth = item.width() / 2;
			}
					
		} else if(kleoIsotope.viewport().width < 1440) {
			if (item.closest(".template-page").hasClass('col-sm-12')) {

				$isoWidth = item.width() / 4;
		
			} else {
				$isoWidth = item.width() / 3;
			}
		} else {
			if (item.closest(".template-page").hasClass('col-sm-12')) {
				if (item.closest(".section-container").hasClass('container-full')) {
					$isoWidth = item.width() / 6;
				} else {
					$isoWidth = item.width() / 4;
				}
			} else {
				$isoWidth = item.width() / 3;
			}
		}
		return $isoWidth;
	},
	
	viewport: function() {
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	}	
	
};



var kleoHeader = {
	spacing: 0,
	init: function() {
		
		//activate sticky main menu
		if (body.hasClass("kleo-navbar-fixed")) {
			kleoHeader.enable_sticky();
		}
		
		//activate logo resizing
		if (body.is(".kleo-navbar-fixed, .navbar-resize")) {
			kleoHeader.resize_logo();
		}		

		//activate retina logo
		kleoHeader.enableRetinaLogo();
		
		//activate social icons expand effect
		kleoHeader.topSocialExpander();
		
		//enable menu Ajax search button
		if(kleoFramework.ajaxSearch == 1) {
			kleoHeader.toggleAjaxSearch();
			kleoHeader.doAjaxSearch();
		}
		
		// Activate Hover menu
		if (kleoIsotope.viewport().width > 992) {
			$('#header .js-activated').dropdownHover().dropdown();
		}
		$('.js-activated').off('click');
		
		//Expand dropdown on caret click
		$('#header .caret').on('click', function() {
			var liItem = $(this).closest(".dropdown, .dropdown-submenu");
			if (liItem.hasClass("open")) {
				liItem.removeClass("open");
			} else {
				liItem.addClass("open");
			}
			return false;
		});
		
		
	},
	initialPos: ($('.navbar-resize .kleo-main-header').length && ! $("body").hasClass('navbar-transparent')) ? $('.navbar-resize .kleo-main-header').offset().top : 0,
	initialSize:  $('.navbar-resize .kleo-main-header').height(),
	/***************************************************
	Decreases header size when user scrolls down
	***************************************************/
	resize_logo: function() {
		
		var header        = $('.navbar-resize .kleo-main-header'),
			logo            = $('.navbar-header .logo img, .navbar-header .logo a'),
			elements        = $('.navbar-header, .nav-collapse ul'),
			el_height       = $(elements).filter(':first').height(),

			set_height      = function()
			{				
				if (kleoIsotope.viewport().width < 992) {
					elements.css({
						'lineHeight': kleoHeader.initialSize + 'px'
					});
					return;
				}
				
				var st = $window.scrollTop(), newH = 0, minHeight = kleoHeader.initialSize /2;
				
				if(st > (kleoHeader.initialPos )) {
					
					if(st < (kleoHeader.initialPos + el_height/2))
					{
						newH = el_height - st + kleoHeader.initialPos;
						header.removeClass('header-scrolled'); 
						$('.btn-buy').removeClass('btn-default');
					}
					else
					{ 
							newH = (el_height)/2;
							header.addClass('header-scrolled');
							$('.btn-buy').addClass('btn-default');
					}
					if (newH < minHeight) { 
						newH = minHeight;
					}

					elements.css({
						'lineHeight': newH + 'px'
					});
					logo.css({'maxHeight': newH + 'px'});	
					
					/* Submenu position */
					var liSize = $(".kleo-main-header .navbar-nav > li:first").height();
					$(".kleo-main-header .navbar-nav > li > .dropdown-menu").css("margin-top", (newH - liSize)/2 -1);
					
				} else {
					
					newH = kleoHeader.initialSize;
					logo.css({'maxHeight': newH + 'px'});		
					
					elements.css({
						'lineHeight': newH + 'px'
					});
					$('.btn-buy').removeClass('btn-default');

					/* Submenu position */
					var liSize = $(".kleo-main-header .navbar-nav > li:first").height();
					$(".kleo-main-header .navbar-nav > li > .dropdown-menu").css("margin-top", (newH - liSize)/2 -1);
				}

			}

		if(!header.length) return false;
		$window.scroll(set_height);
		$($window).smartresize(set_height);
		//$(".kleo-main-header img").imgpreload(function() {
			set_height();
		//});
	},
	
	enable_sticky: function() {
	
		if ($('#wpadminbar').length > 0 && parseInt($window.width()) > 584) {
			kleoHeader.spacing = $('#wpadminbar').height();
		}
		$(".kleo-main-header").sticky({topSpacing:kleoHeader.spacing});
	},
	
	enableRetinaLogo: function() {
		if (window.devicePixelRatio > 1 && kleoFramework.retinaLogo != '') {
				var image = $("#logo_img"),
				imageName = kleoFramework.retinaLogo;
				//rename image
				image.attr('src', imageName);
		}
	},
	
	/***************************************************
	Top Social Bar -  Small slide effect for social icons
	***************************************************/     
	topSocialExpander: function(){
		
		$("#top-social li a").hover(function() {
			if ( !$("#top-social .tabdrop").length || $("#top-social .tabdrop").hasClass("hide")) {
				var tsTextWidth = $(this).children('.ts-text').outerWidth() + 52;
				$(this).stop().animate({width: tsTextWidth}, 250, '');
			}
		}, function() {
			if ( $("#top-social .tabdrop").length || $("#top-social .tabdrop").hasClass("hide")) {
				$(this).stop().animate({width: 33}, 250, '');
			}
		});

	},
	
	toggleAjaxSearch: function() {
    $('.search-trigger').click(function() {
			if ($('#ajax_search_container').hasClass('searchHidden'))
			{
				$('#ajax_search_container').removeClass('searchHidden').addClass('show_search_pop');
				$("#ajax_s").focus();
			}
			return false;
    });
	},
	
	doAjaxSearch: function(options)
	{
		 var defaults = {
				delay: 350,                //delay in ms for typing
				minChars: 3,               //no. of characters after we start the search
				scope: '#header'
			}

			this.options = $.extend({}, defaults, options);
			this.scope   = $(this.options.scope);
			this.body = $("body");
			this.timer   = false;
			this.doingSearch = false;
			this.lastVal = "";
			this.bind_ev = function() {
					this.scope.on('keyup', '#ajax_s' , $.proxy( this.test_search, this));
					this.body.on('mousedown', $.proxy( this.hide_search, this) );
			};
			this.test_search = function(e) {
				clearTimeout(this.timer);
				if(e.currentTarget.value.length >= this.options.minChars && this.lastVal != $.trim(e.currentTarget.value))
				{
					this.timer = setTimeout($.proxy( this.search, this, e), this.options.delay);
				}
			};
			this.hide_search = function(e) {
				var element = $(e.target);
				if(!element.is('#ajax_search_container') && element.parents('#ajax_search_container').length == 0)
				{
					$('#ajax_search_container').addClass('searchHidden').removeClass('show_search_pop');
				}
			};
			this.search = function(e) {
				var form        = $("#ajax_searchform"),
						results     = $(".kleo_ajax_results"),
						values      = form.serialize(),
						loading       = $("#kleo-ajax-search-loading"),
						icon        = $("#kleo_ajaxsearch").html();

				values += "&action=kleo_ajax_search";

				//if last result had no items
				if( !this.doingSearch && results.find('.ajax_not_found').length && e.currentTarget.value.indexOf(this.lastVal) != -1) return;

				this.lastVal = e.currentTarget.value;

				$.ajax({
						url: kleoFramework.ajaxurl,
						type: "POST",
						data:values,
						beforeSend: function()
						{
							loading.show();
							this.doingSearch = true;
						},
						success: function(response)
						{
							if(response == 0) response = "";

							results.html(response);
						},
						complete: function()
						{
							$("#kleo_ajaxsearch").html(icon);
							loading.hide();
							this.doingSearch = false;
						}
				});
			};

			//do search...
			this.bind_ev();
	}
	
};


var parallax = {
		init: function() {
			
			$('.bg-full-width').each(function(){
				var $bgobj = $(this); // assigning the object

					$(window).scroll(function() {
							var yPos = -($window.scrollTop() / $bgobj.data('prlx-speed'));

							// Put together our final background position
							var coords = '50% '+ yPos + 'px';

							// Move the background
							$bgobj.css({ backgroundPosition: coords });
					}); 
			});
			

			parallax.changeSizes();
			$(window).smartresize(function () {
				parallax.changeSizes();
			});
	
		},
		
		changeSizes: function() {
			$(".bg-full-video").each(function(){
				var contHeight = $(this).find(".container").height();
				

				if($(window).width() <= 480) {
						$(this).find("video").css("min-width", "300%");
						$(this).css("height", contHeight);
				} else if($(window).width() <= 870) {
						$(this).find("video").css("min-width", "300%");
						$(this).css("height", contHeight);
				} else if($(window).width() <= 1200) {
						$(this).find("video").css("min-width", "100%");
						$(this).css("height", "auto");
				} else {
						$(this).find("video").css("min-width", "100%");
						$(this).css("height", "auto");
				}
			});			
		}
};


/***************************************************
 Quick Contact Form
***************************************************/
$(".kleo-quick-contact-wrapper").click(function (event) {
		if (event.stopPropagation) {
				event.stopPropagation();
		}
		else if (window.event) {
				window.event.cancelBubble = true;
		}
});
$("html").click(function () {
		$(this).find("#kleo-quick-contact").fadeOut(300);
		$('.kleo-quick-contact-link').removeClass('quick-contact-active');
});

$('.kleo-quick-contact-link').on('click', function () {
	if(!$(this).hasClass('quick-contact-active')) {
			$('#kleo-quick-contact').fadeIn(300);
			$(this).addClass('quick-contact-active');
	} else {
			 $('#kleo-quick-contact').fadeOut(300);
			 $(this).removeClass('quick-contact-active');
	}
	return false;
});

$('.kleo-contact-form').submit(ajaxSubmit);
function ajaxSubmit()
{
	var thiss = $(this);
	var customerForm = thiss.serialize();
	thiss.find(".kleo-contact-success").html('');
	thiss.find(".kleo-contact-loading").show();

	$.ajax({
		type:"POST",
		url: kleoFramework.ajaxurl,
		data: customerForm,
		success:function(data){
			thiss.find(".kleo-contact-loading").hide();
			thiss.find(".kleo-contact-success").html(data);
		},
		error: function(errorThrown){
			alert(errorThrown);
		}
	});
 return false;

}


$.fn.kleo_enable_media = function(options) {
	var defaults = {};
	var options = $.extend(defaults, options);

	return this.each(function() {
		var el				= $(this);

		el.mediaelementplayer({
	    // if the <video width> is not specified, this is the default
			defaultVideoWidth: 480,
			// if the <video height> is not specified, this is the default
			defaultVideoHeight: 270,
			// if set, overrides <video width>
			videoWidth: -1,
			// if set, overrides <video height>
			videoHeight: -1,
			// width of audio player
			audioWidth: "100%",
			// height of audio player
			audioHeight: 30,
			// initial volume when the player starts
			startVolume: 0.8,
			// useful for <audio> player loops
			loop: false,
			// enables Flash and Silverlight to resize to content size
			enableAutosize: true,
			// the order of controls you want on the control bar (and other plugins below)
			features: ['playpause','progress','duration','volume','fullscreen'],
			// Hide controls when playing and mouse is not over the video
			alwaysShowControls: false,
			// force iPad's native controls
			iPadUseNativeControls: false,
			// force iPhone's native controls
			iPhoneUseNativeControls: false,
			// force Android's native controls
			AndroidUseNativeControls: false,
			// forces the hour marker (##:00:00)
			alwaysShowHours: false,
			// show framecount in timecode (##:00:00:00)
			showTimecodeFrameCount: false,
			// used when showTimecodeFrameCount is set to true
			framesPerSecond: 25,
			// turns keyboard support on and off for this instance
			enableKeyboard: true,
			// when this player starts, it will pause other players
			pauseOtherPlayers: true,
			// array of keyboard commands
			keyActions: [],
			/*mode: 'shim'*/
		});
	});
}


	
	/***************************************************
	GLOBAL VARIABLES
	***************************************************/
	var $window = jQuery(window),
		body = jQuery('body'),
		deviceAgent = navigator.userAgent.toLowerCase(),
		isMobile = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/);
	
	
	/***************************************************
	LOAD AND READY FUNCTION
	***************************************************/
	var onReady = {
		init: function(){
			kleoPage.init();
			kleoHeader.init();
			
			parallax.init();
		
			kleoIsotope.init();
			bP.init();

			activate_waypoints();
			activate_shortcode_scripts();
			
			
			/* Focus search Bp directory*/
			
			$( "#buddypress div#group-dir-search input[type=text], #buddypress div#members-dir-search input[type=text]" )
					.focusin(function() {
						$( this ).closest( "form" ).css( "min-width", "90%" );
					});
			$( "#buddypress div#group-dir-search input[type=text], #buddypress div#members-dir-search input[type=text]" )
				.focusout(function() {
					$( this ).closest( "form" ).css( "min-width", "60%" );
				});


		}
	};
	
	var onLoad = {
		init: function(){

		}
	};
	
	kleoPage.notReadyInit();
	jQuery(document).ready(onReady.init);
	jQuery(window).load(onLoad.init);
	
})( jQuery );