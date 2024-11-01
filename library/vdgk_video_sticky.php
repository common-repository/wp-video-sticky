<?php
/**
 * Display functions for the plugin 
 *
 * @author Geek Web Solution
 */
class VDGK_video_sticky {
	// Code to display charts on the front end
	static function vdgk_video_sticky_short_code($vdgk) {
		ob_start();
		$height=295;
		$width=525;
		if(isset($vdgk['height']) && !empty($vdgk['height'])){
			$height=$vdgk['height'];
		}
		if(isset($vdgk['width']) && !empty($vdgk['width'])){
			$width=$vdgk['width'];
		}
		
		if(isset($vdgk['videotype']) && $vdgk['videotype']=='mp4'){
			?>
	<div class="vdgk-video-wrapper" style="width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;">
		<div class="vdgk-sticky-anchor" style=""></div>
		<div class="vdgk-sticky_vd" style="">
			<span class="vdgk_video_draggable"></span>
			<span class="vdgk_video_close vdgk_video_close_video_tag">&times;</span>
			<video class="vdgk-myVideo vdgk-myVideo_tag" controls>
					  <source src="<?php echo $vdgk['src']; ?>" type="video/mp4">
					  Your browser does not support HTML5 video.
					</video>
			<span class="vdgk_play"></span>
		</div>

	</div>
	<?php
		}
		else if(isset($vdgk['videotype']) && $vdgk['videotype']=='youtube'){
			$vdgk_url="";
			if (strpos($vdgk['src'], 'www.youtube.com') !== false) {
				$url=explode("=",$vdgk['src']);
				$vdgk_url=$url['1'];
			}
			if (strpos($vdgk['src'], 'youtu.be') !== false) {
				$url=explode("/",$vdgk['src']);
				$vdgk_url=$url['3'];
			}			
			?>
		<div class="vdgk-video-wrapper" style="width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;">
			<div class="vdgk-sticky-anchor" style=""></div>
			<div class="vdgk-sticky_vd vdgk-myVideo" style="">
				<span class="vdgk_video_draggable"></span>
				<span class="vdgk_video_close vdgk_video_close_youtube">&times;</span>
				<iframe class="vdgk-myVideo vdgk-youtube-iframe" width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="https://www.youtube.com/embed/<?php echo $vdgk_url; ?>?html5=1&enablejsapi=1&autoplay=0" frameborder="0" allowfullscreen>
						</iframe>
			</div>
			<span class="fancybox-start"></span>
		</div>
		<?php
		}
		else if(isset($vdgk['videotype']) && $vdgk['videotype']=='vimeo'){
			$rand=rand();
			$url=explode("/",$vdgk['src']);
			?>
			<div class="vdgk-video-wrapper" style="width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;">
				<div class="vdgk-sticky-anchor" style=""></div>
				<div class="vdgk-sticky_vd" style="">
					<span class="vdgk_video_draggable"></span>
					<span class="vdgk_video_close vdgk_video_close_vimeo<?php echo $vdgk['class'].$rand; ?>">&times;</span>
					<iframe class="vdgk-myVideo vdgk-vimeo-iframe <?php echo $vdgk['class'].$rand; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="https://player.vimeo.com/video/<?php echo $url['3'] ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay; encrypted-media">
					</iframe>
				</div>
				<span class="vdgk_stop_vimeo"></span>
				<span class="vdgk_play_vimeo"></span>
			</div>
			<?php 
			$vdgk_sticky_option=get_option('VDGK_options', $default = false );
			$vdgk_sticky_video=$vdgk_sticky_option['vdgk_sticky_video'];
			if($vdgk_sticky_video=='on'){
			?>
			<script>
				var iframe<?php echo $vdgk['class'].$rand; ?> = document.querySelector('.<?php echo $vdgk['class'].$rand; ?>');
				var player<?php echo $vdgk['class'].$rand; ?> = new Vimeo.Player(iframe<?php echo $vdgk['class'].$rand; ?>);
				player<?php echo $vdgk['class'].$rand; ?>.on('play', function() {
					var bodyClass<?php echo $vdgk['class'].$rand; ?> = document.querySelector('.<?php echo $vdgk['class'].$rand; ?>').classList;
					jQuery("iframe").removeClass('playing');
					jQuery(".fancybox-close").trigger("click");
					jQuery(".vdgk-myVideo_tag").each(function(index) {
						jQuery(this).get(0).pause();
					});
					jQuery(".vdgk-sticky-anchor").removeClass("vdgk_sticky_play_anchor");
					jQuery(".vdgk-sticky_vd").removeClass('vdgk_sticky_play');
					jQuery(".<?php echo $vdgk['class'].$rand; ?>").parent().prev().addClass('vdgk_sticky_play_anchor');
					jQuery(".<?php echo $vdgk['class'].$rand; ?>").parent().addClass('vdgk_sticky_play');
				});
				player<?php echo $vdgk['class'].$rand; ?>.on('pause', function() {
					var bodyClasss<?php echo $vdgk['class'].$rand; ?> = document.querySelector('.<?php echo $vdgk['class'].$rand; ?>').classList;
					
				});


				jQuery('.vdgk_video_close_vimeo<?php echo $vdgk['class'].$rand; ?>').click(function() {
					jQuery(".<?php echo $vdgk['class'].$rand; ?>").parent().removeClass('vdgk_sticky_play');
					jQuery(".<?php echo $vdgk['class'].$rand; ?>").parent().prev().removeClass("vdgk_sticky_play_anchor");
					jQuery(".vdgk-sticky_vd").removeClass('vdgk_sticky');
					player<?php echo $vdgk['class']; ?>.pause();
					

				});
				jQuery('.vdgk_stop_vimeo').click(function() {
					jQuery(".vdgk-vimeo-iframe").parent().removeClass('vdgk_sticky_play');
					jQuery(".vdgk-vimeo-iframe").parent().prev().removeClass("vdgk_sticky_play_anchor");
					player<?php echo $vdgk['class'].$rand; ?>.pause();
				});


				jQuery('.vdgk_play_vimeo').click(function() {
					player<?php echo $vdgk['class'].$rand; ?>.play();
				})
			</script>
			

			<?php 
			}
		}
		
		return ob_get_clean(); 
    }
	
