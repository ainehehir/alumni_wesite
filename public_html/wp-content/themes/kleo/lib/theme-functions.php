<?php
define('KLEO_THEME_VERSION', '20140320');

/* Configuration array */
global $kleo_config;

//define dynamic styles path
$upload_dir = wp_upload_dir();
$kleo_config['custom_style_path'] = $upload_dir['basedir'].'/custom_styles'; 
$kleo_config['custom_style_url'] = $upload_dir['baseurl'].'/custom_styles'; 
$kleo_config['image_overlay'] = '<span class="hover-element"><i>+</i></span>';

//define site style sets
$kleo_config['style_sets'] = array(	'header','main','alternate','footer','socket');
$kleo_config['font_sections'] = array('h1','h2','h3','h4','h5','h6','body');


/***************************************************
:: Framework initialization with required plugins
***************************************************/

$theme_args = array(
	'required_plugins' => array(
		array(
			'name'                  => 'Buddypress', // The plugin name
			'slug'                  => 'buddypress', // The plugin slug (typically the folder name)
			'required'              => false, // If false, the plugin is only 'recommended' instead of required
			'version'               => '1.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'                  => 'bbPress', // The plugin name
			'slug'                  => 'bbpress', // The plugin slug (typically the folder name)
			'required'              => false, // If false, the plugin is only 'recommended' instead of required
			'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => '', // If set, overrides default API URL and points to an external URL
		),
    array(
				'name'			=> 'Visual Composer', // The plugin name
				'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
				'source'			=> get_template_directory() . '/lib/inc/js_composer.zip', // The plugin source
				'required'			=> true, // If false, the plugin is only 'recommended' instead of required
				'version'			=> '3.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'		=> '', // If set, overrides default API URL and points to an external URL
		),
    array(
				'name'			=> 'Revolution Slider', // The plugin name
				'slug'			=> 'revslider', // The plugin slug (typically the folder name)
				'source'			=> get_template_directory() . '/lib/inc/revslider.zip', // The plugin source
				'required'			=> true, // If false, the plugin is only 'recommended' instead of required
				'version'			=> '4.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'		=> '', // If set, overrides default API URL and points to an external URL
		),
    array(
				'name'			=> 'K Elements', // The plugin name
				'slug'			=> 'k-elements', // The plugin slug (typically the folder name)
				'source'			=> get_template_directory() . '/lib/inc/k-elements.zip', // The plugin source
				'required'			=> true, // If false, the plugin is only 'recommended' instead of required
				'version'			=> '1.2.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'		=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'                  => 'rtMedia', // The plugin name
			'slug'                  => 'buddypress-media', // The plugin slug (typically the folder name)
			'required'              => false, // If false, the plugin is only 'recommended' instead of required
			'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => '', // If set, overrides default API URL and points to an external URL
		)
			
	)
);

//instance of our theme framework
global $kleo_theme;
$kleo_theme = new Kleo($theme_args);



/***************************************************
:: Load Theme functions
***************************************************/

add_action( 'after_setup_theme', 'kleo_theme_functions', 12 );

function kleo_theme_functions() {

	/* Plugins and functionalities */
	
	// bbPress compatibility
	if (class_exists( 'bbPress' )) {
		require_once( KLEO_LIB_DIR . '/plugin-bbpress/config.php' );	    //compatibility with bbpress plugin
	}

	// Paid memberships Pro compatibility
	if(function_exists('pmpro_url')) {
		require_once( KLEO_LIB_DIR . '/plugin-pmpro/config.php' );
	}

	// Posts likes
	if (sq_option('likes_status', 1) == 1) {
		require_once( KLEO_LIB_DIR . '/item-likes.php' );
	} 

	// Resize on the fly
	require_once(KLEO_LIB_DIR . '/aq_resizer.php');


	/* Include admin customizations */
	
	if ( is_admin() ) {
		//Options panel
		if ( !class_exists( 'ReduxFramework' ) && file_exists( KLEO_DIR . '/options/framework.php' ) ) {
			require_once( KLEO_DIR . '/options/framework.php' );
		}
		require_once(KLEO_LIB_DIR.'/options.php');

		//Metaboxes
		require_once(KLEO_LIB_DIR.'/metaboxes.php');
	}
	/* Custom menu */
	require_once(KLEO_LIB_DIR . '/menu-custom.php');
}



