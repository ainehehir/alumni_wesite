<?php
/*
Template Name: jobs
 * Author: Digilynx
 * Programme: The digital skills alumni website
 * File description: jobs.php
 * The Jobs page for our theme
 * 
*/
get_header(); ?>

<?php get_template_part('page-parts/general-title-section'); ?>



<?php get_template_part('page-parts/general-before-wrap'); ?>

<div class="col-md-1 page-icon"><span class="icon-Icon" style="color: #494949; font-size: 48px;">&#xe603
</span></div>
<div class="col-md-10">
<h1 style="text-align: center;">Jobs</h1>
</div>
<div class="clearfix"></div>

<hr />

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