<?php
/* Plugin Name: SO Simple Gallery
 * Plugin URI: http://so-wp.com/?p=115
 * Description: With the SO Simple Gallery plugin you can add a beautiful gallery to your Posts or Pages with a simple shortcode.
 * Author: Piet Bos
 * Version: 2015.04.23
 * Author URI: http://senlinonline.com
 * Text Domain: so-simple-gallery
 * Domain Path: /languages
 *
 * Copywrite 2014 Piet Bos (piethfbos@gmail.com)
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
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 */

/**
 * get rid of ob_end_flush(): failed to send buffer of zlib output compression (0) 
 * this error occurs sometimes and completely messes up the Dashboard
 *
 * @source: 3rd comment on wordpress.stackexchange.com/a/70597/2015
 * @since 2014.07.30
 */
ini_set( 'zlib.output_handler', '' );

/**
 * Prevent direct access to files
 * 
 * @since 2014.05.02
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Version check; any WP version under 3.9 is not supported (because we use TinyMCE for the shortcode button and we cannot be bothered to build in backward compatibility)
 * 
 * adapted from example by Thomas Scholz (@toscho) http://wordpress.stackexchange.com/a/95183/2015, Version: 2013.03.31, Licence: MIT (http://opensource.org/licenses/MIT)
 *
 * @since 2014.05.02
 */

//Only do this when on the Plugins page.
if ( ! empty ( $GLOBALS['pagenow'] ) && 'plugins.php' === $GLOBALS['pagenow'] )
	add_action( 'admin_notices', 'sosg_check_admin_notices', 0 );

function sosg_min_wp_version() {
	global $wp_version;
	$require_wp = '4.0';
	$update_url = get_admin_url( null, 'update-core.php' );

	$errors = array();

	if ( version_compare( $wp_version, $require_wp, '<' ) ) 

		$errors[] = "You have WordPress version $wp_version installed, but <b>this plugin requires at least WordPress $require_wp</b>. Please <a href='$update_url'>update your WordPress version</a>.";

	return $errors; 
}

function sosg_check_admin_notices()
{
	$errors = sosg_min_wp_version();

	if ( empty ( $errors ) )
		return;

	// Surpress "Plugin activated" notice.
	unset( $_GET['activate'] );

	// this plugin's name
	$name = get_file_data( __FILE__, array ( 'Plugin Name' ), 'plugin' );

	printf( __( '<div class="error"><p>%1$s</p><p><i>%2$s</i> has been deactivated.</p></div>', 'so-simple-gallery' ),
		join( '</p><p>', $errors ),
		$name[0]
	);
	deactivate_plugins( plugin_basename( __FILE__ ) );
}

/**
 * Set-up Action and Filter Hooks
 * 
 * @since 2014.5.02
 */
add_action( 'init', 'create_so_simple_gallery_cpt' ); // see inc/functions.php

add_action( 'plugins_loaded', 'sosg_init' );

add_action( 'admin_menu', 'sosg_add_options_page' );

add_action( 'plugins_loaded', 'sosg_includes' );

add_action( 'admin_head', 'sosg_add_mce_button' );

add_action( 'wp_enqueue_scripts', 'sosg_load_scripts_and_styles' );

add_action( 'admin_enqueue_scripts', 'sosg_mce_css' );

add_filter( 'plugin_action_links', 'sosg_plugin_action_links', 10, 2 );

add_filter( 'rwmb_meta_boxes', 'sosg_register_meta_boxes' ); // see inc/functions.php

add_filter( 'manage_edit-so_simple_gallery_columns', 'sosg_edit_admin_columns' ); // see inc/functions.php

add_action( 'manage_so_simple_gallery_posts_custom_column', 'sosg_manage_admin_columns', 10, 2 ); // see inc/functions.php

add_filter( 'post_updated_messages', 'sosg_update_messages' ); // see inc/functions.php

/**
 * Load the textdomain
 * 
 * @since 2014.5.02
 */
