<?php
/*********************
SCRIPTS & ENQUEUEING
 *********************/
// enqueue base scripts and styles
add_action( 'wp_enqueue_scripts', 'itstar_scripts_and_styles', 998 );
// loading modernizr and jquery, and reply script
function itstar_scripts_and_styles() {

    global $wp_styles,$wp_scripts; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    if (!is_admin()) {

        $please_wait = array(
            'theme_dir' => get_template_directory_uri(),

        );

        // modernizr (without media query polyfill)
        // wp_register_script( 'please-wait', get_stylesheet_directory_uri() . '/js/lib/please-wait.min.js', array(), '', false );
        // wp_register_script( 'please-wait-custom', get_stylesheet_directory_uri() . '/js/please-wait-custom.js', array('please-wait'), '', false );

        // wp_localize_script( 'please-wait-custom', 'theme_info', $please_wait );





        // register main stylesheet

        wp_register_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', array(), '', 'all' );
//        wp_register_style( 'owl', get_stylesheet_directory_uri() . '/css/owl.carousel.min.css', array(), '', 'all' );
//        wp_register_style( 'owl-theme', get_stylesheet_directory_uri() . '/css/owl.theme.default.min.css', array(), '', 'all' );
//        wp_register_style( 'sliderproCss', get_stylesheet_directory_uri() . '/css/slider-pro.min.css', array(), '', 'all' );

//	  wp_enqueue_style('custom-style',get_template_directory_uri() . '/css/custom-style.css',array(),'','all');
        wp_register_style( 'itstar-stylesheet', get_stylesheet_directory_uri() . '/css/style.css', array(), '', 'all' );
        wp_register_style( 'itstar-ie-stylesheet', get_stylesheet_directory_uri() . '/css/ie/style.css', array(), '', 'all' );
        wp_register_style( 'itstar-ie-only', get_stylesheet_directory_uri() . '/css/ie/ie.css', array(), '' );

        // comment reply script for threaded comments
        if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script( 'comment-reply' );
        }

        //adding scripts file in the footer


        wp_register_script( 'itstar-modernizr', get_stylesheet_directory_uri() . '/js/lib/modernizr.custom.min.js', array(), '2.5.3', false );
//	  	wp_register_script( 'scrolltofixed', get_stylesheet_directory_uri() . '/js/lib/jquery-scrolltofixed-min.js', array('jquery'), '', false );
//        wp_register_script( 'owlScript', get_stylesheet_directory_uri() . '/js/lib/owl.carousel.min.js', array('jquery'), '', false );
//		wp_register_script( 'onscreen', get_stylesheet_directory_uri() . '/js/lib/jquery.onscreen.min.js', array('jquery'), '', false );
//        wp_register_script( 'sliderpro', get_stylesheet_directory_uri() . '/js/lib/jquery.sliderPro.min.js', array('jquery'), '', false );
        wp_register_script( 'html5shiv', get_stylesheet_directory_uri() . '/js/lib/html5shiv.js', array(), '', false );
        // wp_register_script( 'respond-js', get_stylesheet_directory_uri() . '/js/lib/respond.js', array(), '', false );
        wp_register_script( 'pie', get_stylesheet_directory_uri() . '/js/lib/PIE.js', array('jquery'), '', false );
        wp_register_script( 'flexie', get_stylesheet_directory_uri() . '/js/lib/flexie.js', array('jquery'), '', false );
        wp_register_script( 'selectivizr', get_stylesheet_directory_uri() . '/js/lib/selectivizr-min.js', array(), '', false );
        // wp_register_script( 'cssfx', get_stylesheet_directory_uri() . '/js/lib/cssfx.js', array(), '', false );
        wp_register_script( 'itstar-js', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '', true );


        // enqueue styles and scripts
        //wp_enqueue_script( 'please-wait' );
        //wp_enqueue_script( 'please-wait-custom' );
        //wp_enqueue_script( 'itstar-modernizr' );

        wp_enqueue_script( 'modernizr-itstar' );

//        wp_enqueue_style( 'owl' );
//        wp_enqueue_style( 'owl-theme' );
//        wp_enqueue_style( 'sliderproCss' );
        wp_enqueue_style( 'itstar-stylesheet' );
//	  wp_enqueue_style( 'custom-style');





        if(preg_match('/(?i)msie [5-8]/',$_SERVER['HTTP_USER_AGENT'])){
            // if IE<=8
            wp_enqueue_script( 'html5shiv' );

            wp_enqueue_style( 'itstar-ie-stylesheet' );

            wp_enqueue_style( 'itstar-ie-only' );

            wp_enqueue_script( 'firebug-lite' );
            // wp_enqueue_script( 'respond-js' );
            wp_enqueue_script( 'pie' );
            wp_enqueue_script( 'flexie' );
            wp_enqueue_script( 'selectivizr' );
            // wp_enqueue_script( 'cssfx' );
        }

        wp_enqueue_style('font-awesome' );





        /*
        I recommend using a plugin to call jQuery
        using the google cdn. That way it stays cached
        and your site will load faster.
        */


        wp_enqueue_script( 'jquery' );
//	  wp_enqueue_script( 'scrolltofixed' );
//        wp_enqueue_script( 'sliderpro' );
//        wp_enqueue_script( 'owlScript' );

//		wp_enqueue_script( 'onscreen' );

        wp_enqueue_script( 'itstar-js' );



    }
}


?>