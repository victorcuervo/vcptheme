<?php
/**
 * Twenty Fourteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfourteen_setup' ) ) :
/**
 * Twenty Fourteen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_setup() {

	// This theme uses wp_nav_menu() in two locations.

	// REGISTRAMOS LOS DOS MENÚS QUE VAMOS A UTILIZAR
	register_nav_menus( array(
		'primary'   => __( 'Menú Superior', 'twentyfourteen' ),
		'secondary' => __( 'Menú Elementos Importantes', 'twentyfourteen' ),
		'menu_footer' => __( 'Menú del pie de página', 'vcp')
	) );


	// Aceptamos ShortCode en Menús
	if ( ! has_filter( 'wp_nav_menu', 'do_shortcode' ) ) {
		add_filter( 'wp_nav_menu', 'shortcode_unautop' );
		add_filter( 'wp_nav_menu', 'do_shortcode', 11 );
	}

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	//add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url() ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.


	// Add img-fluid class to all images in the content
	function vcp_add_img_fluid_class($content) {
		$content = preg_replace('/<img(.*?)class="(.*?)"/', '<img$1class="$2 img-fluid"', $content);
		$content = preg_replace('/<img(.*?)class=\'(.*?)\'/', '<img$1class=\'$2 img-fluid\'', $content);
		$content = preg_replace('/<img((?!class=)[^>])+>/', '<img class="img-fluid"$1>', $content);
		return $content;
	}
	add_filter('the_content', 'vcp_add_img_fluid_class');

	/* 
	
	REVISAR YA QUE SON LAS IMAGENES PARA EL THUMBNAIL
	
	*/




	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'twentyfourteen_setup' );




/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'twentyfourteen_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function twentyfourteen_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Twenty Fourteen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'twentyfourteen_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function twentyfourteen_has_featured_posts() {
	return ! is_paged() && (bool) twentyfourteen_get_featured_posts();
}

/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function vcp_widgets_init() {



// MIS WIDGETS

	// Widget de Entradas Recientes
	require get_template_directory() . '/inc/VCP_Recent_Widget.php';
	register_widget( 'VCP_Recent_Widget' );


 // MIS AREAS DE FOOTER

	register_sidebar( array(
			'name'          => __( 'Pie de Página Izquierdo', 'vcp' ),
			'id'            => 'footer1',
			'description'   => __( 'Aparece abajo a la izquierda.', 'vcp' ),
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="headline"><h3>',
			'after_title'   => '</h3></div>',
		) );


	register_sidebar( array(
			'name'          => __( 'Pie de Página Central', 'vcp' ),
			'id'            => 'footer2',
			'description'   => __( 'Aparece abajo en el centro.', 'vcp' ),
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="headline"><h3>',
			'after_title'   => '</h3></div>',
		) );

	register_sidebar( array(
		'name'          => __( 'Pie de Página Derecho', 'vcp' ),
		'id'            => 'footer3',
		'description'   => __( 'Aparece abajo a la derecha.', 'vcp' ),
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="headline"><h3>',
		'after_title'   => '</h3></div>',
	) );


	// Sidebar Lateral
register_sidebar( array(
		'name'          => __( 'Sidebar Lateral', 'vcp' ),
		'id'            => 'sidebarlateral',
		'description'   => __( 'Aparece en la barra izquierda', 'vcp' ),
		'before_widget' => '<div class="sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="headline"><h4>',
		'after_title'   => '</h4></div>',
	) );

	// Áreas de Publicidad
	register_sidebar( array(
		'name'          => __( 'Publicidad Lateral', 'vcp' ),
		'id'            => 'adslateral',
		'description'   => __( 'Aparece en la barra derecha', 'vcp' ),
		'before_widget' => '<div class="ads">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Publicidad en el Post', 'vcp' ),
		'id'            => 'adspost',
		'description'   => __( 'Aparece dentro del post', 'vcp' ),
		'before_widget' => '<div class="ads">',
		'after_widget'  => '</div>'
	) );


	register_sidebar( array(
		'name'          => __( 'Publicidad Cabecera', 'vcp' ),
		'id'            => 'adscabecera',
		'description'   => __( 'Aparece en la cabecera', 'vcp' ),
		'before_widget' => '<div class="ads">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Categoria Izquierda', 'vcp' ),
		'id'            => 'cat1',
		'description'   => __( 'Aparece en la categoría a la izquierda.', 'vcp' ),
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="headline"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Categoria Centro', 'vcp' ),
		'id'            => 'cat2',
		'description'   => __( 'Aparece en la categoría en el centro.', 'vcp' ),
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="headline"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Categoria Derecha', 'vcp' ),
		'id'            => 'cat3',
		'description'   => __( 'Aparece en la categoría a la derecha.', 'vcp' ),
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="headline"><h3>',
		'after_title'   => '</h3></div>',
	) );


}
add_action( 'widgets_init', 'vcp_widgets_init' );



