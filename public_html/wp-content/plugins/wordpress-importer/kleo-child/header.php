<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<!-- Fav and touch icons -->
	<?php if (sq_option_url('favicon')) { ?>
	<link rel="shortcut icon" href="<?php echo sq_option_url('favicon'); ?>">
	<?php } ?>
	<?php if (sq_option_url('apple57')) { ?>
	<link rel="apple-touch-icon-precomposed" href="<?php echo sq_option_url('apple57'); ?>">
	<?php } ?>   
	<?php if (sq_option_url('apple72')) { ?>
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo sq_option_url('apple72'); ?>">
	<?php } ?>   
	<?php if (sq_option_url('apple114')) { ?>
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo sq_option_url('apple114'); ?>">
	<?php } ?>   
	<?php if (sq_option_url('apple144')) { ?>
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo sq_option_url('apple144'); ?>">
	<?php } ?>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.js"></script>
	<![endif]-->

	<!--[if IE 7]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/fontello-ie7.css">
	<![endif]-->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
	
	<?php if(function_exists('bp_is_active')) { bp_head(); } ?>	
	
	<?php wp_head(); ?>
    
    
</head>

<?php 
/***************************************************
:: Some header customizations
***************************************************/

$site_style = sq_option('site_style', 'wide') == 'boxed' ? ' page-boxed' : '';
$site_style = apply_filters('kleo_site_style', $site_style);
?>

<body <?php body_class(); ?>>
	
	<?php do_action('kleo_after_body');?>
	
	<!-- PAGE LAYOUT
	================================================ -->
	<!--Attributes-->
	<div class="kleo-page<?php echo $site_style;?>">


	<!-- HEADER SECTION
	================================================ -->
    

	<div id="header" class="header-color">
	
	<div class="navbar" role="navigation">

		
			<div class="kleo-main-header">
				<div class="container">   
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<strong class="logo">
							<a href="http://dsa.webelevate.net"><img id="logo_img" title="Digital Skills Academy Alumni" src="http://dsa.webelevate.net/wp-content/uploads/2014/06/Logo1.png" alt="Digital Skills Academy Alumni"></a>
						</strong>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse nav-collapse pull-right"><ul id="menu-alumni" class="nav navbar-nav"><li id="menu-item-37" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-35 current_page_item menu-item-37 active"><a title="Home" href="http://dsa.webelevate.net/">Home</a></li>
<li id="menu-item-1652" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1652 dropdown mega-2-cols"><a title="Members" href="http://dsa.webelevate.net/members/" class="js-activated">Members <span class="caret"></span></a>
<ul role="menu" class="dropdown-menu pull-left">
	<li id="menu-item-1655" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1655"><a title="My Profile" href="http://dsa.webelevate.net/my-profile/">My Profile</a></li>
	<li id="menu-item-1657" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1657"><a title="View Members" href="http://dsa.webelevate.net/members/">View Members</a></li>
</ul>
</li>
<li id="menu-item-39" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-39"><a title="Events" href="http://dsa.webelevate.net/events/">Events</a></li>
<li id="menu-item-31" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-31"><a title="Jobs" href="http://dsa.webelevate.net/jobs/">Jobs</a></li>
<li id="menu-item-34" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-34 dropdown mega-2-cols"><a title="Alumni Resources" href="#" class="js-activated">Alumni Resources <span class="caret"></span></a>
<ul role="menu" class="dropdown-menu pull-left">
	<li id="menu-item-29" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29"><a title="Mentoring" href="http://dsa.webelevate.net/mentoring/">Mentoring</a></li>
	<li id="menu-item-28" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-28"><a title="Online courses" href="http://dsa.webelevate.net/online-courses/">Online courses</a></li>
</ul>
</li>
<li id="menu-item-30" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30"><a title="Find a Alumni" href="http://dsa.webelevate.net/find-an-alumni/">Find Alumni</a></li>


<li id="menu-item-1651" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1651 dropdown mega-1-cols">

<a class="search-trigger" href="#">
<?php
					if ( is_user_logged_in() ) {
					    echo 'Logout';
					} else {
					    echo 'Login / Register';
					};
					?><span class="caret"></span></a>

<div class="searchHidden" id="ajax_search_container">
				<?php echo do_shortcode( '[upme_login]' ) ?>
					<div class="kleo_ajax_results"></div>
                    
				</div>
</li>


</ul></div>				
</div><!--end container-->
			</div>
			
	</div>

</div><!--end header-->


	<!-- MAIN SECTION
	================================================ -->
	<div id="main">

	<?php 
	/**
	 * Hook into this action if you want to display something before any Main content
	 * 
	 */
	do_action('kleo_before_main');
	?>
    <!-- Static navbar -->
    
	
    