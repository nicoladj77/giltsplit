<?php
function hs_elegance_widgets_init() {
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'					=> 'Sidebar',
		'id' 					=> 'hs_main_sidebar',
		'description'   => __( 'Located at the right side of pages.', HS_CURRENT_THEME),
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	
	// PreFooter Widget Area 1
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'					=> 'PreFooter',
		'id' 					=> 'hs_prefooter_sidebar_1',
		'description'   => __( 'Located at the bottom of pages.', HS_CURRENT_THEME),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footer_heading"><h5>',
		'after_title' => '</h5></div>',
	));
	
	
		// AfterFooter Widget Area 2
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'					=> 'Footer',
		'id' 					=> 'hs_afterfooter_sidebar',
		'description'   => __( 'Located at the bottom of pages.', HS_CURRENT_THEME),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footer_heading"><h5>',
		'after_title' => '</h5></div>',
	));
	
}
/** Register sidebars by running hs_elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'hs_elegance_widgets_init' );
?>