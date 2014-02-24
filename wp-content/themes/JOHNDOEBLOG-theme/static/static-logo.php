<?php /* Static Name: Logo */ ?>
<!-- BEGIN LOGO -->                     
<div class="logo">                            
		<?php if(of_get_option('logo_type') == 'text_logo'){?>
				<h1 class="logo_h logo_h__txt"><a href="<?php echo home_url(); ?>/" title="<?php hs_site_tagline(); ?>" class="logo_link"><?php hs_site_title(); ?></a></h1>
				<!-- Site Tagline -->
				<p class="logo_tagline"><?php hs_site_tagline(); ?></p>
		<?php } else { ?>
				<?php if(of_get_option('logo_url') == ''){ ?>
						<a href="<?php echo home_url(); ?>/" class="logo_h logo_h__img"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php hs_site_tagline(); ?>"></a>
				<?php } else  { ?>
						<h1 class="logo_h logo_h__txt"><a href="<?php echo home_url(); ?>/" class="logo_h logo_h__img"><img src="<?php echo of_get_option('logo_url', "" ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php hs_site_tagline(); ?>"></a></h1>
				<?php }?>
		<?php }?>		
</div>
<!-- END LOGO -->