	static function vdgk_style(){
		$vdgk_sticky_option=get_option('VDGK_options', $default = false );
		$option_position=explode("_",$vdgk_sticky_option['sticky_video_options']);
		$sticky_desktop_video_width=$vdgk_sticky_option['sticky_desktop_video_width'];
		$option_vertical=$vdgk_sticky_option['vertical_offset'];
		$option_horizontal=$vdgk_sticky_option['horizontal_side_offset'];
		$vertical_offset_mobile=$vdgk_sticky_option['vertical_offset_mobile'];
		$horizontal_side_offset_mobile=$vdgk_sticky_option['horizontal_side_offset_mobile'];
		$sticky_mobile_video_width=$vdgk_sticky_option['sticky_mobile_video_width'];
		$draggable=$vdgk_sticky_option['draggable'];
		
		if($draggable=='on'){
			?>
				<style>
					.vdgk_sticky.vdgk_sticky_play {
						margin: 0px;
						will-change: position, transform, opacity;
						position: fixed !important;
						z-index: 9;
						width: 300px;
						height:225px;
						padding: 1px;
						<?php echo $option_position['0'] ?>: <?php echo $option_vertical;
						?>px;
						<?php echo $option_position['1'] ?>: <?php echo $option_horizontal;
						?>px;
						background-color: #000;
					}
					@media (max-width:480px){
						.vdgk-video-wrapper,
						.vdgk-myVideo{
							width: 100% !important;
							height: 160px !important;
						}
						.vdgk_sticky.vdgk_sticky_play{
							width:<?php echo $sticky_mobile_video_width;?>px !important;	
							<?php echo $option_position['0'] ?>: <?php echo $vertical_offset_mobile;
							?>px;
							<?php echo $option_position['1'] ?>: <?php echo $horizontal_side_offset_mobile;
							?>px;
							height: 160px;
						}						
					}
				</style>
				<?php
		}
		else{
		?>
				<style>
					.vdgk_sticky.vdgk_sticky_play {
						margin: 0px;
						will-change: position, transform, opacity;
						position: fixed;
						z-index: 9;
						width: <?php echo $sticky_desktop_video_width;?>px;
						padding: 1px;
						<?php echo $option_position['0'] ?>: <?php echo $option_vertical;
						?>px;
						<?php echo $option_position['1'] ?>: <?php echo $option_horizontal;
						?>px;
						background-color: #000;
					}
					@media (max-width:1024px){
						.vdgk-video-wrapper,
						.vdgk-myVideo{
							width: 100% !important;
							height: auto !important;
						}
						.vdgk_sticky.vdgk_sticky_play{
							width:<?php echo $sticky_mobile_video_width;?>px !important;	
							<?php echo $option_position['0'] ?>: <?php echo $vertical_offset_mobile;
							?>px;
							<?php echo $option_position['1'] ?>: <?php echo $horizontal_side_offset_mobile;
							?>px;
							height: auto;
						}
					}
				</style>
				<?php
		}		
	}
	static function vdgk_script(){
		$vdgk_sticky_option=get_option('VDGK_options', $default = false );
		$draggable=$vdgk_sticky_option['draggable'];
		$vdgk_sticky_video=$vdgk_sticky_option['vdgk_sticky_video'];
			if($vdgk_sticky_video=='on'){
				if($draggable=='on'){
					?>
					<script>
						jQuery('.vdgk-sticky_vd').show(0).draggable({   containment: "window"   });
						var handle = jQuery( ".vdgk-sticky_vd" ).draggable( "option", "handle" );
						jQuery('.vdgk-sticky_vd').draggable( "option", "handle", '.vdgk_video_draggable' );
						
						
					</script>
					<?php
				}
			}
	}
	
}