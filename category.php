<?php

/**
 * Página que muestra el contenido de una categoría
 *
 * @package vcptheme
 * @version 1.0
 * @since vcptheme 1.0
 */

get_header();

// category representa el objeto que contiene la información de la categoría
$category = get_queried_object();
// Nombre de la categoria
$category_name = single_cat_title('', false);
// Id de la categoría
$category_id = $category->term_id;


?>

<div id="cuerpo" class="container">

	<?php if (have_posts()): ?>

		<header class="category-header">
			<div class="w-25 p-3 float-end">
				<?php echo vcp_thumbnail('category',$category_name) ?>
			</div>
			<div class="headline w-75">
				<h2 class="category-title">
					<?php printf(__('%s', 'twentyfourteen'), single_cat_title('', false)); ?>
				</h2>
			</div>
		</header>

		<div id="category-summary">
			<?php
				// Show an optional term description.
				$term_description = term_description();
				if (!empty($term_description)):
					printf('<div class="category-description">%s</div>', $term_description);
				endif;
			?>
		</div>

		<?php

		// Pintamos las categorías dado un nombre de categoria y su id
		printf('%s', vcp_categories($category_name, $category_id));

		// Pintamos las tags dado un título
		printf('%s', vcp_tags($category_name));

		?>

		<div class="row">
			<div class="col-md-12">
				<?php dynamic_sidebar('adspost'); ?>
			</div>
		</div>


		<?php 
			printf('%s', vcp_get_last_articles($category_name,'category',$category_id));
		?>

		<div class="row">
			<div class="col-md-12">
				<?php dynamic_sidebar('adspost'); ?>
			</div>
		</div>

		<div>
			<div class="row">

				<div class="col-md-4 col-sm-6">
					<?php echo vcp_getmanual(single_cat_title('', false)); ?>
				</div>
				<div class="col-md-4 col-sm-6">
					<?php echo vcp_gettest(single_cat_title('', false)); ?>
				</div>
				<div class="col-md-4 col-sm-6">
					<?php echo vcp_getvideo(single_cat_title('', false), null); ?>
				</div>


			</div>
		</div>


		<div class="headline">
			<h2>Artículos
				<?php echo single_cat_title('', false) ?>
			</h2>
		</div>

		<div>
			<ul class="article-list">
				<?php

				$args = array('posts_per_page' => 500, 'offset' => 0, 'category' => $category->term_id);
				$myposts = get_posts($args);
				$html='';
				foreach ($myposts as $post) {
					$html .= '<li><a href="' . get_permalink($post->post_id) . '">' . $post->post_title . '</a></li>';
				}
				echo $html;
				?>
			</ul>
		</div>


	<?php endif; ?>

</div><!-- #Fin Contenido Principal -->

<?php
get_footer();