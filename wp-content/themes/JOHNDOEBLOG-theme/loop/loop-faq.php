<?php /* Loop Name: Loop faq */ ?>
<?php
    $temp = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query();
    $wp_query->query('post_type=faq&showposts=-1');
?>
<?php
$i=1;
?>
<div id="accordion2" class="accordion">
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
    <div class="accordion-group">
	<div class="accordion-heading">
	<a class="accordion-toggle active" href="#id-<?php echo $i; ?>" data-parent="#accordion2" data-toggle="collapse"><h6><?php echo $i; ?>. <?php the_title(); ?></h6>
    </a>
	</div>
    <div id="id-<?php echo $i; ?>" class="accordion-body collapse "><div class="accordion-inner"><?php the_content(); ?>
     </div>
	</div>
	</div>
<?php $i++; ?>
<?php endwhile; ?>
</div>
<?php 
	$wp_query = null;
	$wp_query = $temp;
?>