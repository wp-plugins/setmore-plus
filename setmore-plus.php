<?php
/**
 * Plugin Name: SetMore Plus
 * Plugin URI: http://www.wpmission.com/plugins/setmore-plus
 * Description: Easy online appointments.
 * Version: 2.2
 * Author: Chris Dillon
 * Author URI: http://www.wpmission.com
 * Text Domain: setmore-plus
 * Requires: 3.3 or higher
 * License: GPLv3 or later
 *
 * Copyright 2014  Chris Dillon  chris@wpmission.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class SetmorePlus {

	function __construct() {
	
		load_plugin_textdomain( 'setmore-plus', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'admin_init', array( $this, 'default_settings' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_filter( 'plugin_action_links', array( $this, 'plugin_action_links' ), 10, 2 );
		
		add_action( 'init', array( $this, 'register_shortcodes' ) );
		add_action( 'widgets_init', array( $this, 'register_widget' ) );

	}

	/*
	 * Plugin activation and update.
	 */
	public function default_settings() {
		
		$plugin_data = get_plugin_data( __FILE__, false );
		$plugin_version = $plugin_data['Version'];

		$default_options = array(
			'url' => '',
			'lnt' => 1
		);

		// Updating from 2.1
		$previous_setting = get_option( 'setmoreplus_url' );
		if ( $previous_setting ) {
			$default_options['url'] = $previous_setting;
			delete_option( 'setmoreplus_url' );
		}
		
		$options = get_option( 'setmoreplus' );
		if ( ! $options ) {
			// New activation
			update_option( 'setmoreplus', $default_options );
		}
		else {
			// New options
			if ( ! isset( $options['plugin_version'] ) || $options['plugin_version'] != $plugin_version ) {
				$options = array_merge( $default_options, $options );
				$options['plugin_version'] = $plugin_version;
				update_option( 'setmoreplus', $options );
			}
		}
		
	}

	/*
	 * Plugin list action links
	 */
	public function plugin_action_links( $links, $file ) {
		if ( $file == plugin_basename( __FILE__ ) ){
			$settings_link = '<a href="options-general.php?page=setmore-plus.php">' . __( 'Settings', 'setmore-plus' ) . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}
	
	public function add_options_page() {
		add_options_page( 'SetMore Plus Options', 'SetMore Plus', 'manage_options', basename( __FILE__ ), array( $this, 'settings_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}
	
	public function register_settings() {
		register_setting( 'setmoreplus-settings-group', 'setmoreplus', array( $this, 'sanitize_options' ) );
	}

	public function sanitize_options( $input ) {
		$input['url'] = sanitize_text_field( $input['url'] );
		$input['lnt'] = isset( $input['lnt'] ) ? 1 : 0;
		return $input;
	}

	public function admin_scripts( $hook ) {
		if ( 'widgets.php' == $hook ) {
			wp_enqueue_style( 'setmoreplus-widget-style', plugins_url( 'css/widget.css', __FILE__ ) );
			wp_enqueue_style( 'setmoreplus-widget-admin', plugins_url( 'css/widget-admin.css', __FILE__ ) );
		}
		elseif ( 'settings_page_setmore-plus' == $hook ) {
			wp_enqueue_style( 'setmoreplus-widget-admin', plugins_url( 'css/admin.css', __FILE__ ) );
		}
	}

	public function settings_page() {
		$options = get_option( 'setmoreplus' );
		?>
		<div class="wrap">
		
			<h2>SetMore Plus</h2>
			
			<p><em>This plugin is offered by <a href="http://www.wpmission.com" target="_blank">WP Mission</a>. We have no affiliation with SetMore Appointments and provide no technical support for their service.</em> We do, however, provide lifetime support for this plugin, including <a href="http://www.wpmission.com/contact" target="_blank">free help</a> getting the "Book Appointment" button to match your theme.</p>
			<hr>
			
			<h3>Your SetMore Booking URL</h3>
			
			<form method="post" action="options.php">
				<?php settings_fields( 'setmoreplus-settings-group' ); ?>
				<?php do_settings_sections( 'setmoreplus-settings-group' ); ?>
				
				<div>
							<input type="text" id="setmoreplus_url" name="setmoreplus[url]" style="width: 310px;" value="<?php echo $options['url']; ?>" placeholder="SetMore Booking Page URL">
							<p>To find your unique URL, <a href="http://my.setmore.com" target="_blank">sign in to SetMore</a> and click on the Profile tab. Or get started with <a href="http://www.setmore.com" target="_blank">a completely free account</a>.</p>
				</div>

				<div class="option leave-no-trace">
					<div class="onoffswitch">
						<input id="myonoffswitch" type="checkbox" name="setmoreplus[lnt]" class="onoffswitch-checkbox" value="1" <?php checked( 1, $options['lnt'] ); ?>>
						<label class="onoffswitch-label" for="myonoffswitch">
							<div class="onoffswitch-inner"></div>
							<div class="onoffswitch-switch"></div>
						</label>
					</div>
					<label for="myonoffswitch"><div class="option-label"><?php _e( 'Leave No Trace', 'wider-admin-menu' ); ?></div></label>
					<div class="option-desc">
						<?php _e( 'Deleting this plugin will also delete these settings.', 'wider-admin-menu' ); ?><br>
						<?php _e( 'Deactivating it will <strong>not</strong> delete these settings.', 'wider-admin-menu' ); ?>
					</div>
				</div>

				<?php submit_button(); ?>
			</form>
			<hr>
			
			<h3>To add SetMore to your site</h3>
			
			<p>Use a widget to add a "Book Appointment" button that opens a dialog box with the SetMore scheduler.</p>
			
			<p>Or use the <span class="code">[setmoreplus]</span> shortcode to place the SetMore scheduler directly on a page.</p>
			
		</div>
		<?php
	}
	
	public function register_widget() {
		register_widget( 'SetmorePlus_Widget' );
	}

	public function iframe_function() {
		$html = '<iframe src="' . get_option( 'setmoreplus_url' ) . '" width="600" height="750" frameborder="0"></iframe>';
		return $html;
	}

	public function register_shortcodes() {
		add_shortcode( 'setmoreplus', array( $this, 'iframe_function' ) );
	}
	
}


class SetmorePlus_Widget extends WP_Widget {

	// Instantiate
	function __construct() {
		parent::__construct(
			'wpmsmp_widget',  // base ID
			__( 'SetMore Plus', 'setmore-plus' ),  // name
			array( 'description' => __( 'Add a "Book Appointment" button.', 'setmore-plus' ) )  // args
		);
	}
		
	// Output
	public function widget( $args, $instance ) {
		// Load stylesheet and Colorbox
		wp_enqueue_style( 'setmoreplus-widget-style', plugins_url( 'css/widget.css', __FILE__ ) );
		wp_enqueue_style( 'colorbox-style', plugins_url( 'colorbox/colorbox.css', __FILE__ ) );
		wp_enqueue_script( 'colorbox-script', plugins_url( 'colorbox/jquery.colorbox-min.js', __FILE__ ), array( 'jquery' ) );
		add_action( 'wp_footer', array( $this, 'widget_script' ), 50 );
		
		$setmore_options = get_option('setmoreplus');
		$setmore_url = $setmore_options['url'];
		$defaults = array( 'link-text' => __( 'Book Appointment', 'setmore-plus') );
		$data = array_merge( $args, $instance );
		if ( empty( $data['link-text'] ) )
			$data['link-text'] = $defaults['link-text'];
		
		echo $data['before_widget'];
		
		// widget title
		if ( ! empty( $data['title'] ) )
			echo $data['before_title'] . $data['title'] . $data['after_title'];
		
		// widget text
		if ( ! empty( $data['text'] ) )
			echo '<p>' . $data['text'] . '</p>';
		
		// widget link
		if ( 'button' == $data['style'] ) {
			?>
			<a class="iframe" href="<?php echo $setmore_url; ?>"><img border="none" src="<?php echo plugins_url( 'images/SetMore-book-button.png', __FILE__ ); ?>" alt="Book an appointment"></a>
			<?php
		}
		elseif( 'link' == $data['style'] ) {
			?>
			<a class="setmore iframe" href="<?php echo $setmore_url; ?>"><?php _e( $data['link-text'], 'setmore-plus' ); ?></a>
			<?php
		}
		else {
			?>
			<a class="iframe" href="<?php echo $setmore_url; ?>"><?php _e( $data['link-text'], 'setmore-plus' ); ?></a>
			<?php
		}
		
		echo $data['after_widget'];
	}

	// Options form
	public function form( $instance ) {
		$defaults = array( 
				'title'     => __( '', 'setmore-plus' ), 
				'text'      => __( '', 'setmore-plus' ),
				'link-text' => __( 'Book Appointment', 'setmore-plus' ),
				'style'     => 'button'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$link_text = empty( $instance['link-text'] ) ? $defaults['link-text'] : $instance['link-text'];
		?>
		<script>
			// clicking demo buttons (1) selects radio button and (2) prevents link action
			jQuery(document).ready(function($) { 
				$("a.setmore-admin").click(function(e){ 
					$(this).prev("input").attr("checked", "checked").focus();
					e.preventDefault();
				}); 
			});
		</script>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'setmore-plus' ); ?>: <em><?php _e( '(optional)', 'setmore-plus' ); ?></em></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" class="text widefat" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text', 'setmore-plus' ); ?>: <em><?php _e( '(optional)', 'setmore-plus' ); ?></em></label>
			<textarea id="<?php echo $this->get_field_id( 'text' ); ?>" class="text widefat" name="<?php echo $this->get_field_name('text'); ?>" rows="3"><?php echo $instance['text']; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link-text' ); ?>"><?php _e( 'Link Text', 'setmore-plus' ); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'link-text' ); ?>" type="text" class="text widefat" name="<?php echo $this->get_field_name('link-text'); ?>" value="<?php echo $instance['link-text']; ?>" placeholder="<?php echo $defaults['link-text']; ?>">
		</p>
		
		<?php _e( 'Style', 'setmore-plus' ); ?>:
		<ul class="setmore-style">
			<li>
				<label for="<?php echo $this->get_field_id( 'style-button' ); ?>">
					<input id="<?php echo $this->get_field_id( 'style-button' ); ?>" type="radio" name="<?php echo $this->get_field_name( 'style' ); ?>" value="button" <?php checked( $instance['style'], 'button' ); ?>>
					<a class="setmore-admin" href="#"><img style="vertical-align: middle;" border="none" src="<?php echo plugins_url( 'images/SetMore-book-button.png', __FILE__ ); ?>" alt="Book an appointment"></a>
				</label>
			</li>
			<li>
				<label for="<?php echo $this->get_field_id( 'style-link' ); ?>">
					<input id="<?php echo $this->get_field_id( 'style-link' ); ?>" type="radio" name="<?php echo $this->get_field_name( 'style' ); ?>" value="link" <?php checked( $instance['style'], 'link' ); ?>>
					<a class="setmore setmore-admin" href="#"><?php echo $link_text; ?></a>
				</label>
			</li>
			<li>
				<label for="<?php echo $this->get_field_id( 'style-none' ); ?>">
					<input id="<?php echo $this->get_field_id( 'style-none' ); ?>" type="radio" name="<?php echo $this->get_field_name( 'style' ); ?>" value="none" <?php checked( $instance['style'], 'none' ); ?>>
						<a class="setmore-admin" href="#"><?php echo $link_text; ?></a>
				</label>
				<p><?php _e( "Unstyled. Add style to <code>a.setmore</code> in your theme's stylesheet.", 'setmore-plus' ); ?></p>
			</li>
		</ul>
		<?php
	}

	// Save settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['text']      = strip_tags( $new_instance['text'] );
		$instance['link-text'] = strip_tags( $new_instance['link-text'] );
		$instance['style']     = $new_instance['style'];
		
		return $instance;
	}

	// Script to call lightbox
	public function widget_script() {
		?>
		<script>
		jQuery(document).ready(function($) { 
			$(".iframe").colorbox({
				'iframe'     : true,
				'transition' : 'elastic',
				'speed'      : 200,
				'height'		 : 680,
				'width'			 : 540,
				'opacity'    : 0.8,
			});
		});
		</script>
		<?php
	}

}

new SetmorePlus();
