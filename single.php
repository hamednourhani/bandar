<?php get_header(); ?>
	
	<main class="site-main">
		<?php if(have_posts()){ ?>
			<?php while(have_posts()) { the_post(); ?>


				<div class="site-content">
					<div class="banner-wrapper">
						<?php get_template_part('library/banner','maker');?>
					</div>
					<section class="layout">
						<?php get_sidebar("top"); ?>
						<div class="primary">
							
								
							<article class="hentry single-article">

								<header class="section-title">
									<h1>
										<?php the_title();?>
									</h1>
								</header>
								<main class="article-body">
									<?php the_content(); ?>

								</main>
								<footer class="article-footer">
									<?php get_template_part('library/post','meta'); ?>
								</footer>

							</article>

							<div class="comment-area">
								<?php comments_template(); ?>
							</div>
											
						</div><!-- primary -->

						<div class="secondary">
							<?php get_sidebar(); ?>
						</div><!-- secondary -->
					</section>
				</div>

			<?php } ?>

		<?php } else { ?>	
			
			<div class="site-content">
				<section class="layout">
					<div class="secondary">
						<?php get_sidebar(); ?>
					</div><!-- secondary -->
				</section>
				<?php get_template_part('library/last','products');?>
			</div>

		<?php } ?>
		
	</main>

<?php get_footer(); ?>