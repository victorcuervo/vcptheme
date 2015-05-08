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
				<h2 class="page-title"><?php printf( __( 'Resultados para: %s', 'vcp' ), get_search_query() ); ?></h2>
			</header><!-- .page-header -->

			<div id="cse-search-results"></div>
			<script type="text/javascript">
			  var googleSearchIframeName = "cse-search-results";
			  var googleSearchFormName = "cse-search-box";
			  var googleSearchFrameWidth = 800;
			  var googleSearchDomain = "www.google.es";
			  var googleSearchPath = "/cse";
			</script>
			<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>

	</div><!-- #Fin Cuerpo-->
</div><!-- #Fin Contenido Principal -->


<?php
get_footer();
