



<?php if(is_category() || is_tag() || is_tax()){ 
		$display = false; 
		// Get only image url
		
		?>

			<div class="single-cat-title">
				<section class="layout">
					<h1><?php single_cat_title('',true); ?></h1>
				</section>
			</div>
				
<?php } elseif(is_search()) { ?>
		<div class="single-cat-title">
			<section class="layout">
				<h1><?php printf( __( 'Search Results for: %s', 'itstar' ), get_search_query() ); ?></h1>
			</section>
		</div>
<?php } elseif(is_singular()) {
		$banner_mod = get_post_meta(get_the_ID(),'_itstar_banner_mod',1);

		switch ($banner_mod) {
			case 'slider':
				$slider_shortcode = get_post_meta(get_the_ID(),'_itstar_slider_shortcode');
				echo do_shortcode($slider_shortcode[0] );
				break;
			case 'image':
				$image = get_post_meta( get_the_ID(), '_itstar_image' );
				echo '<div class="banner-inner"><img class="page-banner" src="'.$image[0].'"/></div>';
				break;
			case 'map':
				$map = get_post_meta( get_the_ID(), '_itstar_map',1 );
				echo '<div class="banner-wrapper"><div class="banner-inner">'.$map.'</div></div>';
				break;
			default: 
				echo '<div class="banner-space"></div>';
				break;
		} ?>

		
<?php } else{ ?>
		<div class="banner-space">
		</div>
<?php  } ?>