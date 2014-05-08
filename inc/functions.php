<?php

// Register Custom Post Type
function create_so_simple_gallery_cpt() {

	$labels = array(
		'name'                => _x( 'Simple Galleries', 'Post Type General Name', 'so-simple-gallery' ),
		'singular_name'       => _x( 'Simple Gallery', 'Post Type Singular Name', 'so-simple-gallery' ),
		'menu_name'           => __( 'Simple Galleries', 'so-simple-gallery' ),
		'all_items'           => __( 'All Simple Galleries', 'so-simple-gallery' ),
		'view_item'           => __( 'View Simple Gallery', 'so-simple-gallery' ),
		'add_new_item'        => __( 'Add Simple Gallery', 'so-simple-gallery' ),
		'add_new'             => __( 'Add New', 'so-simple-gallery' ),
		'edit_item'           => __( 'Edit Simple Gallery', 'so-simple-gallery' ),
		'update_item'         => __( 'Update Simple Gallery', 'so-simple-gallery' ),
		'search_items'        => __( 'Search Simple Gallery', 'so-simple-gallery' ),
		'not_found'           => __( 'Not found', 'so-simple-gallery' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'so-simple-gallery' ),
	);
	$args = array(
		'label'               => __( 'so_simple_gallery', 'so-simple-gallery' ),
		'description'         => __( 'Simple Gallery Post Type', 'so-simple-gallery' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 15,
		'menu_icon'           => 'dashicons-images-alt2',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'query_var'			  => false,
		'publicly_queryable'  => false,
		'rewrite'             => false,
		'capability_type'     => 'post',
	);
	register_post_type( 'so_simple_gallery', $args );

}

/**
 * For the function sosg_register_meta_boxes below I have taken the [demo.php file](https://github.com/rilwis/meta-box/blob/master/demo/demo.php) 
 * of the Meta Box plugin and adapted it for the specific purpose of this SO Simple Gallery Plugin.
 *
 * @since 2014.05.02
 */
function sosg_register_meta_boxes( $meta_boxes ) {
	
	$prefix = 'sosg_';

	$meta_boxes[] = array(
		'id' => 'so_simple_gallery_cmb',
		'title' => __( 'Simple Gallery', 'so-simple-gallery' ),
		'pages' => array( 'so_simple_gallery' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			// IMAGE ADVANCED UPLOAD
			array(
				'name' => __( 'Choose the images you want to upload to display in your Simple Gallery.<br /><br />The Gallery looks best with a maximum of 5 landscape images OR when using portrait style image between 6 and 8 images.<br /><br />Mixing portrait and landscape image in one gallery is <strong>not a good idea</strong>.<br /><br />Once you have saved or published your gallery, you can go to the main <strong>All Simple Galleries</strong> screen to see the shortcode you can use.', 'so-simple-gallery' ),
				'id' => "{$prefix}images",
				'type' => 'image_advanced',
				'max_file_uploads' => 8
			),
		)
	);

	return $meta_boxes;
}

/**
 * Add custom admin columns to so-simple-gallery Custom Post Type
 *
 * @source: http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types
 * @since 2014.05.08
 */
function sosg_edit_admin_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Gallery Title', 'so-simple-gallery' ),
		'shortcode' => __( 'Shortcode', 'so-simple-gallery' ),
		'date' => __( 'Date', 'so-simple-gallery' )
	);

	return $columns;
}

/**
 * Add the shortcode to be used to the admin columns
 *
 * @source: http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types
 * @since 2014.05.08
 */
function sosg_manage_admin_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'shortcode' :

			/* Get the Custom Post Type ID. */
			$shortcode = esc_html( $post_id );

			/* If no ID is found, output a default message. */
			if ( empty( $shortcode ) ) {
				echo __( 'Hover over the Gallery name to check what ID shows in the URL', 'so-simple-gallery' );

			/* If there is an ID, wrap the shortcode around it. */
			} else {
				printf( __( '<code>[so-simple-gallery id="%s"]</code>' ), $shortcode );
			}
			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

/**
 * Change the updated messages to add the shortcode to use in
 *
 * @source: http://thomasmaxson.com/update-messages-for-custom-post-types/
 * @since 2014.05.08
 */
function sosg_update_messages( $messages ) {
    global $post;

    $post_ID = $post->ID;
    $post_type = get_post_type( $post_ID );

    $obj = get_post_type_object( $post_type );
    $singular = $obj->labels->singular_name;

    $messages['so_simple_gallery'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __( '%s updated. Use <code>[so-simple-gallery id="%s"]</code> to add the gallery to your Post or Page', 'so-simple-gallery' ), esc_attr( $singular ), esc_html( $post_ID ), strtolower( $singular ) ),
        4 => sprintf( __( '%s updated.', 'so-simple-gallery' ), esc_attr( $singular ) ),
        5 => isset( $_GET['revision']) ? sprintf( __('%2$s restored to revision from %1$s', 'so-simple-gallery' ), wp_post_revision_title( (int) $_GET['revision'], false ), esc_attr( $singular ) ) : false,
        6 => sprintf( __( '%s published. Use <code>[so-simple-gallery id="%s"]</code> to add the gallery to your Post or Page', 'so-simple-gallery' ), esc_attr( $singular ), esc_html( $post_ID ), strtolower( $singular ) ),
        7 => sprintf( __( '%s saved.', 'so-simple-gallery' ), esc_attr( $singular ) ),
        8 => sprintf( __( '%s submitted. <a href="%s" target="_blank">Preview %s</a>', 'so-simple-gallery' ), $singular, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), strtolower( $singular ) ),
        9 => sprintf( __( '%s scheduled for: <strong>%s</strong>. <a href="%s" target="_blank">Preview %s</a>', 'so-simple-gallery' ), $singular, date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ), strtolower( $singular ) ),
        10 => sprintf( __( '%s draft updated. <a href="%s" target="_blank">Preview %s</a>', 'so-simple-gallery' ), $singular, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), strtolower( $singular ) )
    );

    return $messages;
}