function sosg_init() {
	load_plugin_textdomain( 'so-simple-gallery', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/**
 * Add menu page
 * 
 * @since 2014.5.02
 */
function sosg_add_options_page() {

	// Add the new admin menu and page and save the returned hook suffix
	$hook = add_options_page( 'SO Simple Gallery Instructions', 'SO Simple Gallery', 'manage_options', __FILE__, 'sosg_render_form' );
	
	// Use the hook suffix to compose the hook and register an action executed when plugin's options page is loaded
	add_action( 'admin_print_styles-' . $hook , 'sosg_load_custom_admin_style' );

}

function sosg_load_custom_admin_style() {
	wp_enqueue_style( 'sosg', plugins_url( '/css/settings.css', __FILE__ ) );
}

/**
 * Display a Settings link on the main Plugins page
 * 
 * @since 2014.5.02
 */
function sosg_plugin_action_links( $links, $file ) {

	if ( $file == plugin_basename( __FILE__ ) ) {
		$sosg_links = '<a href="' . get_admin_url() . 'options-general.php?page=so-simple-gallery/so-simple-gallery.php">' . __( 'Read before using', 'so-simple-gallery' ) . '</a>';
		// make the 'Settings' link appear first
		array_unshift( $links, $sosg_links );
	}

	return $links;
}

/**
 * Add the function for the files that need to be included
 * 
 * @since 2014.5.02
 */
function sosg_includes() {

	/* Load the plugin functions file. */
	require_once( 'inc/functions.php' );
	/* Load the plugin settings file ONLY if is_admin. */
	if ( is_admin() ) {
		require_once( 'admin/settings.php' );
	}
	/* Load the Aqua Resizer script file. */
	require_once( 'inc/aq_resizer.php' );
}

/**
 * This function checks whether the Meta Box plugin is active (it needs to be active for this to have any use)
 * and redirects to inc/required-plugin.php script if it is not active.
 *
 * modified using http://wpengineer.com/1657/check-if-required-plugin-is-active/ and the _no_wpml_warning function (of WPML)
 *
 * @since 2014.07.30
 */

$plugins = get_option( 'active_plugins' );

$required_plugin = 'meta-box/meta-box.php';

// multisite throws the error message by default, because the plugin is installed on the network site, therefore check for multisite
if ( ! in_array( $required_plugin , $plugins ) && ! is_multisite() ) {

	add_action( 'admin_notices', 'sosg_no_meta_box_warning' );

}

function sosg_no_meta_box_warning() {
    
    // display the warning message
    echo '<div class="message error"><p>';
    
    printf( __( 'The <strong>SO Simple Gallery plugin</strong> only works if you have the <a href="%s">Meta Box</a> plugin installed.', 'so-simple-gallery' ), 
		admin_url( 'plugins.php?page=install-required-plugin' )
	);
    
    echo '</p></div>';
    
}

/**
 * Include the TGM Activation Class
 *
 * @since 2014.07.30
 */
require_once dirname( __FILE__ ) . '/inc/required-plugin.php';



/* @source: https://www.gavick.com/magazine/adding-your-own-buttons-in-tinymce-4-editor.html#tc-section-4 */
function sosg_add_mce_button() {
    global $typenow;
    // check user permissions
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
   	return;
    }
    // verify the post type
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;
	// check if WYSIWYG is enabled
	if ( get_user_option( 'rich_editing' ) == 'true' ) {
		add_filter( 'mce_external_plugins', 'sosg_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'sosg_register_mce_button' );
	}
}

function sosg_add_tinymce_plugin( $plugin_array ) {
   	$plugin_array['sosg_mce_button'] = plugins_url( '/js/mce-button.js', __FILE__ );
   	return $plugin_array;
}

function sosg_register_mce_button( $buttons ) {
   array_push( $buttons, 'sosg_mce_button' );
   return $buttons;
}

/**
 * Add stylesheet for frontend, but only when the shortcode is actually present
 * 
 * @source: https://codex.wordpress.org/Function_Reference/has_shortcode
 * @since 2014.5.02
 */
function sosg_load_scripts_and_styles() {
	global $post;
	if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'so-simple-gallery') ) {
		wp_enqueue_style( 'sosg', plugins_url( '/css/style.css', __FILE__ ) );
	}
}

/* @source: https://www.gavick.com/magazine/adding-your-own-buttons-in-tinymce-4-editor.html#tc-section-4 */
function sosg_mce_css() {
	wp_enqueue_style( 'sosg_mce', plugins_url( '/css/editor-style.css', __FILE__ ) );
}

// Add Shortcode
function sosg_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts( array(
		'id' => '',
	), $atts ) );
		
	// Code
	if ( strlen( $id ) < 1 ) {
		return;
	}
	
	ob_start();
	
	$sosg_gallery = rwmb_meta( 'sosg_images', 'type=image_advanced', esc_html( $id ) );
	
	$i = 0; // add counter so we can add a number class to each individual image in the gallery
	
	foreach ( $sosg_gallery as $sosg_image ) {
	
	$sosg_thumb = aq_resize( $sosg_image['url'], 75, 75, true );

	$url = $sosg_image['full_url'];
	$width = 800;
	$height = '';
	$crop = true;
	$single = false;
	$upscale = true;
	$sosg_big = aq_resize( $url, $width, $height, $crop, $single, $upscale );
	
	$i++;
	
	/* Quick Reminder:
	$sosg_big[0] = url of full image proportionally resized to 800px wide
	$sosg_big[1] = width in pixels (i.e. 800px)
	$sosg_big[2] = proportional height in pixels
	*/
	
	?>
		
	<dt><img src="<?php echo $sosg_thumb; ?>" alt="<?php echo $sosg_image['alt']; ?>" width="75" height="75" /></dt><dd class="sosg-image-<?php echo $i; ?>"><img src="<?php echo $sosg_big[0]; ?>" alt="<?php echo $sosg_image['alt']; ?>" width="<?php echo $sosg_big[1]; ?>" height="<?php echo $sosg_big[2]; ?>" /><span class="sosg-image-title"><?php echo $sosg_image['title']; ?></span></dd>
	    
	<?php } // endforeach
	
	return '<div class="so-simple-gallery"><dl id="sosg" class="gallery-' . esc_html( $id ) . '">' . ob_get_clean() . '</dl></div>';
	
}

add_shortcode( 'so-simple-gallery', 'sosg_shortcode' );

/** The End **/
