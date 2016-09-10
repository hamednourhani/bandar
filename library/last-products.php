<?php

    $args = array(
        'posts_per_page' => 12,
        'order' => 'DESC',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'authors' => '',
        'child_of' => 0,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'product',
        'post_status' => 'publish',
        'suppress_filters' => false
    );
    $items = get_posts($args);

    if (!empty($items)) { ?>
        <div class="items-block">

            <div class="items-list">
                <section class="layout">
                    <?php foreach ($items as $item) { ?>

                        <a class="item-unit"  href="<?php echo get_permalink($item->ID); ?>">
                            <div class="item-thumb">
                                <?php echo get_the_post_thumbnail($item->ID, 'product-thumb'); ?>
                            </div>
                            <div class="item-detail">
                                <h4 class="item-title">
                                    <?php echo $item->post_title; ?>
                                </h4>
                            </div>
                        </a>

                    <?php } ?>
                </section>
            </div>



        </div>
    <?php }

?>