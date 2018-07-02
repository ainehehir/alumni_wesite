<?php

/* 
 * Visual Composer specific configurations
 * @package WordPress
 * @subpackage K Elements
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since K Elements 1.0
 */


vc_set_as_theme();


function kleo_vc_elem_increment() {
	static $count = 0; $count++;
	return $count;
}


/***************************************************
:: Remove Teaser Metabox
***************************************************/
if ( is_admin() ) {
	function kleo_vc_remove_teaser_metabox() {
		$post_types = get_post_types( '', 'names' ); 
		foreach ( $post_types as $post_type ) {
			remove_meta_box( 'vc_teaser',  $post_type, 'side' );
		}
	}
	add_action( 'do_meta_boxes', 'kleo_vc_remove_teaser_metabox' );
}



// Remove Default VC Features
vc_remove_element( "vc_text_separator" ); 
vc_remove_element( "vc_separator" ); 
vc_remove_element( "vc_facebook" ); 
vc_remove_element( "vc_googleplus" ); 
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_pie");
vc_remove_element("vc_tour");
vc_remove_element("vc_button");
vc_remove_element("vc_button2");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");


/**
 * Check if is a Visual composer template to use instead of the default page template
 **/
function kleo_template_redirect()
{	
		$post_id = @get_the_ID();

		if($post_id && is_singular())
		{
			 if($template = locate_template('page-templates/page-builder.php', false))
			 {
					//only redirect if no custom template is set
					$template_file = get_post_meta($post_id, '_wp_page_template', true);

					if("default" == $template_file || empty($template_file))
					{
						require_once($template);
						exit();
					}
			 }
		}
}
//add_action( 'template_redirect', 'kleo_template_redirect');





/***************************************************
:: Visual Composer CSS replace classes
***************************************************/

 
function kleo_css_classes_for_vc_row_and_vc_column($class_string, $tag) {

	if($tag=='vc_row' || $tag=='vc_row_inner') {
			$class_string = str_replace('vc_row-fluid', 'row', $class_string);
	}
	if($tag=='vc_column' || $tag=='vc_column_inner') {
			$class_string = str_replace('vc_span2', 'col-sm-2', $class_string);
			$class_string = str_replace('vc_span3', 'col-sm-3', $class_string);
			$class_string = str_replace('vc_span4', 'col-sm-4', $class_string);
			$class_string = str_replace('vc_span5', 'col-sm-5', $class_string);
			$class_string = str_replace('vc_span6', 'col-sm-6', $class_string);
			$class_string = str_replace('vc_span7', 'col-sm-7', $class_string);
			$class_string = str_replace('vc_span8', 'col-sm-8', $class_string);
			$class_string = str_replace('vc_span9', 'col-sm-9', $class_string);
			$class_string = str_replace('vc_span10', 'col-sm-10', $class_string);
			$class_string = str_replace('vc_span11', 'col-sm-11', $class_string);
			$class_string = str_replace('vc_span12', 'col-sm-12', $class_string);
			$class_string = str_replace('wpb_column', 'kleo_column', $class_string);
			
	}
	return $class_string;
}

add_filter('vc_shortcodes_css_class', 'kleo_css_classes_for_vc_row_and_vc_column', 10, 2);



/***************************************************
:: Visual Composer modify parameters
***************************************************/

