<?php
/**
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package VCP
 * @subpackage VCP 2
 * @since VCP 2
 */

get_header(); ?>

<div id="cuerpo" class="container">
	<div class="row">
		
		<?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );					

				endwhile;
				// Previous/next post navigation.
				//twentyfourteen_paging_nav();

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>

		
	</div><!-- #Fin Cuerpo-->
</div><!-- #Fin Contenido Principal -->

<?php
get_footer();
