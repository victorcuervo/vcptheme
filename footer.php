<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package VCP
 * @subpackage VCP 2
 * @since VCP 2
 */
?>




<!-- Footer -->
	<div id="footer">
		<div class="container">
			<div class="row">

					<div class="col-md-4 col-sm-6"><?php dynamic_sidebar( 'footer1' ); ?></div>
					<div class="col-md-4 col-sm-6"><?php dynamic_sidebar( 'footer2' ); ?></div>
					<div class="col-md-4 col-sm-6"><?php dynamic_sidebar( 'footer3' ); ?></div>
	

			</div>
		</div>



		
	</div>

	<div id="copyright">
		<div class="container">

			<div class="pull-left">
			<?php if ( has_nav_menu( 'menu_footer' ) ) 
				wp_nav_menu( array( 'theme_location' => 'menu_footer','container'=>'','menu_class' =>'footermenu' ) ); 
			?>
			</div>
			

			<span class="pull-right">

			<?php echo get_option('vcp_copyright');?> &copy; <a href="<?php echo get_home_url(); ?>"><?php bloginfo( 'name' ); ?></a> 
			<span> <em><small><a class="text-muted" href="http://www.victorcuervo.com/mis-proyectos/vcp-theme/" target="_blank" title="WordPress VCP Theme">usando VCP Theme</a> </small></em></span> <a href="#"><span class="genericon genericon-uparrow"></span></a> </span>
		</div>


	</div>

	<?php wp_footer(); ?>
</body>
</html>
		