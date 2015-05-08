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
		'before_title'  => '<div class="headline"><h3>',
		'after_title'   => '</h3></div>',
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
		'before_widget' => '<div class="ads col-md-8 hidden-sm hidden-xs">',
		'after_widget'  => '</div>'
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
	
	// METEMOS BOOTSRAP
	
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.1.1' );
	wp_enqueue_style( 'vcp-style', get_stylesheet_uri());
	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '3.1.1',true);
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.2' );


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
    $contactmethods['googleplus'] = 'Google Plus';
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



function vcp_post_ejemplos() {

	$nombre = get_post_custom_values('nombreforo');
	$ejemplos = get_post_custom_values('urlejemplos');

	 $html = '';
	
	if ($ejemplos[0])
		 $html .= vcp_get_rss($nombre[0], $ejemplos[0], 10);

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
	 			
				if ($visulizar[0]) {
	 				$html = '<div class="col-sm-6 col-md-6">';
	 				$html .= '<a href="'.$visualizar[0].'">';
	 				$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/visualizar.png" alt="Visualizar Ejemplo"/></a>';
	 				$html .= '<p class="text-center"><a href="'.$visualizar[0].'">Ejecutar el Ejemplo</a></p>';
	 				$html .= '</div>';
	 			}
	 			

	 			if ($descargar[0]) {
	 				$html .= '<div class="col-sm-6 col-md-6">';
	 				$html .= '<a href="'.$descargar[0].'">';
	 				$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/download.png" alt="Descargar Ejemplo"/></a>';
	 				$html .= '<p class="text-center"><a href="'.$descargar[0].'">Descargar Código Fuente</a></p>';
	 				$html .= '</div>';
	 			}
	 			

	 			if ($errorcodigo[0]) {
	 				$html .= '<div class="col-sm-6 col-md-6">';
	 				$html .= '<a href="'.$errorcodigo[0].'">';
	 				$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/error.png" alt="Reportar Error"/></a>';
	 				$html .= '<p class="text-center"><a href="'.$errorcodigo[0].'">Error en el Código Fuente</a></p>';
	 				$html .= '</div>';
	 			}
	 			

	 			if ($nombre[0] && $urlforo[0]) {
					$html .= '<div class="col-sm-6 col-md-6">';
	 				$html .= '<a href="'.$urlforo[0].'">';
	 				$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/question.png" alt="Foro para Dudas '.$nombre[0].'"/></a>';
	 				$html .= '<p class="text-center"><a href="'.$urlforo[0].'">Foro de '.$nombre[0].'</a></p>';
	 				$html .= '</div>';
	 			}
	 			

	 			if ($nombre[0] && $urlmanual[0]) {
					$html .= '<div class="col-sm-6 col-md-6">';
	 				$html .= '<a href="'.$urlmanual[0].'">';
	 				$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/manual.png" alt="Manual sobre '.$nombre[0].'"/></a>';
	 				$html .= '<p class="text-center"><a href="'.$urlmanual[0].'">Manual de '.$nombre[0].'</a></p>';
	 				$html .= '</div>';
	 			}
	 			

	 			if ($nombre[0] && $urltest[0]) {
					$html .= '<div class="col-sm-6 col-md-6">';
	 				$html .= '<a href="'.$urltest[0].'">';
	 				$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/test.png" alt="Test de '.$nombre[0].'"/></a>';
	 				$html .= '<p class="text-center"><a href="'.$urltest[0].'">Test de '.$nombre[0].'</a></p>';
	 				$html .= '</div>';
	 			}
	 			

	 			if ($nombre[0] && $urlcharla[0]) {
					$html .= '<div class="col-sm-6 col-md-6">';
	 				$html .= '<a href="'.$urlcharla[0].'">';
	 				$html .= '<img class="img-thumbnail center-block" src="'.get_template_directory_uri().'/img/talk.png" alt="Charla sobre '.$nombre[0].'"/></a>';
	 				$html .= '<p class="text-center"><a href="'.$urlcharla[0].'">Charla sobre '.$nombre[0].'</a></p>';
	 				$html .= '</div>';
	 			}
	 			

				if ($nombre[0] && $urlcurso[0]) {
					$html .= '<div class="col-sm-6 col-md-6">';
	 				$html .= '<a href="'.$urlcurso[0].'">';
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






/* IMPLEMENTA FUNCIONES EN OTROS FICHEROS */

// Capacidades de la cabecera
require get_template_directory() . '/inc/custom-header.php';

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
