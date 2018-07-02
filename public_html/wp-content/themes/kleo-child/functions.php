<?php
/**
 * @package WordPress
 * @subpackage Kleo
 * @author Digilynx
 * @since Kleo 1.0
 * Programme: The digital skills alumni website
 * File description: functions.php
 * The functions for our theme
 */

/**
 * Kleo Child Theme Functions
 * Add custom code below
*/ 


/*Extra widget developed for sidebar*/

register_sidebar( array(
	'name' => 'Page Menu',
	'id' => 'page-menu',
	'before_widget' => '<div id="page-nav">',
	'after_widget' => '</div>',
	'before_title' => false,
	'after_title' => false
) );

add_filter( 'wp_page_menu', 'my_page_menu' );

function my_page_menu( $menu ) {
	dynamic_sidebar( 'page-menu' );
}



// add thumbnail support
add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
set_post_thumbnail_size( 200, 130, true ); // 50 pixels wide by 50 pixels tall, hard crop mode


//contact form 7 functions, This adds the password and confirm password fields to the plugin once shortcode [cfp] is entered 

function cfp($atts, $content = null) {
    extract(shortcode_atts(array( "id" => "", "title" => "", "pwd" => "" ), $atts));

    if(empty($id) || empty($title)) return "";

    $cf7 = do_shortcode('[contact-form-7 id="' . $id . '" title="' . $title . '"]');

    $pwd = explode(',', $pwd);
    foreach($pwd as $p) {
        $p = trim($p);

        $cf7 = preg_replace('/<input type="text" name="' . $p . '"/usi', '<input type="password" name="' . $p . '"', $cf7);
		
		
		
    }

    return $cf7;
}
add_shortcode('cfp', 'cfp');


function registration_process_hook() {
	if (isset($_POST['adduser']) && isset($_POST['add-nonce']) && wp_verify_nonce($_POST['add-nonce'], 'add-user')) {
	
		// die if the nonce fails
		if ( !wp_verify_nonce($_POST['add-nonce'],'add-user') ) {
			wp_die('Sorry! That was secure, guess you\'re cheatin huh!');
		} else {
			// auto generate a password
			$user_pass = wp_generate_password();
			// setup new user
			$userdata = array(
				'user_pass' => $user_pass,
				'user_login' => esc_attr( $_POST['user_name'] ),
				'user_email' => esc_attr( $_POST['email'] ),
				'role' => get_option( 'default_role' ),
			);
			// setup some error checks
			if ( !$userdata['user_login'] )
				$error = 'A username is required for registration.';
			elseif ( username_exists($userdata['user_login']) )
				$error = 'Sorry, that username already exists!';
			elseif ( !is_email($userdata['user_email'], true) )
				$error = 'You must enter a valid email address.';
			elseif ( email_exists($userdata['user_email']) )
				$error = 'Sorry, that email address is already used!';
			// setup new users and send notification
			else{
				$new_user = wp_insert_user( $userdata );
				wp_new_user_notification($new_user, $user_pass);
			}
		}
	}
	if ( $new_user ) : ?>

	<p class="alert"><!-- create and alert message to show successful registration -->
	<?php
		$user = get_user_by('id',$new_user);
		echo 'Thank you for registering ' . $user->user_login;
		echo '<br/>Please check your email address. That\'s where you\'ll recieve your login password.<br/> (Be sure to check your spam folder)';
	?>
	</p>
	
	<?php else : ?>
	
		<?php if ( $error ) : ?>
			<p class="error"><!-- echo errors if users fails -->
				<?php echo $error; ?>
			</p>
		<?php endif; ?>
	
	<?php endif;

}
add_action('process_customer_registration_form', 'registration_process_hook');









