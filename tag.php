<?php get_header(); ?>

	<main class="site-main">


		<div class="site-content ">
			<section class="layout">
				<?php get_sidebar("top"); ?>
				<div class="primary">

						<div class="archive-title">
							<h1 class="section-title ">
								<?php single_term_title();?>
							</h1>
						</div>

					<?php if(have_posts()){ ?>


							<?php while(have_posts()) { the_post();	?>

								<article class="hentry archive-article post-archive">

									<div class="featured-image">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('video-larg-thumb'); ?>
										</a>
									</div>

									<header class="article-title">
										<a href="<?php echo the_permalink(); ?>">
											<h3><?php the_title(); ?></h3>
										</a>
									</header>

									<main class="article-body">

										<?php the_excerpt(); ?>

									</main>
									<footer class="article-footer">
										<?php get_template_part('library/post','meta');?>
									</footer>
								</article>
							<?php } ?>

					<?php } ?>

					<nav class="pagination">
						<?php itstar_pagination(); ?>
					</nav>

				</div><!-- primary -->

				<div class="secondary">
					<?php get_sidebar(); ?>
				</div><!-- secondary -->


			</section>
		</div>

	</main>

<?php get_footer(); ?>