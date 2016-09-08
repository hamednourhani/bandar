<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the itstar directory)
 *
 * Be sure to replace all instances of 'itstar_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_itstar
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/itstar
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

//if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
//	require_once dirname( __FILE__ ) . '/cmb2/init.php';
//} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
//	require_once dirname( __FILE__ ) . '/CMB2/init.php';
//}


function ed_metabox_include_front_page( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'] ) ) {
        return $display;
    }

    if ( 'front-page' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return !$display;
    }

    // Get ID of page set as front page, 0 if there isn't one
    $front_page = get_option( 'page_on_front' );

    // there is a front page set and we're on it!
    return $post_id == $front_page;
}
//add_filter( 'cmb2_show_on', 'ed_metabox_include_front_page', 10, 2 );
/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' itstar_box parameter
 *
 * @param  itstar object $cmb itstar object
 *
 * @return bool             True if metabox should show
 */
function itstar_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  itstar_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function itstar_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  itstar_Field object $field      Field object
 */
function itstar_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}
