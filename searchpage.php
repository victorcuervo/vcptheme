<?php
/**
 * Template Name: Search Page
 * The template for displaying Search Results pages
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>


<div id="cuerpo" class="container">
	<div class="row">

			<header class="page-header">
				<h2 class="page-title"><?php printf( __( 'Resultados para: "%s"', 'vcp' ), htmlspecialchars($_GET["q"]) ); ?></h2>
			</header><!-- .page-header -->

			 

            <script>
			  (function() {
			    var cx = 'partner-pub-<?php echo get_option('vcp_search');?>';
			    var gcse = document.createElement('script');
			    gcse.type = 'text/javascript';
			    gcse.async = true;
			    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
			        '//www.google.com/cse/cse.js?cx=' + cx;
			    var s = document.getElementsByTagName('script')[0];
			    s.parentNode.insertBefore(gcse, s);
			  })();
			</script>
			<gcse:searchresults-only></gcse:searchresults-only>


	</div><!-- #Fin Cuerpo-->
</div><!-- #Fin Contenido Principal -->


<?php
get_footer();