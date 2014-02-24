<?php $post_meta = of_get_option('post_meta'); ?>
<?php if ($post_meta=='true' || $post_meta=='') { 
 $post_ID = get_the_ID();
 $blog_author_name = of_get_option('blog_author_name');
 $post_author = of_get_option('post_author');		
?>
	<!-- Post Meta -->
	<div class="meta-space">
	<div class="post_date"><span><?php the_time('d'); ?></span><?php the_time('M Y'); ?></div>
	<div class="post_meta">
	
	<ul>
				<?php if(of_get_option('post_comment') != 'no'){ ?>
		<li><i class="icon-comment-2"></i> <?php comments_popup_link(theme_locals('no_comments'), theme_locals('comment'), ' %'.theme_locals('comments'), theme_locals('comments_link'), theme_locals('comments_closed')); ?></li>
		<?php } ?>
		<?php if(of_get_option('post_category') != 'no'){ ?>
		<li><span class="post_category"><i class="icon-doc-2"></i><?php the_category(', ') ?></span></li>
		<?php } ?>
				<?php if(of_get_option('post_tag') != 'no'){ ?>
								<li>
									<i class="icon-tag-2"></i>
									<?php 
										if(get_the_tags()){
											the_tags('', ', ');
										} else {
											echo theme_locals('has_not_tags');
										}
									 ?>
								</li>
								<?php
							} ?>

		
		<?php if(of_get_option('post_permalink') != 'no'){ ?>
		<li><span class="post_permalink"><i class="icon-link"></i><a href="<?php the_permalink(); ?>" title="<?php echo theme_locals('permalink_to');?> <?php the_title(); ?>"><?php echo theme_locals('permalink_to'); ?></a></span></li>
		<?php } ?>
		</ul>
	</div>
	</div>
	<!--// Post Meta -->
<?php } ?>