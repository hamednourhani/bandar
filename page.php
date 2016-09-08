<?php



get_header();

?>


	<main class="site-main">



		<div class="site-content">
			<section class="layout">

				<?php get_sidebar("top"); ?>

				<div class="primary">

					<?php get_template_part('library/slider','area'); ?>
					<?php get_template_part('library/items','block'); ?>
					<?php get_template_part('library/related', 'articles'); ?>
					


					<?php
					if(have_posts()){ ?>
						<div class="page-content-desc">
							<h4 class="section-title">
								<?php the_title();?>
							</h4>
							<?php
							while(have_posts()) { the_post();
								the_content();
							}
							?>
						</div>
					<?php  }  ?>



					<?php get_template_part("library/best", "articles"); ?>
					<?php get_template_part("library/last","articles");?>


				</div><!-- primary -->

				<div class="secondary">
					<?php get_sidebar(); ?>
				</div><!-- secondary -->

			</section>
		</div>


	</main>

<?php get_footer(); ?>