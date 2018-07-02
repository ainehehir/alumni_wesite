<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

add_filter( 'cmb_meta_boxes', 'kleo_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function kleo_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_kleo_';

	$revslides = array();
	if (function_exists('kleo_revslide_sliders')) {
		foreach(kleo_revslide_sliders() as $k => $v)
		{
			$revslides[$k]['name'] = $v;
			$revslides[$k]['value'] = $k;
		}
	}
	
	$meta_boxes[] = array(
		'id'         => 'general_settings',
		'title'      => 'Theme General settings',
		'pages'      => array( 'post','page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Media',
				'desc' => '',
				'id'   => 'kleomedia',
				'type' => 'tab'
			),
			array(
				'name' => 'Slider',
				'desc' => 'Used when you select the Gallery format. Upload an image or enter an URL.',
				'id'   => $prefix . 'slider',
				'type' => 'file_repeat',
				'allow' => 'url'
			),
			array(
				'name' => 'Video oEmbed URL',
				'desc' => 'Used when you select Video format. Enter a Youtube, Vimeo, Soundcloud, etc URL. See supported services at <a target="_blank" href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'   => $prefix . 'embed',
				'type' => 'oembed',
			),
				
			array(
				'name' => 'Video Self hosted(mp4)',
				'desc' => 'Used when you select Video format. Upload your MP4 video file. Setting a self hosted video will ignore Video oEmbed above.',
				'id'   => $prefix . 'video_mp4',
				'type' => 'file',
			),
			array(
				'name' => 'Video Self hosted(ogv)',
				'desc' => 'Used when you select Video format. Upload your OGV video file.',
				'id'   => $prefix . 'video_ogv',
				'type' => 'file',
			),
			array(
				'name' => 'Video Self hosted(webm)',
				'desc' => 'Used when you select Video format. Upload your WEBM video file.',
				'id'   => $prefix . 'video_webm',
				'type' => 'file',
			),
				
			array(
				'name' => 'Audio',
				'desc' => 'Used when you select Audio format. Upload your audio file',
				'id'   => $prefix . 'audio',
				'type' => 'file',
			),
			array(
				'name' => 'Display settings',
				'desc' => '',
				'id'   => 'kleodisplay',
				'type' => 'tab'
			),
			array(
				'name' => 'Centered text',
				'desc' => 'Check to have centered text on this page',
				'id'   => $prefix . 'centered_text',
				'type' => 'checkbox',
				'value' => '1'
			),
			array(
				'name' => 'Top bar status',
				'desc' => 'Enable/disable site top bar',
				'id'   => $prefix . 'topbar_status',
				'type' => 'select',
				'options' => array(
						array('value' => '', 'name' => 'Default'),
						array('value' => '1', 'name' => 'Visible'),
						array('value' => '0', 'name' => 'Hidden')
					),
				'value' => ''
			),
			array(
				'name' => 'Hide Header',
				'desc' => 'Check to hide whole header area',
				'id'   => $prefix . 'hide_header',
				'type' => 'checkbox',
				'value' => '1'
			),
			array(
				'name' => 'Hide Footer',
				'desc' => 'Check to hide whole footer area',
				'id'   => $prefix . 'hide_footer',
				'type' => 'checkbox',
				'value' => '1'
			),
			array(
				'name' => 'Hide Socket area',
				'desc' => 'Check to hide the area after footer that contains copyright info.',
				'id'   => $prefix . 'hide_socket',
				'type' => 'checkbox',
				'value' => '1'
			),
			array(
				'name' => 'Custom Logo',
				'desc' => 'Use a custom logo for this page only',
				'id'   => $prefix . 'logo',
				'type' => 'file',
			),
			array(
				'name' => 'Transparent Main menu',
				'desc' => 'Check to have Main menu background transparent.',
				'id'   => $prefix . 'transparent_menu',
				'type' => 'checkbox',
				'value' => '1'
			),
				
				
			array(
				'name' => 'Title section',
				'desc' => '',
				'id'   => 'kleoheader',
				'type' => 'tab'
			),
			array(
				'name' => 'Hide the title',
				'desc' => 'Check to hide the title when displaying the post/page',
				'id'   => $prefix . 'title_checkbox',
				'type' => 'checkbox',
				'value' => '1'
			),
			array(
				'name' => 'Breadcrumb',
				'desc' => '',
				'id'   => $prefix . 'hide_breadcrumb',
				'type' => 'select',
				'options' => array(
						array('value' => '', 'name' => 'Default'),
						array('value' => '0', 'name' => 'Visible'),
						array('value' => '1', 'name' => 'Hidden')
					),
				'value' => ''
			),
				
				
			array(
				'name' => 'Hide information',
				'desc' => 'Check to hide contact info in title section',
				'id'   => $prefix . 'hide_info',
				'type' => 'checkbox',
				'value' => '1'
			)
		)
	);

	$meta_boxes[] = array(
		'id'         => 'post_meta',
		'title'      => 'Theme Post Settings',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(

				array(
				'name' => 'Hide post meta',
				'desc' => 'Check to hide the post meta when displaying a post',
				'id'   => $prefix . 'meta_checkbox',
				'type' => 'checkbox',
				'value' => '1'
			),
			array(
				'name' => 'Related posts',
				'desc' => 'Display related posts at bottom of the single post display',
				'id'   => $prefix . 'related_posts',
				'type' => 'select',
				'options' => array(
						array('value' => '', 'name' => 'Default'),
						array('value' => '1', 'name' => 'Visible'),
						array('value' => '0', 'name' => 'Hidden')
					),
				'value' => ''
			),
			array(
				'name' => 'Social share',
				'desc' => 'Display social share at bottom of the single post display',
				'id'   => $prefix . 'blog_social_share',
				'type' => 'select',
				'options' => array(
						array('value' => '', 'name' => 'Default'),
						array('value' => '1', 'name' => 'Visible'),
						array('value' => '0', 'name' => 'Hidden')
					),
				'value' => ''
			),
			array(
				'name' => 'Show media on post page',
				'desc' => 'If you want to show image/gallery/video/audio before the post on single page',
				'id'   => $prefix . 'post_media_status',
				'type' => 'select',
				'options' => array(
						array('value' => '', 'name' => 'Default'),
						array('value' => '1', 'name' => 'Yes'),
						array('value' => '0', 'name' => 'No')
					),
				'value' => ''
			),
		),
	);
	
	
	
	$meta_boxes[] = array(
		'id'         => 'post_layout',
		'title'      => 'Post Layout',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'side',
		'priority'   => 'default',
		'show_names' => false, // Show field names on the left
		'fields'     => array(
			
			array(
				'name' => 'Post layout',
				'desc' => '',
				'id'   => $prefix . 'post_layout',
				'type' => 'select',
				'options' => array(
						array('value' => 'default', 'name' => 'Default'),
						array('value' => 'right', 'name' => 'Right Sidebar'),
						array('value' => 'left', 'name' => 'Left sidebar'),
						array('value' => 'no', 'name' => 'Full width, no sidebar'),
						array('value' => '3lr', 'name' => '3 columns, Right and Left sidebars'),
						array('value' => '3ll', 'name' => '3 columns, 2 Left sidebars'),
						array('value' => '3rr', 'name' => '3 columns, 2 Right sidebars'),
					),
				'value' => 'right'
			),

				
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'clients_metabox',
		'title'      => __('Clients - link', 'kleo_framework'),
		'pages'      => array( 'kleo_clients' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Client link',
				'desc' => 'http://example.com',
				'id'   => $prefix . 'client_link',
				'type' => 'text',
			),
		)
	);
        
	$meta_boxes[] = array(
		'id'         => 'testimonials_metabox',
		'title'      => __('Testimonial - Author description', 'kleo_framework'),
		'pages'      => array( 'kleo-testimonials' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Author description',
				'desc' => '',
				'id'   => $prefix . 'author_description',
				'type' => 'text',
			),
		)
	);
	
	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'initialize_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function initialize_meta_boxes() {

    if ( ! class_exists( 'cmb_Meta_Box' ) ) {
    	require_once trailingslashit( KLEO_DIR ) . 'metaboxes/init.php';
    }
}