function kleo_vc_manipulate_shortcodes() {

	$animation =array(
		"type" => "dropdown",
		"class" => "hide",
		"holder" => 'div',	
		"heading" => __("Animation"),
		"admin_label" => true,
		"param_name" => "animation",
		"value" => array(
			"None" => "",
			"Animate when visible" => "animate-when-visible",
			"Animate when almost visible" => "animate-when-almost-visible"
		),
		"description" => ""
	);
	$css_animation = array(
		"type" => "dropdown",
		"class" => "hide",
		"holder" => 'div',	
		"heading" => __("Animation type"),
		"admin_label" => true,
		"param_name" => "css_animation",
		"value" => array(
			"Right to Left" => "right-to-left",
			"Left to Right" => "left-to-right",
			"Bottom to Top" => "bottom-to-top",
			"Top to Bottom" => "top-to-bottom",
			"Scale" => "el-appear",
			"Fade" => "el-fade",
			"Pulsate" => "pulsate",
		),
		"dependency" => array(
			"element" => "animation",
			"not_empty" => true
		),
		"description" => ""
	);

	$icon = array(
		"type" => "dropdown",
		"holder" => "div",
		"class" => "hide",
		"heading" => __("Icon"),
		"param_name" => "icon",
		"value" => kleo_icons_array(),
		"description" => __("Choose the icon to display")
	);
	$icon_size = array(
		"type" => "dropdown",
		"class" => "hide",
		"holder" => 'div',	
		"heading" => __("Icon size"),
		"admin_label" => true,
		"param_name" => "icon_size",
		"value" => array(
			"Regular" => "",
			"2x" => "2x",
			"3x" => "3x",
			"4x" => "4x"
		)
	);

	$el_class = array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Extra class name"),
		"param_name" => "el_class",
		"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.","js_composer")
	);

	$tooltip = array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Show Tooltip/Popover"),
		"param_name" => "tooltip",
		"value" => array(
			'No' => '',
			"Tooltip" => "tooltip",
			"Popover" => "popover"
		),
		"description" => __("Display a tooltip or popover with descriptive text."),
	);
	$tooltip_position = array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Tip position"),
		"param_name" => "tooltip_position",
		"value" => array(
			"Left" => "left",
			"Right" => "right",
			"Top" => "top",
			"Bottom" => "bottom"
		),
		"dependency" => array(
			"element" => "tooltip",
			"not_empty" => true
		),
		"description" => __("In which position to show the tooltip/popover"),
	);
	$tooltip_title = array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Tip/Popover Title"),
		"param_name" => "tooltip_title",
		"value" => "",
		"dependency" => array(
			"element" => "tooltip",
			"not_empty" => true
		),		
	);
	$tooltip_text = array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Popover text"),
		"param_name" => "tooltip_text",
		"value" => "",
		"dependency" => array(
			"element" => "tooltip",
			"value" => "popover"
		),		
	);
	$tooltip_action = array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Tip/Popover action"),
		"param_name" => "tooltip_action",
		"value" => array(
			"Hover" => "hover",
			"Click" => "click"
		),
		"dependency" => array(
			"element" => "tooltip",
			"not_empty" => true
		),		
		"description" => __("When to trigger the popover"),
	);
	
	$button_args = array(
					array(
						"param_name" => "title",
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Title"),
						"value" => __('Text on the button', "kleo_framework"),
						"description" => __("Button text.")
					),
					array(
						"param_name" => "href",
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("URL(Link)"),
						"value" => '',
						"description" => ""
					),
				array(
						"type" => "target",
						"holder" => "div",
						"class" => "hide",
						"heading" => __("Target"),
						"param_name" => "style",
						"value" => array(
								'Same window' => '_self',
								'New window' => '_blank'
							),
						"description" => ""
					),
					array(
						"param_name" => "style",
						"type" => "dropdown",
						"holder" => "div",
						"class" => "hide",
						"heading" => __("Style"),
						"value" => array(
								'Default' => 'default',
								'Primary' => 'primary',
								'See trough' => 'see-through',
								'Highlight' => 'highlight',
								'Link' => 'link',
							),
						"description" => "Choose the button style"
					),
					array(
						"param_name" => "size",
						"type" => "dropdown",
						"holder" => "div",
						"class" => "hide",
						"heading" => __("Size"),
						"value" => array(
								'Default' => '',
								'Extra small' => 'xs',
								'Small' => 'sm',
								'Large' => 'lg',
							),
						"description" => "Choose how you want them to appear"
					),
					array(
						"param_name" => "type",
						"type" => "dropdown",
						"holder" => "div",
						"class" => "hide",
						"heading" => __("Type"),
						"value" => array(
								'Regular' => '',
								'Animated' => 'text-animated',
								'Subtext' => 'subtext',
								'App button' => 'app'
							),
						"description" => "Choose between several button types."
					),
					
						array(
						"param_name" => "title_alt",
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Second title"),
						"value" => '',
						"dependency" => array(
							"element" => "type",
							"value" => array('text-animated', 'subtext','app')
						),
						"description" => ""
					),
					
				array(
						"param_name" => "special",
						"type" => "dropdown",
						"holder" => "div",
						"class" => "hide",
						"heading" => __("Extra rounded(special)"),
						"value" => array(
								'No' => '',
								'Yes' => 'yes'
							),
						"description" => "Make the button extra rounded"
					),

					$icon,
					$tooltip,
					$tooltip_position,
					$tooltip_title,
					$tooltip_text,
					$tooltip_action,
	);
	
	

	/* ROW */
	vc_remove_param( 'vc_row', 'bg_color' );
	vc_remove_param( 'vc_row', 'font_color' );
	vc_remove_param( 'vc_row', 'padding' );
	vc_remove_param( 'vc_row', 'margin_bottom' );
	vc_remove_param( 'vc_row', 'bg_image' );
	vc_remove_param( 'vc_row', 'bg_image_repeat' );
	vc_remove_param( 'vc_row', 'el_class' );

	vc_add_param( 'vc_row', array(
			'param_name'  => 'inner_container',
			'heading'     => __( 'Inner Container', 'kleo_framework' ),
			'description' => __( 'Select wheter to insert a container to the section. This will keep the content from going full with.', 'kleo_framework' ),
			'type'        => 'dropdown',
			'holder'      => 'div',
			'class' => 'hide',
			"value" => array(
				'Yes' => 'yes',
				'No' => 'no'
			)
	) );
	vc_add_param( 'vc_row', array(
			'param_name'  => 'text_align',
			'heading'     => __( 'Text aling', 'kleo_framework' ),
			'description' => __( 'Align whole row content.', 'kleo_framework' ),
			'type'        => 'dropdown',
			'holder'      => 'div',
			'class' => 'hide',
			"value" => array(
				'Left' => '',
				'Right' => 'right',
				'Center' => 'center'
			)
	) );


	vc_add_param("vc_row", array(
		"type" => "colorpicker",
		"class" => "",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Text color"),
		"param_name" => "text_color",
		"value" => "",
		"description" => __("")
	));

	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Section style"),
		"admin_label" => true,
		"param_name" => "section_type",
		"value" => array(
			"Main style" => "main",
			"Alternate style" => "alternate",
			"Header style" => "header",
			"Footer style" => "footer",
			"Socket style" => "socket"
		),
		"description" => __("These styles are set under Theme options.")
	));

	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',		
		"heading" => __("Background style"),
		"admin_label" => true,
		"param_name" => "type",
		"value" => array(
			"Default" => '',
			"Color" => "color",
			"Image" => "image",
			"Video" => "video"
		),
		"description" => ""
	));


	vc_add_param("vc_row", array(
		"type" => "colorpicker",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Background color"),
		"param_name" => "bg_color",
		"value" => "",
		"description" => __(""),
		"dependency" => array(
			"element" => "type",
			"value" => "color"
		)
	));
	vc_add_param("vc_row", array(
		"type" => "attach_image", //attach_images
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Background image"),
		"param_name" => "bg_image",
		"description" => "",
		"dependency" => array(
			"element" => "type",
			"value" => "image"
		)
	));
	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Background position"),
		"param_name" => "bg_position",
		"value" => array(
			"Top" => "top",
			"Middle" => "center",
			"Bottom" => "bottom"
		),
		"description" => __(""),
		"dependency" => array(
			"element" => "type",
			"value" => "image"
		)
	));
	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Background repeat"),
		"param_name" => "bg_repeat",
		"value" => array(
			"No repeat" => "no-repeat",
			"Repeat (horizontally & vertically)" => "repeat",
			"Repeat horizontally" => "repeat-x",
			"Repeat vertically" => "repeat-y"
		),
		"description" => __(""),
		"dependency" => array(
			"element" => "type",
			"value" => "image"
		)
	));
	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Full-width background"),
		"param_name" => "bg_cover",
		"value" => array(
			"Enabled" => "true",
			"Disabled" => "false"
		),
		"description" => "",
		"dependency" => array(
			"element" => "type",
			"value" => "image"
		)
	));
	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Fixed background"),
		"param_name" => "bg_attachment",
		"value" => array(
			"Disabled" => "false",
			"Enabled" => "true"
		),
		"description" => __(""),
		"dependency" => array(
			"element" => "type",
			"value" => "image"
		)
	));
	// parallax enable
	vc_add_param("vc_row", array(
		"type" => "checkbox",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Enable parallax"),
		"param_name" => "enable_parallax",
		"value" => array(
			"" => "false"
		),
		"dependency" => array(
			"element" => "type",
			"value" => "image"
		)
	));
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Parallax speed"),
		"param_name" => "parallax_speed",
		"value" => "0.1",
		"dependency" => array(
			"element" => "enable_parallax",
			"not_empty" => true
		)
	));
	// video background
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Video background (mp4)"),
		"param_name" => "bg_video_src_mp4",
		"value" => "",
		"dependency" => array(
			"element" => "type",
			"value" => "video"
		)
	));
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Video background (ogv)"),
		"param_name" => "bg_video_src_ogv",
		"value" => "",
		"dependency" => array(
			"element" => "type",
			"value" => "video"
		)
	));
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Video background (webm)"),
		"param_name" => "bg_video_src_webm",
		"value" => "",
		"dependency" => array(
			"element" => "type",
			"value" => "video"
		)
	));

	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Top padding"),
		"param_name" => "padding_top",
		"value" => "40",
		"description" => __("Allowed measures: px,em,%,pt,cm."),
	));
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Bottom padding"),
		"param_name" => "padding_bottom",
		"value" => "40",
		"description" => __("Allowed measures: px,em,%,pt,cm."),
	));
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Left padding"),
		"param_name" => "padding_left",
		"value" => "",
		"description" => __("Allowed measures: px,em,%,pt,cm."),
	));
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Right padding"),
		"param_name" => "padding_right",
		"value" => "",
		"description" => __("Allowed measures: px,em,%,pt,cm."),
	));


	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Top margin"),
		"param_name" => "margin_top",
		"value" => "",
		"description" => __("Allowed measures: px,em,%,pt,cm."),
	));
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Bottom margin"),
		"param_name" => "margin_bottom",
		"value" => "",
		"description" => __("Allowed measures: px,em,%,pt,cm."),
	));
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Minim height"),
		"param_name" => "min_height",
		"value" => "0",
		"description" => __("Allowed measures: px,em,%,pt,cm."),
	));

	vc_add_param( 'vc_row', array(
		'param_name'  => 'border',
		'heading'     => __( 'Border', 'kleo_framework' ),
		'description' => __( 'Select whether or not to display a border on this section.', 'kleo_framework' ),
		'type'        => 'dropdown',
		"holder" => 'div',
		'class' => 'hide',
		'value'       => array(
		'Bottom'     => 'bottom',
			'Top'        => 'top',
			'Left'       => 'left',
			'Right'      => 'right',
			'Horizontal' => 'horizontal',
			'Vertical'   => 'vertical',
			'All'        => 'all',
			'None'       => 'none'
		)
	) );
	
	// overflow hidden
	vc_add_param("vc_row", array(
		"type" => "checkbox",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Overflow hidden"),
		"param_name" => "overflow",
		'description' => __( 'Check if you want to hide section overflow', 'kleo_framework' ),
		"value" => array(
			"" => "false"
		)
	));

	vc_add_param("vc_row", $animation);
	vc_add_param("vc_row", $css_animation);

	vc_add_param("vc_row", array(
			'param_name'  => 'visibility',
			'heading'     => __( 'Responsive Visibility', 'kleo_framework' ),
			'description' => __( 'Hide/Show content by screen size.', 'kleo_framework' ),
			'type'        => 'checkbox',
			'holder'      => 'div',
			'value'       => array(
				'Hidden Phones (max 768px)'    => 'hidden-xs',
				'Hidden Tablets (768px - 991px)'   => 'hidden-sm',
				'Hidden Desktops (992px - 1199px)'  => 'hidden-md',
				'Hidden Large Desktops (min 1200px)'  => 'hidden-lg',
				'Visible Phones (max 767px)'   => 'visible-xs',
				'Visible Tablets (768px - 991px)'  => 'visible-sm',
				'Visible Desktops (992px - 1199px)' => 'visible-md',
				'Visible Large Desktops (min 1200px)' => 'visible-lg'
			)
		)
	);
				
	
	vc_add_param("vc_row", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Custom inline style"),
		"param_name" => "inline_style",
		"value" => ""
	));

	vc_add_param("vc_row", $el_class);


	/* Alert */
	vc_remove_param( 'vc_message', 'css_animation' );
	vc_add_param("vc_message", $animation);	
	vc_add_param("vc_message", $css_animation);


	/* Text column */
	vc_remove_param( 'vc_column_text', 'css_animation' );
	vc_map_update('vc_column_text', array('weight' => '5'));
	vc_add_param("vc_column_text", array(
		"type" => "dropdown",
		"class" => "hide",
		"holder" => 'div',	
		"heading" => __("Lead Content"),
		"admin_label" => true,
		"param_name" => "lead",
		"value" => array(
			"No" => "",
			"Yes" => "yes"
		),
		"description" => ""
	));

	vc_add_param("vc_column_text", $animation);	
	vc_add_param("vc_column_text", $css_animation);



	/* Toggle */
	vc_map_update('vc_toggle', array('name' => 'Toggle', 'description' => 'Add a Toggle element', 'weight' => 6));
	vc_remove_param( 'vc_toggle', 'css_animation' );
	vc_remove_param('vc_toggle','el_class');

	vc_add_param("vc_toggle", array(
		"type" => "dropdown",
		"holder" => "div",
		"class" => "hide",
		"heading" => __("Icon when toggle is opened"),
		"param_name" => "icon",
		"value" => kleo_icons_array(),
		"description" => ""
	));
	vc_add_param("vc_toggle", array(
		"type" => "dropdown",
		"holder" => "div",
		"class" => "hide",
		"heading" => __("Icon when toggle is closed"),
		"param_name" => "icon_closed",
		"value" => kleo_icons_array(),
		"description" => ""
	));
	vc_add_param("vc_toggle", array(
		"type" => "dropdown",
		"class" => "hide",
		"holder" => 'div',	
		"heading" => __("Icon position"),
		"admin_label" => true,
		"param_name" => "icon_position",
		"value" => array(
			"Left" => "to-left",
			"Right" => "to-right"
		),
		"description" => ""
	));
	
	vc_add_param("vc_toggle", $tooltip);
	vc_add_param("vc_toggle", $tooltip_position);
	vc_add_param("vc_toggle", $tooltip_title);
	vc_add_param("vc_toggle", $tooltip_text);
	vc_add_param("vc_toggle", $tooltip_action);
	  

	vc_add_param("vc_toggle", $animation);	
	vc_add_param("vc_toggle", $css_animation);
	vc_add_param("vc_toggle", $el_class); //add the class field


	/* Single Image */

	vc_remove_param( 'vc_single_image', 'css_animation' );
	vc_remove_param('vc_single_image','el_class');
	vc_add_param("vc_single_image", $animation);	
	vc_add_param("vc_single_image", $css_animation);
	vc_add_param("vc_single_image", $el_class); //add the class field


	/* Gallery */
	vc_map_update('vc_gallery',array('description' => ''));
	vc_remove_param( 'vc_gallery', 'interval' );
	vc_remove_param( 'vc_gallery', 'el_class' );
	vc_add_param('vc_gallery', array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Type"),
		"param_name" => "type",
		"value" => array(
			'Big image + thumbs' => 'thumbs',
			'Grid' => 'grid'
		)
	));
	vc_add_param('vc_gallery', array(
		"type" => "dropdown",
		"holder" => 'div',
		'class' => 'hide',	
		"heading" => __("Gap"),
		"param_name" => "gap",
		"value" => array(
			'None' => '',
			'Small' => 'small',
			'Large' => 'large'
		),
		"dependency" => array(
			"element" => "type",
			"value" => "grid"
		)
	));
	vc_add_param( 'vc_gallery', $el_class );


	/* Block Grid */
	vc_map(
		array(
			'base'            => 'kleo_grid',
			'name'            => __( 'Feature Items Grid', 'kleo_framework' ),
			'weight'          => 6,
			'class'           => '',
			'icon'            => 'block-grid',
			'category'        => "Content",
			'description'     => __( 'Easily include elements into a Grid container', 'kleo_framework' ),
			'as_parent'       => array( 'only' => 'kleo_feature_item' ),
			'content_element' => true,
			'js_view'         => 'VcColumnView',
			'params'          => array(
				array(
					'param_name'  => 'type',
					'heading'     => __( 'Type', 'kleo_framework' ),
					'description' => __( 'Select how many items you want per row.', 'kleo_framework' ),
					'type'        => 'dropdown',
					'holder'      => "div",
					'class' => 'hide',
					'value'       => array(
						'Two'   => '2',
						'Three' => '3',
						'Four'  => '4'
					)
				),
				array(
					'param_name'  => 'animation',
					'heading'     => __( 'Animation', 'kleo_framework' ),
					'description' => __( 'Animate elements inside the grid one by one', 'kleo_framework' ),
					'type'        => 'dropdown',
					'holder'      => "div",
					'class' => 'hide',
					'value'       => array(
						'No'   => '',
						'Yes' => 'yes',
					)
				),

				$el_class,

			)
		)
	);

	/* Feature item */

	vc_map(
		array(
			'base'            => 'kleo_feature_item',
			'name'            => __( 'Feature Item', 'kleo_framework' ),
			'weight'          => 880,
			'class'           => '',
			'icon'            => '',
			'category'        => "Content",
			'description'     => __( 'Include a feature item in your block grid', 'kleo_framework' ),
			'as_child'        => array( 'only' => 'kleo_grid' ),
			'content_element' => true,
			'params'          => array(
					
				array(
					'param_name'  => 'title',
					'heading'     => 'Title',
					'description' => "Enter your title here",
					'type'        => 'textfield',
					'holder'      => "div",
					'value'       => ""
				),
				array(
					'param_name'  => 'content',
					'heading'     => 'Text',
					'description' => "Enter your text here",
					'type'        => 'textarea_html',
					'holder'      => "div",
					'value'       => ""
				),
				$icon, //Icons select
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "hide",
					"heading" => __("Icon size"),
					"param_name" => "icon_size",
					"value" => array(
							'Default' => 'default',
							'Big' => 'big'
						),
					"description" => ""
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "hide",
					"heading" => __("Icon position"),
					"param_name" => "icon_position",
					"value" => array(
							'Left' => '',
							'Center' => 'center'
						),
					"description" => ""
				)
			)
		)
	);

	
	
	/* List */
	vc_map(
		array(
			'base'            => 'kleo_list',
			'name'            => __( 'Fancy List', 'kleo_framework' ),
			'weight'          => 6,
			'class'           => '',
			'icon'            => 'block-list',
			'category'        => "Content",
			'description'     => '',
			'as_parent'       => array( 'only' => 'kleo_list_item' ),
			'content_element' => true,
			'js_view'         => 'VcColumnView',
			'params'          => array(
				array(
					'param_name'  => 'type',
					'heading'     => __( 'Type', 'kleo_framework' ),
					'description' => __( 'Select the list type.', 'kleo_framework' ),
					'type'        => 'dropdown',
					'holder'      => "div",
					'class' => 'hide',
					'value'       => array(
						'Standard'   => 'standard',
						'With Icons' => 'icons',
						'Ordered'  => 'ordered',
							'Ordered Roman' => 'ordered-roman',
							'Unstyled' => 'unstyled'
					)
				),
				array(
					'param_name'  => 'icon_color',
					'heading'     => __( 'Icon color', 'kleo_framework' ),
					'description' => "",
					'type'        => 'dropdown',
					'holder'      => "div",
					'class' => 'hide',
					'value'       => array(
						'Normal'   => '',
						'Colored' => 'yes'
					),
					"dependency" => array(
						"element" => "type",
						"value" => array("icons","ordered","ordered-roman")
					)
				),
				array(
					'param_name'  => 'icon_shadow',
					'heading'     => __( 'Icon shadow', 'kleo_framework' ),
					'description' => "",
					'type'        => 'dropdown',
					'holder'      => "div",
					'class' => 'hide',
					'value'       => array(
						'Normal'   => '',
						'Shadow' => 'yes'
					),
					"dependency" => array(
						"element" => "type",
						"value" => "icons"
					)
				),
				array(
					'param_name'  => 'icon_large',
					'heading'     => __( 'Large icon', 'kleo_framework' ),
					'description' => "",
					'type'        => 'dropdown',
					'holder'      => "div",
					'class' => 'hide',
					'value'       => array(
						'Normal'   => '',
						'Large' => 'yes'
					),
					"dependency" => array(
						"element" => "type",
						"value" => "icons"
					)
				),
				array(
					'param_name'  => 'inline',
					'heading'     => __( 'Inline', 'kleo_framework' ),
					'description' => "",
					'type'        => 'dropdown',
					'holder'      => "div",
					'class' => 'hide',
					'value'       => array(
						'No'   => '',
						'Yes' => 'yes'
					),
					"dependency" => array(
						"element" => "type",
						"value" => "icons"
					)
				),
					
				array(
					'param_name'  => 'divider',
					'heading'     => __( 'Divider', 'kleo_framework' ),
					'description' => "",
					'type'        => 'dropdown',
					'holder'      => "div",
					'class' => 'hide',
					'value'       => array(
						'No'   => '',
						'Yes' => 'yes'
					),
				),
				array(
					'param_name'  => 'align',
					'heading'     => __( 'Align', 'kleo_framework' ),
					'description' => __( 'Align the list', 'kleo_framework' ),
					'type'        => 'dropdown',
					'holder'      => "div",
					'class' => 'hide',
					'value'       => array(
						'None' => '',
						'Left'   => 'left',
						'Right' => 'right',
						'Center'  => 'center'
					)
				),
					

				$el_class,

			)
		)
	);

	/* List item */

	vc_map(
		array(
			'base'            => 'kleo_list_item',
			'name'            => __( 'List Item', 'kleo_framework' ),
			'weight'          => 880,
			'class'           => '',
			'icon'            => '',
			'category'        => "Content",
			'description'     => '',
			'as_child'        => array( 'only' => 'kleo_list' ),
			'content_element' => true,
			'params'          => array(
					$icon,
				array(
					'param_name'  => 'content',
					'heading'     => 'Text',
					'description' => "Enter your text here",
					'type'        => 'textarea_html',
					'holder'      => "div",
					'value'       => ""
				),
			)
		)
	);

	
	
	

	/* TABS */
	vc_remove_param( 'vc_tabs', 'interval' );
	vc_remove_param( 'vc_tabs', 'title' );
	vc_remove_param( 'vc_tabs', 'el_class' );
	vc_map_update("vc_tabs",array('weight' => 6));
	vc_add_param('vc_tabs',array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "hide",
			"heading" => __("Type"),
			"param_name" => "type",
			"value" => array(
					'Tabs' => 'tabs',
					'Pills' => 'pills'
				),
			"description" => "Choose how you want them to appear"
		));
	vc_add_param('vc_tabs',array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "hide",
			"heading" => __("Style"),
			"param_name" => "style",
			"value" => array(
					'Default' => 'default',
					'Square' => 'square',
					'Line' => 'line'
				),
			"dependency" => array(
				"element" => "type",
				"value" => "tabs"
			),
			"description" => ""
		));
		vc_add_param('vc_tabs',array(
				'param_name'  => 'active_tab',
				'heading'     => 'Active tab',
				'description' => "Enter tab number to be active on load(Example: 1)",
				'type'        => 'textfield',
				'holder'      => "div",
				'class'      => "hide",
				'value'       => ""
		));

	vc_add_param('vc_tabs',array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "hide",
			"heading" => __("Align"),
			"param_name" => "align",
			"value" => array(
					'Left' => '',
					'Centered' => 'centered',
				),
			"description" => ""
		));
		vc_add_param('vc_tabs',array(
				'param_name'  => 'margin_top',
				'heading'     => 'Top Margin',
				'description' => "Enter the value in pixels. Eq. 50. Field accepts negative values.",
				'type'        => 'textfield',
				'holder'      => "div",
				'class'      => "hide",
				'value'       => ""
		));
	
	vc_add_param('vc_tabs', $el_class);
	
	vc_map_update("vc_tab", array("allowed_container_element" => true));
	
	vc_add_param('vc_tab', $icon);

	
	/* Accordion */
	vc_remove_param( 'vc_accordion', 'interval' );
	vc_remove_param( 'vc_accordion', 'title' );
	vc_remove_param( 'vc_accordion', 'el_class' );
	vc_map_update("vc_accordion", array('weight' => 6, 'description' => ''));
	
	vc_add_param("vc_accordion", array(
		"type" => "dropdown",
		"class" => "hide",
		"holder" => 'div',	
		"heading" => __("Icons position"),
		"admin_label" => true,
		"param_name" => "icons_position",
		"value" => array(
			"Left" => "to-left",
			"Right" => "to-right"
		),
		"description" => ""
	));
	vc_add_param('vc_accordion', $el_class);
	
	vc_map_update("vc_accordion_tab", array("allowed_container_element" => true));
	vc_add_param("vc_accordion_tab", array(
		"type" => "dropdown",
		"holder" => "div",
		"class" => "hide",
		"heading" => __("Icon when accordion item is opened"),
		"param_name" => "icon",
		"value" => kleo_icons_array(),
		"description" => ""
	));
	vc_add_param("vc_accordion_tab", array(
		"type" => "dropdown",
		"holder" => "div",
		"class" => "hide",
		"heading" => __("Icon when accordion item is closed"),
		"param_name" => "icon_closed",
		"value" => kleo_icons_array(),
		"description" => ""
	));
	
	vc_add_param("vc_accordion_tab", $tooltip);
	vc_add_param("vc_accordion_tab", $tooltip_position);
	vc_add_param("vc_accordion_tab", $tooltip_title);
	vc_add_param("vc_accordion_tab", $tooltip_text);
	vc_add_param("vc_accordion_tab", $tooltip_action);

	
	/* Icon */
	vc_map(
		array(
			'base'        => 'kleo_icon',
			'name'        => 'Icon',
			'weight'      => 5,
			'class'       => '',
			'icon'        => 'icon-wpb-ui-icon',
			'category'    => __("Content",'js_composer'),
			'description' => __('Insert an icon into your content','kleo_framework'),
			'params'      => array(
					$icon, 
					$icon_size,
					$tooltip,
					$tooltip_position,
					$tooltip_title,
					$tooltip_text,
					$tooltip_action,
					$el_class
			)
					
	));
	
	/* Clients */
	vc_map(
		array(
			'base'        => 'kleo_clients',
			'name'        => 'Clients',
			'weight'      => 5,
			'class'       => '',
			'icon' => 'kleo_clients',
			'category'    => __("Content",'js_composer'),
			'description' => __('Showcase clients logos','kleo_framework'),
			'params'      => array(
				array(
					'param_name'  => 'animated',
					'heading'     => __( 'Animated', 'kleo_framework' ),
					'description' => __( 'Animate the icons when you first view them', 'kleo_framework' ),
					'type'        => 'dropdown',
					'class' => 'hide',
					'holder'      => 'div',
					'value'       => array(
						'Yes'    => 'yes',
						'No'   => ''
					)	
				),
				array(
					'param_name'  => 'animation',
					'heading'     => __( 'Animation', 'kleo_framework' ),
					'description' => "",
					'type'        => 'dropdown',
					'class' => 'hide',
					'holder'      => 'div',
					'value'       => array(
						'Fade'    => 'fade',
						'Appear'   => 'appear'
					),
					"dependency" => array(
						"element" => "animated",
						"value" => "yes"
					),
				),
				array(
					'param_name'  => 'number',
					'heading'     => 'Number of logos',
					'description' => "How many images to show",
					'type'        => 'textfield',
					'class' => 'hide',
					'holder'      => "div",
					'value'       => "5"
				),
					
					$el_class
			)
					
	));
	
	
	/* Testimonials */
	vc_map(
		array(
			'base'        => 'kleo_testimonials',
			'name'        => 'Testimonials',
			'weight'      => 5,
			'class'       => '',
			'icon' => 'kleo_testimonials',
			'category'    => __("Content",'js_composer'),
			'description' => __('Showcase client testimonials','kleo_framework'),
			'params'      => array(

				array(
					'param_name'  => 'type',
					'heading'     => __( 'Type', 'kleo_framework' ),
					'description' => "",
					'type'        => 'dropdown',
					'class' => 'hide',
					'holder'      => 'div',
					'value'       => array(
						'Simple'    => 'simple',
						'Carousel'   => 'carousel'
					)
				),
				array(
					'param_name'  => 'number',
					'heading'     => 'Number of testimonials',
					'description' => "How many testimonials to show. Default is 3",
					'type'        => 'textfield',
					'class' => 'hide',
					'holder'      => "div",
					'value'       => ""
				),
				array(
					'param_name'  => 'offset',
					'heading'     => 'Testimonials offset',
					'description' => "Display testimonials starting from the number you enter. Eq: if you enter 3, it will show testimonials from the 4th one ",
					'type'        => 'textfield',
					'class' => 'hide',
					'holder'      => "div",
					'value'       => ""
				),
				array(
					"type" => "textfield",
					"holder" => 'div',
					'class' => 'hide',
					"heading" => __("Minimum items to show"),
					"param_name" => "min_items",
					"value" => "",
					"description" => "Default 1",
					"dependency" => array(
						"element" => "type",
						"value" => "carousel"
					),
				),
				array(
					"type" => "textfield",
					"holder" => 'div',
					'class' => 'hide',
					"heading" => __("Maximum items to show"),
					"param_name" => "max_items",
					"value" => "",
					"description" => "Default 1",
					"dependency" => array(
						"element" => "type",
						"value" => "carousel"
					),
				),
				array(
					"type" => "textfield",
					"holder" => 'div',
					'class' => 'hide',
					"heading" => __("Speed between slides"),
					"param_name" => "speed",
					"value" => "",
					"description" => "In miliseconds. Default is 5000 miliseconds, meaning 5 seconds",
					"dependency" => array(
						"element" => "type",
						"value" => "carousel"
					),
				),
				$el_class
			)
					
	));
	
	
	/* PIN */
	vc_map(
		array(
			'base'        => 'kleo_pin',
			'name'        => 'Pin',
			'weight'      => 5,
			'class'       => '',
			'icon'        => 'icon-wpb-ui-icon',
			'category'    => __("Content",'js_composer'),
			'description' => __('Add pins with info','kleo_framework'),
			'params'      => array(
				array(
					'param_name'  => 'type',
					'heading'     => __( 'Type', 'kleo_framework' ),
					'description' => __( 'Type of pin', 'kleo_framework' ),
					'type'        => 'dropdown',
					'holder'      => 'div',
					'value'       => array(
						'Icon'    => 'icon',
						'Circle'   => 'circle',
						'POI' => 'poi'
					)
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "hide",
					"heading" => __("Icon"),
					"param_name" => "icon",
					"value" => kleo_icons_array(),
					"description" => __("Choose the icon to display"),
					"dependency" => array(
						"element" => "type",
						"value" => "icon"
					),
				),
				array(
					'param_name'  => 'top',
					'heading'     => 'Top position',
					'description' => "Please enter only pixels and percentage, eq. 50px or 15%",
					'type'        => 'textfield',
					'holder'      => "div",
					'value'       => ""
				),
				array(
					'param_name'  => 'left',
					'heading'     => 'Left position',
					'description' => "Please enter only pixels and percentage, eq. 50px or 15%",
					'type'        => 'textfield',
					'holder'      => "div",
					'value'       => ""
				),
				array(
					'param_name'  => 'right',
					'heading'     => 'Right position',
					'description' => "Please enter only pixels and percentage, eq. 50px or 15%",
					'type'        => 'textfield',
					'holder'      => "div",
					'value'       => ""
				),
				array(
					'param_name'  => 'bottom',
					'heading'     => 'Bottom position',
					'description' => "Please enter only pixels and percentage, eq. 50px or 15%",
					'type'        => 'textfield',
					'holder'      => "div",
					'value'       => ""
				),
				$tooltip,
				$tooltip_position,
				$tooltip_title,
				$tooltip_text,
				$tooltip_action,
				$animation,
				$css_animation,
				$el_class
			)
					
	));


	/* Button */
	vc_map(
		array(
			'base'        => 'kleo_button',
			'name'        => 'Button',
			'weight'      => 970,
			'class'       => '',
			'icon'        => 'icon-wpb-ui-button',
			'category'    => __("Content",'js_composer'),
			'description' => __('Insert a button in your content','kleo_framework'),
			'params'      => $button_args
		)
	);
	vc_add_param('kleo_button', $el_class);
	
	
	/* Animated numbers */
	vc_map(
		array(
			'base'        => 'kleo_animate_numbers',
			'name'        => 'Animated numbers',
			'weight'      => 970,
			'content_element' => true,
			'class'       => '',
			'icon'            => 'animated-numbers',
			'category'    => __("Content",'js_composer'),
			'description' => __('Insert an animated number','kleo_framework'),
			'params'      => array(
					$animation,
				array(
					'param_name'  => 'content',
					'heading'     => 'Number',
					'description' => "Enter the number to animate",
					'type'        => 'textfield',
					'holder'      => "div",
					'value'       => ""
				),
				array(
					'param_name'  => 'timer',
					'heading'     => 'Timer',
					'description' => "The time in miliseconds to complete the animation, eq 3000 for 3 seconds of animation",
					'type'        => 'textfield',
					'holder'      => "div",
					'class'      => "hide",
					'value'       => ""
				),
					$el_class
			)
		)
	);
	vc_add_param('kleo_button', $el_class);
	
	
	/* Responsive visibility */


	vc_map(
		array(
			'base'            => 'kleo_visibility',
			'name'            => __( 'Visibility', 'kleo_framework' ),
			'weight'          => 6,
			'class'           => '',
			'icon'            => 'visibility',
			'category'        => "Content",
			'description'     => __( 'Alter content based on screen size', 'kleo_framework' ),
			'as_parent'       => array( 'only' => 'kleo_button,vc_toggle,vc_accordion,kleo_grid,kleo_gap,kleo_divider,vc_column_text,kleo_icon,vc_message,vc_tweetmeme,vc_pinterest,vc_single_image,vc_gallery,vc_posts_grid,vc_carousel,vc_widget_sidebar,vc_video,vc_gmaps,vc_raw_html,vc_flickr,rev_slider_vc,kleo_bp_members_carousel,kleo_bp_members_masonry,kleo_bp_members_grid,kleo_bp_groups_carousel,kleo_bp_groups_masonry,kleo_bp_groups_grid,kleo_bp_activity_stream,vc_wp_categories,vc_wp_archives,kleo_pin,kleo_list,kleo_clients,kleo_testimonials,vc_images_carousel' ),
			'content_element' => true,
			'js_view'         => 'VcColumnView',
			'params'          => array(
				array(
					'param_name'  => 'type',
					'heading'     => __( 'Visibility Type', 'kleo_framework' ),
					'description' => __( 'Hide/Show content by screen size.', 'kleo_framework' ),
					'type'        => 'checkbox',
					'holder'      => 'div',
					'value'       => array(
						'Hidden Phones (max 768px)'    => 'hidden-xs',
						'Hidden Tablets (768px - 991px)'   => 'hidden-sm',
						'Hidden Desktops (992px - 1199px)'  => 'hidden-md',
						'Hidden Large Desktops (min 1200px)'  => 'hidden-lg',
						'Visible Phones (max 767px)'   => 'visible-xs',
						'Visible Tablets (768px - 991px)'  => 'visible-sm',
						'Visible Desktops (992px - 1199px)' => 'visible-md',
						'Visible Large Desktops (min 1200px)' => 'visible-lg'
					)
				),
				$el_class
			)
		)
	);

	
	
	/* GAP */

	vc_map(
		array(
			'base'        => 'kleo_gap',
			'name'        => 'Gap',
			'weight'      => 6,
			'class'       => 'kleo-icon',
			'icon'        => 'gap',
			'category'    => __("Content",'js_composer'),
			'description' => __('Insert a vertical gap in your content','kleo_framework'),
			'params'      => array(
				array(
					'param_name'  => 'size',
					'heading'     => __( 'Size', 'kleo_framework' ),
					'description' => __( 'Enter in the size of your gap. Pixels, ems, and percentages are all valid units of measurement.', 'kleo_framework' ),
					'type'        => 'textfield',
					'holder'      => "div",
					'value'       => '10px'
				),
					array(
						"param_name" => "class",
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Class"),
						"value" => '',
						"description" => __("A class to add to the element for CSS referrences.")
					),
				array(
					'param_name'  => "id",
					'heading'     => "Id",
					'description' => __( 'Unique id to add to the element for CSS referrences', 'kleo_framework' ),
					'type'        => "textfield",
					'holder'      => "div"
				),
				array(
						"param_name" => "style",
						"type" => "textfield",
						"class" => "",
						"holder" => 'div',	
						"heading" => __("Custom inline style"),
						"value" => ""
					),
			)
		)
	);



	/* Divider */

	vc_map(
		array(
			'base'        => 'kleo_divider',
			'name'        => 'Divider with icon',
			'weight'      => 6,
			'class'       => 'kleo-icon',
			'icon'        => 'icon-wpb-ui-separator-label',
			'category'    => __("Content",'js_composer'),
			'description' => __('Insert a vertical divider in your content','kleo_framework'),
			'params'      => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Type"),
						"param_name" => "type",
						"value" => array(
								'Full' => 'full',
								'Long' => 'long',
								'Short' => 'short',
								'Double' => 'double'
							),
						"description" => __("The type of the divider.")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Double border"),
						"param_name" => "double",
						"value" => array(
								'No' => '',
								'Yes' => 'Yes'
							),
						"description" => __("Have the divider double lined.")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "hide",
						"heading" => __("Position"),
						"param_name" => "position",
						"value" => array(
								'Center' => 'center',
								'Left' => 'left',
								'Right' => 'right'
							),
						"description" => ""
					),
					$icon, //Icons select
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "hide",
						"heading" => __("Icon size"),
						"param_name" => "icon_size",
						"value" => array(
								'Normal' => '',
								'Large' => 'large'
							),
						"description" => ""
					),
					array(
						"param_name" => "text",
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Text"),
						"value" => '',
						"description" => __("This text wil show inside the divider")
					),

				array(
					'param_name'  => "id",
					'heading'     => "Id",
					'description' => __( 'Unique id to add to the element for CSS referrences', 'kleo_framework' ),
					'type'        => "textfield",
					'holder'      => "div"
				),
					array(
						"param_name" => "class",
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Class"),
						"value" => '',
						"description" => __("A class to add to the element for CSS referrences.")
					),
				array(
						"param_name" => "style",
						"type" => "textfield",
						"class" => "",
						"holder" => 'div',	
						"heading" => __("Custom inline style"),
						"value" => ""
					),
			)
		)
	);

	
	/* Posts grid */
	
	vc_remove_param('vc_posts_grid','title');
	vc_remove_param('vc_posts_grid','grid_columns_count');
	vc_remove_param('vc_posts_grid','grid_layout');
	vc_remove_param('vc_posts_grid','grid_link_target');
	vc_remove_param('vc_posts_grid','filter');
	vc_remove_param('vc_posts_grid','grid_layout_mode');
	vc_remove_param('vc_posts_grid','grid_thumb_size');
	
	
	/* Posts carousel */
	vc_remove_param('vc_carousel','title');
	vc_remove_param('vc_carousel','layout');
	vc_remove_param('vc_carousel','link_target');
	vc_remove_param('vc_carousel','thumb_size');
	vc_remove_param('vc_carousel','speed');
	vc_remove_param('vc_carousel','mode');
	vc_remove_param('vc_carousel','slides_per_view');
	vc_remove_param('vc_carousel','partial_view');
	vc_remove_param('vc_carousel','wrap');
	vc_remove_param('vc_carousel','el_class');
	vc_remove_param('vc_carousel','hide_pagination_control');
	vc_remove_param('vc_carousel','hide_prev_next_buttons');
	
	vc_add_param("vc_carousel", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Minimum items to show"),
		"param_name" => "min_items",
		"value" => "",
		"description" => "",
	));
	vc_add_param("vc_carousel", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Maximum items to show"),
		"param_name" => "max_items",
		"value" => "",
		"description" => "",
	));
	vc_add_param('vc_carousel', $el_class);
	
	
	/* Image carousel */
	vc_remove_param('vc_images_carousel','title');
	vc_remove_param('vc_images_carousel','mode');
	vc_remove_param('vc_images_carousel','slides_per_view');
	vc_remove_param('vc_images_carousel','partial_view');
	vc_remove_param('vc_images_carousel','wrap');
	vc_remove_param('vc_images_carousel','el_class');
	//vc_remove_param('vc_images_carousel','hide_prev_next_buttons');
	
	vc_add_param("vc_images_carousel",array(
		"type" => "dropdown",
		"holder" => "div",
		"class" => "hide",
		"heading" => __("Scroll effect"),
		"param_name" => "scroll_fx",
		"value" => array(
				'Scroll' => 'scroll',
				'CrossFade' => 'crossfade'
			),
		"description" => ""
	));
	
	
	vc_add_param("vc_images_carousel", $animation);
	vc_add_param("vc_images_carousel", 				array(
					'param_name'  => 'css_animation',
					'heading'     => __( 'Animation type', 'kleo_framework' ),
					'description' => "",
					'type'        => 'dropdown',
					'class' => 'hide',
					'holder'      => 'div',
					'value'       => array(
						'Fade'    => 'fade',
						'Appear'   => 'appear'
					),
					"dependency" => array(
						"element" => "animation",
						"not_empty" => true
					),
		));
	
	vc_add_param("vc_images_carousel", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Minimum items to show"),
		"param_name" => "min_items",
		"value" => "",
		"description" => "",
	));
	vc_add_param("vc_images_carousel", array(
		"type" => "textfield",
		"holder" => 'div',
		'class' => 'hide',
		"heading" => __("Maximum items to show"),
		"param_name" => "max_items",
		"value" => "",
		"description" => "",
	));
	
	
	vc_add_param('vc_images_carousel', $el_class);
	
	
	
	// Buddypress Members Carousel

	vc_map( 
		array(
			"name" => __("Members Carousel"),
			"base" => "kleo_bp_members_carousel",
			"class" => "",
			"category" => __('BuddyPress'),
			"icon" => "kleo-bp-icon",
			"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Type"),
						"param_name" => "type",
						"value" => array(
								'Active' => 'active',
								'Newest' => 'newest',
								'Popular' => 'popular',
								'Online' => 'online',
								'Alphabetical' => 'alphabetical',
								'Random' => 'random'
							),
						"description" => __("The type of members to display.")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Number of members"),
						"param_name" => "number",
						"value" => 12,
						"description" => __("How many members to get.")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Minimum Items"),
						"param_name" => "min_items",
						"value" => 1,
						"description" => __("Minimum number of items to show on the screen")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Maximum Items"),
						"param_name" => "max_items",
						"value" => 6,
						"description" => __("Maximum number of items to show on the screen")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Image Type"),
						"param_name" => "image_size",
						"value" => array(
							'Full' => 'full',
							'Thumbnail' => 'thumb'
							),
						"description" => __("The size to get from buddypress")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Avatar type"),
						"param_name" => "rounded",
						"value" => array(
							'Rounded' => 'rounded',
							'Square' => 'square'
							),
						"description" => __("Rounded or square avatar")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Image Width"),
						"param_name" => "item_width",
						"value" => 150,
						"description" => __("The size of the member image")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Online status"),
						"param_name" => "online",
						"value" => array(
							'Show' => 'show',
							'Hide' => 'noshow'
							),
						"description" => __("Show online status")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Class"),
						"param_name" => "class",
						"value" => '',
						"description" => __("A class to add to the element for CSS referrences.")
					),

				)
		)
	);



	// Buddypress Members Carousel

	vc_map( 
		array(
			"name" => __("Members Masonry"),
			"base" => "kleo_bp_members_masonry",
			"class" => "",
			"category" => __('BuddyPress'),
			"icon" => "kleo-bp-icon",
			"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Type"),
						"param_name" => "type",
						"value" => array(
								'Active' => 'active',
								'Newest' => 'newest',
								'Popular' => 'popular',
								'Online' => 'online',
								'Alphabetical' => 'alphabetical',
								'Random' => 'random'
							),
						"description" => __("The type of members to display.")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Number of members"),
						"param_name" => "number",
						"value" => 12,
						"description" => __("How many members to get.")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Avatar type"),
						"param_name" => "rounded",
						"value" => array(
							'Rounded' => 'rounded',
							'Square' => 'square'
							),
						"description" => __("Rounded or square avatar")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Online status"),
						"param_name" => "online",
						"value" => array(
							'Show' => 'show',
							'Hide' => 'noshow'
							),
						"description" => __("Show online status")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Class"),
						"param_name" => "class",
						"value" => '',
						"description" => __("A class to add to the element for CSS referrences.")
					),

				)
		)
	);



	/* Members grid */

	vc_map( 
		array(
			"name" => __("Members Grid"),
			"base" => "kleo_bp_members_grid",
			"class" => "",
			"category" => __('BuddyPress'),
			"icon" => "bp-icon",
			"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Type"),
						"param_name" => "type",
						"value" => array(
								'Active' => 'active',
								'Newest' => 'newest',
								'Popular' => 'popular',
								'Online' => 'online',
								'Alphabetical' => 'alphabetical',
								'Random' => 'random'
							),
						"description" => __("The type of members to display.")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Maximum members"),
						"param_name" => "number",
						"value" => 12,
						"description" => __("How many members you want to display.")
					),
						array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Members per line"),
						"param_name" => "perline",
						"value" => array(
								'1' => 'one',
								'2' => 'two',
								'3' => 'three',
								'4' => 'four',
								'5' => 'five',
								'6' => 'six',
								'7' => 'seven',
								'8' => 'eight',
								'9' => 'nine',
								'10' => 'ten',
								'11' => 'eleven',
								'12' => 'twelve'
							),
						"description" => __("How many members to show per line")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Avatar type"),
						"param_name" => "rounded",
						"value" => array(
							'Square' => 'square',
							'Rounded' => 'rounded'
							),
						"description" => __("Rounded or square avatar")
					),
						array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Animation"),
						"param_name" => "animation",
						"value" => array(
								'None' => '',
								'Fade' => 'fade',
								'Appear' => 'appear'
							),
						"description" => __("Elements will appear animated")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Class"),
						"param_name" => "class",
						"value" => '',
						"description" => __("A class to add to the element for CSS referrences.")
					),				
				)
		)
	);


	// Buddypress Groups Carousel

	vc_map( 
		array(
			"name" => __("Groups Carousel"),
			"base" => "kleo_bp_groups_carousel",
			"class" => "",
			"category" => __('BuddyPress'),
			"icon" => "bp-icon",
			"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Type"),
						"param_name" => "type",
						"value" => array(
								'Active' => 'active',
								'Newest' => 'newest',
								'Popular' => 'popular',
								'Alphabetical' => 'alphabetical',
								'Most Forum Topics' => 'most-forum-topics',
								'Most Forum Posts' => 'most-forum-posts',
								'Random' => 'random'
							),
						"description" => __("The type of groups to display.")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Number of groups"),
						"param_name" => "number",
						"value" => 12,
						"description" => __("How many groups to get.")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Minimum Items"),
						"param_name" => "min_items",
						"value" => 1,
						"description" => __("Minimum number of items to show on the screen")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Maximum Items"),
						"param_name" => "max_items",
						"value" => 6,
						"description" => __("Maximum number of items to show on the screen")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Image Type"),
						"param_name" => "image_size",
						"value" => array(
							'Full' => 'full',
							'Thumbnail' => 'thumb'
							),
						"description" => __("The size to get from buddypress")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Avatar type"),
						"param_name" => "rounded",
						"value" => array(
							'Rounded' => 'rounded',
							'Square' => 'square'
							),
						"description" => __("Rounded or square avatar")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Image Width"),
						"param_name" => "item_width",
						"value" => 150,
						"description" => __("The size of the group image")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Class"),
						"param_name" => "class",
						"value" => '',
						"description" => __("A class to add to the element for CSS referrences.")
					),

				)
		)
	);


	// Buddypress Groups Masonry

	vc_map( 
		array(
			"name" => __("Groups Masonry"),
			"base" => "kleo_bp_groups_masonry",
			"class" => "",
			"category" => __('BuddyPress'),
			"icon" => "bp-icon",
			"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Type"),
						"param_name" => "type",
						"value" => array(
								'Active' => 'active',
								'Newest' => 'newest',
								'Popular' => 'popular',
								'Alphabetical' => 'alphabetical',
								'Most Forum Topics' => 'most-forum-topics',
								'Most Forum Posts' => 'most-forum-posts',
								'Random' => 'random'
							),
						"description" => __("The type of groups to display.")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Number of groups"),
						"param_name" => "number",
						"value" => 12,
						"description" => __("How many groups to get.")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Avatar type"),
						"param_name" => "rounded",
						"value" => array(
							'Rounded' => 'rounded',
							'Square' => 'square'
							),
						"description" => __("Rounded or square avatar")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Class"),
						"param_name" => "class",
						"value" => '',			
						"description" => __("A class to add to the element for CSS referrences.")
					),

				)
		)
	);




	/* Groups grid */

	vc_map( 
		array(
			"name" => __("Groups Grid"),
			"base" => "kleo_bp_groups_grid",
			"class" => "",
			"category" => __('BuddyPress'),
			"icon" => "bp-icon",
			"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Type"),
						"param_name" => "type",
						"value" => array(
								'Active' => 'active',
								'Newest' => 'newest',
								'Popular' => 'popular',
								'Alphabetical' => 'alphabetical',
								'Most Forum Topics' => 'most-forum-topics',
								'Most Forum Posts' => 'most-forum-posts',
								'Random' => 'random'
							),
						"description" => __("The type of groups to display.")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Maximum members"),
						"param_name" => "number",
						"value" => 12,
						"description" => __("How many groups you want to display.")
					),
						array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Groups per line"),
						"param_name" => "perline",
						"value" => array(
								'1' => 'one',
								'2' => 'two',
								'3' => 'three',
								'4' => 'four',
								'5' => 'five',
								'6' => 'six',
								'7' => 'seven',
								'8' => 'eight',
								'9' => 'nine',
								'10' => 'ten',
								'11' => 'eleven',
								'12' => 'twelve'
							),
						"description" => __("How many groups to show per line")
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Avatar type"),
						"param_name" => "rounded",
						"value" => array(
							'Square' => 'square',
							'Rounded' => 'rounded'
							),
						"description" => __("Rounded or square avatar")
					),
						array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Animatione"),
						"param_name" => "animation",
						"value" => array(
								'None' => '',
								'Fade' => 'fade',
								'Appear' => 'appear'
							),
						"description" => __("Elements will appear animated")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Class"),
						"param_name" => "class",
						"value" => '',
						"description" => __("A class to add to the element for CSS referrences.")
					),				
				)
		)
	);

	//Activity Stream
	vc_map( 
		array(
			"name" => __("Members Activity Stream"),
			"base" => "kleo_bp_activity_stream",
			"class" => "",
			"category" => __('BuddyPress'),
			"icon" => "kleo-bp-icon",
			"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Display"),
						"param_name" => "show",
						"value" => array(
							'All' => false,
							'Blogs' => 'blogs',
							'Groups' => 'groups',
							'Friends' => 'friends',
							'Profile' => 'profile',
							'Status' => 'status'
						),
						"description" => __("The type of activity to show")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Number"),
						"param_name" => "number",
						"value" => '6',
						"description" => __("How many activity streams to show")
					),
						array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __("Bottom button"),
						"param_name" => "show_button",
						"value" => array(
							'Yes' => 'yes',
							'No' => 'no'
						),
						"description" => __("Show a button with link to the activity page")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Activity Button Label"),
						"param_name" => "button_label",
						"value" => 'View All Activity',
						"dependency" => array(
							"element" => "show_button",
							"value" => "yes"
						),
						"description" => __("Button text")
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __("Activity Button Link"),
						"param_name" => "button_link",
						"value" => '/activity',
						"dependency" => array(
							"element" => "show_button",
							"value" => "yes"
						),
						"description" => __("Put here the link to your activity page")
					)
				)
		)
	);

}
add_action( 'admin_init', 'kleo_vc_manipulate_shortcodes' );


class WPBakeryShortCode_Kleo_Grid extends WPBakeryShortCodesContainer { }
class WPBakeryShortCode_Kleo_Visibility extends WPBakeryShortCodesContainer { }
class WPBakeryShortCode_Kleo_List extends WPBakeryShortCodesContainer { }
class WPBakeryShortCode_Kleo_Feature_item extends WPBakeryShortCode { }
class WPBakeryShortCode_Kleo_List_item extends WPBakeryShortCode { }