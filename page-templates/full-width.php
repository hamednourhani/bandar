<?php
/**
 * Template Name: full weight
 *
 *
 */


get_header(); ?>

    <main class="site-main full-width">
        <?php if(have_posts()){ ?>
            <?php while(have_posts()) { the_post(); ?>

                <div class="banner-wrapper">

                    <?php get_template_part('library/banner','maker'); ?>

                </div><!-- banner-wrapper -->

                <div class="site-content">


                        <div class="primary">
                            <?php the_content(); ?>
                        </div><!-- primary -->



                </div>
            <?php } ?>



        <?php } ?>

    </main>

<?php get_footer(); ?>