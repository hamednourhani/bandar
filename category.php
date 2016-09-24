<?php get_header(); ?>

	<main class="site-main">


		<div class="site-content">
			<section class="layout">

				<div class="primary">

					<div class="archive-title">

						<header class="section-title">
							<h1>
								<?php single_cat_title();?>
							</h1>
						</header>

					</div>


					<?php if(have_posts()){ ?>
						<?php while(have_posts()) { the_post();
							$post_link = get_post_meta( get_the_ID(), '_itstar_item_link',1 );
							if($post_link == ""){
								$post_link =  get_the_permalink();
							}
							?>

							<article class="hentry archive-article">

								<div class="featured-image">
									<a href="<?php echo $post_link; ?>">
										<?php the_post_thumbnail('post-thumb'); ?>
									</a>
								</div>


								<main class="article-body">
									<h3 class="article-title">
										<a href="<?php echo $post_link; ?>">
											<?php the_title(); ?>
										</a>
									</h3>
									<?php the_excerpt(); ?>
									<?php get_template_part('library/post','meta');?>
								</main>

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