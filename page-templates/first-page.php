<?php
/**
 * Template Name: First Page
 *
 *
 */
get_header();
?>

    <main class="site-main">
                <div class="site-content full-width">

                    <div class="banner-wrapper">
                        <?php get_template_part('library/banner','maker');?>
                    </div>
                         <?php get_template_part('library/last','products');?>

                        <section class="full-width-wrapper">
                            <div class="primary">
                                <?php
                                    if(have_posts()){ ?>
                                    <div class="page-content-desc">
                                        
                                            <?php
                                                while(have_posts()) { the_post();
                                                    the_content();
                                                }
                                            ?>
                                    </div>
                                <?php  }  ?>
                            </div><!-- primary -->
                        </section>
                </div>
    </main>
<?php get_footer(); ?>