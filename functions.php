<?php
/*
Author: Eddie Machado
URL: http://themble.com/itstar/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD itstar CORE (if you remove this, the theme will break)

require_once get_template_directory() . '/library/register-plugins.php';
//setup Kirki plugin for customizing theme
if( class_exists("Kirki") ){
    Kirki::add_config( 'toparoos', array(
        'capability'    => 'edit_theme_options',
        'option_type'   => 'theme_mod',
    ) );
    require_once('library/kirki_options.php');
}

require_once get_template_directory() . '/library/theme-setup.php';
//require_once get_template_directory() . '/library/cmb-functions.php' ;
//require_once get_template_directory().'/library/register-widgets.php';
//require_once get_template_directory().'/library/register-menu-walkers.php';
require_once get_template_directory().'/library/register-scripts-styles.php';
require_once get_template_directory().'/library/extra-functions.php';

?>