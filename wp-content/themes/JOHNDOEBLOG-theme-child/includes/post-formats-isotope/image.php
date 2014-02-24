	<?php 
		if (has_post_thumbnail() ):
			$lightbox = get_post_meta(get_the_ID(), 'tz_image_lightbox', TRUE);
			if($lightbox == 'yes')
				$lightbox = TRUE;
			else
				$lightbox = FALSE;
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' );
	?>

	<div class="post-thumb clearfix">		
		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$folio_thumb_width = of_get_option('folio_thumb_width');
			$folio_thumb_height = of_get_option('folio_thumb_height');
			$image = vt_resize( $thumb,'' , $folio_thumb_width, $folio_thumb_height, true, 100 );
		
		if($lightbox) : ?>			
			<figure class="thumbnail thumbnail__portfolio">
<div class="hider-page"></div>
				<a class="image-wrap" data-rel="prettyPhoto" title="<?php the_title(); ?>" href="<?php echo $src[0]; ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" /><span class="zoom-icon"></span></a>
			</figure>
			<div class="clear"></div>	        
				<span class="overlay">
					<span class="arrow"></span>
				</span>			
		<?php else: ?>		
			<figure class="featured-thumbnail thumbnail large">
			<div class="hider-page"></div>
				<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" />
			</figure>
			<div class="clear"></div>			
		<?php endif; ?>		
	</div>
	<?php endif; ?>
	<div class="caption">

	<?php if(!is_singular()) : ?>				
	<!-- Post Content -->
	<div class="post_content">
	
	<?php
$post_meta = of_get_option('post_meta');
if ($post_meta=='true' || $post_meta=='') { ?>

	<?php get_template_part('includes/post-formats-isotope/post-meta-grid'); ?>
	<?php } ?>
	
		<?php $post_excerpt = of_get_option('post_excerpt');
$folio_excerpt_count = of_get_option('folio_excerpt_count');		?>
		<?php if ($post_excerpt=='true' || $post_excerpt=='') { ?>		
			<div class="excerpt">			
			<?php 
				$content = get_the_content();
				$excerpt = get_the_excerpt();
			if (has_excerpt()) {
				the_excerpt();
			} else {
				if(!is_search()) {
				echo my_string_limit_words($content,$folio_excerpt_count);
				} else {
				echo my_string_limit_words($excerpt,$folio_excerpt_count);
				}
			} ?>			
			</div>
		<?php } ?>
<?php
$blog_masonry_btn = of_get_option('blog_masonry_btn');
if ($blog_masonry_btn=='yes') { ?>
		<a href="<?php the_permalink() ?>" class="btn22 btn-1 btn-1c"><?php echo theme_locals("read_more"); ?></a>
		<div class="clear"></div>
<?php } ?>
	</div>
<?php get_template_part( 'includes/post-formats-isotope/share-buttons' ); ?>
	<?php else :	
	endif; ?>
	</div>			