<?php /* Loop Name: Loop page */ ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
    <?php 
		if (has_post_thumbnail() ):
	?>

	<div class="post-thumb clearfix">		
		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$image = vt_resize( $thumb,'' , 1400, 380, true, 100 );
		?>	
			<figure class="featured-thumbnail thumbnail large">
			<div class="hider-page"></div>
				<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" />
			</figure>
			<div class="clear"></div>	
</div>			
		<?php endif; ?>		
    
        <?php the_content(); ?>
        <div class="pagelink"><?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?><!--.pagination--></div>
    </div><!--#post-->
<?php endwhile; ?>

