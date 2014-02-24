<?php /* Wrapper Name: Footer */ ?>
<?php if ( is_active_sidebar( 'hs_prefooter_sidebar_1' ) ) : ?>
<div class="prefooter">
<div class="container">
        
<div class="row-fluid prefooter-widgets">
 
    <div class="span12">
        <?php dynamic_sidebar("hs_prefooter_sidebar_1"); ?>
    </div>
    
</div>

</div>
</div>
<?php endif; ?>
<?php if ( of_get_option('footer_middle') == 'true') { ?>
<div class="midlefooter">
	<div class="container">
<div class="row-fluid copyright">
    <div class="span6">
	<?php get_template_part("static/static-footer-nav"); ?>
    </div>
    <div class="span6">
    	<?php get_template_part("static/static-footer-text"); ?>
    </div>
</div>
</div>
</div>
<?php } ?>
<div class="afterfooter">
<?php if ( is_active_sidebar( 'hs_afterfooter_sidebar' ) ) : ?>
<div class="container">
        
<div class="row-fluid afterfooter-widgets">
 
    <div class="span12">
        <?php dynamic_sidebar("hs_afterfooter_sidebar"); ?>
    </div>
    
</div>
</div>
<?php endif; ?>

<?php if ( of_get_option('footer_logo') == 'true') { ?>  
<div class="container">
<div class="row-fluid">
<div class="span12">
    	<?php get_template_part("static/static-logo"); ?>
    </div>
</div>
</div>
<?php } ?>

</div>