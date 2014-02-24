<?php

add_action( 'after_setup_theme', 'hs_setup' );

if ( ! function_exists( 'hs_setup' ) ):

function hs_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 200, 150, true ); // Normal post thumbnails

	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// custom menu support
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'header_menu' => 'Header Menu',
	  		  'footer_menu' => 'Footer Menu'
	  		)
	  	);
	}
}
endif;



/* About me */
function hs_post_type_aboutme() {
	register_post_type( 'aboutme',
                array( 
				'label' => __('About me', HS_CURRENT_THEME), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 5,
				'rewrite' => array(
					'slug' => 'aboutme-me',
					'with_front' => FALSE,
				),
				'supports' => array(
						'title',
						'editor')
					) 
				);
}

add_action('init', 'hs_post_type_aboutme');

/* Gallery */
function my_post_type_gallery() {      
    register_post_type( 'gallery',
        array(
            'labels' => array(
                'name' => __( 'Gallery' ),
                'singular_name' => __( 'Gallery' )
            ),
        'public' => true,
        'supports' => array ('title', 'editor', 'thumbnail')
        )
    );

    register_taxonomy(
        'gallery_categories',
        'gallery',
        array(
            'labels' => array(
                'name' => 'Gallery Categories',
                'add_new_item' => 'Add New Gallery Category',
                'new_item_name' => "New Gallery Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'hasArchive' => true
        )
    );
	register_taxonomy('gallery_tag', 'gallery', array('hierarchical' => false, 'label' => theme_locals("tags"), 'singular_name' => theme_locals("tag"), 'rewrite' => true, 'query_var' => true));
}
add_action('init', 'my_post_type_gallery');


/* FAQs */
function phi_post_type_faq() {
	register_post_type('faq', 
				array(
				'label' => __('FAQs', HS_CURRENT_THEME),
				'singular_label' => __('FAQ', HS_CURRENT_THEME),
				'public' => false,
				'show_ui' => true,
				'_builtin' => false, // It's a custom post type, not built in
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array("slug" => "faq"), // Permalinks
				'query_var' => "faq", // This goes to the WP_Query schema
				'supports' => array('title','author','editor'),
				'menu_position' => 5,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				));
}
add_action('init', 'phi_post_type_faq');

?>