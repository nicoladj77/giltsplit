<article id="post-<?php the_ID(); ?>" <?php post_class('format-quote'); ?>>
<?php formaticons(); ?>
	<div class="row-fluid">

	<div class="span12">

	<?php $quote =  get_post_meta(get_the_ID(), 'tz_quote', true); ?>
	<?php $author =  get_post_meta(get_the_ID(), 'tz_author_quote', true); ?>

	<div class="quote-wrap clearfix">
			<div class="quote"> <?php echo $quote; ?></div>
		<?php if($author) { ?>
		<span>
		<?php echo '&mdash; ' . $author; ?>
			</span>
		<?php } ?>
	</div>
	
	</div></div>
</article><!--//.post-holder-->