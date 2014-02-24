<?php

// Recent Comments
if (!function_exists('shortcode_recentcomments')) {

	function shortcode_recentcomments($atts, $content = null) {
	    extract(shortcode_atts(array(
	        'num' => '5',
			'custom_class' => ''
	    ), $atts));

	    global $wpdb;
	    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	    comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
	    comment_type,comment_author_url,
	    SUBSTRING(comment_content,1,50) AS com_excerpt
	    FROM $wpdb->comments
	    LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	    $wpdb->posts.ID)
	    WHERE comment_approved = '1' AND comment_type = '' AND
	    post_password = ''
	    ORDER BY comment_date_gmt DESC LIMIT $num";

	    $comments = $wpdb->get_results($sql);

	    $output = '<ul class="recent-comments unstyled">';

	    foreach ($comments as $comment) {

	        $output .= '<li>';
	            $output .= '<a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="on '.$comment->post_title.'">';
	                 $output .= strip_tags($comment->comment_author).' : '.strip_tags($comment->com_excerpt).'...';
	            $output .= '</a>';
	        $output .= '</li>';

	    }

	    $output .= '</ul>';
	    return $output;
	}
	add_shortcode('recentcomments', 'shortcode_recentcomments');

}


//About me
if (!function_exists('shortcode_aboutme')) {

	function shortcode_aboutme($atts, $content = null) {
	
	global $hercules_add_flexslider;
    $hercules_add_flexslider = true;

		extract(shortcode_atts(array(
				'num' => '5',
				'smooth' => 'false',
				'effect' => 'fade',
				'custom_class' => ''
		), $atts));

		$aboutme = get_posts('post_type=aboutme&orderby=post_date&numberposts='.$num);
$random = hs_gener_random(10);		

		$output = '<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery("#flexslider_'.$random.'").flexslider({
								animation: "'.$effect.'",
								smoothHeight : '.$smooth.',
								directionNav: false
							});
						});';
		$output .= '</script>';
		$output .= '<div class="testimonials"><div id="flexslider_'.$random.'" class="flexslider no-bg '.$custom_class.'">';
		$output .= '<ul class="slides">';
		global $post;
		global $my_string_limit_words;

		foreach($aboutme as $post){
				setup_postdata($post);
				$content = get_the_content();
				$custom = get_post_custom($post->ID);
				
				$post_id ='';
				
				
				
						$output .= '<li>';
						$output .= '<div class="testi-item">';
							
							$output .= '<span class="testi-info">';
								$output .= $content;
						$output .= '</span>';

						
							$output .= '</div>';
				$output .= '</li>';

		}
		$output .= '</ul>';
		$output .= '</div>';
		
$output .= '<div class="private-image">';
		if(of_get_option('private_photo') != ''){
		$image_private = of_get_option('private_photo', "" ); 
									$output .= '<img src="'.$image_private.'" class="img-circle" alt="140x140" style="width: 120px; height: 120px;" />';
								}
		if(of_get_option('blog_founder') != ''){
		$blog_founder = of_get_option('blog_founder', "" );
		$output .= '<h3>'.$blog_founder.'</h3>';
		}
		if(of_get_option('blog_founder_position') != ''){
		$blog_founder_position = of_get_option('blog_founder_position', "" );
		$output .= '<span>'.$blog_founder_position.'</span>';
		}					
		$output .= '</div><div class="clear"></div></div>';
		return $output;
		}

	add_shortcode('aboutme', 'shortcode_aboutme');

}
	
	
//Tag Cloud
if (!function_exists('shortcode_tags')) {

	function shortcode_tags($atts, $content = null) {
		$output = '<div class="tags-cloud clearfix">';
		$tags = wp_tag_cloud('smallest=8&largest=8&format=array');

		foreach($tags as $tag){
				$output .= $tag.' ';
		}

		$output .= '</div><!-- .tags-cloud (end) -->';
		return $output;
	}
	add_shortcode('tags', 'shortcode_tags');

}
add_action( 'after_setup_theme', 'hs_setup' );
?>