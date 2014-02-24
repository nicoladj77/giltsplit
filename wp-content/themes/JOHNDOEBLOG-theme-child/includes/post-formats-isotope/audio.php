<?php
global $hercules_add_swfobject;
$hercules_add_swfobject = true;
global $hercules_add_playlist;
$hercules_add_playlist = true;
global $hercules_add_jplayer;
$hercules_add_jplayer = true;
?>
	
	<?php 
	    $embed = get_post_meta(get_the_ID(), 'tz_audio_embed', true);
		// get audio attribute
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
	<?php } ?>
<?php if ($embed == '') {
		if (has_post_thumbnail() ):
	?>

	<div class="post-thumb clearfix">		
		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
			$folio_thumb_width = of_get_option('folio_thumb_width');
			$folio_thumb_height = of_get_option('folio_thumb_height');
			$image = vt_resize( $thumb,'' , $folio_thumb_width, $folio_thumb_height, true, 100 );
		 ?>				
			<figure class="thumbnail thumbnail__portfolio">
				<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php the_title(); ?>" />
			</figure>
			<div class="clear"></div>
	</div>
	<?php endif; }?>
	</div>
	

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
		$folio_excerpt_count = of_get_option('folio_excerpt_count');?>
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
				
	<?php else :	
	endif; ?>
	</div>