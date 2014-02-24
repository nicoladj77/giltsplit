<?php
class MY_TwitterWidget extends WP_Widget {
function MY_TwitterWidget() {
$widget_ops = array(
'classname' => 'twitter',
'description' => __('A widget that displays the latest tweets', HS_CURRENT_THEME)
);
$this->WP_Widget( 'twitter-widget', __('hercules - Twitter', HS_CURRENT_THEME), $widget_ops );
}   // Widget Settings
 
function widget($args, $instance) {
extract( $args );
 
$title      = apply_filters('widget_title', $instance['title'] );
$numb       = $instance['numb'];
$twitterusername = $instance['twitterusername'];

 
echo $before_widget;
 
// Display the widget title
if ( $title )
echo $before_title . $title . $after_title;
if ( $twitterusername =='' ){
echo "No Tweets Available or bad configuration...";
}else{
$opt_args = array(
'trim_user'         => false,
'exclude_replies'   => false,
'include_rts'       => true
);
$tweets = getTweets($twitterusername, $numb, $opt_args);//change number up to 20 for number of tweets
if(is_array($tweets)){

// to use with intents
echo '<div class="twitter"><i class="icon-twitter icon-3x"></i>';
echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';
global $hercules_add_flexslider;
    $hercules_add_flexslider = true;
$random = hs_gener_random(10);
echo '<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery("#flexslider_'.$random.'").flexslider({
								animation: "slide",
								smoothHeight : true,
								startAt: 0,  
								randomize: false,
								directionNav: false,
								easing: "easeInOutQuart",
								touch: true
							});
						});
		</script>';
echo '<div id="flexslider_'.$random.'" class="flexslider no-bg"><ul class="slides tweet_list unstyled">';

foreach($tweets as $tweet){
$user = $tweet['user'];
echo '<li>';
echo '<div class="tweet_item">';
echo '<div class="tweet_content">';
echo '<div class="stream-item-header">';
if ($instance['fullname'] && is_array($user) && array_key_exists('name', $user) ) {
$name = $user['name'];
echo '<strong class="fullname">' . $name . '</strong>';
}
if ($instance['username'] && is_array($user) && array_key_exists('screen_name', $user) ) {
$screenname = $user['screen_name'];
echo '<a class="account-group" href="http://twitter.com/'.$screenname.'" target="_blank"><span class="username"> @'.$screenname. '</span></a>';
}
echo '</div>';
    if($tweet['text']){
        $the_tweet = $tweet['text'];

		
        if(is_array($tweet['entities']['user_mentions'])){
            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
                $the_tweet = preg_replace(
                    '/@'.$user_mention['screen_name'].'/i',
                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
                    $the_tweet);
            }
        }

        if(is_array($tweet['entities']['hashtags'])){
            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
                $the_tweet = preg_replace(
                    '/#'.$hashtag['text'].'/i',
                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>',
                    $the_tweet);
            }
        }

        if(is_array($tweet['entities']['urls'])){
            foreach($tweet['entities']['urls'] as $key => $link){
                $the_tweet = preg_replace(
                    '`'.$link['url'].'`',
                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
                    $the_tweet);
            }
        }

echo '<div class="tweet_txt">' . $the_tweet . '</div>';


echo '<div class="clearfix">';
echo '
<div class="twitter_intents">
<span><a class="reply-tweet" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">Reply</a></span>
<span><a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">Retweet</a></span>
<span><a class="favorite-tweet" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">Favorite</a></span>
</div>';
 

echo "</div>";

        echo '
        <p class="timestamp">
            <a href="https://twitter.com/'.$twitterusername.'/status/'.$tweet['id_str'].'" target="_blank">
                '.date('d M Y',strtotime($tweet['created_at'])).'
            </a>
        </p>';
    } else {
        echo '
        <br /><br />
        <a href="http://twitter.com/'.$twitterusername.'" target="_blank">Click here to read '.$twitterusername.'\'S Twitter feed</a>';
    }
echo '</div>';
echo '</div>';
echo '</li>';
}
echo "</ul>";
echo "</div></div>";
}
}
echo $after_widget;
 
}   // display the widget
 
function update($new_instance, $old_instance) {
$instance = $old_instance;
 
//Strip tags from title and name to remove HTML
$instance['title']      = strip_tags( $new_instance['title'] );
$instance['twitterusername']  = strip_tags( $new_instance['twitterusername'] );
$instance['numb']       = strip_tags( $new_instance['numb'] );
$instance['fullname']   = strip_tags( $new_instance['fullname'] );
$instance['username']   = strip_tags( $new_instance['username'] );

return $instance;
}   // update the widget
 
function form($instance) {
//Set up some default widget settings.
$defaults = array(
'title' => __('Latest Tweets', HS_CURRENT_THEME),
'twitterusername' => '',
'numb' => '3',
'fullname' => '',
'username' => '',
'show_info' => false
);
$instance = wp_parse_args( (array) $instance, $defaults );
 
// Widget Title: Text Input  ?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'twitterusername' ); ?>"><?php _e('Twitter username:', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'twitterusername' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'twitterusername' ); ?>" value="<?php echo $instance['twitterusername']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'numb' ); ?>"><?php _e('Number of Twets:', HS_CURRENT_THEME); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'numb' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'numb' ); ?>" value="<?php echo $instance['numb']; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id("fullname"); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("fullname"); ?>" name="<?php echo $this->get_field_name("fullname"); ?>"<?php checked( (bool) $instance["fullname"], true ); ?> />
      <?php _e( 'Show fullname', HS_CURRENT_THEME ); ?>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id("username"); ?>">
      <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("username"); ?>" name="<?php echo $this->get_field_name("username"); ?>"<?php checked( (bool) $instance["username"], true ); ?> />
      <?php _e( 'Show username', HS_CURRENT_THEME ); ?>
  </label>
</p>
<?php }  // and of course the form for the widget options
}   // The twitter widget class
?>