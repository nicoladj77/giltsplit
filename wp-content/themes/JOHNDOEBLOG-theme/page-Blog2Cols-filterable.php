<?php
/**
* Template Name: Filterable Blog 2 cols
*/

get_header(); ?>

<div class="content-holder clearfix">
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">
					<div class="span12" id="title-header">
            <div class="page-header">
          <?php get_template_part("static/static-customtitle"); ?>
            </div> 
						
			</div>
				</div>
				<div class="row-fluid">
                    <div class="span12">
                        <?php get_template_part("loop/loop-blog2"); ?>
                        
                    </div>
</div>
			</div>
		</div>
	</div>
</div>

            
<footer class="footer">
<?php get_template_part('wrapper/wrapper-footer'); ?>
</footer>
<?php get_footer(); ?>