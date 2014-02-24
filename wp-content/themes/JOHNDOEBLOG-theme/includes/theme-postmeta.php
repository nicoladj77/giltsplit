<?php

// ==== Post Format meta boxes ====================================== //


// === Define Metabox Fields ====================================== //

$hr_prefix = 'tz_';
 
$hercules_meta_box_quote = array(
	'id' => 'tz-meta-box-quote',
	'title' =>  __('Quote Settings', HS_CURRENT_THEME),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('The Quote',HS_CURRENT_THEME),
				"desc" => __('Put your quote in this field.',HS_CURRENT_THEME),
				"id" => $hr_prefix."quote",
				"type" => "textarea",
				"std" => ""
			),
		array( "name" => __('Author',HS_CURRENT_THEME),
				"desc" => __('Put quote author in this field.',HS_CURRENT_THEME),
				"id" => $hr_prefix."author_quote",
				"type" => "text",
				"std" => ""
			),
	),
	
	
);

$hercules_meta_box_link = array(
	'id' => 'tz-meta-box-link',
	'title' =>  __('Link Settings', HS_CURRENT_THEME),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('The URL',HS_CURRENT_THEME),
				"desc" => __('Insert the URL you wish to link to.',HS_CURRENT_THEME),
				"id" => $hr_prefix."link_url",
				"type" => "text",
				"std" => ""
			),
	),
	
);

$hercules_meta_box_image = array(
	'id' => 'tz-meta-box-image',
	'title' =>  __('Image Settings', HS_CURRENT_THEME),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Enable Lightbox',HS_CURRENT_THEME),
				"desc" => __('Check this to enable the lightbox.',HS_CURRENT_THEME),
				"id" => $hr_prefix."image_lightbox",
				"type" => "select",
				'std' => 'no',
				'options' => array('yes', 'no'),
			),
	),
	
	
);



$hercules_meta_box_audio = array(
	'id' => 'tz-meta-box-audio',
	'title' =>  __('Audio Settings', HS_CURRENT_THEME),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Title',HS_CURRENT_THEME),
				"desc" => __('Input the audio title (for playlist).',HS_CURRENT_THEME),
				"id" => $hr_prefix."audio_title",
				"type" => "text",
				"std" => ""
			),
		array( "name" => __('Artist',HS_CURRENT_THEME),
				"desc" => __('Input the audio artist (for playlist).',HS_CURRENT_THEME),
				"id" => $hr_prefix."audio_artist",
				"type" => "text",
				"std" => ""
			),
		array( "name" => __('Audio format',HS_CURRENT_THEME),
				"desc" => __('Choose audio format.',HS_CURRENT_THEME),
				"id" => $hr_prefix."audio_format",
				"type" => "select",
				"std" => "mp3",
				"options" => array('mp3', 'wav', 'ogg')
			),
		array( "name" => __('Audio URL',HS_CURRENT_THEME),
				"desc" => __('Input the audio URL.',HS_CURRENT_THEME),
				"id" => $hr_prefix."audio_url",
				"type" => "text",
				"std" => ""
			),
		array( "name" => __('Embedded Code',HS_CURRENT_THEME),
				"desc" => __('You can include embedded code from soundcloud.com here.<br><b>Attention!</b> This code overwrite your audio URL(s).',HS_CURRENT_THEME),
				"id" => $hr_prefix."audio_embed",
				"type" => "textarea",
				"std" => ""
			)
	),	
);

$hercules_meta_box_video = array(
	'id' => 'tz-meta-box-video',
	'title' =>  __('Video Settings', HS_CURRENT_THEME),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Embedded Video Code',HS_CURRENT_THEME),
				"desc" => __('You can include embedded code here.',HS_CURRENT_THEME),
				"id" => $hr_prefix."video_embed",
				"type" => "textarea",
				"std" => ""
			)
		)
	
);


add_action('admin_menu', 'tz_add_box');


/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/
 
function tz_add_box() {
	global $hercules_meta_box_quote, $hercules_meta_box_link, $hercules_meta_box_image, $hercules_meta_box_audio, $hercules_meta_box_video;
 
	add_meta_box($hercules_meta_box_quote['id'], $hercules_meta_box_quote['title'], 'tz_show_box_quote', $hercules_meta_box_quote['page'], $hercules_meta_box_quote['context'], $hercules_meta_box_quote['priority']);
	add_meta_box($hercules_meta_box_image['id'], $hercules_meta_box_image['title'], 'tz_show_box_image', $hercules_meta_box_image['page'], $hercules_meta_box_image['context'], $hercules_meta_box_image['priority']);
	add_meta_box($hercules_meta_box_link['id'], $hercules_meta_box_link['title'], 'tz_show_box_link', $hercules_meta_box_link['page'], $hercules_meta_box_link['context'], $hercules_meta_box_link['priority']);
	add_meta_box($hercules_meta_box_audio['id'], $hercules_meta_box_audio['title'], 'tz_show_box_audio', $hercules_meta_box_audio['page'], $hercules_meta_box_audio['context'], $hercules_meta_box_audio['priority']);
	add_meta_box($hercules_meta_box_video['id'], $hercules_meta_box_video['title'], 'tz_show_box_video', $hercules_meta_box_video['page'], $hercules_meta_box_video['context'], $hercules_meta_box_video['priority']);
}


/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function tz_show_box_quote() {
	global $hercules_meta_box_quote, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($hercules_meta_box_quote['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 			
 			//If Text		
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:75%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;

		}

	}
 
	echo '</table>';
}

function tz_show_box_link() {
	global $hercules_meta_box_link, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($hercules_meta_box_link['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;

		}

	}
 
	echo '</table>';
}

function tz_show_box_audio() {
	global $hercules_meta_box_audio, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($hercules_meta_box_audio['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			//If Text		
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:75%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;
			
			//If Select	
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break;

		}

	}
 
	echo '</table>';
}

function tz_show_box_video() {
	global $hercules_meta_box_video, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($hercules_meta_box_video['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
 
			
			//If textarea		
			case 'textarea':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:75%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;
			
			//If Select	
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break;

		}

	}
 
	echo '</table>';
}

function tz_show_box_image() {
	global $hercules_meta_box_image, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($hercules_meta_box_image['fields'] as $field) {
		
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		switch ($field['type']) {
 
			
			//If Select	
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break;

		}

	}
 
	echo '</table>';
}

 
add_action('save_post', 'tz_save_data');


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function tz_save_data($post_id) {
	global $hercules_meta_box_quote, $hercules_meta_box_link, $hercules_meta_box_image, $hercules_meta_box_audio, $hercules_meta_box_video;
 
	// verify nonce
	if (!isset($_POST['tz_meta_box_nonce']) || !wp_verify_nonce($_POST['tz_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($hercules_meta_box_quote['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
	foreach ($hercules_meta_box_link['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
	foreach ($hercules_meta_box_audio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'],stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
	foreach ($hercules_meta_box_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
	foreach ($hercules_meta_box_image['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}