<?php
/**
 * Se muestra el contenido de un post
 *
 * @package vcptheme
 * @version 1.0
 * @since vcptheme 1.0
 */
?>

<div class="col-md-9">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- Main Content -->
		<!-- <div id="content" class="col-6"> -->

		<header>

			<!-- Thumbnail -->
			<div class="w-25 p-3 float-end">
				<?php echo vcp_thumbnail('article') ?>
			</div>
			<div class="w-75 p-1" id="post-info">
				<div id="post-path">
					<a href="/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
							class="bi bi-house-fill" viewBox="0 0 16 16">
							<path
								d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
							<path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
						</svg></a>
					&rarr;
					<?php
					$categories = get_the_category();
					$separator = ',';
					$output = '';
					$category_name = '';
					if ($categories) {
						$category_name = $categories[0]->name;
						foreach ($categories as $category) {
							$output .= '<a href="' . get_category_link($category->term_id) . '" title="' . esc_attr(sprintf(__("Ver todos los artículos de %s"), $category->name)) . '">' . $category->cat_name . '</a>' . $separator;
						}
						echo trim($output, $separator);
					}
					?>
					&rarr;
					<h2>
						<?php the_title(); ?>
					</h2>
				</div>
				<div id="post-date">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
						class="bi bi-calendar-date" viewBox="0 0 16 16">
						<path
							d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
						<path
							d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
					</svg>
					<span>
						<?php
							echo "<strong>Publicado:</strong> ";
							the_date('d/M/Y'); ?>
					</span>


					<?php

						$fecha = get_the_date('d/M/Y');
						$actualizado = get_the_modified_date('d/M/Y');

						if ($fecha != $actualizado):
					?>

					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
					class="bi bi-calendar-date" viewBox="0 0 16 16">
					<path
						d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
					<path
						d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
					</svg>
					<span><strong>Actualizado:</strong> <?php echo $actualizado; ?></span>

					<?php
						endif;
					?>



				</div>
				<div id="post-tags">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
						class="bi bi-tags" viewBox="0 0 16 16">
						<path
							d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
						<path
							d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z" />
					</svg>
					<?php the_tags('<ul class="tags"><li>', '</li><li>', '</li></ul>'); ?>
				</div>
			</div>
		</header><!-- .entry-header -->

		<?php if (is_search()): ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else: ?>
			<div class="entry-content">

				<?php
				the_content(__('Continar leyendo <span class="meta-nav">&rarr;</span>', 'twentyfourteen'));


				wp_link_pages(
					array(
						'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfourteen') . '</span>',
						'after' => '</div>',
						'link_before' => '<span>',
						'link_after' => '</span>',
					)
				);
				?>

			</div><!-- .entry-content -->
		<?php endif; ?>

		<?php
			printf('%s', vcp_codigo_fuente(get_the_title()));
			printf('%s', vcp_codigo_ejecucion());
		?>			

		<div>
			<div class="row">
				<div class="col-lg-6">

					<?php
					// Miramos si tiene vídeo concreto
					$video = get_post_custom_values('video');

					if (isset($video[0]))
						echo vcp_getvideo($category_name, $video[0]);
					else
						echo vcp_getvideo($category_name, null);
					?>
				</div>
				<div class="col-lg-6">
					<?php echo vcp_gettest($category_name); ?>
				</div>
			</div>
		</div>

		<?php dynamic_sidebar('adspost'); ?>

		<?php

		if (comments_open() || get_comments_number()) {
			comments_template();
		}

		// Para editar el Post
		edit_post_link(__('Edit', 'twentyfourteen'), '<span class="edit-link">', '</span>');
		?>


		<!-- </div> -->

	</article><!-- #post-## -->
</div>

<?php get_sidebar(); ?>