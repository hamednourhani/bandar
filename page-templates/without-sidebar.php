<?php
/**
 * Template Name: without sidebar
 *
 *
 */


get_header(); ?>

    <main class="site-main without-sidebar">
        <?php if(have_posts()){ ?>
            <?php while(have_posts()) { the_post(); ?>

                <div class="banner-wrapper">

                    <?php get_template_part('library/banner','maker'); ?>

                </div><!-- banner-wrapper -->

                <div class="site-content ">
                    <section class="layout">
                        <header class="section-title">
                            <h1>
                                <?php the_title();?>
                            </h1>
                        </header>
                        <div class="primary">


                            <article class="hentry">
                                <header class="article-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <h3><?php the_title(); ?></h3>
                                    </a>
                                </header>
                                <main class="article-body">
                                    <?php the_content(); ?>

                                </main>
                            </article>

                        </div><!-- primary -->


                    </section>
                    <?php get_template_part('library/last','products');?>
                </div>
            <?php } ?>


        <?php } ?>

    </main>

<?php get_footer(); ?>