/***************************************************
:: Load post types class
***************************************************/

require_once KLEO_LIB_DIR. '/post-types.php';
new Post_types();


/***************************************************
:: Include widgets
***************************************************/

$kleo_widgets = array(
	'recent_posts.php'
);

$kleo_widgets = apply_filters( 'kleo_widgets', $kleo_widgets );

foreach ( $kleo_widgets as $widget ) {
	$file_path = trailingslashit( KLEO_LIB_DIR ) . 'widgets/' . $widget;
	
	if ( file_exists( $file_path ) ) {
		require_once( $file_path );
	}
}


/**
 * Return the breadcrumb area
 * @global object $wp_query
 * @param array $args
 * @return string
 */
function kleo_title_section($args = false)
{
    $defaults 	 = array(

			'title'				=> get_the_title(),
			'show_title' => true,
			'show_breadcrumb'	=> true,
			'link'				=> '',
			'output'			=> "<section class='{class} border-bottom'><div class='container'>{title_data}{breadcrumb_data}{extra}</div></section>",
			'class'				=> 'container-wrap main-title alternate-color ',
			'extra'				=> '<p class="page-info">'.sq_option('title_info', '').'</p>',
			'heading'		=> 'h1',
			'link' => ''
    );
    
		if ( is_tax() || is_category() || is_tag() )
		{
			global $wp_query;

			$term = $wp_query->get_queried_object();
			if (!empty($term)) {
				$defaults['link'] = get_term_link( $term );
			}
		}

		// Parse incomming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters('kleo_title_args', $args);

		// OPTIONAL: Declare each item in $args as its own variable i.e. $type, $before.
		extract( $args, EXTR_SKIP );
        
		if(!empty($link)) {
			$title = "<a href='".$link."' rel='bookmark' title='".__('Permanent Link:','kleo_framework')." ".esc_attr( $title )."'>".$title."</a>";
		}
		
		$breadcrumb_data = '';
		if($show_breadcrumb) 
		{
			$breadcrumb_data = kleo_breadcrumb(array('container_class' => 'breadcrumb'));
		}
		
		$title_data = '';
		if($show_title) 
		{
			$title_data = '<{heading} class="page-title">{title}</{heading}>';
		}
		
		$output = str_replace('{title_data}', $title_data, $output);
		$output = str_replace('{class}', $class, $output);
		$output = str_replace('{title}', $title, $output);
		$output = str_replace('{breadcrumb_data}', $breadcrumb_data, $output);
		$output = str_replace('{extra}', $extra, $output);
		$output = str_replace('{heading}', $heading, $output);
        
		return $output;
}



/***************************************************
 * TOP TOOLBAR - ADMIN BAR
 * Enable or disable the bar, depending of the theme option setting
***************************************************/
if (sq_option('admin_bar', 1) == '0'):
	remove_action('wp_footer','wp_admin_bar_render',1000);
	add_filter('show_admin_bar', '__return_false');
endif;



/***************************************************
:: MAINTENANCE MODE
***************************************************/
if (!function_exists('kleo_maintenance_mode')) {
	function kleo_maintenance_mode() {

		$logo_path = apply_filters('kleo_logo', sq_option_url('logo'));
		$logo_img = '<img src="'. $logo_path .'" alt="maintenance" style="margin: 0 auto; display: block;" />';
		
		if (sq_option('maintenance_mode', 0) == 1) {

			if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
				wp_die(
						$logo_img 
							. '<div style="text-align:center">'
							. sq_option('maintenance_msg', '')
							. '</div>',
						get_bloginfo( 'name' )
					);
			}
		}
	}
	add_action('get_header', 'kleo_maintenance_mode');
}



/***************************************************
:: Get social profiles
***************************************************/

