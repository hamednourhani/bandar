<?php
/**
 * Created by PhpStorm.
 * User: itstar
 * Date: 2016/08/29
 * Time: 10:53 AM
 */
function itstar_add_section( ) {
    global $wp_customize;
    $wp_customize->add_section('itstar_theme_option' , array(
        'title'      => __('Theme Option','itstar'),
        'priority'   => 30,
        )
    );
}
add_action( 'customize_register', 'itstar_add_section' );
Kirki::add_field( 'toparoos', array(
    'type'        => 'color',
    'settings'    => 'side_widget_header_color',
    'label'       => __( 'Side Widget Header Color', 'itstar' ),
    'section'     => 'colors',
    'default'     => '#333336',
    'priority'    => 10,
    'alpha'       => true,
) );
Kirki::add_field( 'toparoos', array(
    'type'        => 'color',
    'settings'    => 'body_wrapper_color',
    'label'       => __( 'Background Color', 'itstar' ),
    'section'     => 'colors',
    'default'     => '#F5F5F5',
    'priority'    => 10,
    'alpha'       => true,
) );

Kirki::add_field( 'toparoos', array(
    'type'        => 'upload',
    'settings'    => 'site_logo_from_option',
    'label'       => __( 'Site Logo', 'itstar' ),
    'section'     => 'itstar_theme_option',
    'default'     => '',
    'priority'    => 10,
    'alpha'       => true,
) );

Kirki::add_field( 'toparoos', array(
    'type'        => 'upload',
    'settings'    => 'site_menu_logo_from_option',
    'label'       => __( 'Site Menu Logo', 'itstar' ),
    'section'     => 'itstar_theme_option',
    'default'     => '',
    'priority'    => 10,
    'alpha'       => true,
) );


function itstar_customized_theme_style() {
    wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom-style.css' );
    $side_widget_header_color = get_theme_mod( 'side_widget_header_color' );
    $background_color = get_theme_mod( 'body_wrapper_color' );
    $custom_inline_style = "
        .body-wrapper {
            background-color : {$background_color};
        }
        .secondary aside.widget .widgettitle{
                        color: {$side_widget_header_color};
               
         }
    ";
    wp_add_inline_style( 'custom-style', $custom_inline_style );
}
add_action( 'wp_enqueue_scripts', 'itstar_customized_theme_style',999 );
