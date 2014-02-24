<!-- .share-buttons -->
<?php
$social_share = of_get_option('social_share');
$shareon = of_get_option('shareon');
$facebook_share = of_get_option('facebook_share');
$twitter_share = of_get_option('twitter_share');
$gplus_share = of_get_option('gplus_share');
$digg_share = of_get_option('digg_share');
$reddit_share = of_get_option('reddit_share');
$linkedin_share = of_get_option('linkedin_share');
$pinterest_share = of_get_option('pinterest_share');
$stumbleupon_share = of_get_option('stumbleupon_share');
$tumblr_share = of_get_option('tumblr_share');
$email_share = of_get_option('email_share');
if ($social_share=='true') {
?>
<div class="share-buttons">
	<?php
		/* get permalink */
		$permalink = get_permalink(get_the_ID());
		$titleget = get_the_title();
	?>
<?php
if ($shareon=='true') { ?>
<div class="shareon"><?php echo theme_locals("share_on"); ?></div>
<?php } ?>
<?php
if ($facebook_share=='true') { ?>
<a class="icon-facebook-1 icon-2x" href="http://www.facebook.com/sharer.php?u=<?php echo $permalink;?>&amp;t=<?php echo str_replace(" ", "%20", $titleget);?>" target="_blank" ></a>
<?php } ?>
<?php
if ($twitter_share=='true') { ?>
<a class="icon-twitter icon-2x" href="http://twitter.com/share?url=<?php echo $permalink; ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>"></a>
<?php } ?>
<?php
if ($gplus_share=='true') { ?>
<a class="icon-googleplus icon-2x" href="https://plus.google.com/share?url=<?php echo $permalink; ?>" target="_blank"></a>
<?php } ?>
<?php
if ($digg_share=='true') { ?>
<a class="icon-digg icon-2x" href="http://www.digg.com/submit?url=<?php echo $permalink; ?>" target="_blank"></a>
<?php } ?>
<?php
if ($reddit_share=='true') { ?>
<a class="icon-reddit icon-2x" href="http://reddit.com/submit?url=<?php echo $permalink; ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>" target="_blank"></a>
<?php } ?>
<?php
if ($linkedin_share=='true') { ?>
<a class="icon-linkedin icon-2x" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink; ?>" target="_blank"></a>
<?php } ?>
<?php
if ($pinterest_share=='true') { ?>
<a class="icon-pinterest icon-2x" href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'></a>
<?php } ?>
<?php
if ($stumbleupon_share=='true') { ?>
<a class="icon-stumbleupon icon-2x" href="http://www.stumbleupon.com/submit?url=<?php echo $permalink; ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>" target="_blank"></a>
<?php } ?>
<?php
if ($tumblr_share=='true') {
$str = $permalink;
$str = preg_replace('#^https?://#', '', $str);
?>
<a class="icon-tumblr icon-2x" href="http://www.tumblr.com/share/link?url=<?php echo $str; ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>" target="_blank"></a>
<?php } ?>
<?php
if ($email_share=='true') { ?>
<a class="icon-mail icon-2x" href="mailto:?Subject=<?php echo str_replace(" ", "%20", $titleget); ?>&amp;Body=<?php echo $permalink; ?>"></a>
<?php } ?>
</div><!-- //.share-buttons -->
<?php } ?>