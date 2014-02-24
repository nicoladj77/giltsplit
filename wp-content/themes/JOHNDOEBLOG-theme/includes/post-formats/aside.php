<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
<?php formaticons(); ?>
<div class="row-fluid">
	<?php $hercules_post_meta = of_get_option('post_meta'); ?>
<?php if ($hercules_post_meta=='true' || $hercules_post_meta=='') { ?>
	<div class="span3">
	<?php get_template_part('includes/post-formats/post-meta'); ?>
	</div>
	<div class="span9 leftline">
	<?php }else{ ?>
	<div class="span12">
	<?php } ?>
		
    <!-- Post Content -->
    <div class="post_content">
        <?php the_content('<span>Continue Reading</span>'); ?>
		<?php wp_link_pages('before=<div class="pagelink">&after=</div>'); ?>
    	<!--// Post Content -->
    	<div class="clear"></div>
    </div>
    
   </div></div>
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->