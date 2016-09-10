<?php
get_header();
?>
	<main class="site-main">
		<div class="site-content">
			<div class="banner-wrapper">
				<?php get_template_part('library/banner','maker');?>
			</div>
			<section class="layout">

				<div class="primary">
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
				</div><!-- primary -->

				<div class="secondary">
					<?php get_sidebar(); ?>
				</div><!-- secondary -->

			</section>
		</div>
	</main>
<?php get_footer(); ?>