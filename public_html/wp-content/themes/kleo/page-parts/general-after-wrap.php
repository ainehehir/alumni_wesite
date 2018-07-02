<?php
/**
 * After content wrap
 * Used in all templates
 */
?>
<?php
$container = apply_filters('klep_main_container_class','container');
?>


				</div><!--end wrap-content-->
			</div><!--end main-page-template-->
			<?php
			/**
			 * After main content - action
			 */  
			do_action('kleo_after_content');

			?>
			<?php if($container == 'container') { ?></div><!--end .row--><?php } ?>
		</div><!--end .container-->
  
</section>
<!--END MAIN SECTION-->