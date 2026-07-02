var revapi318,
	tpj=jQuery;
			
tpj(document).ready(function() {
	if(tpj("#welcome").revolution === undefined){
		revslider_showDoubleJqueryError("#welcome");
	}else{
		revapi318 = tpj("#welcome").show().revolution({
			sliderType:"standard",
			jsFileLocation:"plugins/revolution/revolution/js/",
			sliderLayout:"fullscreen",
			dottedOverlay:"none",
			delay:5000,
			navigation: {
				keyboardNavigation:"off",
				keyboard_direction: "horizontal",
				mouseScrollNavigation:"off",
 				mouseScrollReverse:"default",
				onHoverStop:"off",
				touch:{
					touchenabled:"on",
					touchOnDesktop:"off",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				}
				,
				arrows: {
					style:"new-bullet-bar",
					enable:false,
					hide_onmobile:true,
					hide_under:778,
					hide_onleave:false,
					tmp:'<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div>    <div class="tp-arr-img-over"></div> </div>',
					left: {
						h_align:"left",
						v_align:"center",
						h_offset:40,
						v_offset:-40
					},
					right: {
						h_align:"right",
						v_align:"center",
						h_offset:40,
						v_offset:-40
					}
				}
				,
				bullets: {
					enable:false,
					hide_onmobile:false,
					//hide_over:479,
					style:"hermes",
					hide_onleave:false,
					direction:"horizontal",
					h_align:"center",
					v_align:"bottom",
					h_offset:0,
					v_offset:20,
					space:5,
					tmp:''
				}
			},
			viewPort: {
				enable:true,
				outof:"wait",
				visible_area:"80%",
				presize:true
			},
			responsiveLevels:[1920,1440,1024,778,480],
			visibilityLevels:[1920,1440,1024,778,480],
			gridwidth:[1920,1600,1366,1024,480],
			gridheight:[960,900,820,760,700],
			lazyType:"single",
			parallax: {
				type:"scroll",
				origo:"slidercenter",
				speed:400,
				levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
			},
			shadow:0,
			spinner:"spinner3",
			stopLoop:"off",
			stopAfterLoops:-1,
			stopAtSlide:-1,
			shuffle:"off",
			autoHeight:"off",
			fullScreenAutoWidth:"on",
			fullScreenAlignForce:"on",
			fullScreenOffsetContainer: ".site-header",
			fullScreenOffset: "",
			disableProgressBar:"on",
			hideThumbsOnMobile:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
		});
	}
	try{initSocialSharing("318")} catch(e){}

	function syncSliderCaptionWidths() {
		if (window.innerWidth < 1440) {
			tpj('#welcome_wrapper .slider-caption-text').css('width', '');
			return;
		}

		tpj('#welcome_wrapper .slider-caption-text').each(function () {
			var el = this;
			el.style.width = 'auto';
			var width = Math.ceil(el.scrollWidth);
			if (width > 0) {
				el.style.width = width + 'px';
			}
		});
	}

	function initSliderImageZoom(revapi) {
		var ZOOM_CLASS = 'home-slider-zoom';
		var SLIDE_DELAY = 10000;

		function applyZoom($slide) {
			if (!$slide || !$slide.length) {
				return;
			}

			if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
				return;
			}

			tpj('#welcome_wrapper .tp-bgimg').removeClass(ZOOM_CLASS);

			var $bg = $slide.find('.tp-bgimg').first();
			if (!$bg.length) {
				return;
			}

			$bg.removeClass(ZOOM_CLASS);
			void $bg[0].offsetWidth;
			$bg.css('--slider-zoom-duration', SLIDE_DELAY + 'ms').addClass(ZOOM_CLASS);
		}

		revapi.bind('revolution.slide.onafterswap', function (event, data) {
			if (data && data.currentslide) {
				applyZoom(data.currentslide);
			}
		});

		revapi.bind('revolution.slide.onloaded', function () {
			var $active = tpj('#welcome_wrapper .rev_slider li.active-revslide');
			if ($active.length) {
				applyZoom($active);
			}
		});
	}

	if (typeof revapi318 !== 'undefined' && revapi318) {
		revapi318.bind('revolution.slide.onloaded', syncSliderCaptionWidths);
		revapi318.bind('revolution.slide.onafterswap', syncSliderCaptionWidths);
		initSliderImageZoom(revapi318);
		tpj(window).on('resize', function () {
			clearTimeout(window.__sliderCaptionResizeTimer);
			window.__sliderCaptionResizeTimer = setTimeout(syncSliderCaptionWidths, 150);
		});
		setTimeout(syncSliderCaptionWidths, 400);
	}
});
/*ready*/
