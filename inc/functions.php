<?php
/**
 * For the function sosg_register_meta_boxes below I have taken the [demo.php file](https://github.com/rilwis/meta-box/blob/master/demo/demo.php) 
 * of the Meta Box plugin and adapted it for the specific purpose of this SO Simple Gallery Plugin.
 *
 * @since 2014.05.02
 */

/**
 * Register meta box
 *
 * @since 2014.05.02
 */
function sosg_register_meta_boxes( $meta_boxes )
{

	$prefix = 'sosg_';

	$meta_boxes[] = array(
		'id' => 'so_simple_gallery_cmb',
		'title' => __( 'Simple Gallery', 'so-simple-gallery' ),
		'pages' => array( 'so_simple_gallery' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			// HEADING
			array(
				'type' => 'heading',
				'name' => __( 'Note the ID number of this Simple Gallery (in the permalink), you need to add that to the shortcode later.', 'so-simple-gallery' ),
				'id'   => 'fake_id', // Not used but needed for plugin
			),
			// IMAGE ADVANCED UPLOAD
			array(
				'name' => __( 'Choose the images you want to upload to display in your Simple Gallery (max. 6)', 'so-simple-gallery' ),
				'id' => "{$prefix}images",
				'type' => 'image_advanced',
				'max_file_uploads' => 10
			),
		)
	);

	return $meta_boxes;
}

