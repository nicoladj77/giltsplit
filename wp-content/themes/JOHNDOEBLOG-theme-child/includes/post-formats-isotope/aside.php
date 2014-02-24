<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
		
<div class="row-fluid">
	<?php $hercules_post_meta = of_get_option('post_meta'); ?>
<?php if ($hercules_post_meta=='true' || $hercules_post_meta=='') { ?>
	<div class="span3">
	<?php get_template_part('includes/post-formats/post-meta-grid'); ?>
	</div>
	<div class="span9">
	<?php }else{ ?>
	<div class="span12">
	<?php } ?>
		
    <!-- Post Content -->
    <div class="post_content">
        <?php the_content('<span>Continue Reading</span>'); ?>
    	<!--// Post Content -->
    	<div class="clear"></div>
    </div>
    
   </div></div>
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->