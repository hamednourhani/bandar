<?php
/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
 *********************/
function itstar_ahoy() {

    //Allow editor style.
    //add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

    // let's get language support going, if you need it
    load_theme_textdomain( 'itstar', get_template_directory() . '/languages' );

    // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
    require_once( 'custom-post-type.php' );

    // launching operation cleanup
    add_action( 'init', 'itstar_head_cleanup' );
    // A better title
    add_filter( 'wp_title', 'rw_title', 10, 3 );
    // remove WP version from RSS
    add_filter( 'the_generator', 'itstar_rss_version' );
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'itstar_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action( 'wp_head', 'itstar_remove_recent_comments_style', 1 );
    // clean up gallery output in wp
    add_filter( 'gallery_style', 'itstar_gallery_style' );


    // ie conditional wrapper

    // launching this stuff after theme setup
    itstar_theme_support();

    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'itstar_register_sidebars' );

    //register customizer
    add_action( 'customize_register', 'itstar_theme_customizer' );
    // cleaning up random code around images
    add_filter( 'the_content', 'itstar_filter_ptags_on_images' );
    // cleaning up excerpt
    add_filter( 'excerpt_more', 'itstar_excerpt_more' );
    add_filter( 'excerpt_length', 'itstar_excerpt_length', 999 );
    //hide admin for anonymous users
    add_filter( 'show_admin_bar' , 'itstar_disable_admin_bar');

    //disable wordpress update notify
    add_action('admin_menu','itstar_wphidenag');

    add_filter('pre_get_posts','itstar_SearchFilter');

   

    add_filter( 'get_search_form', 'itstar_search_form' );

    remove_filter('template_redirect', 'redirect_canonical');
} /* end itstar ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'itstar_ahoy' );

/************* OEMBED SIZE OPTIONS *************/

// if ( ! isset( $content_width ) ) {
//  $content_width = 640;
// }

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'slider', 960, 500, array( 'center', 'center' ) );
add_image_size( 'post-thumb', 150, 150, array( 'center', 'center' ) );
add_image_size( 'product-thumb', 340, 200, array( 'center', 'center' ) );
add_image_size( 'widget-thumb', 35, 35, array( 'center', 'center' ) );
add_image_size( 'post-banner', 960, 300, array( 'center', 'center' ) );



add_filter( 'image_size_names_choose', 'itstar_custom_image_sizes' );
function itstar_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'slider' => __('960px by 500px'),
        'post-thumb' => __('150px by 150px'),
        'product-thumb' => __('300px by 180px'),
        'widget-thumb' => __('35px by 35px'),
        'post-banner' => __('960px by 300px'),


    ) );
}

/*********************
THEME SUPPORT
 *********************/

// Adding WP 3+ Functions & Theme Support
function itstar_theme_support() {

    // wp thumbnails (sizes handled in functions.php)
    add_theme_support( 'post-thumbnails' );

    // default thumb size
    set_post_thumbnail_size(150,150 , true);

    // wp custom background (thx to @bransonwerner for update)
//	add_theme_support( 'custom-background',
//	    array(
//	    'default-image' => '',    // background image default
//	    'default-color' => '',    // background color default (dont add the #)
//	    'wp-head-callback' => '_custom_background_cb',
//	    'admin-head-callback' => '',
//	    'admin-preview-callback' => ''
//	    )
//	);

    // rss thingy
    add_theme_support('automatic-feed-links');

    // to add header image support go here: http://themble.com/support/adding-header-background-image-support/

    // adding post format support
    add_theme_support( 'post-formats',
        array(
            'aside',             // title less blurb
            'gallery',           // gallery of images
            'link',              // quick link to other site
            'image',             // an image
            'quote',             // a quick quote
            'status',            // a Facebook like status update
            'video',             // video
            'audio',             // audio
            'chat'               // chat transcript
        )
    );

    // Enable support for HTML5 markup.
    add_theme_support( 'html5', array(
        'comment-list',
        'search-form',
        'comment-form'
    ) );

    // wp menus
    add_theme_support( 'menus' );

    // registering wp3+ menus
    register_nav_menus(
        array(
            'main-menu' => __( 'The Main Menu', 'itstar' ),   // main nav in header
            'responsive-menu' => __( 'Responsive Menu', 'itstar' ), // top menu  in footer
            //'responsive-menu-2' => __( 'Responsive Menu', 'itstar' ) // top menu  in footer
        )
    );

} /* end itstar theme support */

/************* THEME CUSTOMIZE *********************/
function itstar_head_cleanup() {
    // category feeds
    // remove_action( 'wp_head', 'feed_links_extra', 3 );
    // post and comment feeds
    // remove_action( 'wp_head', 'feed_links', 2 );
    // EditURI link
    remove_action( 'wp_head', 'rsd_link' );
    // windows live writer
    remove_action( 'wp_head', 'wlwmanifest_link' );
    // previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    // start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    // links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    // WP version
    remove_action( 'wp_head', 'wp_generator' );
    // remove WP version from css
    add_filter( 'style_loader_src', 'itstar_remove_wp_ver_css_js', 9999 );
    // remove Wp version from scripts
    add_filter( 'script_loader_src', 'itstar_remove_wp_ver_css_js', 9999 );

} /* end itstar head cleanup */

function itstar_theme_customizer($wp_customize) {
}


// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
    global $page, $paged;

    // Don't affect in feeds.
    if ( is_feed() ) return $title;

    // Add the blog's name
    if ( 'right' == $seplocation ) {
        $title .= get_bloginfo( 'name' );
    } else {
        $title = get_bloginfo( 'name' ) . $title;
    }

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );

    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " {$sep} {$site_description}";
    }

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 ) {
        $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
    }

    return $title;

} // end better title

