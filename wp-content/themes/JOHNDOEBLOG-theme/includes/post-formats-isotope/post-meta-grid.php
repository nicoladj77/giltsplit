<?php $post_meta = of_get_option('post_meta'); ?>
<?php if ($post_meta=='true' || $post_meta=='') {  ?>
<?php $post_ID = get_the_ID(); ?>
<?php $blog_author_name = of_get_option('blog_author_name');
              $post_author = of_get_option('post_author');		
		?>
	<!-- Post Meta -->
	<?php if(of_get_option('post_date') != 'no' || of_get_option('post_author') != 'no' || of_get_option('post_comment') != 'no' ){ ?>
	<div style="width:100%; display:block;" class="post_date_grid_filtr" >
	<div style="float:left; width:85%;" >
	<?php if(of_get_option('post_date') != 'no'){ ?>
	<span><?php the_time('d'); ?></span> <?php the_time('M Y'); } ?>
		<?php if ($post_author=='yes' || $post_author=='') { ?>
		| <span class="post_author"><?php echo $blog_author_name; ?> <?php the_author_posts_link() ?></span>
		<?php } ?>
	</div>
	<div style="float:right; width:15%; text-align:right;">

	<?php if(of_get_option('post_comment') != 'no'){ ?>
		<i class="icon-comment-2"></i> <?php comments_popup_link(theme_locals('no_comments'), theme_locals('comment'), ' %'.theme_locals('comments'), theme_locals('comments_link'), theme_locals('comments_closed')); ?>
		<?php } ?>

							</div>
			<div class="clear"></div>				
	</div>						
	<?php } ?>
	<h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php echo theme_locals('permalink_to');?> <?php the_title(); ?>"><?php the_title(); ?></a></h4>
	
	<div class="post_meta_grid">
	<ul>

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
		</ul>
	</div>
	
	<!--// Post Meta -->
<?php } ?>

							
							