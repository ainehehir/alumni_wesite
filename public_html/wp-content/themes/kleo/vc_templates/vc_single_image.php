<?php

$output = $el_class = $image = $img_size = $img_link = $img_link_target = $img_link_large = $title = $alignment = $animation = $css_animation = '';

extract(shortcode_atts(array(
    'title' => '',
    'image' => $image,
    'img_size'  => 'thumbnail',
    'img_link_large' => false,
    'img_link' => '',
    'img_link_target' => '_self',
    'alignment' => 'left',
    'el_class' => '',
		'animation' => '',
    'css_animation' => ''
), $atts));

$img_id = preg_replace('/[^\d]/', '', $image);
$img = wpb_getImageBySize(array( 'attach_id' => $img_id, 'thumb_size' => $img_size ));
if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" /> <small>'.__('This is image placeholder, edit your page to replace it.', 'js_composer').'</small>';

$el_class = $this->getExtraClass($el_class);

$link_to = '';
if ($img_link_large==true) {
    $link_to = wp_get_attachment_image_src( $img_id, 'large');
    $link_to = $link_to[0];
}
else if (!empty($img_link)) {
    $link_to = $img_link;
}
if(!empty($link_to) && !preg_match('/^(https?\:\/\/|\/\/)/', $link_to)) $link_to = 'http://'.$link_to;
$image_string = !empty($link_to) ? '<a href="'.$link_to.'"'.($img_link_target!='_self' ? ' target="'.$img_link_target.'"' : '').($img_link_target=='_self' ? ' data-gallery="" data-rel="prettyPhoto"' : '').'>'.$img['thumbnail'].'</a>' : $img['thumbnail'];

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'element-wrap wpb_content_element'.$el_class, $this->settings['base']);

$css_class .= ' element-'.$alignment.' text-'.$alignment;

if ( $animation != '' ) {
	wp_enqueue_script( 'waypoints' );
	$css_class .= " animated {$animation} {$css_animation}";
}

$output .= "\n\t".'<div class="'.$css_class.'">';
$output .= "\n\t\t\t".wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_singleimage_heading'));
$output .= "\n\t\t\t".$image_string;
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_single_image');

echo $output;