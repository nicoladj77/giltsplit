<?php if(!is_singular()) : ?>

		<?php if(has_post_thumbnail()) { ?>
				<?php
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
					$folio_thumb_width = of_get_option('folio_thumb_width');
			$folio_thumb_height = of_get_option('folio_thumb_height');
			$image = vt_resize( $thumb,'' , $folio_thumb_width, $folio_thumb_height, true, 100 );
				?>
				<figure class="featured-thumbnail thumbnail large">
				<div class="hider-page"></div>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" /><span class="zoom-icon"></span></a>
				</figure>
		<?php } ?>

<?php endif; ?>