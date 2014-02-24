	<?php $url =  get_post_meta(get_the_ID(), 'tz_link_url', true); ?>

	<?php 
		
if (has_post_thumbnail() ):
$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$folio_thumb_width = of_get_option('folio_thumb_width');
			$folio_thumb_height = of_get_option('folio_thumb_height');
			$image = vt_resize( $thumb,'' , $folio_thumb_width, $folio_thumb_height, true, 100 ); 
endif; ?>	
			<div class="link-image clearfix">
			<a target="_blank" href="<?php echo $url; ?>" title="<?php echo theme_locals('permalink_to');?> <?php echo $url; ?>">
		<div class="image-link">	
	<div class="image-background" style="background: url('<?php if (has_post_thumbnail() ): echo $image['url']; endif; ?>') no-repeat scroll 0% 0% transparent; width: 100%; height: 100%;"></div>
	</div>
	<p><span class="responsive">
       <?php echo $url; ?>
    </span></p>
	</a>
	</div>