// remove WP version from RSS
function itstar_rss_version() { return ''; }

// remove WP version from scripts
function itstar_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function itstar_remove_wp_widget_recent_comments_style() {
    if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
        remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
    }
}

// remove injected CSS from recent comments widget
function itstar_remove_recent_comments_style() {
    global $wp_widget_factory;
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
    }
}

// remove injected CSS from gallery
function itstar_gallery_style($css) {
    return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function itstar_register_sidebars() {
    register_sidebar(array(
        'id' => 'sidebar',
        'name' => __( 'Sidebar', 'itstar' ),
        'description' => __( 'The first (primary) sidebar.', 'itstar' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'id' => 'footer-first',
        'name' => __( 'Footer First', 'itstar' ),
        'description' => __( 'The first footer widget area', 'itstar' ),
        'before_widget' => '<aside id="%1$s" class="footer-first widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'id' => 'footer-first-col2',
        'name' => __( 'Footer First Col2', 'itstar' ),
        'description' => __( 'The first footer widget area', 'itstar' ),
        'before_widget' => '<aside id="%1$s" class="footer-first widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'id' => 'footer-first-col3',
        'name' => __( 'Footer First Col3', 'itstar' ),
        'description' => __( 'The first footer widget area', 'itstar' ),
        'before_widget' => '<aside id="%1$s" class="footer-first widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'id' => 'footer-first-col4',
        'name' => __( 'Footer First Col4', 'itstar' ),
        'description' => __( 'The first footer widget area', 'itstar' ),
        'before_widget' => '<aside id="%1$s" class="footer-first widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));


}

/************* COMMENT LAYOUT *********************/

// Comment Layout
function itstar_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment; ?>
<div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
        <header class="comment-author vcard">
            <?php
            /*
              this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
              echo get_avatar($comment,$size='32',$default='<path_to_url>' );
            */
            ?>
            <?php // custom gravatar call ?>
            <?php
            // create variable
            $bgauthemail = get_comment_author_email();
            ?>
            <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
            <?php // end custom gravatar call ?>
            <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'itstar' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'itstar' ),'  ','') ) ?>
            <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'itstar' )); ?> </a></time>

        </header>
        <?php if ($comment->comment_approved == '0') : ?>
            <div class="alert alert-info">
                <p><?php _e( 'Your comment is awaiting moderation.', 'itstar' ) ?></p>
            </div>
        <?php endif; ?>
        <section class="comment_content cf">
            <?php comment_text() ?>
        </section>
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
    <?php // </li> is added by WordPress automatically ?>
    <?php
} // don't remove this bracket!


function itstar_pagination(){
    global $wp_query;

    if($wp_query->max_num_pages > 1){
        if('item' !== get_post_type() ){
            $big = 999999999;
            echo /*__('Page : ','itstar').*/paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'prev_text'    => __('<i class="fa fa-angle-double-left"></i>','itstar'),
                'next_text'    => __('<i class="fa fa-angle-double-right"></i>','itstar')
            ) );
        } else {
            $big = 999999999;
            echo /*__('Page : ','itstar').*/paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'prev_text'    => __('<i class="fa fa-angle-double-left"></i>','itstar'),
                'next_text'    => __('<i class="fa fa-angle-double-right"></i>','itstar')
            ) );
        }
    }
}

function itstar_SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', array('post','product'));
    }
    return $query;
}





defined('ICL_LANGUAGE_CODE') or define('ICL_LANGUAGE_CODE', 'fa');

function itstar_search_form( $form ) {
    global $post,$wp_query,$wpdb;


    if(ICL_LANGUAGE_CODE == 'en' || ICL_LANGUAGE_CODE == 'it'){
        $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
          <div>
              <label class="screen-reader-text" for="s">' . __( 'Search for:','itstar' ) . '</label>
              <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.__("Search...","itstar").'"/>
               <span class="searchButton"><i class="fa fa-search"></i></span>
              <input type="hidden" name="lang" value="'.ICL_LANGUAGE_CODE.'"/>
          </div>
         </form>';
    } else {
        $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
          <div>
              <label class="screen-reader-text" for="s">' . __( 'Search for:','itstar' ) . '</label>
              <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.__("Search...","itstar").'"/>
              <span class="searchButton"><i class="fa fa-search"></i></span>
          </div>
         </form>';
    }

    return $form;
}

add_filter( 'get_search_form', 'itstar_search_form' );

if ( ICL_LANGUAGE_CODE =='it' || ICL_LANGUAGE_CODE =='en'){

    remove_filter('the_title', 'ztjalali_persian_num');
    remove_filter('the_content', 'ztjalali_persian_num');
    remove_filter('the_excerpt', 'ztjalali_persian_num');
    remove_filter('comment_text', 'ztjalali_persian_num');
    // change arabic characters
    remove_filter('the_content', 'ztjalali_ch_arabic_to_persian');
    remove_filter('the_title', 'ztjalali_ch_arabic_to_persian');
    remove_filter('the_excerpt', 'ztjalali_ch_arabic_to_persian');
    remove_filter('comment_text', 'ztjalali_ch_arabic_to_persian');



}
// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function itstar_filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function itstar_excerpt_more($more) {
    global $post;
    // edit here if you like
    return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'itstar' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'itstar' ) .'</a>';
}

function itstar_excerpt_length( $length ) {
    return 34;
}


//hide admin bar from front end
function itstar_disable_admin_bar(){
    if(!is_admin()){
        return false;
    }
}


function itstar_wphidenag() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}

?>