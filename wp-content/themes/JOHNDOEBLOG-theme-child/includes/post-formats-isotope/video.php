<?php 
		
		$embed = get_post_meta(get_the_ID(), 'tz_video_embed', true);
		
		// get thumb
		if(has_post_thumbnail()) {
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$folio_thumb_width = of_get_option('folio_thumb_width');
			$folio_thumb_height = of_get_option('folio_thumb_height');
			$image = vt_resize( $thumb,'' , $folio_thumb_width, $folio_thumb_height, true, 100 );
		}
	?>

	<div class="video-wrap">
<?php
			if ($embed != '') {
				echo stripslashes(htmlspecialchars_decode($embed));
			} else { ?>
<figure class="featured-thumbnail thumbnail large">
			<div class="hider-page"></div>
				<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" />
			</figure>
			<div class="clear"></div>
<?php }
		?>
	</div>
			
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