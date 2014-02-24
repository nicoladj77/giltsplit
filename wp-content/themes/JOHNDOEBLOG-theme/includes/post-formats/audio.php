<?php
global $hercules_add_swfobject;
$hercules_add_swfobject = true;
global $hercules_add_playlist;
$hercules_add_playlist = true;
global $hercules_add_jplayer;
$hercules_add_jplayer = true;

// get audio attribute
$embed = get_post_meta(get_the_ID(), 'tz_audio_embed', true);
		$hercules_audio_title = get_post_meta(get_the_ID(), 'tz_audio_title', true);
		$hercules_audio_artist = get_post_meta(get_the_ID(), 'tz_audio_artist', true);		
		$hercules_audio_format = get_post_meta(get_the_ID(), 'tz_audio_format', true);
		$hercules_audio_url = get_post_meta(get_the_ID(), 'tz_audio_url', true);

		// get site URL
		$hercules_home_url = get_template_directory_uri();
		$hercules_pos = strpos($hercules_audio_url, 'wp-content');
		$hercules_audio_new = substr($hercules_audio_url, $hercules_pos, strlen($hercules_audio_url) - $hercules_pos);
		$hercules_file = $hercules_home_url.'/'.$hercules_audio_new;
		
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>	
<?php formaticons(); ?>
<div class="audio-wraper" style="position:relative;">
<?php
			if ($embed != '') {
			
				echo stripslashes(htmlspecialchars_decode($embed));

			} else { ?>
	<div class="audio-wrap">
		<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
		ready: function () {
			jQuery(this).jPlayer("setMedia", {
			title:"<?php echo $hercules_audio_title; ?>",
			artist:"<?php echo $hercules_audio_artist; ?>",
			free:true,
			<?php echo $hercules_audio_format; ?>: "<?php echo stripslashes(htmlspecialchars_decode($hercules_file)); ?>"
		});
		},
swfPath: "<?php echo get_template_directory_uri(); ?>/flash",
		supplied: "mp3, wav, ogg, all",
		cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",

		smoothPlayBar: true,
		keyEnabled: true
		
});
});
		</script>
		
		<!-- BEGIN audio -->
		<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>
		<div id="jp_container_<?php the_ID(); ?>" class="jp-audio">
			<div class="jp-type-single">
				<div class="jp-gui">
					<div class="jp-interface">
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-current-time"></div>
						<div class="jp-title"><?php echo $hercules_audio_artist; ?> : <?php echo $hercules_audio_title; ?></div>
						
						<div class="jp-controls-holder">
							<ul class="jp-controls">
								<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span>Play</span></a></li>
								<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span>Pause</span></a></li>
							</ul>
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
							
						</div>
					</div>
					<div class="jp-no-solution">
						<span>Update Required. </span>To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
					</div>
				</div>
			</div>
		</div>
		<!-- END audio -->
	</div>
		<?php 
		if (has_post_thumbnail() ):
	?>

	<div class="post-thumb clearfix">		
		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$blog_thumb_width = of_get_option('blog_thumb_width');
			$blog_thumb_height = of_get_option('blog_thumb_height');
			$image = vt_resize( $thumb,'' , $blog_thumb_width, $blog_thumb_height, true, 100 );
		 ?>				
			<figure class="featured-thumbnail thumbnail large">
			<div class="hider-page"></div>
				<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" />
			</figure>
			<div class="clear"></div>
	</div>
	<?php endif; ?>
	<?php } ?>
	</div>
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
	<!--// Post Content -->
	<?php endif; ?>
	</div></div>
<?php get_template_part( 'includes/post-formats/share-buttons' ); ?>
</article><!--//.post__holder-->