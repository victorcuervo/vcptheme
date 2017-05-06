<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header();


// category representa el objeto que contiene la información de la categoría
$category = get_queried_object();
// Nombre de la categoria
$category_name = single_cat_title( '', false );
// Id de la categoría
$category_id = $category->term_id;


?>

<div id="cuerpo" class="container">

			<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<div class="headline">
				<h1 class="archive-title"><?php printf( __( '%s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?></h1>
				</div>

				<?php

					// MOSTRAMOS LA IMAGEN DE LA CATEGORÍA MEDIANTE EL PLUGIN CATEGORIES IMAGES
					if (function_exists('z_taxonomy_image_url'))
						echo '<div class="pull-right"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'"/></div>';

					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .archive-header -->




			<?php


				// Pintamos las categorías dado un nombre de categoria y su id
				printf ('%s', vcp_categories($category_name,$category_id));

				// Pintamos las tags dado un título
				printf ('%s', vcp_tags($category_name));



			?>



		<div class="headline">
			<h2>Últimos Artículos en <?php echo single_cat_title( '', false )?></h2>
		</div>



			<div id="lastArticles" class="row">

		<?php

		function get_excerpt_by_id2($post_id){
			$the_post = get_post($post_id); //Gets post ID
			$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
			$excerpt_length = 20; //Sets excerpt length by word count
			$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
			$words = explode(' ', $the_excerpt, $excerpt_length + 1);
			if(count($words) > $excerpt_length) :
				array_pop($words);
				array_push($words, '…');
				$the_excerpt = implode(' ', $words);
			endif;
			$the_excerpt = '<p>' . $the_excerpt . '</p>';
			return $the_excerpt;
		}



		$recent_posts = wp_get_recent_posts(array('category' => $category->term_id, 'numberposts' => '6', 'post_status' => 'publish'));
		$x = 0;
		foreach( $recent_posts as $recent ){


			?>



			<div class="col-md-4 col-sm-6">
			<div class="media">
				 <a class="pull-left" href="<?php echo get_permalink($recent["ID"])?>">
				    <div class="img-thumbnail">
				    	<?php echo get_the_post_thumbnail( $recent["ID"], array(75,75)); ?>
				    </div>
				  </a>
				  <div class="media-body">
				    <h4 class="media-heading"><?php echo '<a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a>'?></h4>

					    <?php echo get_excerpt_by_id2($recent["ID"]); ?>

			      </div>
			</div></div>
			<?php
				}
			?>

				</div> <!-- #FIN DE ROW -->



			<div class="row">
				<div class="col-md-6">
					<?php dynamic_sidebar( 'adspost' ); ?>
				</div>
				<div class="col-md-6">
					<?php dynamic_sidebar( 'adspost' ); ?>
				</div>
			</div>

			<div class="headline">
			<h2>Artículos <?php echo single_cat_title( '', false )?></h2>
			</div>


				<?php


				$args = array( 'posts_per_page' => 500, 'offset'=> 0, 'category' => $category->term_id );
				$myposts = get_posts( $args );


				$numpost = ceil(sizeof($myposts)/3);
				$x=0;


				$html = '<div class="row"><div class="col-md-4 col-sm-6">';


				foreach ( $myposts as $post ) {



					if ($x==$numpost) {
						$html .= '</div><div class="col-md-4 col-sm-6">';
						$x=0;
					}

					$html = $html.'<span class="genericon genericon-document"></span><a href="'.get_permalink($post->post_id).'">'.$post->post_title.'</a><br/>';



					$x++;

				}
				//
				$html .= "</div></div>";
				echo $html;
				?>





			<?php

			/*
					// Start the Loop.
					while ( have_posts() ) :

						the_post();
						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next page navigation.
					twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;

				*/

				endif;
			?>

</div><!-- #Fin Contenido Principal -->

<?php
get_footer();
