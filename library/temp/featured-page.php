<?php

    $args = array (
        'numberposts' => -1,
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'authors' => '',
        'child_of' => 0,
        'meta_key' => '_itstar_feature_page_radio',
        'meta_value' => 'yes',
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'page',
        'post_status' => 'publish',
        'suppress_filters' => false
    );
    // The Query
    $page_list = get_posts( $args );

    if(!empty($page_list) ){ ?>
        <div class="featured-pages-wrap">
            <h4 class="section-title">
                <?php echo __("Our Services","itstar");?>
            </h4>
            <section class="layout">
                <?php foreach ( $page_list as $page ):?>
                    <a class="page-grid" href="<?php echo get_permalink( $page->ID ); ?> " >
                        <div class="page-grid-thumbnail">
                           <?php echo get_the_post_thumbnail($page->ID,'page-thumb');?>
                        </div>
                        <span class="page-grid-title">
                            <?php echo $page->post_title; ?>
                        </span>
                    </a>

                <?php endforeach; ?>
            </section>
        </div>
        <?php
    }
    
?>


