<?php
/**
 * Plantilla para las páginas 404 (Not Found)
 *
 * @package vcptheme
 * @version 1.0
 * @since vcptheme 1.0
 */

get_header(); ?>



<div id="cuerpo" class="container">

	<header>
		<div class="w-25 p-3 float-end">
			<img src="<?php bloginfo('template_directory'); ?>/img/404.png" class="float-end img-fluid"
				alt="Página No Encontrada" />
		</div>

		<div class="headline w-75">
			<h2>Ups! <small>Parece que no encontramos lo que buscas...</small></h2>
		</div>
	</header>
	<div class="row">
		<p>Navega por nuestras <strong>
				<?php echo get_option('vcp_categorias'); ?>
			</strong> a ver si hay suerte.</p>

		<div class="categorias">
			<ul id="categorias">
				<?php
				$args = array(
					'orderby' => 'name',
					'parent' => 0
				);
				$categories = get_categories($args);

				foreach ($categories as $category) {
					echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
				}
				?>

			</ul>
		</div>

	</div><!-- #Fin Cuerpo-->
</div><!-- #Fin Contenido Principal -->

<?php
get_footer();