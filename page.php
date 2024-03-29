<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="cuerpo" class="container">
	<div class="row">

		<?php
		// Start the Loop.
		while (have_posts()):
			the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part('content', 'page');

			// Previous/next post navigation.
			//twentyfourteen_post_nav();
		
			// If comments are open or we have at least one comment, load up the comment template.
		
		endwhile;
		?>
	</div><!-- #Fin Cuerpo-->
</div><!-- #Fin Contenido Principal -->

<?php
get_footer();