<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */
?>

			<?php
			/**
			 * After main part - action
			 */
			do_action('kleo_after_main');
			?>

		</div><!-- #main -->

		<div id="footer" class="footer-color border-top">
	<div class="container">
		<div class="template-page tpl-no">
			<div class="wrap-content">
				<div class="row">
					<div class="col-sm-4">
                    
						<div id="footer-sidebar-1" class="footer-sidebar widget-area" role="complementary">
							<div id="text-2" class="widget widget_text"><h4 class="widget-title footer-title">Connect with us</h4>	<br />
                            <a class="social-icons" href="#"><span class="icon-" style="font-size:40px">&#xe606;</span></a> <a class="social-icons" href="#"><span class="icon-" style="font-size:40px">&#xe607;</span></a>  <a class="social-icons" href="#"><span class="icon-" style="font-size:40px">&#xe608;</span></a> <a class="social-icons" href="#"><span class="icon-" style="font-size:40px">&#xe609;</span></a>	<div class="textwidget"></div>
		</div>						</div>
					</div>
					<div class="col-sm-4">
						<div id="footer-sidebar-2" class="footer-sidebar widget-area" role="complementary">
							<div id="text-3" class="widget widget_text"><h4 class="widget-title footer-title">About us</h4>
                            <p>
                            The Digital Skills Academy Alumni website
was developed to help connect and
reconnect its members. Its main focus is to
help participants on the next part of their
journey
                            
                            </p>
                            
                            			<div class="textwidget"></div>
		</div>						</div>
					</div>
					<div class="col-sm-4">
						<div id="footer-sidebar-3" class="footer-sidebar widget-area" role="complementary">
							<div id="text-4" class="widget widget_text"><h4 class="widget-title footer-title">Contact</h4>	
                            <span data-icon="&#xe040;"></span> Email: <a href="mailto:info@digitalskillsacademy.com" title="Email">info@digitalskillsacademy.com</a><br /><span data-icon="&#xe03c;"></span> Phone: +353 (0) 1 480 6244
                            
                            		<div class="textwidget"></div>
		</div>	
						</div>
					</div>
					<div class="col-sm-3">
						<div id="footer-sidebar-4" class="footer-sidebar widget-area" role="complementary">

													</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
    
    
    
		<?php 
		/**
		 * After footer hook
		 * @hooked kleo_go_up
		 * @hooked kleo_show_contact_form
		 */
		do_action('kleo_after_footer');
		?>
		
	</div><!-- #page -->
	
	<!-- Analytics -->
	<?php echo sq_option('analytics', ''); ?>
	
	<?php wp_footer(); ?>
    
      
</body>
</html>