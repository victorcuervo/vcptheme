<?php
 /**
 * Se muestra el contenido de una página
 *
 * @package vcptheme
 * @version 1.0
 * @since vcptheme 1.0
 */
?>

<div class="col-md-9">
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
					<h2><?php the_title(); ?></h2>
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
						<?php the_date('d/M/Y'); ?>
					</span>
				</div>			
			</div>
		</header><!-- .entry-header -->


		<?php if ( is_search() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Seguir leyendo <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) ); ?>

			</div>
		<?php endif; ?>

				
		<?php dynamic_sidebar( 'adspost' ); ?>

		<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		?>
	</article>
</div>
<?php get_sidebar(); ?>