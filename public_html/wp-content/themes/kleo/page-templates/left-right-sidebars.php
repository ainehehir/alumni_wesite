<?php
/**
 * Template Name: 3 Columns - Left and Right sidebars
 *
 * Description: Show a page template with left and right sidebars
 *
 * @package WordPress
 * @subpackage Kleo
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Kleo 1.0
 */

get_header(); ?>

<?php
//create 3lr template
add_action('kleo_after_content', 'kleo_sidebar');
add_action('kleo_after_content', 'kleo_extra_sidebar');

add_filter('kleo_main_template_classes', create_function('$cols', '$cols = "col-sm-push-3 col-sm-6 tpl-3lr"; return $cols;'));
add_filter('kleo_sidebar_classes', create_function('$cols', '$cols = "col-sm-pull-6 col-sm-3 sidebar-3lr"; return $cols;'));
add_filter('kleo_extra_sidebar_classes', create_function('$classes', '$classes = "col-sm-3 sidebar-3lr"; return $classes;'));

?>

<?php get_template_part('page-parts/general-title-section'); ?>

<?php get_template_part('page-parts/general-before-wrap'); ?>

<?php
if ( have_posts() ) :
	// Start the Loop.
	while ( have_posts() ) : the_post();

		/*
		 * Include the post format-specific template for the content. If you want to
		 * use this in a child theme, then include a file called called content-___.php
		 * (where ___ is the post format) and that will be used instead.
		 */
		get_template_part( 'content', 'page' );

	endwhile;

endif;
?>
        
<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php get_footer(); ?>