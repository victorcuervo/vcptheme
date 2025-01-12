<?php
/**
 * Implement Custom Header functionality for Twenty Fourteen
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * Set up the WordPress core custom header settings.
 *
 * @since Twenty Fourteen 1.0
 *
 * @uses twentyfourteen_header_style()
 * @uses twentyfourteen_admin_header_style()
 * @uses twentyfourteen_admin_header_image()
 */


// Constantes de la Cabecera
//define('HEADER_TEXTCOLOR', 'ffffff');
//define('HEADER_IMAGE', ''); 
//define('HEADER_IMAGE_WIDTH', 1050); // use width and height appropriate for your theme
//define('HEADER_IMAGE_HEIGHT', 950);        



// Tamaños de las imágenes
//set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
//add_image_size( 'large-feature', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
//add_image_size( 'small-feature', 210, 50 );


// Activamos el Custom-Header, además indicamos el tendrá RANDOM

function vcp_custom_header_setup() {

	add_theme_support( 'custom-header', array(
		'default-image' => '%s/img/headers/header1.jpg',
		'random-default' 		=> true,
		'flex-height'            => true,
		'height'                 => 250,
		'wp-head-callback' 		=> 'vcp_header_style',
		'admin-head-callback'   => 'vcp_admin_header_style',
		'default-text-color'     => '#fff'
		 ) );

}


add_action( 'after_setup_theme', 'vcp_custom_header_setup' );


function vcp_header_style(){
		// Modificación del Theme. Añadiendo la imagen y el color
		?>		
		<?php $header_image = get_header_image();			
		if ($header_image) { ?>
				
			<style>

        	#cabecera {
				background: url(<?php echo $header_image; ?>) no-repeat;
				border-top: 1px solid #fff;
				background-size: cover;
				-moz-background-size: cover;
				-webkit-background-size: cover;
				-o-background-size: cover;
				background-position: center;
			}

			@media (max-width: 480px) {
				#cabecera {
					height: 100px;
				}
			}
			@media (min-width: 481px) and (max-width: 1024px) {
				#cabecera {
					height: 150px;
				}
			}

			@media (min-width: 1025px) {
				#cabecera {
					height: 250px;
				}
			}

        	</style>
    <?php }
    	$header_color = get_header_textcolor();
    	if ($header_color) { ?>
    		<style>
        	#cabecera, #cabecera h1, #cabecera a, #cabecera a:hover, #cabecera small {
            	color: <?php echo $header_color; ?>;            	            	
        	}
        	</style>    	
    	<?php }       
}







// Registramos las imágenes de cabecera
register_default_headers( array(
		'tulipanes' => array(
			'url' => '%s/img/headers/header1.jpg',
			'thumbnail_url' => '%s/img/headers/header1-thumbnail.jpg',
			// translators: header image description
			'description' => __( 'Tulipanes', 'vcp' )
		),
		'taxis' => array(
			'url' => '%s/img/headers/header2.jpg',
			'thumbnail_url' => '%s/img/headers/header2-thumbnail.jpg',
			// translators: header image description
			'description' => __( 'Taxis', 'vcp' )
		),
		'yate' => array(
			'url' => '%s/img/headers/header3.jpg',
			'thumbnail_url' => '%s/img/headers/header3-thumbnail.jpg',
			// translators: header image description
			'description' => __( 'Yate', 'vcp' )
		),
		'estocolmo' => array(
			'url' => '%s/img/headers/header4.jpg',
			'thumbnail_url' => '%s/img/headers/header4-thumbnail.jpg',
			// translators: header image description
			'description' => __( 'Estocolmo', 'vcp' )
		),
		'mariposa' => array(
			'url' => '%s/img/headers/header5.jpg',
			'thumbnail_url' => '%s/img/headers/header5-thumbnail.jpg',
			// translators: header image description
			'description' => __( 'Mariposa', 'vcp' )
		),
		'avila' => array(
			'url' => '%s/img/headers/header6.jpg',
			'thumbnail_url' => '%s/img/headers/header6-thumbnail.jpg',
			// translators: header image description
			'description' => __( 'Avila', 'vcp' )
		),
		'500' => array(
			'url' => '%s/img/headers/header7.jpg',
			'thumbnail_url' => '%s/img/headers/header7-thumbnail.jpg',
			// translators: header image description 
			'description' => __( '500', 'vcp' )
		),
		'mosaico' => array(
			'url' => '%s/img/headers/header8.jpg',
			'thumbnail_url' => '%s/img/headers/header8-thumbnail.jpg',
			// translators: header image description 
			'description' => __( 'Mosaico', 'vcp' )
		),
		'aveiro' => array(
			'url' => '%s/img/headers/header9.jpg',
			'thumbnail_url' => '%s/img/headers/header9-thumbnail.jpg',
			// translators: header image description 
			'description' => __( 'Aveiro', 'vcp' )
		),
		'saopaulo' => array(
			'url' => '%s/img/headers/header10.jpg',
			'thumbnail_url' => '%s/img/headers/header10-thumbnail.jpg',
			// translators: header image description 
			'description' => __( 'Sao Paulo', 'vcp' )
		)
) );



function vcp_admin_header_style() {
	// Previsualización en el panel de administración
	?><style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
            background: no-repeat;
        }
        #name {
			color:#fff;	
			font-size:30px;
			margin:0;
			padding:0 0 0 30px;
			text-align:left;
		}
		#headimg a,#headimg a:hover {
			background:transparent;
			color:#fff;
			text-decoration:none;
		}

		#desc {
			font-size:14px;
			margin:0;
			padding:0 0 0 30px;
			text-align:left;
		}
    </style><?php
}


