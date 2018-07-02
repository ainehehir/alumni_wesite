<?php
/**
 * Shortcodes logic.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }



/***************************************************
:: Include shortcodes
***************************************************/
global $kleo_config;
$k_elements = array(
		
		'kleo_gap' => array(
				'name' => 'Gap',
				'category' => '',
				'example' => '[kleo_gap size="12px" class="" id=""]'
				),
		'kleo_divider' => array(
				'name' => 'Divider',
				'category' => '',
				'example' => '[kleo_divider type="full|long|double|short" double="yes|no" position="center|left|right" text="" class="" id=""]'
				),
		'kleo_grid' => array(
				'name' => 'Grid container',
				'category' => '',
				'example' => '[kleo_grid type="2|3|4|5|6" animation="yes"][kleo_feature_item]Feature item 1[/kleo_feature_item][kleo_feature_item]Feature item 2[/kleo_feature_item][/kleo_grid]'
				),
		'kleo_feature_item' => array(
				'name' => 'Feature Item',
				'category' => '',
				'example' => '[kleo_feature_item]Text[/kleo_feature_item]'
				),
		'kleo_button' => array(
				'name' => 'Button',
				'category' => '',
				'example' => '[kleo_button title="Button text" href="" style="default" size="" ]'
				),
		'kleo_icon' => array(
				'name' => 'Icon',
				'category' => '',
				'example' => '[kleo_icon icon="android" icon_size=""]'
				),
		'kleo_list' => array(
				'name' => 'Fancy List',
				'category' => '',
				'example' => '[kleo_list][kleo_list_item]Lorem ipsum[/kleo_list_item][kleo_list_item]Lorem ipsum[/kleo_list_item][/kleo_list]'
				),
		'kleo_list_item' => array(
				'name' => 'Fancy List Item',
				'category' => '',
				'example' => '[kleo_list_item]Lorem ipsum[/kleo_list_item]'
				),
		'kleo_animate_numbers' => array(
				'name' => 'Animated numbers',
				'category' => '',
				'example' => '[kleo_animate_numbers animation="animate-when-almost-visible" timer=""]100[/kleo_animate_numbers]'
				),
		'kleo_visibility' => array(
				'name' => 'Responsive Visibility',
				'category' => '',
				'example' => '[kleo_visibility type="visible-md"]'
				),
		'kleo_pin' => array(
				'name' => 'Pin',
				'category' => '',
				'example' => '[kleo_pin type="circle" left="" right="" top="" bottom=""]'
				),
		'kleo_clients' => array(
				'name' => 'Clients',
				'category' => '',
				'example' => '[kleo_clients number=5 animated=yes animation=fade]'
				),
		'kleo_testimonials' => array(
				'name' => 'Testimonials',
				'category' => '',
				'example' => '[kleo_testimonials number=3]'
				),
		'kleo_bp_members_carousel' => array(
				'name' => 'Members Carousel',
				'category' => 'buddypress',
				'example' => '[kleo_bp_members_carousel type="newest" number="12" min_items="1" max_items="6" item_width="150" image_size="full" rounded="rounded" online="show" class=""]'
				),
		'kleo_bp_members_grid' => array(
				'name' => 'Members Grid',
				'category' => 'buddypress',
				'example' => '[kleo_bp_members_grid type="newest" number="12" size="150" class=""]'
				),
		'kleo_bp_members_masonry' => array(
				'name' => 'Members Masonry',
				'category' => 'buddypress',
				'example' => '[kleo_bp_members_masonry type="newest" number="12" rounded="rounded" class=""]'
				),
		'kleo_bp_groups_carousel' => array(
				'name' => 'Groups Carousel',
				'category' => 'buddypress',
				'example' => '[kleo_bp_groups_carousel type="newest" number="12" min_items="1" max_items="6" item_width="150" image_size="full" rounded="rounded" class=""]'
				),
		'kleo_bp_groups_grid' => array(
				'name' => 'Groups Grid',
				'category' => 'buddypress',
				'example' => '[kleo_bp_groups_grid type="newest" number="12" size="150" class=""]'
				),
		'kleo_bp_groups_masonry' => array(
				'name' => 'Groups Masonry',
				'category' => 'buddypress',
				'example' => '[kleo_bp_groups_masonry type="newest" number="12" rounded="rounded" class=""]'
				),
		'kleo_bp_activity_stream' => array(
				'name' => 'Activity Stream',
				'category' => 'buddypress',
				'example' => '[kleo_bp_activity_stream number=6 show_button=yes button_label="View All Activity" button_link="/activity"]'
				)			
);