if (!function_exists('kleo_get_social_profiles')):

	function kleo_get_social_profiles($args=false)
	{
		$output = '';
		$icons = '';
		$all_options = get_option("kleo_".KLEO_DOMAIN);
		
    $defaults 	 = array(
				'container'	=> 'ul',
				'item_tag' => 'li',
				'target' => '_blank'
    );
		// Parse incomming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters('kleo_get_social_profiles_args', $args);
		
		//get social data from theme options
		if (!empty($all_options)) {
			foreach ($all_options as $k => $opt)
			{
				if (substr( $k, 0, 7 ) === 'social_' && !empty($opt) ) {
					$k = str_replace('social_','',$k);
					$title = str_replace(
							array('gplus', 'vimeo-squared', 'pinterest-circled', 'instagramm'), 
							array('Google+', 'Vimeo','Pinterest', 'Instagram'), 
							$k
						);

					$icons .= '<' . $args['item_tag'] . '>';
					$icons .= '<a target="'.$args['target'].'" href="'.$opt.'"><i class="icon-'.$k.'"></i><div class="ts-text">'.ucfirst($title).'</div></a>';
					$icons .= '</' . $args['item_tag'] . '>';
				}
			}
		}
		
		$icons = apply_filters('kleo_get_social_profiles', $icons);
		if ($icons != '') {
			$output .= '<' . $args['container'] . '>';
			$output .= $icons;
			$output .= '</' . $args['container'] . '>';
		}
		
		return $output;
		
	}

endif;



/***************************************************
:: Ajax search in header main menu
***************************************************/

//if set from admin to show search
if (sq_option('ajax_search', 1))
{
	add_filter( 'wp_nav_menu_items', 'kleo_search_menu_item', 10, 2 );
}


if(!function_exists('kleo_search_menu_item'))
{
	/**
	 * Add search to menu
	 * @param string $items
	 * @param oject $args
	 * @return string
	 */
	function kleo_search_menu_item ( $items, $args )
	{
	    if ($args->theme_location == 'primary')
	    {
				ob_start();
				?>

				<div class="searchHidden" id="ajax_search_container">
					<form class="form-inline" id="ajax_searchform" action="#">
						<input autocomplete="off" type="text" class="form-control" id="ajax_s" name="s" value="<?php if (isset($_REQUEST['s'])) echo $_REQUEST['s']; ?>">
						<span id="kleo-ajax-search-loading"><i class="icon-spin5 animate-spin"></i></span>
					</form>
					<div class="kleo_ajax_results"></div>
				</div>

				<?php
	        $form = ob_get_clean();
	        $items .= '<li id="nav-menu-item-search" class="menu-item kleo-menu-item-search"><a class="search-trigger" href="#"><i class="icon icon-search"></i></a>'.$form.'</li>';
	    }
	    return $items;
	}
}

//Catch ajax requests
add_action( 'wp_ajax_kleo_ajax_search', 'kleo_ajax_search' );
add_action( 'wp_ajax_nopriv_kleo_ajax_search', 'kleo_ajax_search' );

