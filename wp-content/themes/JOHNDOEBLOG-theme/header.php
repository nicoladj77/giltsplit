<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->
<head>
	<title><?php if ( is_category() ) {
		echo __('Category Archive for &quot;', HS_CURRENT_THEME); single_cat_title(); echo __('&quot; | ', HS_CURRENT_THEME); hs_site_title();
	} elseif ( is_tag() ) {
		echo __('Tag Archive for &quot;', HS_CURRENT_THEME); single_tag_title(); echo __('&quot; | ', HS_CURRENT_THEME); hs_site_title();
	} elseif ( is_archive() ) {
		wp_title(''); echo __(' Archive | ', HS_CURRENT_THEME); hs_site_title();
	} elseif ( is_search() ) {
		echo __('Search for &quot;', HS_CURRENT_THEME).esc_html($s).__('&quot; | ', HS_CURRENT_THEME); hs_site_title();
	} elseif ( is_home() || is_front_page()) {
		bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
	}  elseif ( is_404() ) {
		echo __('Error 404 Not Found | ', HS_CURRENT_THEME); hs_site_title();
	} elseif ( is_single() ) {
		wp_title('');
	} else {
		wp_title( ' | ', true, 'right' ); hs_site_title(); 
	} ?></title>
	<?php if(of_get_option('description') != ''){ ?>
	<meta name="description" content="<?php echo of_get_option('description'); ?>" />
	<?php } else { ?>
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<?php } ?>
	<meta name="keywords" content="<?php echo of_get_option('keywords'); ?>" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if(of_get_option('favicon') != ''){ ?>
	<link rel="icon" href="<?php echo of_get_option('favicon', "" ); ?>" type="image/x-icon" />
	<?php } else { ?>
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
	<?php } ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
	<?php 	
	/* The HTML5 Shim is required for older browsers, mainly older versions IE */ ?>
	<!--[if lt IE 8]>
	<div style=' clear: both; text-align:center; position: relative;'>
    	<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
    </div>
	<![endif]-->
<?php		
wp_head();
?>	
	
</head>
<?php 
$hercules_widebox = '';
if ( of_get_option('hs_wrapper') == 'false') {  
		$hercules_widebox = 'boxed';
		} ?>

<body <?php body_class($hercules_widebox); ?>>
	
	<?php $hercules_header_position = of_get_option('header_position'); 
	$hercules_holder = '';
$hercules_holder = 'margin-top:295px;';


			if($hercules_header_position == 'stickyheader') {
				$hercules_header_position = "header";
				
			}elseif ($hercules_header_position == 'normalheader') {
			$hercules_header_position = "normal_header";
			$hercules_holder = 'margin-top:0px;';
			}else {
			$hercules_header_position = "header";

			}
		?>
		<?php $hercules_header_styling = of_get_option('header_color');
$hercules_headerstyling = '';		
			if($hercules_header_styling != '') {
				$hercules_headerstyling = 'background-color:'.$hercules_header_styling.';';
			}
		?>
		<div class="main-holder" style="<?php echo $hercules_holder; ?>">
<header class="<?php echo $hercules_header_position; ?>" style="<?php echo $hercules_headerstyling; if (is_admin_bar_showing()) {echo ("margin-top:32px;");} ?>">
<?php if ( of_get_option('g_search_box_id') == 'yes') { ?>
<div class="top-panel hidden-phone">

    <div class="top-panel-content" style="display: none;">
        <div class="top-panel-content-inner clearfix">
            

<div class="container">
<div class="row-fluid">

<div class="span12">	
<?php get_template_part("static/static-search"); ?>
</div>

</div>
</div>

        </div>
    </div>
    <div class="top-panel-button">
        <div class="toggle-button"><i class="icon-search-2 icon-2x"></i></div>
    </div>

</div>
<?php } ?>
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<?php 	
				get_template_part('wrapper/wrapper-header'); ?>
			</div>
		</div>
	</div>
</header>