<?php // Isotope Portfolio Init ?>
<?php 

	$i=1;
	if ( have_posts() ) while ( have_posts() ) : the_post(); 

	// Get categories
	$portfolio_cats = wp_get_object_terms($post->ID, 'category');

	// Get tags
	$portfolio_tags = wp_get_object_terms($post->ID, 'post_tag');

	// Theme Options vars
	$folio_filter = of_get_option('folio_filter');
	$folio_title = of_get_option('folio_title');
	$folio_btn = of_get_option('folio_btn');
	$folio_excerpt = of_get_option('folio_excerpt');
	$folio_excerpt_count = of_get_option('folio_excerpt_count');
	$folio_thumb_width = of_get_option('folio_thumb_width');
	$folio_thumb_height = of_get_option('folio_thumb_height');
	$custom = get_post_custom($post->ID);

	//mediaType init
	$format = get_post_format();
	
	?>
	
	<li class="portfolio_item <?php foreach( $portfolio_cats as $portfolio_cat ) { echo $portfolio_cat->slug.' ';} ?> <?php foreach( $portfolio_tags as $portfolio_tag ) { echo $portfolio_tag->slug.' ';} ?>">

		<div id="post-<?php the_ID(); ?>" <?php post_class('portfolio_item_holder'); ?>>
		
			<?php
			formaticons();
			get_template_part( 'includes/post-formats-isotope/'.$format );
		if ($format == '')
			get_template_part( 'includes/post-formats-isotope/standard' );
			?>		
			
		</div>
	</li>	
	<?php $i++; endwhile; ?>