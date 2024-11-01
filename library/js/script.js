jQuery(document).ready(function () {
	var style="";
	var stylee="";
	function sticky_relocate() {
		if (jQuery(".vdgk-sticky-anchor").hasClass("vdgk_sticky_play_anchor")) {
			
			//console.log("style_count"+style_count);
			stylee=jQuery('.vdgk-sticky_vd.vdgk_sticky_play').attr('style');
			
			if(stylee.length > 20 ){				style=jQuery('.vdgk-sticky_vd.vdgk_sticky_play').attr('style');			}
			var window_top = jQuery(window).scrollTop();
			var div_top = jQuery('.vdgk-sticky-anchor.vdgk_sticky_play_anchor') .offset().top;
			if (window_top > div_top) {
				jQuery('.vdgk-sticky_vd').attr('style',style);
				jQuery('.vdgk-sticky_vd.vdgk_sticky_play').addClass('vdgk_sticky');
			} else if (window_top < div_top - jQuery(window).height()) {
				jQuery('.vdgk-sticky_vd').attr('style',style);
				jQuery('.vdgk-sticky_vd.vdgk_sticky_play').addClass('vdgk_sticky');
			} else {
				jQuery('.vdgk-sticky_vd').removeClass('vdgk_sticky');
				stylee=jQuery('.vdgk-sticky_vd.vdgk_sticky_play').attr('style');
				if(stylee.length > 20){
					style=jQuery('.vdgk-sticky_vd.vdgk_sticky_play').attr('style');
				}
				jQuery('.vdgk-sticky_vd').css('left','');
				jQuery('.vdgk-sticky_vd').css('top','');
				}			}
	}
	jQuery(function () {
		jQuery(window).scroll(sticky_relocate);
		sticky_relocate();
	});
	var dir = 1;
	var MIN_TOP = 200;
	var MAX_TOP = 350;

	function autoscroll() {
		var window_top = jQuery(window).scrollTop() + dir;
		if (window_top >= MAX_TOP) {
			window_top = MAX_TOP;
			dir = -1;
		} else if (window_top <= MIN_TOP) {
			window_top = MIN_TOP;
			dir = 1;
		}
		jQuery(window).scrollTop(window_top);
		window.setTimeout(autoscroll, 100);
	}
	var videocontainer = '.vdgk-myVideo';
	jQuery(videocontainer).on('play', function () {
		jQuery("iframe").removeClass('playing');
		jQuery(".fancybox-close").trigger("click");
		jQuery(".vdgk_stop_vimeo").trigger("click");

		jQuery(".vdgk-sticky-anchor").removeClass("vdgk_sticky_play_anchor");
		jQuery(".vdgk-sticky_vd").removeClass('vdgk_sticky_play');
		jQuery(this).parent().addClass('vdgk_sticky_play');
		jQuery(this).parent().prev().addClass('vdgk_sticky_play_anchor');

	});
	jQuery(videocontainer).on('pause', function () {
		//jQuery(this).parent().removeClass('vdgk_sticky_play');
		//jQuery(this).parent().prev().removeClass("vdgk_sticky_play_anchor");

	});
	jQuery(".vdgk_play").bind("click", function () {
		var vid = jQuery(this).prev().get(0);

		if (vid.paused) {
			jQuery(".vdgk_stop_vimeo").trigger("click");
			jQuery(".vdgk-myVideo_tag").each(function (index) {
				jQuery(this).parent().removeClass('vdgk_sticky_play');
				jQuery(this).parent().prev().removeClass("vdgk_sticky_play_anchor");
				jQuery(this).get(0).pause();
			});
			vid.play();
		} else {
			
			vid.pause();
			
		}
	});
	jQuery(".vdgk_video_close_video_tag").bind("click", function () {
		jQuery(".vdgk-sticky-anchor").removeClass("vdgk_sticky_play_anchor");
		jQuery(".vdgk-sticky_vd").removeClass('vdgk_sticky_play');
		jQuery(".vdgk-sticky_vd").removeClass('vdgk_sticky');
		var vid = jQuery(".vdgk-myVideo_tag").get(0);
		if (vid.paused) {
			jQuery(".vdgk_stop_vimeo").trigger("click");
			jQuery(".vdgk-myVideo_tag").each(function (index) {
				jQuery(this).get(0).pause();
			});
			//vid.play();
		} else {
			
			vid.pause();
		}
	});
	
});
//youtube
var ytplayerList;
window.onYouTubeIframeAPIReady = function () {
	var player = [],
		$iframe_parent,
		$this;
	// each all iframe
	jQuery('.vdgk-youtube-iframe').each(function (i) {
		// get parent element
		$this = jQuery(this);
		var this_iframe = jQuery(this);
		$iframe_parent = $this.closest('.iframe-video');
		player[i] = new YT.Player(this, {
			// callbacks
			events: {
				'onReady': function (event) {
					// mute on/off 
					if ($iframe_parent.data('mute')) {
						event.target.mute();
					}
				},
				'onStateChange': function (event) {
					switch (event.data) {
						case 1:
							// start play
							
							if (jQuery(this_iframe).parent().next().hasClass("fancybox-start")) {
								
								jQuery("iframe").removeClass('playing');
								jQuery(this_iframe).addClass('playing');
								jQuery(".fancybox-close").trigger("click");
								jQuery(".vdgk-myVideo_tag").each(function (index) {
									jQuery(this).get(0).pause();
								});
								jQuery(".vdgk_stop_vimeo").trigger("click");
								jQuery(".vdgk-sticky-anchor").removeClass("vdgk_sticky_play_anchor");
								jQuery(".vdgk-sticky_vd").removeClass('vdgk_sticky_play');
								jQuery(this_iframe).parent().addClass('vdgk_sticky_play');
								jQuery(this_iframe).parent().prev().addClass('vdgk_sticky_play_anchor');
								jQuery(this_iframe).parent().next().removeClass("fancybox-start");
								jQuery(this_iframe).parent().next().addClass("fancybox-close");
							}
							/* else{
                            	player[i].pauseVideo();
                            } */
							break;
						case 2:
							// pause
							
							jQuery(this_iframe).removeClass('vdgk_sticky_play');
							jQuery(this_iframe).parent().prev().removeClass("vdgk_sticky_play_anchor");
							jQuery(this_iframe).parent().next().addClass("fancybox-start");
							jQuery(this_iframe).parent().next().removeClass("fancybox-close");

							break;
						case 3:
							// buffering
							
							break;
						case 0:
							// end video
							
							break;
						default:
							'-1'
							// not play
					}
				}
			}
		});

		jQuery(document).on('click', '.vdgk_video_close_youtube', function () {
			
				jQuery(this).parent().removeClass('vdgk_sticky_play');
				jQuery(this).parent().prev().removeClass("vdgk_sticky_play_anchor");
				jQuery(".vdgk-sticky_vd").removeClass('vdgk_sticky');
				player[i].pauseVideo();
				jQuery(this).next().next().addClass("fancybox-start");
				jQuery(this).next().next().removeClass("fancybox-close");
				return false;
			
		});
		jQuery(document).on('click', '.fancybox-close', function () {
			if (!jQuery(this).prev('iframe').hasClass('playing')) {
				var src = "";
				jQuery(this).prev().removeClass('vdgk_sticky_play');
				jQuery(this).prev().prev().removeClass("vdgk_sticky_play_anchor");
				jQuery.each(player, function (j) {
					
					if (jQuery.inArray("playing", player[j]['a']['classList']) !== -1) {
						//in array
					} else {
						player[j].pauseVideo(); //not in array
					}
				});
				jQuery(this).addClass("fancybox-start");
				jQuery(this).removeClass("fancybox-close");
				return false;
			}
		});
	});
}