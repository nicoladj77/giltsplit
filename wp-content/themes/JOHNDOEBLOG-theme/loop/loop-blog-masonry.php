<?php /* Loop Name: Loop portfolio 3 */ ?>
<?php // Theme Options vars
$items_count = of_get_option('items_count3');
$cols = '3cols';
$feautered = '';
wp_enqueue_script('isotope');
wp_enqueue_script('debouncedresize');
require_once get_template_directory() . '/blog-category-loop-masonry.php';