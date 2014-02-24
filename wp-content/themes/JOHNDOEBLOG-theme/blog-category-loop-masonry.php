<?php // Theme Options vars
	$layout_mode = of_get_option('layout_mode');
?>

<script>
	jQuery(document).ready(function($) {
	var $container = jQuery('#portfolio-grid'),
			filters = {},
			items_count = jQuery(".portfolio_item").size();
			jQuery(".portfolio_item").hide();
		
		$container.imagesLoaded( function(){	
			setColumnWidth();
			$container.isotope({
				itemSelector : '.portfolio_item',
				hiddenClass : 'portfolio_hidden',
				resizable : false,
				transformsEnabled : true,
				layoutMode: 'masonry'
			});
		
		});
		
		function getNumColumns(){
			
			var $folioWrapper = jQuery('#portfolio-grid').data('cols');
			
			if($folioWrapper == '1col') {
				var winWidth = jQuery("#portfolio-grid").width();		
				var column = 1;		
				return column;
			}
			
			if($folioWrapper == '2cols') {
				var winWidth = jQuery("#portfolio-grid").width();		
				var column = 2;		
				if (winWidth<380) column = 1;
				return column;
			}
			
			else if ($folioWrapper == '3cols') {
				var winWidth = jQuery("#portfolio-grid").width();		
				var column = 3;		
				if (winWidth<380) column = 1;
				else if(winWidth>=380 && winWidth<788)  column = 2;
				else if(winWidth>=788 && winWidth<1160)  column = 3;
				else if(winWidth>=1160) column = 3;
				return column;
			}
			
			else if ($folioWrapper == '4cols') {
				var winWidth = jQuery("#portfolio-grid").width();		
				var column = 4;		
				if (winWidth<380) column = 1;
				else if(winWidth>=380 && winWidth<788)  column = 2;
				else if(winWidth>=788 && winWidth<1160)  column = 3;
				else if(winWidth>=1160) column = 4;		
				return column;
			}
			else if ($folioWrapper == '5cols') {
				var winWidth = jQuery("#portfolio-grid").width();		
				var column = 5;		
				if (winWidth<380) column = 1;
				else if(winWidth>=380 && winWidth<788)  column = 2;
				else if(winWidth>=788 && winWidth<1160)  column = 3;
				else if(winWidth>=1160) column = 5;		
				return column;
			}
			else if ($folioWrapper == '6cols') {
				var winWidth = jQuery("#portfolio-grid").width();		
				var column = 5;		
				if (winWidth<380) column = 1;
				else if(winWidth>=380 && winWidth<788)  column = 2;
				else if(winWidth>=788 && winWidth<1160)  column = 3;
				else if(winWidth>=1160) column = 6;		
				return column;
			}
			else if ($folioWrapper == '8cols') {
				var winWidth = jQuery("#portfolio-grid").width();		
				var column = 5;		
				if (winWidth<380) column = 1;
				else if(winWidth>=380 && winWidth<788)  column = 2;
				else if(winWidth>=788 && winWidth<1160)  column = 3;
				else if(winWidth>=1160) column = 8;		
				return column;
			}
		}
		
		function setColumnWidth(){
			var columns = getNumColumns();		
		
			var containerWidth = jQuery("#portfolio-grid").width();		
			var postWidth = containerWidth/columns;
			postWidth = Math.floor(postWidth);
	 	
			jQuery(".portfolio_item").each(function(index){
				jQuery(this).css({"width":postWidth+"px"}).fadeIn(360);
			});
}
			
		function arrange(){
			setColumnWidth();		
			$container.isotope('reLayout');	
		}
			
		jQuery(window).on("debouncedresize", function( event ) {	
			arrange();	
jQuery(".responsive").fitText(1.2);			
		});
		
		
		// Filter projects
		$('.filter a').click(function(){
			var $this = $(this).parent('span');
			// don't proceed if already active
			if ( $this.hasClass('active') ) {
				return;
			}

			var $optionSet = $this.parents('.filter');
			// change active class
			$optionSet.find('.active').removeClass('active');
			$this.addClass('active');

			var selector = $(this).attr('data-filter');
			$container.isotope({ filter: selector });

			var hiddenItems = 0,
				showenItems = 0;
			jQuery(".portfolio_item").each(function(){
				if ( jQuery(this).hasClass('portfolio_hidden') ) {
					hiddenItems++;
				};
			});

			showenItems = items_count - hiddenItems;
			if ( ($(this).attr('data-count')) > showenItems ) {				
				jQuery(".pagination__posts").css({"display" : "block"});
			} else {
				jQuery(".pagination__posts").css({"display" : "none"});
			}
			return false;
		});	
	});
</script>
<ul id="portfolio-grid" class="filterable-portfolio thumbnails portfolio-<?php echo $cols; ?>" data-cols="<?php echo $cols; ?>">
	<?php get_template_part('blog-isotope-loop'); ?>
</ul>

<?php 

	get_template_part('includes/post-formats/post-nav');
	
?>