/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function vcp_scripts() {

	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.0' );
	wp_enqueue_style( 'vcp-style', get_stylesheet_uri());
	wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.0',true);

	// Metemos el estilo de una fuente de Google
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap', array(), '1.0' );
	wp_style_add_data( 'google-fonts', 'preload', 'true' );

	// Quitamos los de Guttemberg
	wp_dequeue_style( 'wp-block-library');
	wp_dequeue_style( 'wp-block-library-theme' );

	if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
		wp_enqueue_script( 'comment-reply' );

	if (is_singular())
		wp_enqueue_script( 'github', 'https://buttons.github.io/buttons.js',null, '1.0',false);


}
add_action( 'wp_enqueue_scripts', 'vcp_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
/*
function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );

*/

if ( ! function_exists( 'twentyfourteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'twentyfourteen_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'twentyfourteen' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} else {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );



function my_new_contactmethods( $contactmethods ) {

    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['youtube'] = 'YouTube';
    $contactmethods['linkedin'] = 'LinkedIn';
	$contactmethods['github'] = 'Github';
	$contactmethods['instagram'] = 'Instagram';
    return $contactmethods;

}

add_filter('user_contactmethods','my_new_contactmethods',10,1);



/* WALKER DE LOS COMENTARIOS */
require get_template_directory() . '/inc/comments-walker.php';


function vcp_get_rss($nombre, $url, $numeroitems) {

	$html.= '<h3>Ejemplos sobre '.$nombre.'</h3>'.
			'<p>Te adjuntamos algunos ejemplos sobre '.$nombre.' relacionados con el tema tratado.</p>';

	// Get a SimplePie feed object from the specified feed source.
	$rss = fetch_feed( $url);

	if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly
    	// Figure out how many total items there are, but limit it to 5.
    	$maxitems = $rss->get_item_quantity( $numeroitems );

    	// Build an array of all the items, starting with element 0 (first element).
    	$rss_items = $rss->get_items( 0, $maxitems );

	endif;

	$html.=  '<ul>';
	if ( $maxitems != 0 ) :
        foreach ( $rss_items as $item ) :
            $html.=  '<li><a href="';
            $html.=  esc_url( $item->get_permalink() ).'"';
            $html.=  ' title="';
            //printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') );
            $html.=  '">'.esc_html( $item->get_title() );
            $html.=  '</a></li>';
        endforeach;
    endif;
	$html.=  '</ul>';

	return $html;

}

/* Función que devuelve la información de descarga, manual, test,... del artículo */

function vcp_informacion_articulo() {


		$nombre = get_post_custom_values('nombreforo');
		$descargar = get_post_custom_values('descargar');
		$visualizar = get_post_custom_values('visualizar');
		$errorcodigo = get_post_custom_values('errorcodigo');
		$urlcharla = get_post_custom_values('urlcharla');
		$urlforo = get_post_custom_values('urlforo');
		$urltest = get_post_custom_values('urltest');
		$urlmanual = get_post_custom_values('urlmanual');
		$urlcurso = get_post_custom_values('urlcurso');

		$html = '';

		if (isset($visualizar[0])) {
			$html = '<div class="col-6 col-sm-4 col-md-6">';
			$html .= '<a href="'.$visualizar[0].'" target="_blank">';
			$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/play.png" alt="Visualizar Ejemplo"/></a>';
			$html .= '<p class="text-center"><a href="'.$visualizar[0].'">Ejecutar el Ejemplo</a></p>';
			$html .= '</div>';
		}


		if (isset($descargar[0])) {
			$html .= '<div class="col-6 col-sm-4 col-md-6">';
			$html .= '<a href="'.$descargar[0].'" target="_blank">';
			$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/download.png" alt="Descargar Ejemplo"/></a>';
			$html .= '<p class="text-center"><a href="'.$descargar[0].'">Descargar Código Fuente</a></p>';
			$html .= '</div>';
		}


		if (isset($errorcodigo[0])) {
			$html .= '<div class="col-6 col-sm-4 col-md-6">';
			$html .= '<a href="'.$errorcodigo[0].'" target="_blank">';
			$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/error.png" alt="Reportar Error"/></a>';
			$html .= '<p class="text-center"><a href="'.$errorcodigo[0].'">Error en el Código</a></p>';
			$html .= '</div>';
		}


		if (isset($nombre[0]) && isset($urlforo[0])) {
			$html .= '<div class="col-6 col-sm-4 col-md-6">';
			$html .= '<a href="'.$urlforo[0].'" target="_blank">';
			$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/question.png" alt="Foro para Dudas '.$nombre[0].'"/></a>';
			$html .= '<p class="text-center"><a href="'.$urlforo[0].'">Preguntas de '.$nombre[0].'</a></p>';
			$html .= '</div>';
		}


		if (isset($nombre[0]) && isset($urlmanual[0])) {
			$html .= '<div class="col-6 col-sm-4 col-md-6">';
			$html .= '<a href="'.$urlmanual[0].'" target="_blank">';
			$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/manual.png" alt="Manual sobre '.$nombre[0].'"/></a>';
			$html .= '<p class="text-center"><a href="'.$urlmanual[0].'">Manual de '.$nombre[0].'</a></p>';
			$html .= '</div>';
		}


		if (isset($nombre[0]) && isset($urltest[0])) {
			$html .= '<div class="col-6 col-sm-4 col-md-6">';
			$html .= '<a href="'.$urltest[0].'" target="_blank">';
			$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/test.png" alt="Test de '.$nombre[0].'"/></a>';
			$html .= '<p class="text-center"><a href="'.$urltest[0].'">Test sobre '.$nombre[0].'</a></p>';
			$html .= '</div>';
		}


		if (isset($nombre[0]) && isset($urlcharla[0])) {
			$html .= '<div class="col-6 col-sm-4 col-md-6">';
			$html .= '<a href="'.$urlcharla[0].'" target="_blank">';
			$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/talk.png" alt="Charla sobre '.$nombre[0].'"/></a>';
			$html .= '<p class="text-center"><a href="'.$urlcharla[0].'">Charla sobre '.$nombre[0].'</a></p>';
			$html .= '</div>';
		}


		if (isset($nombre[0]) && isset($urlcurso[0])) {
			$html .= '<div class="col-6 col-sm-4 col-md-6">';
			$html .= '<a href="'.$urlcurso[0].'" target="_blank">';;
			$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/curso.png" alt="Curso de '.$nombre[0].'"/></a>';
			$html .= '<p class="text-center"><a href="'.$urlcurso[0].'">Curso de '.$nombre[0].'</a></p>';
			$html .= '</div>';
		}

		$cabecera = '<div class="headline"><h3>Artículo</h3></div>'.
						'<div class="panel panel-primary">'.
							'<div class="panel-body">'.
								'<div class="row">';
		$pie = '</div>
					</div>
						</div>';

		if ($html!='')
			echo $cabecera.$html.$pie;


}


function vcp_volver($slug) {

/*
 * Función que recibe un slug para crear un volver utilizando su slug.
 * El volver puede ser una categoría, si no es una categoría es una etiqueta
 * Por ejemplo:
 *  google-calendar-eventos-repetitivos
 *  la categiría es google calendar
 *  si google-calendar-eventos es una categoria uso el CATEGORY
 *  si no uso el TAG
 */

	// Quitamos el último término
	$slug_a_buscar = substr($slug,0,strrpos($slug,'-'));

	// Validamos si es una categoría
	$categoria = get_category_by_slug($slug_a_buscar);

	if (empty($categoria)) {
		// Si no es una categoría lo buscamos como tag
		$etiqueta = get_term_by('slug',$slug_a_buscar,'post_tag');

		// Comprobamos que sea una etiqueta
		if ((isset($etiqueta)) && (isset($etiqueta->term_id))) {
			$etiqueta_link = get_tag_link($etiqueta->term_id);
			return "<i class='fa-solid fa-backward'></i> <a href='{$etiqueta_link}' title='Elementos {$etiqueta->name}' class='{$etiqueta->slug}'>Volver a {$etiqueta->name}</a>";
		} else {
			return '';
		}
	} else {
		$categoria_link = get_category_link($categoria->term_id);
		return "<i class='fa-solid fa-backward'></i> <a href='{$categoria_link}' title='Elementos {$categoria->name}' class='{$categoria->slug}'>Volver a {$categoria->name}</a>";
	}


}



function vcp_tags($nombre) {

/*
 * Función que devuelve una estructura de etiquetas a partir de un nombre recibido como parámetro.
 * Serían las tags que coinciden con dicho nombre
 */

	/*
	// Buscamos tags con el nombre y un espacio
	$tags = get_tags(array('name__like'=>$nombre.' '));

	$html = '';


	if (sizeof($tags)>0) {

		$html = '<div class="headline"><h2>Elementos de '.$nombre.'</h2></div>';
		$html .= '<div class="row"><div class="col-md-3 col-sm-6 col-xs-6">';

		$numtags = ceil(sizeof($tags)/4);

		$x=0;

		foreach ( $tags as $tag ) {

			$tag_link = get_tag_link( $tag->term_id );

			if($x==$numtags) {
				$html .= '</div><div class="col-md-3 col-sm-6 col-xs-6">';
				$x=0;
			}

			$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
			$html .= "{$tag->name}</a><br/>";
			$x++;
		}

		$html .= '</div></div>';


	}

	return $html;
	*/

	
	// Buscamos tags con el nombre y un espacio
	$tags = get_tags(array('name__like'=>$nombre.' '));

	$html = '';


	if (sizeof($tags)>0) {

		$html = '<div class="headline"><h2>Elementos de '.$nombre.'</h2></div>';
		$html .= '<div><ul class="tag-list">';


		foreach ( $tags as $tag ) {

			$tag_link = get_tag_link( $tag->term_id );


			$html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
			$html .= "{$tag->name}</a></li>";
		}

		$html .= '</ul></div>';


	}

	return $html;


}


function vcp_categories($nombre,$id) {

	/*
	* Función que devuelve una estructura de categorias a partir de un nombre e id de categoria recibido como parámetro.
	* Serían las subcategorías de una categoría
	*/


	$categorias = get_categories(array('child_of'=>$id));
	$html = '';

	if (sizeof($categorias)>0) {

		$html = '<div class="headline"><h2>Categorías de '.$nombre.'</h2></div>';
		$html .= '<div class="row"><div class="col-md-3 col-sm-6 col-xs-6">';

		$numcategs = ceil(sizeof($categorias)/4);

		$x=0;

		foreach ( $categorias as $categoria ) {

			$categoria_link = get_category_link($categoria->term_id);

			if($x==$numcategs) {
				$html .= '</div><div class="col-md-3 col-sm-6 col-xs-6">';
				$x=0;
			}

			$html .= "<a href='{$categoria_link}' title='{$categoria->name} Tag' class='{$categoria->slug}'>{$categoria->name}</a><br/>";
			$x++;
		}

		$html .= '</div></div>';


	}

	return $html;

}


function vcp_thumbnail($option,$category = '') {
	/* 
	
		Función que gestiona como se mostrará el thumbnail de las páginas y
		post, si est centrado o a la izquierda 

		El parametro $option puede indicar que sea del artículo o de la categoría
		ya que se recupera la imagen de diferentes sitios:
			- article
			- category

		Para las imágenes de categoría hay que comprobar que está la extensión
		
	*/

	$imagen = '';
	
	// Buscamos la imagen
	if ($option == 'article')
		$imagen = get_the_post_thumbnail_url(null, 'full');
	else if (($option == 'category') && function_exists('z_taxonomy_image_url') && z_taxonomy_image_url()) 
		$imagen = z_taxonomy_image_url();

	if ($imagen != '')			
		return '<img src="'.$imagen.'" class="img-fluid" alt="Artículos '.$category.'">';
	else 
		return '';

	

	/*

		$sitiothumb =  get_option('vcp_thumbnail');
		if ($sitiothumb == 'center')
		$html .= the_post_thumbnail( 'full', array('class'=>"center-block img-responsive img-cabecera"));
	else if ($sitiothumb == 'left')
		$html .= the_post_thumbnail( 'full', array('class'=>"pull-left img-responsive thumb"));
	else
	*/

}





/* IMPLEMENTA FUNCIONES EN OTROS FICHEROS */

// Capacidades de la cabecera
// require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
//require get_template_directory() . '/inc/template-tags.php';

// Añade las capacidades de customización del tema
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	//require get_template_directory() . '/inc/featured-content.php';
}
/*** Remove Query String from Static Resources ***/
function remove_cssjs_ver( $src ) {
 if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );



/* Personalización de los elementos li y a del menú */

function _namespace_menu_item_class( $classes, $item ) {       
    $classes[] = "nav-item"; // you can add multiple classes here
    return $classes;
} 
function _namespace_menu_anchor_class( $atts, $item, $args ) {    
    $atts['class'] = "nav-link";
    return $atts;
}

add_filter( 'nav_menu_css_class' , '_namespace_menu_item_class' , 10, 2 );
add_filter( 'nav_menu_link_attributes', '_namespace_menu_anchor_class', 10, 3 );




function vcp_getmanual($category) {

	$cats = [
		'Javascript' => ['/img/tutorials/javascript.png','https://manualweb.net/javascript?utm_source=lineadecodigo&utm_medium=download&utm_id=javascript&utm_campaign=book'],
		'HTML5' =>  ['/img/tutorials/html5.jpeg','https://manualweb.net/html5?utm_source=lineadecodigo&utm_medium=download&utm_id=html5&utm_campaign=book'],
		'Java' =>  ['/img/tutorials/java.jpeg','https://manualweb.net/java?utm_source=lineadecodigo&utm_medium=download&utm_id=javas&utm_campaign=book'],
		'MongoDB' =>  ['/img/tutorials/mongodb.jpeg','https://manualweb.net/mongodb?utm_source=lineadecodigo&utm_medium=download&utm_id=mongodb&utm_campaign=book'],
		'Python' =>  ['/img/tutorials/python.jpeg','https://manualweb.net/python?utm_source=lineadecodigo&utm_medium=download&utm_id=python&utm_campaign=book'],
		'Dart' => ['/img/tutorials/dart.webp','https://manualweb.net/dart?utm_source=lineadecodigo&utm_medium=download&utm_id=python&utm_campaign=book'],
		'CSS' => ['/img/tutorials/css.webp','https://manualweb.net/css?utm_source=lineadecodigo&utm_medium=download&utm_id=python&utm_campaign=book']
	];
	
	$respuesta = '';

	if (isset($cats[$category]))
		$respuesta =  '<div class="headline"><h4>Manual '.$category.'</h4></div>'
				.'<p class="manual">Aprende más sobre '.$category.' <a href="'.$cats[$category][1].'">consultando online o descargando nuestro manual</a>.'
				.'<div><a href="'.$cats[$category][1].'"><img class="img-fluid" src="'.get_template_directory_uri().$cats[$category][0].'"  alt="Tutorial '.$category.'"/></a></div>';

	return $respuesta;

}

function vcp_gettest($category) {

	$cats = [
		'Javascript' => ['/img/tests/javascript.png','https://testprogramacion.com/javascript/'],
		'Java' => ['/img/tests/java.png','https://testprogramacion.com/java/'],
		'HTML5' => ['/img/tests/html5.png','https://testprogramacion.com/html5/'],
		'HTML' => ['/img/tests/html.png','https://testprogramacion.com/html/'],
		'CSS' => ['/img/tests/css.png','https://testprogramacion.com/css/'],
		'Bootstrap' => ['/img/tests/bootstrap.png','https://testprogramacion.com/bootstrap/'],
		'MongoDB' => ['/img/tests/mongodb.png','https://testprogramacion.com/mongodb/'],		
	];

	$respuesta = '';
	
	if (isset($cats[$category]))
		$respuesta =  '<div class="headline"><h4>Test '.$category.'</h4></div>'
					.'<p class="test">¿Te atreves a probar tus <a href="'.$cats[$category][1].'">habilidades y conocimiento en '.$category.'</a> con nuestro test?'
					.'<div><a href="'.$cats[$category][1].'"><img class="img-fluid" src="'.get_template_directory_uri().$cats[$category][0].'"  alt="Test '.$category.'"/></a></div>';

	return $respuesta;

}

function vcp_getvideo($category,$video) {

	$cats = [
		'Bootstrap' => ['PLLVIhySQmrVZGCCZGraNWZsYl17aVQF2G'],
		'HTML5' => ['PLLVIhySQmrVZvt63iAl2xSwTePNmd-UhI'],
		'MongoDB' => ['PLLVIhySQmrVZGA6RpEkZJEH3rQOrHbi_c'],
		'Javascript' => ['PLLVIhySQmrVaRju-qP84x9YRqTtA_GmfK'],
		'Java' => ['PLLVIhySQmrVbjCFPla5c0OIp6iNWfM-hq'],
		'HTML' => ['PLLVIhySQmrVaaLfsbi9VHVffq3Kk8KAST'],
	];

	$respuesta = '';

	// Comprobamos si enlazar a un vídeo en concreto
	if (isset($video))
		$codigovideo = 'https://www.youtube.com/watch?v='.$video;
	else if (isset($cats[$category]))
		$codigovideo = 	'https://www.youtube.com/embed/videoseries?list='.$cats[$category][0];

	if (isset($codigovideo))
		$respuesta  = '<div class="headline"><h4>Vídeos sobre '.$category.'</h4></div>'
			.'<script src="https://apis.google.com/js/platform.js"></script>'
			.'<p class="video">Disfruta también de nuestros artículos sobre '.$category.' en formato vídeo. Aprovecha y <a href="https://www.youtube.com/lineadecodigo">suscribete a nuestro canal</a>.</p>'
			.'<div class="g-ytsubscribe" data-channel="lineadecodigo" data-layout="default" data-count="default"></div>'
			.'<div class="ratio ratio-16x9">'
			.'<iframe src="'.$codigovideo.'" allowfullscreen></iframe>'
			.'</div>';

	return $respuesta;

}


/*
	Función que recibe el id de un psot y recupera el resumen de texto.
*/

function vcp_get_excerpt_by_id($post_id)
{
	$the_post = get_post($post_id); //Gets post ID
	$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	$excerpt_length = 20; //Sets excerpt length by word count
	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
	$words = explode(' ', $the_excerpt, $excerpt_length + 1);
	if (count($words) > $excerpt_length):
		array_pop($words);
		array_push($words, '…');
		$the_excerpt = implode(' ', $words);
	endif;
	$the_excerpt = '<p>' . $the_excerpt . '</p>';
	return $the_excerpt;
}


function vcp_get_last_articles($categoria,$filtro,$valor_filtro) {

	/*
		Función que nos devuelve la estructura de un máximo de 6 artículos que representan los
		últimos artículos de una categoría, etiqueta o globales

		El filtro elige sin es category o tag
	*/

	$content = '<section id="last-articles"><header class="headline">';

	if (isset($categoria))
		$content .= '<h2>Últimos Códigos en '.$categoria.'</h2>';
	else 
		$content .= '<h2>Últimos Códigos</h2>';

	$content .= '</header>';

	$content.= '<div class="row row-eq-height">';

	$recent_posts = wp_get_recent_posts(array($filtro => $valor_filtro, 'numberposts' => '6', 'post_status' => 'publish'));
	$x = 0;
	foreach ($recent_posts as $recent) {

		$content .= '<div class="col-md-4 col-sm-6">'
						.'<div class="last-articles d-flex">'
							.'<div class="flex-shrink-0">'
								.'<a href="'.get_permalink($recent["ID"]).'">'
								.'<div class="img-thumbnail rounded float-start">'
								.get_the_post_thumbnail($recent["ID"], array(75, 75))
								.'</div>'
								.'</a>'
							.'</div>'
							.'<div class="flex-grow-1 ms-3">'
								.'<h4 class="media-heading">'
								.'<a href="' . get_permalink($recent["ID"]) . '" title="' . esc_attr($recent["post_title"]) . '" >' . $recent["post_title"] . '</a>'
								.'</h4>'
								.vcp_get_excerpt_by_id($recent["ID"])																
							.'</div>'
						.'</div>'
					.'</div>';

	}
	$content .= '</div></section>';

	return $content;

}

function vcp_codigo_fuente($titulo) {

	$urlcodigo = get_post_custom_values('descargar');
	$imgcodigo = get_post_custom_values('codigo');
	$srepo = '';

	// Recuperamos el repositio de github
	// Puede haber alguna URL erronea todavía apuntando a code.
	
	if ((isset($urlcodigo)) && (str_contains($urlcodigo[0],'github.com'))) {
		$inicio = strpos($urlcodigo[0], '/',9); // Empiezo evistando el http:// o https://
		$primerslash = strpos($urlcodigo[0], '/',$inicio+1);
		$segundoslash = strpos($urlcodigo[0], '/',$primerslash+1);
		$repo = substr($urlcodigo[0],$inicio+1,$segundoslash-$inicio-1);
	}


	$content = '';

	if ($urlcodigo != '' && str_contains($urlcodigo[0],'github.com'))
		$content = '<div class="headline">'
							.'<h4>Código Fuente</h4>'
						.'</div>'
						.'<div>'
							.'Descárgate el código fuente de <strong><a href="'.$urlcodigo[0].'" target="_blank">'.$titulo.'</a></strong><br>'
							.'<span>Y si te ha gustado nuestro código fuente puedes regalarnos una estrella</span> '							
							.'<span class="align-middle"><a class="github-button" href="https://github.com/'.$repo.'" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star victorcuervo/lineadecodigo_html on GitHub">Star</a></span>'
						.'</div>';
		
		if ($imgcodigo != '')
			$content.='<div class="p-3">'
						.'<a href="'.$urlcodigo[0].'" target="_blank">'
						.'<img class="img-fluid mx-auto d-block" src="'.$imgcodigo[0].'" alt="'.$titulo.'">' 
						.'</a></div>';

	return $content;

	
}

function vcp_codigo_ejecucion() {

	$urlrun = get_post_custom_values('run');
	$content = '';

	if ($urlrun != '')
		$content = '<div class="headline">'
							.'<h4>Ejecuta el Código</h4>'
						.'</div>'
						.'<div class="ratio ratio-16x9">'
							.'<iframe height="400px" src="https://onecompiler.com/embed/'.$urlrun[0].'" width="100%"></iframe>'							
						.'</div>';
		
	return $content;

}


/*
	Función que genera el texto para ayuda en los comentarios y que redirige al foro.

*/
function vcp_foro($category) {

	$cats = [
		'AJAX' => 'https://dudasprogramacion.com/javascript?utm_source=lineadecodigo&utm_medium=question&utm_id=javascript&utm_campaign=forum',
		'Bootstrap' => 'https://dudasprogramacion.com/html/bootstrap?utm_source=lineadecodigo&utm_medium=question&utm_id=bootstrap&utm_campaign=forum',
		'CSS' => 'https://dudasprogramacion.com/html/css?utm_source=lineadecodigo&utm_medium=question&utm_id=css&utm_campaign=forum',
		'EmberJS' => 'https://dudasprogramacion.com/javascript/emberjs?utm_source=lineadecodigo&utm_medium=question&utm_id=emberjs&utm_campaign=forum',
		'Google' => 'https://dudasprogramacion.com/api/api-google?utm_source=lineadecodigo&utm_medium=question&utm_id=api-google&utm_campaign=forum',
		'Groovy' => 'https://dudasprogramacion.com/java/groovy?utm_source=lineadecodigo&utm_medium=question&utm_id=groovy&utm_campaign=forum',
		'HTML' => 'https://dudasprogramacion.com/html?utm_source=lineadecodigo&utm_medium=question&utm_id=html&utm_campaign=forum',
		'HTML5' => 'https://dudasprogramacion.com/html/html5?utm_source=lineadecodigo&utm_medium=question&utm_id=html5&utm_campaign=forum',
		'Java' => 'https://dudasprogramacion.com/java?utm_source=lineadecodigo&utm_medium=question&utm_id=java&utm_campaign=forum',
		'Javascript' => 'https://dudasprogramacion.com/javascript?utm_source=lineadecodigo&utm_medium=question&utm_id=javascript&utm_campaign=forum',
		'jQuery' => 'https://dudasprogramacion.com/javascript/jquery?utm_source=lineadecodigo&utm_medium=question&utm_id=jquery&utm_campaign=forum',
		'DotNet' => 'https://dudasprogramacion.com/net?utm_source=lineadecodigo&utm_medium=question&utm_id=dotnet&utm_campaign=forum',
		'MongoDB' => 'https://dudasprogramacion.com/bases-de-datos/mongodb?utm_source=lineadecodigo&utm_medium=question&utm_id=mongodb&utm_campaign=forum',
		'NodeJS' => 'https://dudasprogramacion.com/javascript/nodejs?utm_source=lineadecodigo&utm_medium=question&utm_id=nodejs&utm_campaign=forum',
		'PHP' => 'https://dudasprogramacion.com/php?utm_source=lineadecodigo&utm_medium=question&utm_id=php&utm_campaign=forum',
		'Prototype' => 'https://dudasprogramacion.com/javascript?utm_source=lineadecodigo&utm_medium=question&utm_id=prototype&utm_campaign=forum',
		'Python' => 'https://dudasprogramacion.com/python?utm_source=lineadecodigo&utm_medium=question&utm_id=python&utm_campaign=forum',
		'ReactJS' => 'https://dudasprogramacion.com/javascript/reactjs?utm_source=lineadecodigo&utm_medium=question&utm_id=react&utm_campaign=forum',
		'SQL' => 'https://dudasprogramacion.com/bases-de-datos/sql?utm_source=lineadecodigo&utm_medium=question&utm_id=sql&utm_campaign=forum',
		'SVG' => 'https://dudasprogramacion.com/html/svg?utm_source=lineadecodigo&utm_medium=question&utm_id=svg&utm_campaign=forum',
		'Symfony' => 'https://dudasprogramacion.com/php/symfony?utm_source=lineadecodigo&utm_medium=question&utm_id=symfony&utm_campaign=forum',
		'Typescript' => 'https://dudasprogramacion.com/javascript/typescript?utm_source=lineadecodigo&utm_medium=question&utm_id=typescript&utm_campaign=forum',
		'XML' => 'https://dudasprogramacion.com/xml?utm_source=lineadecodigo&utm_medium=question&utm_id=xml&utm_campaign=forum',
	];


	if (isset($cats[$category]))
	 	return '<div class="alert alert-success" role="alert">Antes de enviar tu pregunta comprueba que tiene que ver sobre este artículo. Si tienes alguna <strong>pregunta de caracter general</strong> o necesitas <strong>ayuda con un ejercicio</strong> te recomiendo que <a href="'.$cats[$category].'" target="_blank">utilices nuestro foro sobre '.$category.'</a></div>';

}