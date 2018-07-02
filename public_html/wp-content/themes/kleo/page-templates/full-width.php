<?php
/**
 * Template Name: Full-width
 *
 * Description: Template withour sidebar
 *
 * @package WordPress
 * @subpackage Kleo
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Kleo 1.0
 */

get_header(); ?>

<?php
//create full width template
remove_action('kleo_after_content', 'kleo_sidebar');
remove_action('kleo_after_content', 'kleo_extra_sidebar');

add_filter('kleo_main_template_classes', create_function('$cols', '$cols = "col-sm-12 tpl-no"; return $cols;'));

if (kleo_has_shortcode('vc_row')) {
	$container = 'container-full';
	add_filter('klep_main_container_class',create_function("","return '$container';"));
}
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