<?php
/**
 * Utility functions for the plugin
 *
 * @author Geek Web Solution
 */
class vdgk_video_stick_util {

     static function vdgk_setup() {
        // Come here when the plugin is run
		
        add_shortcode('vdgk-video-sticky', array('VDGK_video_sticky','vdgk_video_sticky_short_code'), 1);        
        add_shortcode('vdgk_video_sticky', array('VDGK_video_sticky','vdgk_video_sticky_short_code'), 1);
		add_action('admin_head',array('vdgk_video_stick_util', 'vdgk_mce_button'));
		add_action('wp_footer',array('VDGK_video_sticky', 'vdgk_style'));
		add_action('wp_footer',array('VDGK_video_sticky', 'vdgk_script'));
		 if (is_admin()) {
            // Set up admin actions
			add_action('admin_menu', array('VDGK_video_sticky_admin', 'vdgk_video_sticky_forms_menu'));
            add_action('admin_enqueue_scripts', array('vdgk_video_stick_util','vdgk_enqueue_admin_scripts'));
			
        } else {
            // Set up front end actions
			$vdgk_sticky_option=get_option('VDGK_options', $default = false );
			$vdgk_sticky_video=$vdgk_sticky_option['vdgk_sticky_video'];
			if($vdgk_sticky_video=='on'){
				add_action('wp_enqueue_scripts', array('vdgk_video_stick_util','vdgk_enqueue_scripts'));
			}
			
        }
    }
	static function vdgk_plugin_add_settings_link( $links ) {
				$settings_link = '<a href="options-general.php?page=vdgk_wordpress_video_sticky">' . __( 'Settings' ) . '</a>';
				array_push( $links, $settings_link );
				return $links;
			}
		// Filter Functions with Hooks
	static function vdgk_mce_button() {
	  // Check if user have permission
	  if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	  }
	  
	  if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins',array('vdgk_video_stick_util', 'vdgk_tinymce') );
		add_filter( 'mce_buttons', array('vdgk_video_stick_util','vdgk_register_mce_button') );
	  }
	}
	static function vdgk_tinymce( $plugin_array ) {
	  $plugin_array['vdgk_mce_button'] = plugins_url('/js/vigk_buttons.js', __FILE__);
	  return $plugin_array;
	}

	// Register new button in the editor
	static function vdgk_register_mce_button( $buttons ) { 
	  array_push( $buttons, 'vdgk_mce_button' );
	  return $buttons;
	}
	static function vdgk_register_activation() {
		 $VDGK['sticky_video_options']='bottom_right';
		 $VDGK['sticky_desktop_video_width']=300;
		 $VDGK['vertical_offset']=20;
		 $VDGK['vertical_offset_mobile']=10;
		 $VDGK['horizontal_side_offset']=20;
		 $VDGK['horizontal_side_offset_mobile']=10;			
		 $VDGK['sticky_mobile_video_width']=200;		
		 $VDGK['vdgk_sticky_video']="on";		
		 $VDGK['draggable']="off";		
		 $options_get=get_option( 'VDGK_options', $default = false );
		 if(empty($options_get)){
			update_option('VDGK_options', $VDGK, $autoload = null );
		 }
		 
	}
	
    static function vdgk_enqueue_scripts() {
		wp_enqueue_script('vdgk_video_stick_script', plugins_url('/js/script.js', __FILE__), array('jquery'), VDGK_BUILD);
		wp_enqueue_script('vdgk_video_stick_player', plugins_url('/js/player.js', __FILE__), array('jquery'), VDGK_BUILD);
		wp_enqueue_style('vdgk_video_stick_style', plugins_url('css/style.css', __FILE__), false, VDGK_BUILD);
		wp_enqueue_script('vdgk_video_stick_youtube', plugins_url('/js/youtube.js', __FILE__), array('jquery'), VDGK_BUILD);
		wp_enqueue_script('vdgk_video_stick_jquery-ui', plugins_url('/js/jquery-ui.js', __FILE__), array('jquery'), VDGK_BUILD); 
		wp_enqueue_script('vdgk_video_stick_jqueryuitouch-punch', plugins_url('/js/jquery.ui.touch-punch.js', __FILE__), array('jquery'), VDGK_BUILD); 
		
    }

    static function vdgk_enqueue_admin_scripts() {
        wp_enqueue_style('vdgk_video_admin_styles', plugins_url('css/styles-admin.css', __FILE__), false, VDGK_BUILD);
        wp_enqueue_script('vdgk_video_stick_admin_scripts', plugins_url('js/scripts-admin.js', __FILE__), false, VDGK_BUILD);
		//wp_enqueue_script('vdgk_video_stick_vigk_buttons', plugins_url('/js/vigk_buttons.js', __FILE__), array('jquery'), VDGK_BUILD);
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_style ('wp-jquery-ui-dialog');
        
	 }
    
    

} // end class vdgk_video_stick_util
