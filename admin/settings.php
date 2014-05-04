<?php
/**
 * Render the Plugin options form
 * @since 2.0.0
 * @modified 2014.04.04 to add SO PLUS reference
 */
function sosg_render_form() { ?>

	<div class="wrap">
		
		<!-- Display Plugin Header, and Description -->
		<h2><?php _e( 'SO Simple Gallery Instructions', 'so-simple-gallery' ); ?></h2>
		
		<p><?php _e( 'Below you can find some instruction on how to use the SO Simple Gallery plugin.', 'so-simple-gallery' ); ?></p>
			
		<div class="sosg-instructions">
	
			<p><?php _e( 'With the SO Simple Gallery plugin you can upload up to 10 images per gallery.<br />I have restricted the maximum number of uploads, because it is a vertically oriented plugin and beyond 10 it rapidly becomes ugly.', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'The plugin uses a script that dynamically resizes the images, so you do not have to worry whether or not your images are suitable for use.', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'The only thing you need to keep in mind are the <strong>minimum dimensions</strong> of the images you plan to use;<br />these are: 400 pixels (width and/or height).', 'so-simple-gallery' ); ?></p>
			<hr />
			<p><?php _e( 'The plugin adds <i class="dashicons-images-alt2"></i> <em>Simple Galleries</em> to your sidebar under the Media menu.', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'Via that menu you can see all your existing Simple Galleries and Add a New Simple Gallery.', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'You can give your Simple Gallery a title and then start uploading your images.<br />You can choose your images from the Media Library or Upload them from your computer.', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'After saving the Simple Gallery, you only need to take note of the ID number of that specific Gallery.<br />You ned that number later for the shortcode.', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'Once you have added one or more Simple Galleries it is time to add it/them to your content.', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'For that I have made a simple to use shortcode button available that you will see if you are using the Visual Editor.', 'so-simple-gallery' ); ?></p>
			<?php
				$screenshot_button = plugins_url( '../images/shortcode-button.png', __FILE__ );
			?>
			<img src="<?php echo $screenshot_button; ?>" width="600" height="265" alt="" title="shortcode-button" />
			<p><?php _e( 'If you click that button it will automatically insert the following shortcode:<br /><code>[so-simple-gallery id=""]</code>', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'Now here is where you need to input the ID number of the Gallery you want to show, like:<br><code>[so-simple-gallery id="123"]</code> (where 123 is the ID number of your Simple Gallery).', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'If you are not using the Visual Editor, you can just copy the shortcode from the above example and add it to your HTML content.', 'so-simple-gallery' ); ?></p>
			<p><?php _e( 'If you want to include the shortcode in one of your template files, then you need to use the shortcode like this:<br><code>&lt;?php echo do_shortcode(); ?&gt;</code> and then add the shortcode to between opening and closing single quotes between the parenthesis.', 'so-simple-gallery' ); ?></p>
			<p><?php _e( '', 'so-simple-gallery' ); ?></p>
			<p><?php _e( '', 'so-simple-gallery' ); ?></p>
		
		</div><!-- .sosg-instructions -->

		<hr />
		
		<p class="rate-this-plugin">
			<?php
			/* Translators: 1 is link to WP Repo */
			printf( __( 'If you have found this plugin at all useful, please give it a favourable rating in the <a href="%s" title="Rate this plugin!">WordPress Plugin Repository</a>.', 'so-simple-gallery' ), 
				esc_url( 'http://wordpress.org/support/view/plugin-reviews/so-simple-gallery' )
			);
			?>
		</p>
		
		<p class="support">
			<?php
			/* Translators: 1 is link to Github Repo */
			printf( __( 'If you have an issue with this plugin or want to leave a feature request, please note that I give <a href="%s" title="Support or Feature Requests via Github">support via Github</a> only.', 'so-simple-gallery' ), 
				esc_url( 'https://github.com/senlin/so-simple-gallery/issues' )
			);
			?>
		</p>
		
		<div class="author postbox">
			
			<h3 class="hndle">
				<span><?php _e( 'About the Author', 'so-simple-gallery' ); ?></span>
			</h3>
			
			<div class="inside">
				<div class="top">
					<img class="author-image" src="http://www.gravatar.com/avatar/<?php echo md5( 'info@senlinonline.com' ); ?>" />
					<p>
						<?php printf( __( 'Hi, my name is Piet Bos, I hope you like this plugin! Please check out any of my other plugins on <a href="%s" title="SO WP Plugins">SO WP Plugins</a>. You can find out more information about me via the following links:', 'so-simple-gallery' ),
							esc_url( 'http://so-wp.com' )
						); ?>
					</p>
				</div> <!-- end .top -->
				
				<ul>
					<li><a href="https://senlinonline.com/plus/" target="_blank" title="SO PLUS"><?php _e( 'SO PLUS', 'so-simple-gallery' ); ?></a></li>
					<li><a href="http://senlinonline.com/" target="_blank" title="Senlin Online"><?php _e( 'Senlin Online', 'so-simple-gallery' ); ?></a></li>
					<li><a href="http://wpti.ps/" target="_blank" title="WP TIPS"><?php _e( 'WP Tips', 'so-simple-gallery' ); ?></a></li>
					<li><a href="https://plus.google.com/+PietBos" target="_blank" title="Piet on Google+"><?php _e( 'Google+', 'so-simple-gallery' ); ?></a></li>
					<li><a href="https://cn.linkedin.com/in/pietbos" target="_blank" title="LinkedIn profile"><?php _e( 'LinkedIn', 'so-simple-gallery' ); ?></a></li>
					<li><a href="https://twitter.com/piethfbos" target="_blank" title="Twitter"><?php _e( 'Twitter: @piethfbos', 'so-simple-gallery' ); ?></a></li>
					<li><a href="https://github.com/senlin" title="on Github"><?php _e( 'Github', 'so-simple-gallery' ); ?></a></li>
					<li><a href="https://profiles.wordpress.org/senlin/" title="on WordPress.org"><?php _e( 'WordPress.org Profile', 'so-simple-gallery' ); ?></a></li>
				</ul>
			
			</div> <!-- end .inside -->
		
		</div> <!-- end .postbox -->

	</div> <!-- end .wrap -->

<?php }

