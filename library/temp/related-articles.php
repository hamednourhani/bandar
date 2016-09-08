<?php
$show_article = get_post_meta( get_the_ID(), '_itstar_show_related_article_radio',1 );
//var_dump('$show_article:'.$show_article);
if($show_article == 'yes'){
$article_cat_id = get_post_meta( get_the_ID(), '_itstar_related_article_term_id',1 );
//var_dump('$article_cat_id'.$article_cat_id);
$args = array(
    'posts_per_page' => 20,
    'category' => $article_cat_id,
    'order'   => 'DESC',
    'hierarchical' => 1,
    'exclude' => '',
    'include' => '',
    'meta_key' => '_itstar_related_post_radio',
    'meta_value' => 'yes',
    'authors' => '',
    'child_of' => 0,
    'parent' => -1,
    'exclude_tree' => '',
    'number' => '',
    'offset' => 0,
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => false
);
$articles = get_posts($args);
    

if(!empty($articles) ){

    ?>
    <div class="articles-block">

        <h3 class="section-title">
            <?php echo __('Related Articles','itstar');?>
        </h3>

        <div class="articles-list">
            <section class="layout">
                <?php foreach( $articles as $article ) {
                    $article_link =  get_permalink($article->ID);
                    ?>

                    <a class="article-unit" href="<?php echo $article_link; ?>">
                        <div class="article-thumb">
                            <?php echo get_the_post_thumbnail($article->ID,'page-thumb');?>
                        </div>
                        <div class="article-detail">
                            <h4 class="article-title">
                                <?php echo $article->post_title; ?>
                            </h4>
                                        <span class="article-desc">
                                            <?php echo $article->post_excerpt;?>
                                         </span>
                        </div>
                    </a>

                <?php } ?>
            </section>
        </div>


        <div class="more-articles-container">
            <a class="more-articles" href="<?php echo get_term_link(intval($article_cat_id), 'category'); ?>">
                <?php echo __("more articles","itstar");?>
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            </a>
        </div>
    </div>
<?php }

}
?>