<?php

 // Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 900;

// The excerpt based on words
function my_string_limit_words($hs_string, $hs_word_limit)
{
  $hs_words = explode(' ', $hs_string, ($hs_word_limit + 1));
  if(count($hs_words) > $hs_word_limit)
  array_pop($hs_words);
  return implode(' ', $hs_words).'... ';
}


// The excerpt based on character
function my_string_limit_char($hs_excerpt, $hs_substr=0)
{

	$hs_string = strip_tags(str_replace('...', '...', $hs_excerpt));
	if ($hs_substr>0) {
		$hs_string = substr($hs_string, 0, $hs_substr);
	}
	return $hs_string;
		}


add_action( 'after_setup_theme', 'hs_setup' );


// Remove invalid tags
function hs_remove_invalid_tags($hs_str, $tags) 
{
    foreach($tags as $tag)
    {
    	$hs_str = preg_replace('#^<\/'.$tag.'>|<'.$tag.'>$#', '', trim($hs_str));
    }

    return $hs_str;
}

// Generates a random string (for embedding flash)
function hs_gener_random($length){

	srand((double)microtime()*1000000 );
	
	$hs_random_id = "";
	
	$char_list = "abcdefghijklmnopqrstuvwxyz";
	
	for($i = 0; $i < $length; $i++) {
		$hs_random_id .= substr($char_list,(rand()%(strlen($char_list))), 1);
	}
	
	return $hs_random_id;
}


// For embedding video file
function hs_theme_video($file, $image, $width, $height, $color){

	//Template URL
	$hs_template_url = get_template_directory_uri();
	
	//Unique ID
	$hs_id = "video-".hs_gener_random(15);
	
	$hs_object_height = $height + 39;

	//JS
	$output  = '<script type="text/javascript">'."\n";
	$output .= 'var flashvars = {};'."\n";
	$output .= 'flashvars.player_width="'.$width.'";'."\n";
	$output .= 'flashvars.player_height="'.$height.'"'."\n";
	$output .= 'flashvars.player_id="'.$hs_id.'";'."\n";
	$output .= 'flashvars.thumb="'.$image.'";'."\n";
	$output .= 'flashvars.colorTheme="'.$color.'";'."\n";
	$output .= 'var params = { "wmode": "transparent" };'."\n";
	$output .= 'params.wmode = "transparent";'."\n";
	$output .= 'params.quality = "high";';
	$output .= 'params.allowFullScreen = "true";'."\n";
	$output .= 'params.allowScriptAccess = "always";'."\n";
	$output .= 'params.quality="high";'."\n";
	$output .= 'var attributes = {};'."\n";
	$output .= 'attributes.id = "'.$hs_id.'";'."\n";
	$output .= 'swfobject.embedSWF("'.$hs_template_url.'/flash/video.swf?fileVideo='.$file.'", "'.$hs_id.'", "'.$width.'", "'.$hs_object_height.'", "9.0.0", false, flashvars, params, attributes);'."\n";
	$output .= '</script>'."\n\n";
	
	$output .= '<div class="video-bg" style="width:'.$width.'px; height:'.$height.'px; background-image:url('.$image.')">'."\n";
	$output .= '</div>'."\n";
	
	//HTML
	$output .= '<div id="'.$hs_id.'">'."\n";
		$output .= '<a href="http://www.adobe.com/go/getflashplayer">'."\n";
				$output .= '<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />'."\n";
		$output .= '</a>'."\n";
	$output .= '</div>';

	return $output;
    
}



