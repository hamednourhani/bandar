<?php
/******************************************************************/
/*--------------------Video Features-------------------------------*/
/******************************************************************/
add_action('cmb2_init','itstar_register_video_metabox');
// add_action('cmb2_init','itstar_register_tour_information_metabox');
function itstar_register_video_metabox(){

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_itstar_';

    /**
     * Sample metabox to demonstrate each field type included
     */
    $cmb_demo = new_cmb2_box(array(
        'id' => $prefix . 'video',
        'title' => __('Video Features', 'itstar'),
        'object_types' => array('video'), // Post type

    ));


    $cmb_demo->add_field(array(
        'name' => __('video url', 'itstar'),
        'desc' => __('Video Link', 'itstar'),
        'id' => $prefix . 'video_link',
        'type' => 'text_url',

    ));

}


/*--------------------Post -------------------------------*/
/******************************************************************/

add_action('cmb2_init','itstar_register_is_feature_post_metabox');
// add_action('cmb2_init','itstar_register_tour_information_metabox');
function itstar_register_is_feature_post_metabox()
{


    $prefix = '_itstar_';


    $cmb_demo = new_cmb2_box(array(
        'id' => $prefix . 'post_features',
        'title' => __('Post Features', 'itstar'),
        'object_types' => array('post'), // Post type

    ));


    $cmb_demo->add_field(array(
        'name' => __('Feature', 'itstar'),
        'desc' => __('is this post a feature one?', 'itstar'),
        'id' => $prefix . 'feature_post_radio',
        'type' => 'radio_inline',
        'show_option_none' => false,
        'default'          => 'No',
        'options' => array(
            'No' => __('no', 'itstar'),
            'yes' => __('Yes', 'itstar'),
        ),
    ));

    $cmb_demo->add_field(array(
        'name' => __('Related Article', 'itstar'),
        'desc' => __('is this post an Related Article?', 'itstar'),
        'id' => $prefix . 'related_post_radio',
        'type' => 'radio_inline',
        'show_option_none' => false,
        'default'          => 'No',
        'options' => array(
            'yes' => __('Yes', 'itstar'),
            'No' => __('no', 'itstar'),
        ),
    ));

    $cmb_demo->add_field(array(
        'name' => __('Article', 'itstar'),
        'desc' => __('is this post an Article?', 'itstar'),
        'id' => $prefix . 'article_post_radio',
        'type' => 'radio_inline',
        'show_option_none' => false,
        'default'          => 'No',
        'options' => array(
            'yes' => __('Yes', 'itstar'),
            'No' => __('no', 'itstar'),
        ),
    ));
//
}

/*--------------------slide -------------------------------*/
/******************************************************************/

add_action('cmb2_init','itstar_register_is_feature_slide_metabox');
// add_action('cmb2_init','itstar_register_tour_information_metabox');
function itstar_register_is_feature_slide_metabox()
{


    $prefix = '_itstar_';


    $cmb_demo = new_cmb2_box(array(
        'id' => $prefix . 'slide_features',
        'title' => __('slide Features', 'itstar'),
        'object_types' => array('slide'), // Post type

    ));

    $cmb_demo->add_field( array(
        'name'       => __( 'Link', 'itstar' ),
        'desc'       => __( 'Slide Link', 'itstar' ),
        'id'         => $prefix . 'slide_link',
        'type' => 'text_url',

    ) );

//
}
/******************************************************************/
/*--------------------item Features-------------------------------*/
/******************************************************************/
add_action('cmb2_init','itstar_register_item_metabox');
// add_action('cmb2_init','itstar_register_tour_information_metabox');
function itstar_register_item_metabox(){

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_itstar_';

    /**
     * Sample metabox to demonstrate each field type included
     */
    $cmb_demo = new_cmb2_box(array(
        'id' => $prefix . 'item',
        'title' => __('item Features', 'itstar'),
        'object_types' => array('item'), // Post type

    ));


    $cmb_demo->add_field(array(
        'name' => __('item priority', 'itstar'),
        'desc' => __('item priority', 'itstar'),
        'id' => $prefix . 'item_pri',
        'type' => 'text_small',

    ));
    $cmb_demo->add_field(array(
        'name' => __('item url', 'itstar'),
        'desc' => __('item Link', 'itstar'),
        'id' => $prefix . 'item_link',
        'type' => 'text_url',

    ));

}

/*--------------------Page -------------------------------*/
/******************************************************************/

