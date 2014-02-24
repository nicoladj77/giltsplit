<?php /* Static Name: Navigation */ 
	if (has_nav_menu('header_menu')) { ?>
		<!-- BEGIN MAIN NAVIGATION  -->
		<div class="menu-button"><i class="icon-menu"></i></div>
		<nav class="nav nav__primary clearfix"> 
			<?php wp_nav_menu( array(
				'container'		=> false,
				'menu_id'       => '',
				'depth'         => 0,
				'items_wrap'    => '<ul class="flexnav" data-breakpoint="800">%3$s</ul>',
				'theme_location'=> 'header_menu',
				'walker'		=> new hs_description_walker()
			)); ?>
			
		 </nav>
		<!-- END MAIN NAVIGATION -->
<?php } ?>