// Add Thumb Column
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
	// for post and page
	add_theme_support('post-thumbnails', array( 'post', 'page' ) );
	function fb_AddThumbColumn($cols) {
	$cols['thumbnail'] = __('Thumbnail', HS_CURRENT_THEME);
	return $cols;
}
function fb_AddThumbValue($column_name, $post_id) {
	$hs_width = (int) 35;
	$hs_height = (int) 35;
	if ( 'thumbnail' == $column_name ) {
		// thumbnail of WP 2.9
		$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
		// image from gallery
		$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
		if ($thumbnail_id)
			$thumb = wp_get_attachment_image( $thumbnail_id, array($hs_width, $hs_height), true );
		elseif ($attachments) {
			foreach ( $attachments as $attachment_id => $attachment ) {
				$thumb = wp_get_attachment_image( $attachment_id, array($hs_width, $hs_height), true );
			}
		}
		if ( isset($thumb) && $thumb ) {
			echo $thumb;
		} else {
			echo __('None', HS_CURRENT_THEME);
		}
	}
}
// for posts
add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
// for pages
add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}



// Show filter by categories for custom posts
function hs_restrict_manage_posts() {
	global $typenow;
	$hs_args=array( 'public' => true, '_builtin' => false ); 
	$hs_post_types = get_post_types($hs_args);
	if ( in_array($typenow, $hs_post_types) ) {
	$hs_filters = get_object_taxonomies($typenow);
		foreach ($hs_filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			wp_dropdown_categories(array(
				'show_option_all' => __('Show All '.$tax_obj->label, HS_CURRENT_THEME ),
				'taxonomy' => $tax_slug,
				'name' => $tax_obj->name,
				'orderby' => 'term_order',
				// 'selected' => $_GET[$tax_obj->query_var],
				'hierarchical' => $tax_obj->hierarchical,
				'show_count' => false,
				'hide_empty' => true
			));
		}
	}
}
function hs_convert_restrict($query) {
	global $pagenow;
	global $typenow;
	if ($pagenow=='edit.php') {
		$hs_filters = get_object_taxonomies($typenow);
		foreach ($hs_filters as $tax_slug) {
			$hs_var = &$query->query_vars[$tax_slug];
			if ( isset($hs_var) ) {
				$term = get_term_by('id',$hs_var,$tax_slug);
				// $var = $term->slug;
			}
		}
	}
}
add_action('restrict_manage_posts', 'hs_restrict_manage_posts' );
add_filter('parse_query','hs_convert_restrict');



// Add to admin_init function
add_action('manage_portfolio_posts_custom_column' , 'hs_custom_portfolio_columns', 10, 2);
add_filter('manage_edit-portfolio_columns', 'hs_portfolio_columns');
//Add columns for portfolio posts
function hs_portfolio_columns($columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Title",
		"portfolio_categories" => "Categories",
		"portfolio_tags" => "Tags",
		"comments" => "<span><span class=\"vers\"><img src=\"".get_admin_url()."images/comment-grey-bubble.png\" alt=\"Comments\"></span></span>",
		"date" => "Date",
		"thumbnail" => "Thumbnail"
	);
	return $columns;
}
function hs_custom_portfolio_columns( $column, $post_id ) {
	switch ( $column ) {
	case 'portfolio_categories':
		$hs_terms = get_the_term_list( $post_id , 'portfolio_category' , '' , ',' , '' );
		if ( is_string( $hs_terms ) ) {
			echo $hs_terms;
		} else {
			echo 'Uncategorized';
		}
		break;
	case 'portfolio_tags':
		$hs_terms = get_the_term_list( $post_id , 'portfolio_tag' , '' , ',' , '' );
		if ( is_string( $hs_terms ) ) {
			echo $hs_terms;
		}
		break;
	}	
}



/*-----------------------------------------------------------------------------------*/
/* Output image */
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'hs_image' ) ) {
    function hs_image($postid, $imagesize) {
		if (has_post_thumbnail($postid) ):
			$lightbox = get_post_meta(get_the_ID(), 'tz_image_lightbox', TRUE);
			if($lightbox == 'yes')
				$lightbox = TRUE;
			else
				$lightbox = FALSE;
			$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' );

	        // get the featured image for the post
	        if( has_post_thumbnail($postid) ) {
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
        $image = vt_resize( $thumb,'' , 1400, 480, true, 100 );
				if($lightbox) :
					echo '<figure class="featured-thumbnail thumbnail large"><div class="hider-page"></div><a class="image-wrap" data-rel="prettyPhoto" title="'. get_the_title() .'" href="'. $src[0] .'"><img src="'. $image['url'] .'" width="'.$image['width'].'" height="'.$image['height'].'" alt="'. get_the_title() .'" /><span class="zoom-icon"></span></a></figure><div style="clear:both;"></div>';
				else :
					echo '<figure class="featured-thumbnail thumbnail large"><div class="hider-page"></div><img src="'. $image['url'] .'" width="'.$image['width'].'" height="'.$image['height'].'" alt="'. get_the_title() .'" /></figure><div style="clear:both;"></div>';
				endif;						
        	}
        endif;
    }
}


