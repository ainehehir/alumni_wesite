<?php
/*
Template Name: Registration Page
 * Author: Digilynx
 * Programme: The digital skills alumni website
 * File description: registration.php
 * The business registration page for our theme

*/
get_header(); ?>

<?php get_template_part('page-parts/general-title-section'); ?>



<?php get_template_part('page-parts/general-before-wrap'); ?>


<?php
if ( have_posts() ) :
	// Start the Loop.
	while ( have_posts() ) : the_post();

		/*
		 * Include the post format-specific template for the content. If you want to
		 * use this in a child theme, then include a file called called content-___.php
		 * (where ___ is the post format) and that will be used instead.
		 */
		 
		 
		 
		get_template_part( 'content', 'page' );
		

	endwhile;

endif;



?>

<form method="POST" id="adduser" class="user-forms" action="">
	<strong>Name</strong>
	<p class="form-username">
		<label for="user_name"><?php echo 'Username (required)'; ?></label>
		<input class="text-input" name="user_name" type="text" id="user_name" value="" />
	</p>
	
	<p class="form-email">
		<label for="email"><?php echo 'E-mail (required)'; ?></label>
		<input class="text-input" name="email" type="text" id="email" value="" />
	</p>
	
	<p class="form-submit">
		<input name="adduser" type="submit" id="addusersub" class="submit button" value="Register" />
		<?php wp_nonce_field( 'add-user', 'add-nonce' ) ?><!-- a little security to process on submission -->
		<input name="action" type="hidden" id="action" value="adduser" />
	</p>
</form>



 <!-- Registration -->
        <div id="register-form">
        <div class="title">
            <h1>Register your Account</h1>
            <span>Sign Up with us and Enjoy!</span>
        </div>
            <form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
            <input type="text" name="user_login" value="Username" id="user_login" class="input" />
            <input type="text" name="user_email" value="E-Mail" id="user_email" class="input"  />
                <?php do_action('register_form'); ?>
                <input type="submit" value="Register" id="register" />
            <hr />
            <p class="statement">A password will be e-mailed to you.</p>


            </form>
        </div>

        
<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php get_footer(); ?>



 
