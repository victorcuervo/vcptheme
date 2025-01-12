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
$tag_name = single_tag_title('', false);
$tag_slug = $tag->slug;
$category = substr($tag_name, 0, stripos($tag_name, ' '));


?>

<div id="cuerpo" class="container">


	<?php
	if (have_posts()):
	?>

		<header class="tag-header">
			<div class="w-25 p-3 float-end">
				<?php echo vcp_thumbnail('category', $category) ?>
			</div>
			<div class="headline w-75">
				<h2 class="tag-title">
					<?php printf(__('%s', 'twentyfourteen'), single_tag_title('', false)); ?>
				</h2>
			</div>
		</header>

		<div id="tag-summary">
			<?php
			// Show an optional term description.
			$term_description = term_description();
			if (!empty($term_description)):
				printf('<div class="tag-description">%s</div>', $term_description);
			endif;
			?>
		</div>

		<?php

		// Ponemos la información de volver.
		printf('%s', vcp_volver($tag_slug));

		// Pintamos las tags dado un título
		printf('%s', vcp_tags($tag_name));

		?>

		<div class="row">
			<div class="col-md-12">
				<?php dynamic_sidebar('adspost'); ?>
			</div>
		</div>


		<?php

		// Últimos Artículos
		printf('%s', vcp_get_last_articles($tag_name, 'tag', $tag_slug));

		?>

		<div class="row">
			<div class="col-md-12">
				<?php dynamic_sidebar('adspost'); ?>
			</div>
		</div>

		<div>
			<div class="row">

				<div class="col-md-4 col-sm-6">
					<?php echo vcp_getmanual($category); ?>
				</div>
				<div class="col-md-4 col-sm-6">
					<?php echo vcp_gettest($category); ?>
				</div>				
				<div class="col-md-4 col-sm-6">
					<?php echo vcp_getvideo($category,null); ?>
				</div>


			</div>
		</div>


		<div class="headline">
			<h2>Artículos
				<?php echo single_tag_title('', false) ?>
			</h2>
		</div>

		<div>
			<ul class="article-list">
				<?php

				$args = array('posts_per_page' => 500, 'offset' => 0, 'tag' => $tag->slug);
				$myposts = get_posts($args);
				$html='';
				foreach ($myposts as $post) {
					$html .= '<li><a href="' . get_permalink($post->post_id) . '">' . $post->post_title . '</a></li>';
				}
				echo $html;
				?>
			</ul>
		</div>



		<?php
	endif;
	?>

</div><!-- #Fin Contenido Principal -->

<?php
get_footer();