/*-----------------------------------------------------------------------------------*/
/* Output gallery */
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'hs_grid_gallery' ) ) {
    function hs_grid_gallery($postid, $imagesize) { ?>
				
				<!--BEGIN .slider -->
					<div class="grid_gallery clearfix">
					
						<div class="grid_gallery_inner">
							
						<?php 
								$args = array(
										'orderby'		 => 'menu_order',
										'order' => 'ASC',
										'post_type'      => 'attachment',
										'post_parent'    => get_the_ID(),
										'post_mime_type' => 'image',
										'post_status'    => null,
										'numberposts'    => -1,
								);
								$attachments = get_posts($args);
						?>

								
								<?php if ($attachments) : ?>
								
								<?php foreach ($attachments as $attachment) : ?>
										
										<?php 
											$attachment_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
											$url = $attachment->ID;
											$image = vt_resize( $url,'' , 260, 160, true, 100 );
										?>
										
										<div class="gallery_item">
											<figure class="featured-thumbnail single-gallery-item">
												<a href="<?php echo $attachment_url['0'] ?>" class="image-wrap" data-rel="prettyPhoto[gallery]">
												<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>"/>
												<span class="zoom-icon"></span>
												</a>
											</figure>
										</div>
								
								<?php endforeach; ?>
								
								<?php endif; ?>
							<div style="clear:both;"></div>
						</div>

					<!--END .slider -->
					</div>
				
				
        
    <?php }
}

/*-----------------------------------------------------------------------------------*/
/* Output gallery slideshow */
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'hs_gallery' ) ) {
    function hs_gallery($postid, $imagesize) { ?>
        <?php $hs_random = hs_gener_random(10); ?>
				<script type="text/javascript">
					// Can also be used with $(document).ready()
					jQuery(window).load(function() {
						jQuery('#flexslider_<?php echo $hs_random ?>').flexslider({
				slideshowSpeed: 5000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
animationSpeed: 800,            //Integer: Set the speed of animations, in milliseconds
initDelay: 0,
				smoothHeight: true,
				controlNav: false
				animation: "slide",
								directionNav: false,
								direction: "vertical",
								touch: true
						});
					});
				</script>


				<!-- Place somewhere in the <body> of your page -->
				<div id="flexslider_<?php echo $hs_random ?>" class="flexslider thumbnail">
					<ul class="slides">
						
						<?php 
						$args = array(
							'orderby'		 => 'menu_order',
							'order' => 'ASC',
							'post_type'      => 'attachment',
							'post_parent'    => get_the_ID(),
							'post_mime_type' => 'image',
							'post_status'    => null,
							'numberposts'    => -1,
						);
						$attachments = get_posts($args); ?>
						
						<?php if ($attachments) : ?>
						
						<?php foreach ($attachments as $attachment) : ?>
						
						<?php 
							$attachment_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
							$url = $attachment->ID;
							$image = vt_resize( $url,'' , 1400, 480, true, 100 );
						?>
						
						<li><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>"/></li>
						
						<?php endforeach; ?>
						<?php endif; ?>
						
					</ul>
					<div style="clear:both;"></div>
				</div>
			
    <?php }
}

