<?php
/**
 * Template Name: Home Page
 * Plantilla para la p�gina principal
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */


get_header(); ?>

<div id="cuerpo" class="container">

		

			<?php if ( have_posts() ) : the_post(); the_content();?>

	
		<div class="headline">
			<h2>Últimos Artículos</h2>
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
		
		$category = get_queried_object();

		$recent_posts = wp_get_recent_posts(array('numberposts' => '6', 'post_status' => 'publish'));
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
			<h2><?php echo get_option('vcp_categorias');?></h2>
		</div>
			<div class="row">
			<div class="col-md-3">
			<?php
				$args = array(
				  'orderby' => 'name',
				  'parent' => 0
				  );
				$categories = get_categories( $args );

				$cuarto = floor(sizeof($categories)/4);
				$x=0;

				foreach ( $categories as $category ) {
					echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><br/>';
					if ($x==$cuarto) {
						echo "</div><div class='col-md-3'>";
						$x=0;
					} else
						$x++;
				}
			?>
			</div>

		</div>

			
				



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