<?php get_header(); ?>

<?php
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

$product_cat_id = get_queried_object()->term_id;
$args = array(
	'posts_per_page' => 20,
	'tax_query' => array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'term_id',
			'terms'    => $product_cat_id,
		)
	),
	'meta_key' => '_itstar_product_pri',
	'orderby' => 'meta_value',
	'order'   => 'DESC',
	'paged' => $paged,
	'hierarchical' => 1,
	'exclude' => '',
	'include' => '',
//    'meta_key' => '_itstar_feature_post_radio',
//    'meta_value' => 'yes',
	'authors' => '',
	'child_of' => 0,
	'parent' => -1,
	'exclude_tree' => '',
	'number' => '',
//	'offset' => 0,
	'post_type' => 'product',
	'post_status' => 'publish',
	'suppress_filters' => false
);
$products = query_posts($args);
?>


	<main class="site-main">

		
		<div class="site-content ">
			<section class="layout">

				<?php get_sidebar("top"); ?>

				<div class="primary">

					<div class="products-block">
							<h1 class="section-title ">
								<?php single_term_title();?>
							</h1>
						<?php if(have_posts()){ ?>
							<ul class="products-list">
								<?php while(have_posts()) { the_post();
									$product_link = get_post_meta( get_the_ID(), '_itstar_product_link',1 );
									if($product_link == ""){
										$product_link =  get_the_permalink();
									}
									?>
									<li>
											<a href="<?php echo $product_link; ?>">
												<div class="product-thumb">
													<?php echo get_the_post_thumbnail(get_the_ID(),'post-thumb');?>
												</div>
												<div class="product-detail">
													<h4 class="product-title">
														<?php the_title(); ?>
													</h4>
                                        <span class="product-desc">
                                            <?php the_excerpt();?>
                                         </span>
												</div>
											</a>
										</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>


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