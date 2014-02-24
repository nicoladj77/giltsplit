<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
<?php formaticons(); ?>
	<?php 
	global $hercules_add_flexslider;
    $hercules_add_flexslider = true;
	$hercules_random = hs_gener_random(10);
	?>

	<script type="text/javascript">
		// Can also be used with $(document).ready()
		jQuery(window).load(function() {
			jQuery('#flexslider_<?php echo $hercules_random ?>').flexslider({
				slideshowSpeed: 5000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
animationSpeed: 800,            //Integer: Set the speed of animations, in milliseconds
initDelay: 0,
				smoothHeight: true,
				controlNav: false,
								prevText: "",
nextText: "",
animation: "slide",
								directionNav: true,
								touch: true
			});
		});
	</script>

	<div class="post-thumb clearfix">
		<!-- Slider -->
			<div id="flexslider_<?php echo $hercules_random ?>" class="flexslider thumbnail" style="margin: 0px 0px 1.5em;"><a href="<?php the_permalink() ?>">
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
						$blog_thumb_width = of_get_option('blog_thumb_width');
			$blog_thumb_height = of_get_option('blog_thumb_height');
			$image = vt_resize( $url,'' , $blog_thumb_width, $blog_thumb_height, true, 100 );
					?>
					
					<li><div class="hider-page"></div><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>"/></li>
					
					<?php 
						endforeach;
						endif;
					?>
					
				</ul><span class="zoom-icon"></span></a>
			</div>
			<!-- /Slider -->		
		
	<div class="row-fluid">
	<?php $post_meta = of_get_option('post_meta'); ?>
<?php if ($post_meta=='true' || $post_meta=='') { ?>
	<div class="span3">
	<?php get_template_part('includes/post-formats/post-meta'); ?>
	</div>
	<div class="span9 leftline">
	<?php }else{ ?>
	<div class="span12">
	<?php } ?>
		<header class="post-header">	
		<?php if(!is_singular()) : ?>
		<?php $blog_author_name = of_get_option('blog_author_name');
              $post_author = of_get_option('post_author');		
		if ($post_author=='yes' || $post_author=='') { ?>
		<span class="post_author"><?php echo $blog_author_name; ?> <?php the_author_posts_link() ?></span>
		<?php } ?>
			<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php echo theme_locals('permalink_to');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<?php else :?>
		<?php $blog_author_name = of_get_option('blog_author_name');
		$post_author = of_get_option('post_author');
		if ($post_author=='yes' || $post_author=='') { ?>
		<span class="post_author"><?php echo $blog_author_name; ?> <?php the_author_posts_link() ?></span>
		<?php } ?>
			<h2 class="post-title"><?php the_title(); ?></h2>
		<?php endif; ?>
	</header>
	<?php if(!is_singular()) : ?>				
	<!-- Post Content -->
	<div class="post_content">
		<?php $post_excerpt = of_get_option('post_excerpt');
$blog_excerpt = of_get_option('blog_excerpt_count');		?>
		<?php if ($post_excerpt=='true' || $post_excerpt=='') { ?>		
			<div class="excerpt">			
			<?php 
				$content = get_the_content();
				$excerpt = get_the_excerpt();
			if (has_excerpt()) {
				the_excerpt();
			} else {
				if(!is_search()) {
				echo my_string_limit_words($content,$blog_excerpt);
				} else {
				echo my_string_limit_words($excerpt,$blog_excerpt);
				}
			} ?>			
			</div>
		<?php } ?>
		<a href="<?php the_permalink() ?>" class="btn22 btn-1 btn-1c"><?php echo theme_locals("read_more"); ?></a>
		<div class="clear"></div>
	</div>
				
	<?php else :?>	
	<!-- Post Content -->
	<div class="post_content">	
		<?php the_content(''); ?>
		<?php wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
		<div class="clear"></div>
	</div>
	<!-- //Post Content -->	
	<?php endif; ?>
	</div>	</div>	
	
</div>
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->