<?php
/**
* Template Name: Contact Page
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
			</div>
		</div>
	</div>
</div>

<div id="contact-page" class="content-holder clearfix">
<?php get_template_part("loop/loop-contact"); ?>
</div>

<footer class="footer">
<?php get_template_part('wrapper/wrapper-footer'); ?>
</footer>
<?php get_footer(); ?>