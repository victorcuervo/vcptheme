<?php
/**
 * Twenty Fourteen Theme Customizer support
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 

function twentyfourteen_customize_register( $wp_customize ) {


	// Nuevo apartado para las variables configurables
	$wp_customize->add_section( 'vcp_featured_content', array(
		'title'       => __( 'Contenido Configurable', 'vcp' ),
		'description' => 'Aquí puedes configurar parte de contenido variable del tema.',
		'priority'    => 130,
	) );
	

	// Para el Copyright
	$wp_customize->add_setting('vcp_copyright', array(
        'default'        => '2001-2007',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('vcp_copyright_control', array(
        'label'      => __('Copyright', 'vcp'),
        'section'    => 'vcp_featured_content',
        'settings'   => 'vcp_copyright',
    ));


    // Para el código del buscador
    $wp_customize->add_setting('vcp_search', array(
        'default'        => '1617825704006857:7528701740',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('vcp_search_control', array(
        'label'      => __('Código Buscador', 'vcp'),
        'section'    => 'vcp_featured_content',
        'settings'   => 'vcp_search',
    ));


    // Para poner Categorías o Tecnologías u otra cosa
    $wp_customize->add_setting('vcp_categorias', array(
        'default'        => 'Tecnologías',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('vcp_categorias_control', array(
        'label'      => __('Categorias', 'vcp'),
        'section'    => 'vcp_featured_content',
        'settings'   => 'vcp_categorias',
    ));
    
    
    // Para thumbnail de los post: right, center o left
    $wp_customize->add_setting('vcp_thumbnail', array(
    		'default'        => 'right',
    		'capability'     => 'edit_theme_options',
    		'type'           => 'option',
    
    ));
    
    $wp_customize->add_control('vcp_thumbnail_control', array(
    		'label'      => __('Thumbnail', 'vcp'),
    		'section'    => 'vcp_featured_content',
    		'settings'   => 'vcp_thumbnail',
    ));
    




/*


	// Add the featured content layout setting and control.
	$wp_customize->add_setting( 'featured_content_layout', array(
		'default'           => 'grid',
		'sanitize_callback' => 'twentyfourteen_sanitize_layout',
	) );

	$wp_customize->add_control( 'featured_content_layout', array(
		'label'   => __( 'Copyright', 'twentyfourteen' ),
		'section' => 'featured_content',
		'type'    => 'select',
		'choices' => array(
			'grid'   => __( 'Grid',   'twentyfourteen' ),
			'slider' => __( 'Slider', 'twentyfourteen' ),
		),
	) );

*/



}
add_action( 'customize_register', 'twentyfourteen_customize_register' );