/*-----------------------------------------------------------------------------------*/
/*	Output Audio
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'hs_audio' ) ) {

    function hs_audio($postid) {
	
		// get audio attribute
		$hs_audio_title = get_post_meta($postid, 'tz_audio_title', true);
		$hs_audio_artist = get_post_meta($postid, 'tz_audio_artist', true);		
		$hs_audio_format = get_post_meta($postid, 'tz_audio_format', true);
		$hs_audio_url = get_post_meta($postid, 'tz_audio_url', true);

		// get site URL
		$hs_home_url = home_url();
		$hs_pos = strpos($hs_audio_url, 'wp-content');
		$hs_audio_new = substr($hs_audio_url, $hs_pos, strlen($hs_audio_url) - $hs_pos);
		$hs_file = $hs_home_url.'/'.$hs_audio_new;
	?>
				
		<script type="text/javascript">
			jQuery(document).ready(function(){
				var myPlaylist_<?php the_ID(); ?> = new jPlayerPlaylist({
				  jPlayer: "#jquery_jplayer_<?php the_ID(); ?>",
				  cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>"
				}, [
				  {
					title:"<?php echo $hs_audio_title; ?>",
					artist:"<?php echo $hs_audio_artist; ?>",
					<?php echo $hs_audio_format; ?>: "<?php echo stripslashes(htmlspecialchars_decode($hs_file)); ?>" <?php if(has_post_thumbnail()) {?>,
					poster: "<?php echo $image; ?>" <?php } ?>
				  }
				], {
				  playlistOptions: {
					enableRemoveControls: false
				  },
				  ready: function () {
					jQuery(this).jPlayer("setMedia", {
						<?php echo $hs_audio_format; ?>: "<?php echo stripslashes(htmlspecialchars_decode($hs_file)); ?>"
						});
					},
				  swfPath: "<?php echo get_template_directory_uri(); ?>/flash",
				  wmode: "window",
				  supplied: "mp3, all"
				});
			});
		</script>
		
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
						<div class="jp-duration"></div>
						<div class="jp-time-sep"></div>
						<div class="jp-current-time"></div>
						<div class="jp-controls-holder">
							<ul class="jp-controls">
								<li><a href="javascript:;" class="jp-previous" tabindex="1" title="Previous"><span>Previous</span></a></li>
								<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span>Play</span></a></li>
								<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span>Pause</span></a></li>
								<li><a href="javascript:;" class="jp-next" tabindex="1" title="Next"><span>Next</span></a></li>
								<li><a href="javascript:;" class="jp-stop" tabindex="1" title="Stop"><span>Stop</span></a></li>
							</ul>
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
							<ul class="jp-toggles">
								<li><a href="javascript:;" class="jp-mute" tabindex="1" title="Mute"><span>Mute</span></a></li>
								<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="Unmute"><span>Unmute</span></a></li>
							</ul>
						</div>
					</div>
					<div class="jp-no-solution">
						<span>Update Required. </span>To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
					</div>
				</div>
			</div>
			<div class="jp-playlist">
				<ul>
					<li></li>
				</ul>
			</div>
		</div>
    	<?php 
    }
}



/*-----------------------------------------------------------------------------------*/
/*	Output Video
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'hs_video' ) ) {

    function hs_video($postid) {
	
		// get video attribute
		$video_title = get_post_meta($postid, 'tz_video_title', true);
		$video_artist = get_post_meta($postid, 'tz_video_artist', true);
		$embed = get_post_meta(get_the_ID(), 'tz_video_embed', true);
		$m4v_url = get_post_meta($postid, 'tz_m4v_url', true);
		$ogv_url = get_post_meta($postid, 'tz_ogv_url', true);

		// get site URL
		$home_url = home_url();

		$pos1 = strpos($m4v_url, 'wp-content');
		$m4v_new = substr($m4v_url, $pos1, strlen($m4v_url) - $pos1);
		$file1 = $home_url.'/'.$m4v_new;

		$pos2 = strpos($ogv_url, 'wp-content');
		$ogv_new = substr($ogv_url, $pos2, strlen($ogv_url) - $pos2);
		$file2 = $home_url.'/'.$ogv_new;

		// get thumb (poster image)
		$thumb = get_post_thumbnail_id( $postid );
		$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
	    $image = vt_resize( $thumb,'' , 1400, 380, true, 100 );
		if ($embed != '') {
			echo stripslashes(htmlspecialchars_decode($embed));
		} else { ?>				
			<script type="text/javascript">
				jQuery(document).ready(function(){
					var myPlaylist_<?php the_ID(); ?> = new jPlayerPlaylist({
					  jPlayer: "#jquery_jplayer_<?php the_ID(); ?>",
					  cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>"
					}, [
					  {
						title:"<?php echo $video_title; ?>",
						artist:"<?php echo $video_artist; ?>",
						m4v: "<?php echo stripslashes(htmlspecialchars_decode($file1)); ?>",
						ogv: "<?php echo stripslashes(htmlspecialchars_decode($file2)); ?>" <?php if(has_post_thumbnail()) {?>,
						poster: "<?php echo $image['url']; ?>" <?php } ?>
					  }
					], {
					  playlistOptions: {
						enableRemoveControls: false
					  },
					  ready: function () {
						jQuery(this).jPlayer("setMedia", {
							m4v: "<?php echo stripslashes(htmlspecialchars_decode($file1)); ?>",
							ogv: "<?php echo stripslashes(htmlspecialchars_decode($file2)); ?>"
							});
						},
					  swfPath: "<?php echo get_template_directory_uri(); ?>/flash",
					  supplied: "m4v, ogv, all",
					  wmode:"window",
					  size: {
						width: "100%",
						height: "100%"
						}
					});
				});
			</script>
			
			<div id="jp_container_<?php the_ID(); ?>" class="jp-video fullwidth playlist">
				<div class="jp-type-list-parent">
					<div class="jp-type-single">
						<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>
						<div class="jp-gui">
							<div class="jp-video-play">
								<a href="javascript:;" class="jp-video-play-icon" tabindex="1" title="Play">Play</a>
							</div>
							<div class="jp-interface">
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
								<div class="jp-duration"></div>
								<div class="jp-time-sep"></div>
								<div class="jp-current-time"></div>
								<div class="jp-controls-holder">
									<ul class="jp-controls">
										<li><a href="javascript:;" class="jp-previous" tabindex="1" title="Previous"><span>Previous</span></a></li>
										<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span>Play</span></a></li>
										<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span>Pause</span></a></li>
										<li><a href="javascript:;" class="jp-next" tabindex="1" title="Next"><span>Next</span></a></li>
										<li><a href="javascript:;" class="jp-stop" tabindex="1" title="Stop"><span>Stop</span></a></li>
									</ul>
									<div class="jp-volume-bar">
										<div class="jp-volume-bar-value"></div>
									</div>
									<ul class="jp-toggles">
										<li><a href="javascript:;" class="jp-mute" tabindex="1" title="Mute"><span>Mute</span></a></li>
										<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="Unmute"><span>Unmute</span></a></li>
									</ul>
								</div>
							</div>
							<div class="jp-no-solution">
								<span>Update Required. </span>To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
							</div>	
						</div>
					</div>			
				</div>
				<div class="jp-playlist">
					<ul>
						<li></li>
					</ul>
				</div>
			</div>
    	<?php }
    }
}




/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'hs_pagination' ) ) {
	function hs_pagination($pages = '', $range = 1)
	{ 
	     $hs_showitems = ($range * 2)+1; 
	 
	     global $paged;
	     if(empty($paged)) $paged = 1;
	 
	     if($pages == '')
	     {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;
	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }  
	 
	     if(1 != $pages)
	     {
	         echo "<div class=\"pagination pagination__posts\"><ul>";
	         if($paged > 2 && $paged > $range+1 && $hs_showitems < $pages) echo "<li class='first'><a href='".get_pagenum_link(1)."'>First</a></li>";
	         if($paged > 1 && $hs_showitems < $pages) echo "<li class='prev'><a href='".get_pagenum_link($paged - 1)."'>Prev</a></li>";
	 
	         for ($i=1; $i <= $pages; $i++)
	         {
	             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $hs_showitems ))
	             {
	                 echo ($paged == $i)? "<li class=\"active\"><a href=''>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
	             }
	         }
	 
	         if ($paged < $pages && $hs_showitems < $pages) echo "<li class='next'><a href=\"".get_pagenum_link($paged + 1)."\">Next</a></li>"; 
	         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $hs_showitems < $pages) echo "<li class='last'><a href='".get_pagenum_link($pages)."'>Last</a></li>";
	         echo "</ul></div>\n";
	     }
	}
}


/*-----------------------------------------------------------------------------------*/
/* Custom Comments Structure
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'hercules_comment' ) ) {
	function hercules_comment($comment, $args, $depth) {
	     $GLOBALS['comment'] = $comment;
$GLOBALS['depth'] = $depth;
	?> 
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>" class="clearfix">
	     	<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
	      		<div class="wrapper">
	      			<div class="comment-author vcard">
	  	         		<?php echo get_avatar( $comment->comment_author_email, 65 ); ?>
	  	  				
	  	      		</div>
	  		      	<?php if ($comment->comment_approved == '0') : ?>
	  		        	<em><?php _e('Your comment is awaiting moderation.', HS_CURRENT_THEME) ?></em>
	  		      	<?php endif; ?>	      	
	  		     	<div class="extra-wrap">
					<?php printf(__('<span class="author">%1$s</span>' ), get_comment_author_link()) ?><br />
					<?php printf(__('%1$s', HS_CURRENT_THEME ), get_comment_date('F j, Y')) ?>
	  		     		<?php comment_text() ?>	     	
	  		     	</div>
	  		    </div>
		     	<div class="wrapper">
				  	<div class="reply">
				    	<?php //comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span><i class="icon-reply"></i></span>', HS_CURRENT_THEME ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				   	</div>
			 	</div>
	    	</div>
	<?php }
}

// Remove Empty Paragraphs
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content) {
	$array = array (
			'<p>['    => '[', 
			']</p>'   => ']', 
			']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}

/*-----------------------------------------------------------------------------------*/
/*	Breadcrumbs
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'hs_breadcrumbs' ) ) {
function hs_breadcrumbs() {

  $showOnHome = 0; // 1 - show "hs_breadcrumbs" on home page, 0 - hide
  $delimiter = '<li class="divider">/</li>'; // divider
  $home = 'Home'; // text for link "Home"
  $showCurrent = 1; // 1 - show title current post/page, 0 - hide
  $before = '<li class="active">'; // open tag for active breadcrumb
  $after = '</li>'; // close tag for active breadcrumb

  global $post;
  $hs_homeLink = home_url();

 if (is_front_page()) {

    if ($showOnHome == 1) echo '<ul class="breadcrumb breadcrumb__t"><li><a href="' . $hs_homeLink . '">' . $home . '</a><li></ul>';

  } else {

    echo '<ul class="breadcrumb breadcrumb__t"><li><a href="' . $hs_homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
	
	if ( is_home() ) {
		echo $before . theme_locals("blog") . $after;
	} elseif ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . theme_locals("category_archives").': "' . single_cat_title('', false) . '"' . $after;
    
	} elseif ( is_tax() ) {
      echo $before . 'Post type: "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_search() ) {
      echo $before . theme_locals("fearch_for") . ': "' . get_search_query() . '"' . $after;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
      	$post_name = get_post_type();
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $hs_homeLink . '/' . $post_name . '/">' . $post_type->labels->singular_name . '</a></li>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $hs_breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $hs_breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $hs_breadcrumbs = array_reverse($hs_breadcrumbs);
      for ($i = 0; $i < count($hs_breadcrumbs); $i++) {
        echo $hs_breadcrumbs[$i];
        if ($i != count($hs_breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . theme_locals("tag_archives") . ': "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . theme_locals("by") . ' ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . '404' . $after;
    }
	/*
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __(' Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
	*/
    echo '</ul>';
  }
} // end hs_breadcrumbs() 
}?>