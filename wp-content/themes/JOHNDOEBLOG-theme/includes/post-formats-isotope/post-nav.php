<?php //if(function_exists('hs_pagination')) : ?>
  <?php //hs_pagination($wp_query->max_num_pages); ?>
<?php //else : ?>
  <?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <ul class="paging">
      <li style="float:left;">
        <?php next_posts_link(theme_locals("older")) ?>
      </li><!--.older-->
      <li style="float:right;">
        <?php previous_posts_link(theme_locals("newer")) ?>
      </li><!--.newer-->
	  <li class="clear"></li>
    </ul><!--.oldernewer-->

  <?php endif; ?>
<?php //endif; ?>
<!-- Posts navigation -->