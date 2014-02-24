<?php
/**
 * Carousel
 *
 */
if (!function_exists('shortcode_carousel')) {

	function shortcode_carousel($atts, $content = null) {
	global $hercules_add_carouFredSel;
    $hercules_add_carouFredSel = true;
			extract(shortcode_atts(array(
				'title' => '',
				'num' => '4',
				'type' => '',
				'thumb' => 'true',
				'istitle' => 'false',
				'thumb_width' => '390',
				'thumb_height' => '250',
				'more_text_single' => '',
				'category' => '',
				'custom_category' => '',
				'excerpt_count' => '12',
				'date' => '',
				'author' => '',			
				'max_items' => '3',
				'navigation' => '',
				'scrolling' => '',
				'custom_class' => ''
			), $atts));

			$template_url = get_stylesheet_directory_uri();
			
			// check what type of post user selected
			switch ($type) {
			   	case 'blog':
					$type_post = '';
					break;
			   	case 'portfolio':
					$type_post = 'portfolio';
					break;
				case 'testimonial':
					$type_post = 'testi';
					break;
			}		
$random = hs_gener_random(10);	
if ($scrolling == "no") {	
$scroll = "false";
}else{
$scroll = "true";
}
		$output = '<script type="text/javascript">
				jQuery(window).load(function() {
							jQuery("#foo_'.$random.'").carouFredSel({
							responsive	: true,
							swipe : true,
							auto : '.$scroll.',
	scroll : {
items: 1,
easing : "easeInOutCubic",
duration : 900
},
	prev	: {	
		button	: "#foo2_prev",
		key		: "left"
	},
	next	: { 
		button	: "#foo2_next",
		key		: "right"
	},
	items: {
		
		width: '.$thumb_width.',
		visible: {
							min: 1,
							max: '.$max_items.'
						}
	}
				});
				});';		
		$output .= '</script>';
		if ($navigation == "yes" || $title != '') {
			$output .= '<div class="fs-carousel-header">';
			if ($title != '') {
				
				$output .= '<div class="pull-left"><h5 style="text-align: left;">'.$title.'</h5></div>';
			}
			if ($navigation == "yes" ) {
			$output .= '<div class="pull-right" style="margin-top:8px"><a class="prev" id="foo2_prev" href="#"><i class="icon-angle-left"></i></a>
	<a class="next" id="foo2_next" href="#"><i class="icon-angle-right"></i></a></div>';
	}
	$output .= '<div class="clear"></div>';
	$output .= '</div>';
	}
			$output .= '<div style="overflow: hidden;">';
			$output .= '<div style="position: relative; overflow: hidden; margin: 0px -15px 0em !important;" class="fs-carousel '.$custom_class.'">';
			$output .= '<ul id="foo_'.$random.'" class="posts-grid row-fluid unstyled">';
			
			global $post;
			global $my_string_limit_words;
			
			$args = array(
				'post_type' => $type_post,
				'category_name' => $category,
				$type_post . '_category' => $custom_category,
				'numberposts' => $num,
				'orderby' => 'post_date',
				'order' => 'DESC'
			);

			$latest = get_posts($args);
			$i = 0;
			
			foreach($latest as $post) {
				setup_postdata($post);
				$excerpt = get_the_excerpt();
				$format = get_post_format();
				$post_id = '';
				if (has_post_thumbnail($post->ID)) {
				$picture = get_post_thumbnail_id($post->ID);
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				$url = $attachment_url['0'];
				$image = vt_resize( $picture,'' , $thumb_width, $thumb_height, true, 100 );
				}
				$link_format_url =  get_post_meta(get_the_ID(), 'tz_link_url', true);		

				$output .= '<li style="margin:0 15px; width:'.$thumb_width.';" class="fs-carousel_li '.$format.'">';				
					
					if ($thumb == 'true') {
						if (has_post_thumbnail($post->ID)) {
												
							$output .= '<div style="position:relative; margin: 0 auto; ">';
						$output .= '<figure class="featured-thumbnail-grid"><a class="image-wrap" href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
						$output .= '<div class="hider-page"></div>';
						$output .= '<img src="'.$image['url'].'" width="'.$thumb_width.'" height="'.$thumb_height.'" alt="'.get_the_title($post_id).'" />';
						$output .= '<div class="zoom-icon"></div>';
						$output .= '</a></figure></div>';

						} 
					}

					// $output .= '<div class="desc">';
					// $output .= '<div class="post_title_grid">';				
					
					//Link format
					if ($format == "link" && $istitle == 'true') {
						$output .= '<h5><a href="'.$link_format_url.'" title="'.get_the_title($post->ID).'">';
						$output .= $link_format_url;
						$output .= '</a></h5>';

					//Other formats
					} else {
					
					if ($istitle == 'true') {
						$output .= '<h5><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
						$output .= get_the_title($post->ID);
						$output .= '</a></h5>';
					}
					}
if ($date == "yes") {
$output .= '<span class="post_date_grid">';
						$output .= '<time datetime="'.get_the_time('Y-m-d\TH:i:s', $post->ID).'"><span>' .get_the_time('d', $post->ID). '</span>'.get_the_time('M Y', $post->ID).'</time>';
						$output .= '</span>';
					}					
// $output .= '</div>';
if ($author == "yes") {
						$output .= '<span class="author2">By <a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('display_name').'</a></span>';
					}
					if($excerpt_count >= 1){
						$output .= '<div class="post_excerpt_grid"><p class="excerpt">';
						$output .= my_string_limit_words($excerpt,$excerpt_count);
						$output .= '</p></div>';
					}
					
					if($more_text_single!=""){
						$output .= '<span class="post_comment_grid"><a href="'.get_permalink($post->ID).'" class="btn" title="'.get_the_title($post->ID).'">';
						$output .= $more_text_single;
						$output .= '</a></span>';
					}
					// $output .= '</div><div class="spacer"></div><div class="spacer"></div>';
					
				$output .= '</li>';

			}
			$output .= '</ul>';
	       	$output .= '<div class="clearfix"></div>';

			
	       	$output .= '</div></div>';
			return $output;
	}
	add_shortcode('carousel', 'shortcode_carousel');
	
}?>