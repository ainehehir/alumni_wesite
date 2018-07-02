<?php
/**
 * The template for displaying Buddypress pages
 *
 *
 * @package Wordpress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

get_header(); ?>

<?php
$title_arr = array();

if(sq_option('bp_title_location', 'breadcrumb') != 'breadcrumb') {
	$title_arr['show_title'] = false;
}

$title = get_the_title();
if (bp_is_group_create()) {
	$title = preg_replace("/<a\b[^>]*>(.*?)<\/a>/i","",get_the_title());
}
$title_arr['title'] = $title;

$title_arr['extra'] = '<p class="page-info">'.sq_option('bp_title_info', '').'</p>';
if(sq_option('bp_breadcrumb_status', 1) == 0) {
	$title_arr['show_breadcrumb'] = false;
}
	
if( sq_option('bp_breadcrumb_status', 1) == 0
				&& sq_option('bp_title_status', 1) == 0 
				&& sq_option('bp_title_info', '') == '' ) 
{
	//hide the section
}
else
{
	echo kleo_title_section($title_arr); 
}
?>

<?php get_template_part('page-parts/general-before-wrap'); ?>

<?php
if ( have_posts() ) :
	// Start the Loop.
	while ( have_posts() ) : the_post(); 
	?>
	<div class="row">
		<div class="col-sm-12">
			
			<?php if (sq_option('bp_title_location','breadcrumb') == 'main'): ?>
			<h1 class="text-center" style="font-size:20px;"><?php echo strip_tags($title); ?></h1>
			<?php endif;?>
			
			<div class="article-content">
					<?php the_content(); ?>
			</div><!--end article-content-->
		</div><!--end twelve-->
	</div>


	<?php
	endwhile;

endif;
?>
        
<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php get_footer(); ?>