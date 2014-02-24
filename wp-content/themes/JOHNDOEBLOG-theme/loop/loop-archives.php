<?php /* Loop Name: Loop archives */ ?>
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
				<img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" alt="<?php the_title(); ?>" />
			</figure>
			<div class="clear"></div>	
</div>			
		<?php endif; ?>	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?> style="padding-bottom:40px;">
    <div class="post-content">
        <?php the_content('<span>Continue Reading</span>'); ?>
        <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', HS_CURRENT_THEME).'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <div class="archive_lists">
            <div class="row-fluid">
                <div class="span4">
                    <h3 class="archive_h"><?php _e('Last 10 Posts', HS_CURRENT_THEME) ?></h3>
                    <div class="list styled check-list">
                        <ul>
                        <?php $archive_10 = get_posts('numberposts=10');
                        foreach($archive_10 as $post) : ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="span4">
                    <h3 class="archive_h"><?php _e('Archives by Month:', HS_CURRENT_THEME) ?></h3>
                    <div class="list styled check-list">
                        <ul>
                            <?php wp_get_archives('type=monthly'); ?>
                        </ul>
                    </div>
                </div>
                <div class="span4">
                    <h3 class="archive_h"><?php _e('Archives by Subject:', HS_CURRENT_THEME) ?></h3>
                    <div class="list styled check-list">
                        <ul>
                            <?php wp_list_categories( 'title_li=' ); ?>
                        </ul>
                    </div><!-- .archive_lists -->
                </div>
            </div>
        </div><!-- .post-content -->
    </div>
</div>
<?php endwhile; endif; ?>
