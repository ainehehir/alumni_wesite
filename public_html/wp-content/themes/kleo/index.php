<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Kleo
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Kleo 1.0
 */

get_header(); ?>

<?php 
//Specific class for post listing */
$blog_type = sq_option('blog_type','masonry');
$template_classes = $blog_type . '-listing';
if ($blog_type == 'standard' && sq_option('blog_meta_status', 1) == 1) { $template_classes .= ' with-meta'; }
add_filter('kleo_main_template_classes', create_function('$cls','$cls .=" posts-listing '.$template_classes.'"; return $cls;'));


/***************************************************
:: Title section
***************************************************/
if (sq_option('title_location', 'breadcrumb') == 'main') {
	$title_arr['show_title'] = false;
}
else {
	$page_title = __('Blog', 'kleo_framework');
	if (get_option('page_for_posts')) {
		$page_title = get_the_title(get_option('page_for_posts'));
	}
	$title_arr['title'] = $page_title;
}

if(sq_option('breadcrumb_status', 1) == 0) {
	$title_arr['show_breadcrumb'] = false;
}

echo kleo_title_section($title_arr);

?>





<?php get_template_part('page-parts/general-before-wrap');?>


		<div class="col-md-1 page-icon"><i class="fa fa-comments" style="color:#494949;font-size:48px; padding-right:10px;"></i>


</div><div class="col-md-10"><h1 style="text-align: center;">Features & Advice</h1></div>
<div class="clearfix"></div>
<hr/>



<?php
	if (kleo_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

<?php
if ( have_posts() ) :
	
	if ($blog_type == 'masonry') : ?>
		<div class="row">
			<div class="grid-posts kleo-isotope masonry">
	<?php endif; ?>
				
	<?php
	// Start the Loop.
	while ( have_posts() ) : the_post();

		/*
		 * Include the post format-specific template for the content. If you want to
		 * use this in a child theme, then include a file called called content-___.php
		 * (where ___ is the post format) and that will be used instead.
		 */
		?>
		<?php 
		if ($blog_type == 'masonry') : 

		 get_template_part( 'page-parts/post-content-masonry');
				
		else:  
			 get_template_part( 'content', get_post_format() );
		endif;
		
	endwhile;
	
	if ($blog_type == 'masonry') : ?>
			</div>
		</div>
        
        
        
	<?php endif; ?>	

	<?php
	
	// Post navigation.
	kleo_pagination();

else :
	// If no content, include the "No posts found" template.
	get_template_part( 'content', 'none' );

endif;
?>


        
<?php get_template_part('page-parts/general-after-wrap');?>



<?php get_footer(); ?>