<?php
/**
 * GRID Shortcode
 * [kleo_grid]Text[/kleo_grid]
 * 
 * @package WordPress
 * @subpackage K Elements
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since K Elements 1.0
 */


extract( shortcode_atts( array(
		'class' => '',
		'type' => '3',
		'animation' => ''
), $atts ) );


$class = ( $class != '' ) ? ' row multi-columns-row ' . esc_attr( $class ) : 'row multi-columns-row';

$col = floor(12/$type);

//Find items
$innersh = '';
$sh = preg_match_all('~\[kleo_feature_item([^\[\]]*)]([^\[\]]+)\[/kleo_feature_item]~', $content, $childs);
if($sh && isset($childs[0]) && !empty($childs[0])) {

	foreach ($childs[0] as $child) {
		$innersh .= '<div class="col-xs-12 col-sm-6 col-md-'.$col.'">';
		$innersh .= do_shortcode($child);
		$innersh .= '</div>';
	}
}

$output .= "<div class=\"{$class}\">"; 
if ($animation != '') {
	$output .='<div class="one-by-one-animated animate-when-almost-visible">';
}

$output .= $innersh;

if ($animation != '') {
	$output .= "</div>";
}

$output .= "</div>";