if(!function_exists('kleo_ajax_search'))
{
	function kleo_ajax_search()
	{
		//if "s" input is missing exit
		if(empty($_REQUEST['s'])) die();

		$output = "";
		$defaults = array('numberposts' => 4, 'post_type' => 'any', 'post_status' => 'publish', 'post_password' => '', 'suppress_filters' => false);
		$defaults =  apply_filters( 'kleo_ajax_query_args', $defaults);

		$query = array_merge($defaults, $_REQUEST);
		$query = http_build_query($query);
		$posts = get_posts( $query );

			//if there are no posts
		if(empty($posts))
		{
			$output  = "<div class='kleo_ajax_entry ajax_not_found'>";
			$output .= "<div class='ajax_search_content'>";
			$output .= "<i class='icon icon-exclamation-sign'></i> ";
			$output .= __("Sorry, no pages matched your criteria.", 'kleo_framework');
			$output .= "<br>";
			$output .= __("Please try searching by different terms.", 'kleo_framework');
			$output .= "</div>";
			$output .= "</div>";
			echo $output;
			die();
		}

		//if there are posts
		$post_types = array();
		$post_type_obj = array();
		foreach($posts as $post)
		{
			$post_types[$post->post_type][] = $post;
			if(empty($post_type_obj[$post->post_type]))
			{
				$post_type_obj[$post->post_type] = get_post_type_object($post->post_type);
			}
		}

		foreach($post_types as $ptype => $post_type)
		{
			if(isset($post_type_obj[$ptype]->labels->name))
			{
				$output .= "<h4>".$post_type_obj[$ptype]->labels->name."</h4>";
			}
			else
			{
				$output .= "<hr>";
			}
			foreach($post_type as $post)
			{
				$format = get_post_format($post->ID);
				if (get_the_post_thumbnail( $post->ID, 'thumbnail' ))
				{
					$image = get_the_post_thumbnail( $post->ID, 'thumbnail' );
				}
				else
				{
					if ($format == 'video') {
						$image = "<i class='icon icon-video'></i>";
					}
					elseif ($format == 'image' || $format == 'gallery') {
						$image = "<i class='icon icon-picture'></i>";
					}
					else {
						$image = "<i class='icon icon-link'></i>";
					}
				}

				$excerpt = "";

				if(!empty($post->post_content))
				{
					$excerpt =  "<br>".char_trim(trim(strip_tags(strip_shortcodes($post->post_content))),40,"...");
				}
				$link = apply_filters('kleo_custom_url', get_permalink($post->ID));
				$classes = "format-".$format;
				$output .= "<div class ='kleo_ajax_entry $classes'>";
				$output .= "<div class='ajax_search_image'>$image</div>";
				$output .= "<div class='ajax_search_content'>";
				$output .= "<a href='$link' class='search_title'>";
				$output .= get_the_title($post->ID);
				$output .= "</a>";
				$output .= "<span class='search_excerpt'>";
				$output .= $excerpt;
				$output .= "</span>";
				$output .= "</div>";
				$output .= "</div>";
			}
		}

		$output .= "<a class='ajax_view_all' href='".home_url('?s='.$_REQUEST['s'] )."'>".__('View all results','kleo_framework')."</a>";

		echo $output;
		die();
	}
}



/***************************************************
:: WPML language switch
***************************************************/
if (!function_exists('kleo_lang_menu_item')):
	
	function kleo_lang_menu_item ( $items, $args )
	{
		if ($args->theme_location == 'top')
		{
			$items .= kleo_get_languages();
		}
		
		return $items;
	}
	
endif;						
										
if(sq_option('show_lang',1) == 1) {
	add_filter( 'wp_nav_menu_items', 'kleo_lang_menu_item', 10, 2 );
}

function kleo_get_languages() {

	$output = '';
	$active = '';
	$langs = '';

	if (function_exists('icl_get_languages')) {
		$languages = icl_get_languages('skip_missing=0&orderby=code');

		if(!empty($languages)){
			foreach($languages as $l)
			{
				if (sq_option('show_lang_flag', 1) == 1) {
					$flags = '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /> ';
				} else {
					$flags = '';
				}
				$langs .= '<li>';
				if($l['country_flag_url']){
					if(!$l['active']) {
						$langs .= '<a href="'.$l['url'].'">'.$flags.'<span class="language name">'.$l['translated_name'].'</span></a>'."\n";
					} else {
						$active = '<a '. (count($languages) > 1 ? 'href="#" class="dropdown-toggle js-activated current-language" data-toggle="dropdown"' : 'href="'.$l['url'].'"') . '>'.$flags.'<span class="language name">'.$l['translated_name'].'</span>' . (count($languages) > 1 ? ' <span class="caret"></span>' : '') . '</a>'."\n";
					}
				}
				$langs .= '</li>';
			}
		}

		$output .= ' 
		<li class="'.(count($languages) > 1 ? 'dropdown' : '') . ' kleo-langs">'
		. $active .
			'<ul class="dropdown-menu pull-right">'
			.$langs
			.'</ul>
		</li>';
	}

	return $output;
}


