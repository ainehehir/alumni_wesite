<?php
/**
 * Header section of our theme
 *
 * Displays all of the <div id="header"> section
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

//set logo path
$logo_path = sq_option_url('logo');
$logo_path = apply_filters('kleo_logo',$logo_path );
$social_icons = apply_filters('kleo_show_social_icons', sq_option('show_social_icons', 1));
$top_bar = sq_option('show_top_bar', 1);
$top_bar = apply_filters('kleo_show_top_bar', $top_bar);
?>

<div id="header" class="header-color">
	
	<div class="navbar" role="navigation">

		<?php if ($top_bar == 1) { //top bar enabled ?>
		
		<!--Attributes-->
		<!--class = social-header inverse-->
		 <div class="social-header header-color">
     		<div class="container">
          <div class="top-bar">

						<div id="top-social" class="col-sm-12 col-md-5 no-padd">
							<?php echo kleo_get_social_profiles(); ?>
						</div>

						<?php
						// Top menu
						wp_nav_menu( array(
								'theme_location'    => 'top',
								'depth'             => 2,
								'container'         => 'div',
								'container_class'   => 'top-menu col-sm-12 col-md-7 no-padd',
								'menu_class'        => '',
								'fallback_cb'       => '',
								'walker'            => new kleo_walker_nav_menu()
								)
						);
						?>
  
          </div><!--end top-bar-->
        </div>
			</div>
		
			<?php } //end top bar condition ?>

			<div class="kleo-main-header">
				<div class="container">   
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
							<span class="sr-only"><?php _e("Toggle navigation",'kleo_framework');?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<strong class="logo">
							<a href="<?php echo home_url();?>"><img id="logo_img" title="<?php bloginfo('name'); ?>" src="<?php echo $logo_path; ?>" alt="<?php bloginfo('name'); ?>"></a>
						</strong>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<?php
					// Main menu
					wp_nav_menu( array(
							'theme_location'    => 'primary',
							'depth'             => 3,
							'container'         => 'div',
							'container_class'   => 'collapse navbar-collapse nav-collapse pull-right',
							'menu_class'        => 'nav navbar-nav',
							'fallback_cb'       => 'kleo_walker_nav_menu::fallback',
							'walker'            => new kleo_walker_nav_menu())
					);
					?>
				</div><!--end container-->
			</div>
			
	</div>

</div><!--end header-->