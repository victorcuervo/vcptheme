<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */


get_header();

// El objeto TAG que manejamos en la página
$tag = get_queried_object();
$tag_name = single_tag_title( '', false );
$tag_slug = $tag->slug;


?>

<div id="cuerpo" class="container-fluid">


			<?php if ( have_posts() ) :


			?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( '%s', 'twentyfourteen' ), single_tag_title( '', false ) ); ?></h1>

				<?php





					// MOSTRAMOS LA IMAGEN DE LA CATEGORÍA MEDIANTE EL PLUGIN CATEGORIES IMAGES
					/* HAY QUE VALIDAR QUE TIENE URL, SI NO NO METO LA IMAGEN */
					if (function_exists('z_taxonomy_image_url'))
						echo '<img src="'.z_taxonomy_image_url($tag->term_id).'" class="pull-right" alt="'.single_tag_title( '', false ).'"/>';




					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .archive-header -->

			<?php

				// Ponemos la información de volver.
				printf ('%s', vcp_volver($tag_slug));

				// Pintamos las tags dado un título
				printf ('%s', vcp_tags($tag_name));

			?>



		<div class="headline">
			<h2>Últimos Artículos en <?php echo single_tag_title( '', false )?></h2>
		</div>
			<div class="row row-eq-height">

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


		$recent_posts = wp_get_recent_posts(array('tag' => $tag->slug, 'numberposts' => '6', 'post_status' => 'publish'));
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


			<div class="headline">
			<h2>Artículos <?php echo single_tag_title( '', false )?></h2>
			</div>


				<?php



				$args = array( 'posts_per_page' => 500, 'offset'=> 0, 'tag' => $tag->slug) ;

				$myposts = get_posts ( $args );


				$numpost = ceil(sizeof($myposts)/3);
				$x=0;


				$html = '<div class="row"><div class="col-md-4">';


				foreach ( $myposts as $post ) {



					if (($x==$numpost) && ($numpost>0)) {
						$html .= '</div><div class="col-md-4">';
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



				endif;
			?>


</div><!-- #Fin Contenido Principal -->

<?php
get_footer();
