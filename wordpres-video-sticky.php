<?php
/*
Plugin Name: Wordpress Video Sticky

Description: This plugin allows you to create a sticky/pinned floating video on page Scroll.

Author: Geek Web Solution

Version: 1.2

Author URI: http://geekwebsolution.com/
 */

//do not allow direct access
if (strpos(strtolower($_SERVER['SCRIPT_NAME']), strtolower(basename(__FILE__)))) {
    header('HTTP/1.0 403 Forbidden');
    exit('Forbidden');
}

/* * ******************
 * Global constants
 * ****************** */


// ********** Be sure to use "Match case," and do UPPER and lower case seperately ****************

define('VDGK_VERSION', '0.5');
define('VDGK_BUILD', '1');  // Used to force load of latest .js files
define('VDGK_FILE', __FILE__); // For use in other files
define('VDGK_PATH', plugin_dir_path(__FILE__));
define('VDGK_URL', plugin_dir_url(__FILE__));



/* * ******************
 * Includes
 * ****************** */
//function to run on activation 
 
require_once VDGK_PATH . 'library/class-util.php';

if ( is_admin() ) {
    require_once VDGK_PATH . 'library/class-admin.php';
} else {
	require_once VDGK_PATH . 'library/vdgk_video_sticky.php';
}
//  Initialize plugin settings and hooks ... 
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", array('vdgk_video_stick_util', 'vdgk_plugin_add_settings_link'));	
register_activation_hook( __FILE__,  array('vdgk_video_stick_util','vdgk_register_activation' ));
vdgk_video_stick_util::vdgk_setup();

