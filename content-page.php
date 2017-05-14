<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package VCP
 * @subpackage VCP 2
 * @since VCP 2
 */
?>




<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<!-- CONTENIDO PRINCIPAL -->
<div id="content" class="col-md-9">

	<header>

		<div class="headline">
			<?php the_title( '<h2>', '</h2>' ); ?>
		</div>

		<div id="post-info">

			<!-- FECHA -->
			<span class="genericon genericon-month"></span>
			<span><?php the_date('d/M/Y');?></span>


			<!-- COMENTARIOS -->

			<?php
				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
				<span class="genericon genericon-comment"></span>
				<span class="comments-link"><?php comments_popup_link( __( 'Deja un comentario', 'twentyfourteen' ), __( '1 Comentario', 'twentyfourteen' ), __( '% Comentarios', 'twentyfourteen' ) ); ?></span>
			<?php
				endif;
			?>


		</div>


	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">

	<!-- PONEMOS EL THUMBNAIL -->
	<div>
		<?php vcp_thumbnail() ?>
	</div>


			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );


				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>

	</div><!-- .entry-content -->
	<?php endif; ?>


	<?php

	// Si hay ejemplos relacionados los publicamos
	echo vcp_post_ejemplos();

	// Volcamos los vídeos
	$nombre = get_post_custom_values('nombreforo');
	$video = get_post_custom_values('urlvideo');

	if ($video[0]) {
		$shortcode = '[tubepress mode="playlist" playlistValue="'.$video[0].'"]';
		echo '<h3>Vídeos sobre '.$nombre[0].'</h3><div>';
		echo apply_filters('the_content', $shortcode);
		echo '</div>';
	}


	echo '<h3>Comparteme...</h3>';
	echo '<p>Si <strong>te ha gustado el artículo o te ha sido de utilidad</strong>, no dejes de compartirlo con tus amigos en las <strong>redes sociales</strong>... Te estaremos muy agradecidos. :-D</p>';
	echo '<div class="row">';
	if (function_exists('dd_twitter_generate')) {
		echo '<div class="col-md-1 col-sm-1 col-xs-1">';
		dd_twitter_generate('Normal','twitter_username');
		echo '</div>';
	}

	if (function_exists('dd_fblike_generate')) {
		echo '<div class="col-md-1 col-sm-1 col-xs-1">';
		 dd_fblike_generate('Like Box Count');
		echo '</div>';
	}

	if (function_exists('dd_google1_generate')) {
		echo '<div class="col-md-1 col-sm-1 col-xs-1">';
		dd_google1_generate('Normal');
		echo '</div>';
	}

	if (function_exists('dd_linkedin_generate')) {
		echo '<div class="col-md-1 col-sm-1 col-xs-1">';
		dd_linkedin_generate('Normal');
		echo '</div>';
	}

	echo '</div>';

 ?>

<?php dynamic_sidebar( 'adspost' ); ?>

<?php

if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

// Para editar el Post
edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
?>

</div><!-- #FIN DE LA COLUMNA -->


<!-- Sidebar -->
<div id="sidebar" class="col-md-3">


		<div id="author">
			<div class="headline"><h3><?php the_author_meta('first_name'); echo ' '; the_author_meta('last_name') ?> </h3></div>
			<div class="img-thumbnail pull-right">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 86 ); ?>
			</div>
			<div class="author-description"><?php the_author_meta('description');?></div>
			<div class="author-social">
				<?php if (get_the_author_meta('website')):?>
					<a href="<?php the_author_meta('website');?>" target="_blank" rel="author external"><span class="genericon genericon-home"></span></a>
				<? endif; ?>
				<?php if (get_the_author_meta('twitter')):?>
					<a href="<?php the_author_meta('twitter');?>" target="_blank"><span class="genericon genericon-twitter"></span></a>
				<? endif; ?>
				<?php if (get_the_author_meta('facebook')):?>
					<a href="<?php the_author_meta('facebook');?>" target="_blank"><span class="genericon genericon-facebook"></span></a>
				<? endif; ?>
				<?php if (get_the_author_meta('linkedin')):?>
					<a href="<?php the_author_meta('linkedin');?>" target="_blank"><span class="genericon genericon-linkedin"></span></a>
				<? endif; ?>
				<?php if (get_the_author_meta('youtube')):?>
					<a href="<?php the_author_meta('youtube');?>" target="_blank"><span class="genericon genericon-youtube"></span></a>
				<? endif; ?>
				<?php if (get_the_author_meta('googleplus')):?>
					<a href="<?php the_author_meta('googleplus');?>?rel=author" target="_blank"><span class="genericon genericon-googleplus"></span></a>
				<? endif; ?>

			</div>
		</div>

		<?php dynamic_sidebar( 'adslateral' ); ?>


		<?php vcp_informacion_articulo(); ?>


		<div class="headline"><h3><?php echo get_option('vcp_categorias');?></h3></div>

		<div class="row">
			<div class="col-md-6">
			<?php
				$args = array(
				  'orderby' => 'name',
				  'parent' => 0
				  );
				$categories = get_categories( $args );

				$mitad = sizeof($categories)/2;
				$x=1;

				foreach ( $categories as $category ) {
					echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><br/>';
					if ($x==$mitad) echo "</div><div class='col-md-6'>";
					$x++;
				}
			?>
			</div>

		</div>







</div><!-- #FIN CONTENIDO PRINCIPAL -->




</article><!-- #post-## -->
