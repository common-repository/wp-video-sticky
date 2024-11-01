<?php
/**
 * Description: Admin functions for the plugin 
 *
 * @author Geek Web Solution
 */
class VDGK_video_sticky_admin {
	static $options;
	//menu
	 static function vdgk_video_sticky_forms_menu()
	{
		add_menu_page('Video Stick Settings', 'WP Video Sticky ', 'manage_options', 'vdgk_wordpress_video_sticky',  array(__CLASS__,'vdgk_video_sticky_settings'), 'dashicons-format-video' );   
	}
	static function vdgk_video_sticky_settings(){     
		if (!current_user_can('manage_options'))  {
					wp_die( __('You do not have sufficient permissions to access this page.') );
				}   
		if(isset($_POST['submit-form-video'])){
			 $sticky_video_options=sanitize_text_field($_POST['sticky_video_options']);
			 $sticky_desktop_video_width=sanitize_text_field($_POST['sticky_desktop_video_width']);
			 $vertical_offset=sanitize_text_field($_POST['sticky_video_options_position_vertical_offset']);
			 $vertical_offset_mobile=sanitize_text_field($_POST['sticky_video_options_position_vertical_offset_mobile']);
			 $horizontal_side_offset=sanitize_text_field($_POST['sticky_video_options_position_side_offset']);
			 $horizontal_side_offset_mobile=sanitize_text_field($_POST['sticky_video_options_position_side_offset_mobile']);
			 $sticky_mobile_video_width=sanitize_text_field($_POST['sticky_mobile_video_width']);
			 $vdgk_sticky_video=sanitize_text_field($_POST['vdgk_sticky_video']);
			 $draggable=sanitize_text_field($_POST['draggable']);
			 if(empty($vertical_offset)){
				 
				 $vertical_offset=0;
			 }
			 if(empty($vertical_offset_mobile)){
				 $vertical_offset_mobile=0;
			 }
			 if(empty($horizontal_side_offset)){
				 $horizontal_side_offset=0;
			 }
			 if(empty($horizontal_side_offset_mobile)){
				 $horizontal_side_offset_mobile=0;
			 }
			 if(empty($draggable)){
				 $draggable='off';
			 } 
			 if(empty($vdgk_sticky_video)){
				 $vdgk_sticky_video='off';
			 } 
			 if($sticky_mobile_video_width <= 100){
				
				VDGK_video_sticky_admin::vdgk_failure_option_msg('Sticky video height value must be greater than or equal to 100');
			}
			else{
				if($sticky_desktop_video_width <= 100){
				VDGK_video_sticky_admin::vdgk_failure_option_msg('Sticky video width value must be greater than or equal to 100');
				}
				else{
					
					$VDGK['sticky_video_options']=$sticky_video_options;
					 $VDGK['sticky_desktop_video_width']=$sticky_desktop_video_width; 
					 $VDGK['vertical_offset']=$vertical_offset;
					 $VDGK['vertical_offset_mobile']=$vertical_offset_mobile;
					 $VDGK['horizontal_side_offset']=$horizontal_side_offset;
					 $VDGK['horizontal_side_offset_mobile']=$horizontal_side_offset_mobile;
					 $VDGK['sticky_mobile_video_width']=$sticky_mobile_video_width;
					 $VDGK['draggable']=$draggable;
					 $VDGK['vdgk_sticky_video']=$vdgk_sticky_video;
					 
					 $wpnonce_design=sanitize_text_field($_POST['wpnonce_design']);
				
					if(wp_verify_nonce( $wpnonce_design, 'vdgk_video_sticky_settings' ))
					{
						update_option('VDGK_options', $VDGK, $autoload = null );
						VDGK_video_sticky_admin::vdgk_success_option_msg("Save Setting!");
					}
					else
					{
						VDGK_video_sticky_admin::vdgk_failure_option_msg('Unable to save data!');
					}
				}	
			}	
		}
		
		
		?>
	<div class="wrap">	
	<h2>Sticky Video Settings</h2>	
	<form class="vdgk-sticky-video-admin-form" method="post" action="" enctype="multipart/form-data">
		<?php $options_get=get_option( 'VDGK_options', $default = false ); 
			
	   ?>
		
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">Sticky Video </th>
					<td> 
						
							<label class="vdgk-switch vdgk-switch-Sticky_Video">
							  <input type="checkbox" id="vdgk_Sticky_Video"  name="vdgk_sticky_video" value="on" <?php if(isset($options_get) && !empty($options_get)){if($options_get['vdgk_sticky_video']=='on'){ echo "checked"; } } ?>>
							  <span class="vdgk-slider vdgk-round"></span>
							</label>
						
					</td>
				</tr>
				
				<tr>
					<th scope="row">Position when sticky</th>
					<td>
						<select name="sticky_video_options">
					  <option  value="top_left" <?php if(isset($options_get) && !empty($options_get)){if($options_get['sticky_video_options']=='top_left'){ echo "selected"; } } ?>>Top - Left</option>
					  <option  value="top_right"  <?php if(isset($options_get) && !empty($options_get)){if($options_get['sticky_video_options']=='top_right'){ echo "selected"; } } ?>>Top - Right</option>
					  <option  value="bottom_left"  <?php if(isset($options_get) && !empty($options_get)){if($options_get['sticky_video_options']=='bottom_left'){ echo "selected"; } } ?>>Bottom - Left</option>
					  <option  value="bottom_right"  <?php if(isset($options_get) && !empty($options_get)){if($options_get['sticky_video_options']=='bottom_right'){ echo "selected"; } } ?>>Bottom - Right</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row">Sticky Video Draggable</th>
					<td>
						
							<label class="vdgk-switch vdgk-switch-draggable">
							  <input type="checkbox" id="vdgk_draggable_on"  name="draggable" value="on" <?php if(isset($options_get) && !empty($options_get)){if($options_get['draggable']=='on'){ echo "checked"; } } ?>>
							  <span class="vdgk-slider vdgk-round"></span>
							</label>
						
					</td>
				</tr>
				<?php if(isset($options_get) && !empty($options_get)){if($options_get['draggable']=='on'){
					?>
					<script>
					jQuery( document ).ready(function() {
						jQuery(".vdgk_draggable_active").hide();
					});
					</script>
					<?php
					} } ?>
				<tr class="vdgk_draggable_active">
					<th scope="row">Sticky Desktop video width</th>
					<td>
						<input type="number" id="sticky_desktop_video_width" style="width:5em" min="" max="9999" name="sticky_desktop_video_width" value="<?php if(isset($options_get) && !empty($options_get)){if($options_get['sticky_desktop_video_width']){ echo $options_get['sticky_desktop_video_width']; }  } ?>" > px
					</td>
				</tr>
				<tr class="vdgk_draggable_active">
					<th scope="row">Sticky mobile video width</th>
					<td>
						<input type="number" id="sticky_mobile_video_width" style="width:5em" min="" max="9999" name="sticky_mobile_video_width" value="<?php if(isset($options_get) && !empty($options_get)){if($options_get['sticky_mobile_video_width']){ echo $options_get['sticky_mobile_video_width']; }  }  ?>"> px
					</td>
				</tr>
				<tr>
					<th scope="row">Vertical offset when sticky</th>
					<td>
						<div class="sticky-video-wp-admin--right-text-alignment-box">							
							<span class="vdgk-offset-lable">
								<span>Desktop/Tablet:</span>
								<input type="number" style="width:5em" min="-9999" max="9999" name="sticky_video_options_position_vertical_offset" value="<?php if(isset($options_get) && !empty($options_get)){if($options_get['vertical_offset']){ echo $options_get['vertical_offset']; } else{ echo 0; }  }  ?>">
								<span class="sticky-video-wp-admin--text.-input-unit">px</span>
							</span>
							<span class="vdgk-offset-lable">
								<span>Mobile:</span>
								<input type="number" style="width:5em" min="-9999" max="9999" name="sticky_video_options_position_vertical_offset_mobile" value="<?php if(isset($options_get) && !empty($options_get)){if($options_get['vertical_offset_mobile']){ echo $options_get['vertical_offset_mobile']; } else{ echo 0; }  }  ?>">
								<span class="sticky-video-wp-admin--text-input-unit">px</span>
							</span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">Horizontal offset when sticky</th>
					<td>
						<div class="sticky-video-wp-admin--right-text-alignment-box">
							<span class="vdgk-offset-lable">
								<span>Desktop/Tablet:</span>
								<input type="number" style="width:5em" min="-9999" max="9999" name="sticky_video_options_position_side_offset" value="<?php if(isset($options_get) && !empty($options_get)){if($options_get['horizontal_side_offset']){ echo $options_get['horizontal_side_offset']; } else{ echo 0; }  }  ?>">
								<span class="sticky-video-wp-admin--text-input-unit">px</span>
							</span>
							<span class="vdgk-offset-lable">
								<span>Mobile:</span>
								<input type="number" style="width:5em" min="-9999" max="9999" name="sticky_video_options_position_side_offset_mobile" value="<?php if(isset($options_get) && !empty($options_get)){if($options_get['horizontal_side_offset_mobile']){ echo $options_get['horizontal_side_offset_mobile']; } else{ echo 0; }  }  ?>">
								<span class="sticky-video-wp-admin--text-input-unit">px</span>
							</span>
						</div>
					</td>
				</tr>
				
			</tbody>
		</table>
		<input type="hidden" id="_wpnonce" name="wpnonce_design" value="<?php echo $nonce = wp_create_nonce('vdgk_video_sticky_settings'); ?>" />
		<input type="submit" name="submit-form-video" id="submit-form" class="button button-primary" value="Save Changes">
	</form>
	</div>
	<?php
	}
	static function  vdgk_success_option_msg($msg)
	{
		
		echo ' <div class="notice notice-success vdgk-success-msg is-dismissible"><p>'. $msg . '</p></div>';		
		
	}

	// Error message
	static function  vdgk_failure_option_msg($msg)
	{ 
		echo  '<div class="notice notice-error  is-dismissible"><p>' . $msg . '</p></div>';
			
	}
}    