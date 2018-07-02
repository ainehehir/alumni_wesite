<?php
/**
 * Before content wrap
 * Used in all templates
 */
?>
<?php
$main_tpl_classes = apply_filters('kleo_main_template_classes', '');

if (kleo_has_shortcode('kleo_bp_')) {
	$section_id = 'id="buddypress" ';
}	else {
	$section_id = '';
}

$container = apply_filters('klep_main_container_class','container');
?>

<section class="container-wrap main-color">
	<div id="main-container" class="<?php echo $container; ?>">
		<?php if($container == 'container') { ?><div class="row"> <?php } ?>

			<?php
			/**
			 * Before main content - action
			 */
			do_action('kleo_before_content');
			?>
			<div <?php echo $section_id;?>class="template-page <?php echo $main_tpl_classes; ?>">
				<div class="wrap-content">
					
				<?php
				if (sq_option('title_location', 'breadcrumb') == 'main') {
					$title_status = true;
					if(is_singular() && get_cfield('title_checkbox') == 1) {
						$title_status = false;
					}
					if ($title_status) {
						echo '<h1 class="page-title">' . kleo_title() . '</h1>';
					}
				}
				?>