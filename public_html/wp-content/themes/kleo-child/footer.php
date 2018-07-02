<?php
/**
 * The template for displaying the footer
 * Author: Digilynx
 * Programme: The digital skills alumni website
 * File description: footer.php
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
        <!--Bootstrap layout-->
	<div class="container">
		<div class="template-page tpl-no">
			<div class="wrap-content">
            
				<div class="row">
					<div class="col-sm-4">
                    <!--Social media content-->
						<div id="footer-sidebar-1" class="footer-sidebar widget-area" role="complementary">
							<div id="text-2" class="widget widget_text"><h4 class="widget-title footer-title">Connect with us</h4>	<br />
                            <a class="social-icons" href="#"><span class="icon-" style="font-size:40px">&#xe606;</span></a> <a class="social-icons" href="http://twitter.com/DigiSkillsAlum"><span class="icon-" style="font-size:40px">&#xe607;</span></a>  <div class="textwidget"></div>
		</div>						</div>
					</div>
                    <!--About us content-->
					<div class="col-sm-4">
						<div id="footer-sidebar-2" class="footer-sidebar widget-area" role="complementary">
							<div id="text-3" class="widget widget_text"><h4 class="widget-title footer-title">About us</h4>
                            <p>
                            The Digital Skills Academy Alumni website was designed to help you stay in touch with the college and fellow Alumni, to support your digital career through jobs, events and networking, and to assist you in staying abreast of rapidly-evolving industry developments.
                            
                            </p>
                            
                            			<div class="textwidget"></div>
		</div>						</div>
					</div>
                    <!--Contact details-->
					<div class="col-sm-4">
						<div id="footer-sidebar-3" class="footer-sidebar widget-area" role="complementary">
							<div id="text-4" class="widget widget_text"><h4 class="widget-title footer-title">Contact</h4>	
                            <div class="row contact">
                            <div class="col-xs-1"><i class="fa fa-envelope"></i></div> <div class="col-xs-11"> <a href="mailto:admin@digitalskillsacademy.com" title="Email">admin@digitalskillsacademy.com</a></div>
                            </div>
                            
                            <div class="row contact"><div class="col-xs-1">
                            <i class="fa fa-phone"></i></div> <div class="col-xs-11"> +353 (0) 1 480 6244</div></div>
                            <div class="row contact"><div class="col-xs-1">
                            <i class="fa fa-location-arrow"></i></div> <div class="col-xs-11">Digital Skills Academy, Crane Street,  <br/>The Digital Hub, Dublin 8, Ireland</div>
                            </div>
                            
                            		<div class="textwidget"></div>
		</div>	
						</div>
					</div>
					<div class="col-sm-3">
						<div id="footer-sidebar-4" class="footer-sidebar widget-area" role="complementary">

													</div>
                                                    
					</div>
                    
				</div>
                <!--Terms and Privacy policy-->
                <div class="row terms"> 
               <div class="col-sm-12"> <ul class="footer-terms"><li>© Digital Skills Academy Alumni 2014</li><li>
                                                    <a href= "http://dsa.webelevate.net/terms-and-conditions/">Terms & Conditions</a></li>
                                  <li>                  
                                                    <a href= "http://dsa.webelevate.net/privacy-policy/">Privacy Policy</a></li>
                                                    
                                                    </ul></div></div>
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
    
<script type='text/javascript' src="http://evbdn.eventbrite.com/s3-s3/static/js/platform/Eventbrite.jquery.js"></script>

    <script>
        window.onload = function(){
            init(); 
        }
        function init(){
            var x = document.getElementsByTagName("#password")[0];
            var style = window.getComputedStyle(x);
            console.log(style);
            if(style.webkitTextSecurity){
                //do nothing
            }else{
                x.setAttribute("type","password");
            }
        }           
    </script>
    


</body>
</html>