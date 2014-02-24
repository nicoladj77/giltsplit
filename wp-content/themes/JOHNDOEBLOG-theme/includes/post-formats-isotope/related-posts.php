<?php
// Reference : http://codex.wordpress.org/Function_Reference/wp_get_post_tags
// we are using this function to get an array of tags assigned to current post
$tags = wp_get_post_tags($post->ID);

if ($tags) {

	$tag_ids = array();
			
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'showposts' => 4, // these are the number of related posts we want to display
			'ignore_sticky_posts' => 1 // to exclude the sticky post
		);

	// WP_Query takes the same arguments as query_posts
	$related_query = new WP_Query($args);

	if ($related_query->have_posts()) {	?>
	<div class="related-posts">
		<?php $blog_related = of_get_option('blog_related'); ?>
		<?php if($blog_related){?>
			<h5 class="related-posts_h"><?php echo of_get_option('blog_related'); ?></h5>
		<?php } else { ?>
			<h5 class="related-posts_h"><?php echo theme_locals("posts_std");?></h5>
		<?php } ?>

			<ul class="related-posts_list clearfix">

				<?php
				while ($related_query->have_posts()) : $related_query->the_post();
				?>
					<li class="related-posts_item">
						<?php if(has_post_thumbnail()) { ?>
							<?php
								$thumb = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
								$image = vt_resize( $thumb,'' , 300, 220, true, 100 );
								
							?>
							<figure class="thumbnail featured-thumbnail">
							<div class="hider-page"></div>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" /><span class="zoom-icon"></span></a>
							</figure>
						<?php } else { ?>
							<figure class="thumbnail featured-thumbnail">
							<div class="hider-page"></div>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/empty_thumb.gif" alt="<?php the_title(); ?>" /></a>
							</figure>
						<?php } ?>
						<h6><a href="<?php the_permalink() ?>" > <?php the_title();?> </a></h6>
					</li>
				<?php
				endwhile;
				?>
			</ul>
	</div><!-- .related-posts -->
	<?php }
	wp_reset_query(); // to reset the loop : http://codex.wordpress.org/Function_Reference/wp_reset_query
} ?>