/***************************************************
:: Go up button
***************************************************/
function kleo_go_up() 
{
	?>
	<a class="kleo-go-top" href="#"><i class="icon-up-open-big"></i></a>
	<?php
}

if(sq_option('go_top',1) == 1) {
	add_action('kleo_after_footer', 'kleo_go_up');
}



/***************************************************
:: Bottom contact form
***************************************************/

if (!function_exists('kleo_contact_form')) {
	function kleo_contact_form( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title'    	 => 'CONTACT US'
		), $atts));
	
		$output = '';
		
		$output .= '<div class="kleo-quick-contact-wrapper">'
			.'<a class="kleo-quick-contact-link" href="#"><i class="icon-mail-alt"></i></a>'
			.'<div id="kleo-quick-contact">'
				.'<h4 class="kleo-qc-title">'. $title .'</h4>'
				.'<p>'. do_shortcode($content).'</p>'
				.'<form class="kleo-contact-form" action="#" method="post" novalidate>'
					.'<input type="text" placeholder="'.__("Your Name",'kleo_framework').'" required id="contact_name" name="contact_name" class="form-control" value="" tabindex="276" />'
					.'<input type="email" required placeholder="' . __("Your Email",'kleo_framework') . '" id="contact_email" name="contact_email" class="form-control" value="" tabindex="277"  />'
					.'<textarea placeholder="' . __("Type your message...",'kleo_framework') . '" required id="contact_content" name="contact_content" class="form-control" tabindex="278"></textarea>'
						.'<input type="hidden" name="action" value="kleo_sendmail">'
						.'<button tabindex="279" class="btn btn-default pull-right" type="submit">'. __("Send",'kleo_framework').'</button>'
					.'<div class="kleo-contact-loading">'. __("Sending",'kleo_framework').' <i class="icon-spinner icon-spin icon-large"></i></div>'
					.'<div class="kleo-contact-success"> </div>'
				.'</form>'
				.'<div class="bottom-arrow"></div>'
			.'</div>'
		.'</div><!--end kleo-quick-contact-wrapper-->';
			
		return $output;
	}
	add_shortcode('kleo_contact_form', 'kleo_contact_form');
}

add_action('wp_ajax_kleo_sendmail', 'kleo_sendmail');
add_action('wp_ajax_nopriv_kleo_sendmail', 'kleo_sendmail');