$k_elements = apply_filters( 'k_elements_shortcodes', $k_elements );
$kleo_config['shortcodes'] = $k_elements;



/***************************************************
:: SMALL SHORTCODES
***************************************************/

function kleo_current_year( $atts, $content = null ) {
	return date('Y');
}
add_shortcode('current-year', 'kleo_current_year');
add_shortcode('site-url', 'home_url');




/**
 * Animated numbers
 */
add_shortcode( "kleo_animate_numbers", "kleo_animate_numbers_func");
add_filter('kleo_tinymce_shortcodes', "kleo_animate_numbers_mce");


function kleo_animate_numbers_func($atts, $content = null) {
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_animate_numbers'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_animate_numbers';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_animate_numbers_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_animate_numbers'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}


/* Button */
add_shortcode( "kleo_button", "kleo_button_func");
add_filter('kleo_tinymce_shortcodes', "kleo_button_mce");

function kleo_button_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_button'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_button';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_button_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_button'];
	
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/* List */
add_shortcode( "kleo_list", "kleo_list_func");
add_filter('kleo_tinymce_shortcodes', "kleo_list_mce");

function kleo_list_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_list'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_list';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_list_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_list'];
	
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}




/* List item */
add_shortcode( "kleo_list_item", "kleo_list_item_func");
add_filter('kleo_tinymce_shortcodes', "kleo_list_item_mce");

function kleo_list_item_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_list_item'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_list_item';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_list_item_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_list_item'];
	
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/**
 * Responsive Visibility
 */
add_shortcode( "kleo_visibility", "kleo_visibility_func");
add_filter('kleo_tinymce_shortcodes', "kleo_visibility_mce");


