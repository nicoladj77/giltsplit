	<?php 
	global $hercules_add_flexslider;
    $hercules_add_flexslider = true;
	$hercules_random = hs_gener_random(10);
	$folio_thumb_width = of_get_option('folio_thumb_width');
	$folio_thumb_height = of_get_option('folio_thumb_height');
	?>
	<script type="text/javascript">
		// Can also be used with $(document).ready()
		jQuery(window).load(function() {
			jQuery('#flexslider_<?php echo $hercules_random ?>').flexslider({
				slideshowSpeed: 5000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
animationSpeed: 1400,            //Integer: Set the speed of animations, in milliseconds
initDelay: 0,
				smoothHeight: true,
				controlNav: false,
								prevText: "",
nextText: "",
animation: "fade",
 
								directionNav: true,
								touch: true,
								start: function(){jQuery('#portfolio-grid').isotope('reLayout');}
			});
			
		});
	</script>
<!-- Slider -->
<div class="post-thumb clearfix">
		<!-- Slider -->
			<div id="flexslider_<?php echo $hercules_random ?>" class="flexslider thumbnail">
				<ul class="slides">					
					<?php 
						$hercules_args = array(
							'orderby'		=> 'menu_order',
							'order'			=> 	'ASC',
							'post_type'		=> 'attachment',
							'post_parent'	=> get_the_ID(),
							'post_mime_type'=> 'image',
							'post_status'	=> null,
							'numberposts'	=> -1,
						);
						$hercules_attachments = get_posts($hercules_args);
					
						if ($hercules_attachments) :					
						foreach ($hercules_attachments as $attachment) :
							$attachment_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
							$url = $attachment->ID;
						$image = vt_resize( $url,'' , $folio_thumb_width, $folio_thumb_height, true, 100 );
					?>
					
					<li><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>"/></li>
					
					<?php 
						endforeach;
						endif;
					?>
					
				</ul>
			</div>
				</div>	<!-- /Slider -->
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