if (!function_exists('kleo_sendmail')): 
	function kleo_sendmail()
	{
		if(isset($_POST['action'])) {

			$error_tpl = "<span class='mail-error'>%s</span>";
			
			//contact name
			if(trim($_POST['contact_name']) === '') 
			{
				printf($error_tpl, __('Please enter your name.','kleo_framework') );
				die();
			}
			else 
			{
				$name = trim($_POST['contact_name']);
			}

			///contact email
			if(trim($_POST['contact_email']) === '') 
			{
				printf($error_tpl, __('Please enter your email address.','kleo_framework') );
				die();
			} 
			elseif (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+.[a-z]{2,4}$/i", trim($_POST['contact_email']))) 
			{
				printf($error_tpl, __('You entered an invalid email address.','kleo_framework') );
				die();
			} 
			else 
			{
				$email = trim($_POST['contact_email']);
			}

			//message
			if(trim($_POST['contact_content']) === '') 
			{
				printf($error_tpl, __('Please enter a message.','kleo_framework') );
				die();
			} 
			else 
			{
				if(function_exists('stripslashes')) {
					$comment = stripslashes(trim($_POST['contact_content']));
				} else {
					$comment = trim($_POST['contact_content']);
				}
			}

			$emailTo = sq_option('contact_form_to','');
			if (!isset($emailTo) || ($emailTo == '') )
			{
				$emailTo = get_option('admin_email');
			}

			$subject = __('Contact Form Message','kleo_framework');
			apply_filters('kleo_contact_form_subject',$subject);

			$body = __("You received a new contact form message:", 'kleo_framework');
			$body .= __("Name: ", 'kleo_framework') . $name . "<br>";
			$body .= __("Email: ", 'kleo_framework') .$email . "<br>" ;
			$body .= __("Message: ", 'kleo_framework') . $comment . "<br>";

			$headers[] = "Content-type: text/html";
			$headers[] = "Reply-To: $name <$email>";
			apply_filters('kleo_contact_form_headers',$headers);

			if(wp_mail($emailTo, $subject, $body, $headers))
			{
				echo '<span class="mail-success">' . __("Thank you. Your message has been sent.", 'kleo_framework').' <i class="icon-ok icon-large"></i></span>';

				do_action('kleo_after_contact_form_mail_send', $name, $email, $comment);
			}
			else
			{
				printf($error_tpl, __("Mail couldn't be sent. Please try again!",'kleo_framework') );
			}

		}
		else
		{
			printf($error_tpl, __("Unknown error ocurred. Please try again!",'kleo_framework') );
		}
		 die();
	}
endif;


function kleo_show_contact_form() 
{
	$title = sq_option('contact_form_title','');
	$content= sq_option('contact_form_text','');
	
	echo do_shortcode('[kleo_contact_form title="'.$title.'"]'.$content.'[/kleo_contact_form]');
}

if(sq_option('contact_form',1) == 1) {
	add_action('kleo_after_footer', 'kleo_show_contact_form');
}




/***************************************************
:: SOCKET AREA
***************************************************/
function kleo_show_socket() 
{
	get_template_part('page-parts/socket');
}

if (sq_option('socket_enable', 1) == 1) {
	add_action('kleo_after_footer', 'kleo_show_socket');
}





/***************************************************
:: EXCERPT
***************************************************/

if (!function_exists('kleo_new_excerpt_length')) {
	function kleo_new_excerpt_length($length) {
			return 60;
	}
	add_filter('excerpt_length', 'kleo_new_excerpt_length');
}

if (!function_exists('kleo_excerpt')) :
	function kleo_excerpt($limit = 20) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt).'';
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return '<p>' . $excerpt . '</p>';
	}
endif;


if (!function_exists('kleo_has_shortcode')) {
	function kleo_has_shortcode( $shortcode = '', $attribute = '' ) {

		if (is_page() || is_single()) {
		$current_post = get_post( get_the_ID() );
		$post_content  = $current_post->post_content;
		$found         = false;

		if ( ! $shortcode ) {
			return $found;
		}

		if ( stripos( $post_content, '[' . $shortcode ) !== false ) {
			$found = true;
		}

		return $found;
		} else {
			return false;
		}
	}
}

if (!function_exists('kleo_icons_array')) {
	function kleo_icons_array() {

		$icons= array('');

		$icons_json = file_get_contents( KLEO_LIB_DIR . '/assets/font-icons.json');
		if ($icons_json) {
			$arr = json_decode($icons_json, true);
			foreach($arr['glyphs'] as $icon) 
			{
				$icons[$icon['css']] = $icon['css'];
				asort($icons);
			}
		}

		return $icons;
	}
}