add_action('cmb2_init','itstar_register_is_feature_page_metabox');
// add_action('cmb2_init','itstar_register_tour_information_metabox');
function itstar_register_is_feature_page_metabox()
{

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_itstar_';

    /**
     * Sample metabox to demonstrate each field type included
     */
    $cmb_demo = new_cmb2_box(array(
        'id' => $prefix . 'feature_page',
        'title' => __('Page Features', 'itstar'),
        'object_types' => array('page'), // Post type

    ));


    $cmb_demo->add_field(array(
        'name' => __('Feature', 'itstar'),
        'desc' => __('is this page a feature page?', 'itstar'),
        'id' => $prefix . 'feature_page_radio',
        'type' => 'radio_inline',
        'show_option_none' => false,
        'default'          => 'No',
        'options' => array(
            'No' => __('no', 'itstar'),
            'yes' => __('Yes', 'itstar'),


        ),


    ));

    //slide
    $cmb_demo->add_field(array(
        'name' => __('Slider', 'itstar'),
        'desc' => __('Show slider?', 'itstar'),
        'id' => $prefix . 'show_slider_radio',
        'type' => 'radio_inline',
        'show_option_none' => false,
        'default'          => 'No',
        'options' => array(
            'No' => __('no', 'itstar'),
            'yes' => __('Yes', 'itstar'),


        ),


    ));

    $slide_terms = get_terms('slide_cat',
        array(
            'orderby'    => 'count',
            'hide_empty' => 0
        )
    );

    $slide_term_array = array();
    $slide_term_array['none'] = '--';

    foreach ( $slide_terms as $term ) {
        $slide_term_array[$term->term_id] = $term->name;
    }



    $cmb_demo->add_field(array(
        'name'    => __( 'Slider Category', 'naiau' ),
        'desc'    => __( 'Select Slider Category', 'naiau' ),
        'id'      => $prefix .'slide_term_id',
        'type'    => 'select',
        'options' =>  $slide_term_array,
        'default' => 'none',

    ) );


    //items
    $cmb_demo->add_field(array(
        'name' => __('Items', 'itstar'),
        'desc' => __('Show Items?', 'itstar'),
        'id' => $prefix . 'show_items_radio',
        'type' => 'radio_inline',
        'show_option_none' => false,
        'default'          => 'No',
        'options' => array(
            'No' => __('no', 'itstar'),
            'yes' => __('Yes', 'itstar'),
        ),
    ));

    $cmb_demo->add_field(array(
        'name' => __('Items Title', 'itstar'),
        'desc' => __('Items Title', 'itstar'),
        'id' => $prefix . 'items_title',
        'type' => 'text',

    ));

    $item_terms = get_terms('item_cat',
        array(
            'orderby'    => 'count',
            'hide_empty' => 0
        )
    );

    $item_term_array = array();
    $item_term_array['none'] = '--';

    foreach ( $item_terms as $term ) {
        $item_term_array[$term->term_id] = $term->name;
    }



    $cmb_demo->add_field(array(
        'name'    => __( 'item Category', 'naiau' ),
        'desc'    => __( 'Select item Category', 'itstar' ),
        'id'      => $prefix .'item_term_id',
        'type'    => 'select',
        'options' =>  $item_term_array,
        'default' => 'none',

    ) );

    $cmb_demo->add_field(array(
        'name' => __('Related Articles', 'itstar'),
        'desc' => __('Show Related Articles?', 'itstar'),
        'id' => $prefix . 'show_related_article_radio',
        'type' => 'radio_inline',
        'show_option_none' => false,
        'default'          => 'No',
        'options' => array(
            'No' => __('no', 'itstar'),
            'yes' => __('Yes', 'itstar'),
        ),
    ));

    $categories = get_categories( array(
        'orderby' => 'count',
    ) );


    $article_terms_array = array();
    $article_terms_array['none'] = '--';

    foreach ( $categories as $term ) {
        $article_terms_array[$term->term_id] = $term->name;
    }



    $cmb_demo->add_field(array(
        'name'    => __( 'Article Category', 'naiau' ),
        'desc'    => __( 'Select Article Category', 'itstar' ),
        'id'      => $prefix .'related_article_term_id',
        'type'    => 'select',
        'options' => $article_terms_array,
        'default' => 'none',

    ) );

    $cmb_demo->add_field(array(
        'name' => __('Best Articles', 'itstar'),
        'desc' => __('Show Best Articles?', 'itstar'),
        'id' => $prefix . 'show_best_article_radio',
        'type' => 'radio_inline',
        'show_option_none' => false,
        'default'          => 'No',
        'options' => array(
            'No' => __('no', 'itstar'),
            'yes' => __('Yes', 'itstar'),
        ),
    ));

    $cmb_demo->add_field(array(
        'name' => __('Last Articles', 'itstar'),
        'desc' => __('Show Last Articles?', 'itstar'),
        'id' => $prefix . 'show_last_article_radio',
        'type' => 'radio_inline',
        'show_option_none' => false,
        'default'          => 'No',
        'options' => array(
            'No' => __('no', 'itstar'),
            'yes' => __('Yes', 'itstar'),
        ),
    ));

//
}


?>