function kleo_visibility_func($atts, $content = null) {
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_visibility'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_visibility';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_visibility_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_visibility'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/**
 * ICON
 */

add_shortcode( "kleo_icon", "kleo_icon_func");
add_filter('kleo_tinymce_shortcodes', "kleo_icon_mce");


function kleo_icon_func($atts, $content = null) {
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_icon'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_icon';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_icon_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_icon'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}


/* 
 * Clients
 */
add_shortcode( "kleo_clients", "kleo_clients_func");
add_filter('kleo_tinymce_shortcodes', "kleo_clients_mce");


function kleo_clients_func($atts, $content = null) {
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_clients'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_clients';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_clients_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_clients'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/* 
 * Testimonials
 */
add_shortcode( "kleo_testimonials", "kleo_testimonials_func");
add_filter('kleo_tinymce_shortcodes', "kleo_testimonials_mce");


function kleo_testimonials_func($atts, $content = null) {
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_testimonials'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_testimonials';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_testimonials_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_testimonials'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}


/**
 * PIN
 */
add_shortcode( "kleo_pin", "kleo_pin_func");
add_filter('kleo_tinymce_shortcodes', "kleo_pin_mce");


function kleo_pin_func($atts, $content = null) {
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_pin'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_pin';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_pin_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_pin'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}


/**
 * GAP
 */

add_shortcode( "kleo_gap", "kleo_gap_func");
add_filter('kleo_tinymce_shortcodes', "kleo_gap_mce");


function kleo_gap_func($atts, $content = null) {
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_gap'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_gap';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_gap_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_gap'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/**
 * DIVIDER
 */

add_shortcode( "kleo_divider", "kleo_divider_func");
add_filter('kleo_tinymce_shortcodes', "kleo_divider_mce");


function kleo_divider_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_divider'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_divider';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_divider_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_divider'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}

/* Grid */

add_shortcode( "kleo_grid", "kleo_grid_func");
add_filter('kleo_tinymce_shortcodes', "kleo_grid_mce");


function kleo_grid_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_grid'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_grid';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_grid_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_grid'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}


/* Feature Item */


add_shortcode( "kleo_feature_item", "kleo_feature_item_func");
add_filter('kleo_tinymce_shortcodes', "kleo_feature_item_mce");


function kleo_feature_item_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_feature_item'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_feature_item';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_feature_item_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_feature_item'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}

/**
 * Buddypress Activity Stream.
 */

add_shortcode( "kleo_bp_activity_stream", "kleo_bp_activity_stream_func");
add_filter('kleo_tinymce_shortcodes', "kleo_bp_activity_stream_mce");


function kleo_bp_activity_stream_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_activity_stream'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_bp_activity_stream';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_bp_activity_stream_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_activity_stream'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/**
 * Buddypress Groups carousel.
 */

add_shortcode( "kleo_bp_groups_carousel", "kleo_bp_groups_carousel_func");
add_filter('kleo_tinymce_shortcodes', "kleo_bp_groups_carousel_mce");


function kleo_bp_groups_carousel_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_groups_carousel'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_bp_groups_carousel';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_bp_groups_carousel_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_groups_carousel'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/**
 * Buddypress Groups grid.
 */

add_shortcode( "kleo_bp_groups_grid", "kleo_bp_groups_grid_func");
add_filter('kleo_tinymce_shortcodes', "kleo_bp_groups_grid_mce");


function kleo_bp_groups_grid_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_groups_grid'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_bp_groups_grid';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_bp_groups_grid_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_groups_grid'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"],  
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/**
 * Buddypress Groups carousel.
 */

add_shortcode( "kleo_bp_groups_masonry", "kleo_bp_groups_masonry_func");
add_filter('kleo_tinymce_shortcodes', "kleo_bp_groups_masonry_mce");


function kleo_bp_groups_masonry_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_groups_masonry'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_bp_groups_masonry';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_bp_groups_masonry_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_groups_masonry'];
	if(!isset($shortcode)) {
		return $args;
	}

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/**
 * Buddypress Members carousel.
 */

add_shortcode( "kleo_bp_members_carousel", "kleo_bp_members_carousel_func");
add_filter('kleo_tinymce_shortcodes', "kleo_bp_members_carousel_mce");


function kleo_bp_members_carousel_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_members_carousel'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_bp_members_carousel';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_bp_members_carousel_mce($args) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_members_carousel'];
	if(!isset($shortcode)) {
		return $args;
	}

	$shortcode = $kleo_config['shortcodes']['kleo_bp_members_carousel'];

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/**
 * Buddypress Members grid.
 */

add_shortcode( "kleo_bp_members_grid", "kleo_bp_members_grid_func");
add_filter('kleo_tinymce_shortcodes', "kleo_bp_members_grid_mce");


function kleo_bp_members_grid_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_members_grid'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_bp_members_grid';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_bp_members_grid_mce($args) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_members_grid'];
	if(!isset($shortcode)) {
		return $args;
	}

	$shortcode = $kleo_config['shortcodes']['kleo_bp_members_grid'];

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}



/**
 * Buddypress Groups carousel.
 */

add_shortcode( "kleo_bp_members_masonry", "kleo_bp_members_masonry_func");
add_filter('kleo_tinymce_shortcodes', "kleo_bp_members_masonry_mce");


function kleo_bp_members_masonry_func($atts, $content = null) {
	
	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_members_masonry'];
	$output = '';

	if(!isset($shortcode)) {
		return;
	}

	$sh_category = '';
	if ( isset($shortcode['category']) && !empty($shortcode['category']) ) {
		$sh_category = trailingslashit($shortcode['category']);
	}
	$shortcode_path = $sh_category .'kleo_bp_members_masonry';

	if(find_shortcode_template($shortcode_path)) {
		include find_shortcode_template($shortcode_path);
	} else {
		$output = kleo_shortcode_not_found();
	}

	return $output;
}

function kleo_bp_members_masonry_mce($args) {

	global $kleo_config;
	$shortcode = $kleo_config['shortcodes']['kleo_bp_members_masonry'];
	if(!isset($shortcode)) {
		return $args;
	}

	$shortcode = $kleo_config['shortcodes']['kleo_bp_members_masonry'];

	$args[$shortcode["category"]][] = array(
			"name" => $shortcode["name"], 
			"category" => $shortcode["category"],
			"code" => $shortcode["example"]
		); 
	return $args;
}


/* BP MEMBERS STATS */

if (!function_exists('kleo_bp_member_stats_func')) {
    function kleo_bp_member_stats_func( $atts, $content = null ) {
			extract(shortcode_atts(array(
				'field' => '',
				'value' => '',
				'online' => false
				), $atts));

			return kleo_bp_member_stats($field, $value, $online);
    }
    add_shortcode('kleo_bp_member_stats', 'kleo_bp_member_stats_func');
		add_filter('kleo_tinymce_shortcodes', create_function('$args','$args["buddypress"][] = array("name" => "Members statistics", "category" => "buddypress", "code" => "[kleo_bp_member_stats field=\"\" value=\"\" online=false]"); return $args;'));
}


if (!function_exists('kleo_total_members')) {
    function kleo_total_members( $atts, $content = null ) {
			return bp_get_total_member_count();
    }
    add_shortcode('kleo_total_members', 'kleo_total_members');
		add_filter('kleo_tinymce_shortcodes', create_function('$args','$args["buddypress"][] = array("name" => "Total members", "category" => "buddypress", "code" => "[kleo_total_members]"); return $args;'));

}