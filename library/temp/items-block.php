<?php
$show_item = get_post_meta( get_the_ID(), '_itstar_show_items_radio',1 );
//var_dump('$show_item:'.$show_item);
if($show_item == "yes") {
    $item_cat_id = get_post_meta(get_the_ID(), '_itstar_item_term_id', 1);
//    var_dump('$item_cat_id:'.$item_cat_id);
    $args = array(
        'posts_per_page' => 20,
        'tax_query' => array(
            array(
                'taxonomy' => 'item_cat',
                'field' => 'term_id',
                'terms' => $item_cat_id,
            )
        ),
        'meta_key' => '_itstar_item_pri',
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
//    'meta_key' => '_itstar_feature_post_radio',
//    'meta_value' => 'yes',
        'authors' => '',
        'child_of' => 0,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'item',
        'post_status' => 'publish',
        'suppress_filters' => false
    );
    $items = get_posts($args);

    if (!empty($items)) {

        $block_title = get_post_meta(get_the_ID(), '_itstar_items_title', 1);

        ?>
        <div class="items-block">

            <h3 class="section-title">
                <?php echo $block_title; ?>
            </h3>

            <div class="items-list">
                <section class="layout">
                    <?php foreach ($items as $item) {
                        $item_link = get_post_meta($item->ID, '_itstar_item_link', 1);
                        $nofollow = 'rel="nofollow"';
                        if ($item_link == "") {
                            $item_link = get_permalink($item->ID);
                            $nofollow = '';
                        }
                        ?>

                        <a class="item-unit" <?php echo $nofollow; ?> href="<?php echo $item_link; ?>">
                            <div class="item-thumb">
                                <?php echo get_the_post_thumbnail($item->ID, 'page-thumb'); ?>
                            </div>
                            <div class="item-detail">
                                <h4 class="item-title">
                                    <?php echo $item->post_title; ?>
                                </h4>
                                        <span class="item-desc">
                                            <?php echo $item->post_excerpt; ?>
                                         </span>
                            </div>
                        </a>

                    <?php } ?>
                </section>
            </div>


            <div class="more-items-container">
                <a class="more-items" href="<?php echo get_term_link(intval($item_cat_id), 'item_cat'); ?>">
                    <?php echo __("more items", "itstar"); ?>
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    <?php }
}
?>