<?php
/**
 * @package WordPress
 * @subpackage Kleo
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Kleo 1.0
 */

/**
 * Kleo Child Theme Functions
 * Add custom code below
*/ 


register_sidebar( array(
	'name' => 'Page Menu',
	'id' => 'page-menu',
	'before_widget' => '<div id="page-nav">',
	'after_widget' => '</div>',
	'before_title' => false,
	'after_title' => false
) );

add_filter( 'wp_page_menu', 'my_page_menu' );

function my_page_menu( $menu ) {
	dynamic_sidebar( 'page-menu' );
}



// add thumbnail support
add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
set_post_thumbnail_size( 200, 130, true ); // 50 pixels wide by 50 pixels tall, hard crop mode

