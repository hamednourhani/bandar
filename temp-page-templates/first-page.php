<?php
/**
 * Template Name: First Page
 *
 *
 */


get_header();


?>


    <main class="site-main full-weight">


                <div class="banner-wrapper">

                    <?php get_template_part('library/banner','maker'); ?>

                </div><!-- banner-wrapper -->

                <div class="site-content">


                    <div class="primary">

                        <div class="feature-pages">
                            <a id="NextPageBtn" href="#">
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <a id="PrevPageBtn" href="#">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <section class="layout">
                                <div class="feature-pages-wrapper">
                                <div class="feature-pages-inner ">
                                    <?php $args = array(
                                        'sort_order' => 'asc',
                                        'sort_column' => 'post_title',
                                        'hierarchical' => 1,
                                        'exclude' => '',
                                        'include' => '',
                                        'meta_key' => '_itstar_feature_page_radio',
                                        'meta_value' => 'yes',
                                        'authors' => '',
                                        'child_of' => 0,
                                        'parent' => -1,
                                        'exclude_tree' => '',
                                        'number' => '',
                                        'offset' => 0,
                                        'post_type' => 'page',
                                        'post_status' => 'publish',
                                         'suppress_filters' => false
                                    );
                                    $pages = get_pages($args);

                                    ?>
                                   <ul class="owl-carousel owl-theme">
                                    <?php foreach( $pages as $page ) {?>
                                       <li>
                                        <a class="page-grid" href="<?php echo get_permalink($page->ID); ?>">
                                            <h3>
                                                <?php echo $page->post_title; ?>
                                            </h3>
                                            <span>
                                                 <?php echo get_post_meta( $page->ID, '_itstar_page_excerpt',1 ); ?>
                                            </span>
                                            <div class="page-thumb-container">
                                                <img src="<?php echo get_the_post_thumbnail_url($page->ID,'page-thumb');?>" alt="">
                                            </div>
                                        </a>
                                        </li>
                                   <?php } ?>
                                </ul>

                                  </div>
                                </div>
                            </section>
                         </div>


                        <div class="furniture-wrapper">
                            <section class="layout">

                                    <div class="furniture-inner">
                                        <ul>
                                            <li>
                                                <a href="<?php echo get_post_meta( get_the_ID(), '_itstar_news_link',1 );?>">
                                                    <div class="image-wrapper">
                                                        <img src="<?php echo get_template_directory_uri();?>/images/icons/news-icon.png" alt="">
                                                    </div>
                                                    <span>
                                                        <?php echo __('Contact Us','itstar');?>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo get_post_meta( get_the_ID(), '_itstar_photo_gallery_link',1 );?>">
                                                    <div class="image-wrapper">
                                                        <img src="<?php echo get_template_directory_uri();?>/images/icons/heart-icon.png" alt="">
                                                    </div>
                                                    <span>
                                                         <?php echo __('Products','itstar');?>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo get_post_meta( get_the_ID(), '_itstar_agencies_link',1 );?>">
                                                    <div class="image-wrapper">
                                                        <img src="<?php echo get_template_directory_uri();?>/images/icons/agencies-icon.png" alt="">
                                                    </div>
                                                    <span>
                                                         <?php echo __('Cataloges','itstar');?>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo get_post_meta( get_the_ID(), '_itstar_support_link',1 );?>">
                                                    <div class="image-wrapper">
                                                        <img src="<?php echo get_template_directory_uri();?>/images/icons/support-icon.png" alt="">
                                                    </div>
                                                    <span>
                                                         <?php echo __('About 3mm','itstar');?>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="furniture-image-container">
                                            <img src="<?php echo get_template_directory_uri();?>/images/3mm.png" alt="">
                                        </div>
                                    </div>

                            </section>
                        </div>

                        <div class="products-container">
                            <section class="layout">
                                <?php
                                    if(have_posts()){
                                        while(have_posts()) { the_post();
                                            the_content();
                                        }
                                    }
                                ?>
                            </section>
                        </div>

                    </div><!-- primary -->



                </div>


    </main>

<?php get_footer(); ?>