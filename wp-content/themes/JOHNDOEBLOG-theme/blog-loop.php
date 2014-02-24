<?php // Theme Options vars
if ( of_get_option('folio_filter') != 'none') {
?>
<div class="filter-wrapper clearfix">
<div style="text-align:center;">
				<div id="filters" class="filter nav nav-pills">
					<?php
						$count_posts = wp_count_posts('post');
					?>
					<?php echo theme_locals("categories"); ?> <span class="active"><a class="btn" href="#" data-count="<?php echo $count_posts->publish; ?>" data-filter><?php echo theme_locals("show_all"); ?></a></span>
					<?php
$filter_array = array();
						$portfolio_categories = get_categories(array('taxonomy'=>'category'));
						
						foreach($portfolio_categories as $category) {
							$filter_array[$category->slug] = $category->count;
						}
						global $paged, $wp_query, $wp;
        if  ( empty($paged) ) {
                if ( !empty( $_GET['paged'] ) ) {
                        $paged = $_GET['paged'];
                } elseif ( !empty($wp->matched_query) && $args = wp_parse_args($wp->matched_query) ) {
                        if ( !empty( $args['paged'] ) ) {
                                $paged = $args['paged'];
                        }
                }
                if ( !empty($paged) )
                        $wp_query->set('paged', $paged);
        }
						$the_query = new WP_Query();
						if ($paged == 0)
							$paged = 1;

						$custom_count = ($paged - 1) * $items_count;

						$the_query->query('post_type=post&showposts='. $items_count .'&offset=' . $custom_count);
						
						
						while( $the_query->have_posts() ) :
							$the_query->the_post();
							$post_id = $the_query->post->ID;
							$terms = get_the_terms( $post_id, 'category');
							if ( $terms && ! is_wp_error( $terms ) ) {
								foreach ( $terms as $term )
									$filter_array[$term->slug] = $term;
									
							}
						endwhile;	
						foreach ($filter_array as $key => $value)
							if ( isset($value->count) ) {
							
								echo '<span><a class="btn" href="#" data-count="'. $value->count .'" data-filter=".'.$key.'">' . $value->name . '</a></span>';
							}	
						
						wp_reset_postdata();				
						
					?>
				</div>
				<div class="clear"></div>
			</div></div>

<?php }
global $paged, $wp_query, $wp;
        if  ( empty($paged) ) {
                if ( !empty( $_GET['paged'] ) ) {
                        $paged = $_GET['paged'];
                } elseif ( !empty($wp->matched_query) && $args = wp_parse_args($wp->matched_query) ) {
                        if ( !empty( $args['paged'] ) ) {
                                $paged = $args['paged'];
                        }
                }
                if ( !empty($paged) )
                        $wp_query->set('paged', $paged);
        }
	
$temp = $wp_query;
	$wp_query= null;
		
	$wp_query = new WP_Query();
	$wp_query->query("post_type=post&paged=".$paged.'&showposts='.$items_count ); 

?>
	
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title">not_found</h1>
		<div class="entry-content">
			
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

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
$wp_query = null;
	$wp_query = $temp;
	
?>