<?php
/**
 * Plantilla para las páginas 404 (Not Found)
 *
 * @package VCP
 * @subpackage VCP_v2
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="cuerpo" class="container">
	<div class="row">

		<img src="<?php bloginfo( 'template_directory' ); ?>/img/404.png" class="pull-right" alt="Página No Encontrada"/>
		<div class="headline">
			<h2>Ups! <small>Parece que no encontramos lo que buscas...</small></h2>
		</div>
		
		<p>Navega por nuestras <strong><?php echo get_option('vcp_categorias');?></strong> a ver si hay suerte.</p>
		

			<div class="row">
			<div class="col-md-3">
			<?php
				$args = array(
				  'orderby' => 'name',
				  'parent' => 0
				  );
				$categories = get_categories( $args );

				$cuarto = floor(sizeof($categories)/3);
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

	
	</div><!-- #Fin Cuerpo-->
</div><!-- #Fin Contenido Principal -->

<?php
get_footer();