if ( ! function_exists( 'kleo_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Kleo 1.0
 *
 * @return void
 */
function kleo_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	
	<nav class="pagination-sticky post-navigation" role="navigation">
		<?php
		if ( is_attachment() ) :
			previous_post_link( '%link', __( '<span id="older-nav">Go to article</span>', 'kleo_framework' ) );
		else :
			previous_post_link( '%link', __( '<span id="older-nav">Previous Post</span>', 'kleo_framework' ) );
			next_post_link( '%link', __( '<span id="newer-nav">Next Post</span>', 'kleo_framework' ) );
		endif;
		?>
	</nav><!-- .navigation -->
	
	<?php
}
endif;

/**
 * Check to see if post meta is enabled for a single post
 * @return int
 */
function kleo_postmeta_enabled() {
	$meta_status = sq_option('blog_meta_status', 1);
	
	if(get_cfield('meta_checkbox') == 1) {
		$meta_status = 0;
	}
	return $meta_status;
}


/**
 * Check to see if post media is enabled for a single post page
 * @return int
 */
function kleo_postmedia_enabled() {
	
	if (!is_single()) {
		return 1;
	}
	$media_status = sq_option('blog_media_status', 1);
	
	$post_status = get_cfield('post_media_status');
	if($post_status != '') {
		$media_status = get_cfield('post_media_status');
	}
	
	return $media_status;
}


function kleo_get_img_overlay() {
	global $kleo_config;
	
	return $kleo_config['image_overlay'];
}



/***************************************************
:: Facebook Integration
***************************************************/

if (!function_exists('kleo_fb_button')) :
	function kleo_fb_button()
	{
		echo kleo_get_fb_button();
	}
endif;
if (!function_exists('kleo_get_fb_button')) :
	function kleo_get_fb_button()
	{
		ob_start();
		?>
			<div class="kleo-fb-wrapper text-center">
				<a href="#" class="kleo-facebook-connect btn btn-default "><i class="icon-facebook"></i> &nbsp;<?php _e("Facebook", 'kleo_framework');?></a>
			</div>
			<div class="gap-20"></div>
			<div class="hr-title hr-full"><abbr> <?php echo __("or", "kleo_framework");?> </abbr></div>
		<?php

		$output = ob_get_clean();

		return $output;
	}
endif;

if (!function_exists('kleo_fb_button_regpage')) :
	function kleo_fb_button_regpage()
	{
		echo kleo_get_fb_button_regpage();
	}
endif;
if (!function_exists('kleo_get_fb_button_regpage')) :
	function kleo_get_fb_button_regpage()
	{
		ob_start();
		?>
			<div class="kleo-fb-wrapper text-center">
				<a href="#" class="kleo-facebook-connect btn btn-default "><i class="icon-facebook"></i> &nbsp;<?php _e("Facebook", 'kleo_framework');?></a>
			</div>
			<div class="gap-30"></div>
			<div class="hr-title hr-full"><abbr> <?php echo __("or", "kleo_framework");?> </abbr></div>
			<div class="gap-10"></div>
		<?php
		$output = ob_get_clean();

		return $output;
	}
endif;

if (sq_option('facebook_login', 0) == 1) {
	add_action('bp_before_login_widget_loggedout', 'kleo_fb_button' );
	if (sq_option('facebook_register', 0) == 1) {
		add_action('bp_before_register_page', 'kleo_fb_button_regpage' );
	}
}



/***************************************************
:: oEmbed manipulation for youtube/vimeo video
***************************************************/

if ( ! function_exists( 'kleo_add_video_wmode_transparent' ) ) :
	/**
	 * Automatically add wmode=transparent to embeded media
	 * Automatically add showinfo=0 for youtube
	 * @param type $html
	 * @param type $url
	 * @param type $attr
	 * @return type
	 */
	function kleo_add_video_wmode_transparent($html, $url, $attr)
	{
		if (strpos($html, "youtube.com") !== NULL || strpos($html, "youtu.be") !== NULL) {
			$info = "&amp;showinfo=0";
		}
		else {
			$info = "";
		}

		if ( strpos( $html, "<embed src=" ) !== false ) {
			return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); 
		}
		elseif ( strpos ( $html, 'feature=oembed' ) !== false ) { 
			return str_replace( 'feature=oembed', 'feature=oembed&amp;wmode=opaque'.$info, $html ); 
		}
		else {
			return $html;
		}
	}
endif;

add_filter( 'oembed_result', 'kleo_add_video_wmode_transparent', 10, 3);

if (!function_exists('kleo_oembed_filter')):
	function kleo_oembed_filter( $return, $data, $url ) {
		$return = str_replace('frameborder="0"', 'style="border: none"', $return);
		return $return;
	}
endif;

add_filter('oembed_dataparse', 'kleo_oembed_filter', 90, 3 );



/***************************************************
:: Apply oEmbed for post video format
***************************************************/
add_filter( 'kleo_oembed_video', array( $wp_embed, 'autoembed'), 8 );



/***************************************************
:: Prettyphoto on image gallery
***************************************************/

//add_filter( 'wp_get_attachment_link', 'kleo_galley_pretty');
 
function kleo_galley_pretty( $content ) {
	$content = preg_replace("/<a/","<a rel=\"prettyPhoto[gallery]\"",$content,1);
	return $content;
}