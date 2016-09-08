<?php

$show_slide_boolean = get_post_meta( get_the_ID(), '_itstar_show_slider_radio',1 );
//var_dump($show_slide_boolean);
if($show_slide_boolean == "yes"){

	$slide_cat_id = get_post_meta( get_the_ID(), '_itstar_slide_term_id',1 );


	$args = array (
		'numberposts' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'slide_cat',
				'field'    => 'term_id',
				'terms'    => $slide_cat_id,
			)
		),
		'sort_order' => 'asc',
		'sort_column' => 'post_title',
		'hierarchical' => 1,
		'exclude' => '',
		'include' => '',
		'authors' => '',
		'child_of' => 0,
		'parent' => -1,
		'exclude_tree' => '',
		'number' => '',
		'offset' => 0,
		'post_type' => 'slide',
		'post_status' => 'publish',
		'suppress_filters' => false
		);
	// The Query
		$page_list = get_posts( $args );

//		?>
<!--			<pre>-->
<!--				--><?php //var_dump($page_list); ?>
<!--			</pre>-->
<!--		--><?php

	 ?>


		<?php if(!empty($page_list) ){ ?>
		<div class="slider-wrap">
			<div id="page-slider" class="slider-pro">

				<div class="sp-slides">
				<?php foreach ( $page_list as $page ) :
					$slide_url = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'slider');
					$slide_link = get_post_meta( $page->ID, '_itstar_slide_link',1 );
				?>
					<div class="sp-slide">
						<a href="<?php
							if($slide_link !== ''){
								echo $slide_link;
							}else {
								echo get_permalink($page->ID);
							}
						?> "
							<?php if($slide_link !== ''){echo 'rel="nofollow"';} ?>
							>
							<img class="sp-image" src="<?php echo get_template_directory_uri();?>/images/blank.gif"
								data-src="<?php echo $slide_url[0]; ?>"
								data-retina="<?php echo $slide_url[0]; ?>"/>
						</a>


					</div>
				<?php endforeach; ?>

				</div>

				<div class="sp-thumbnails">
					<?php foreach ( $page_list as $page ): ?>

						<div class="sp-thumbnail">
							<div class="sp-thumbnail-title">
								<a href="<?php echo get_permalink( $page->ID ); ?> " >
									<?php echo $page->post_title; ?>
								</a>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
			</div>
			<script type="text/javascript" >
				jQuery( document ).ready(function( $ ) {
					if(typeof $.fn.sliderPro !== 'undefined') {
						$('#page-slider').sliderPro({
							width: 960,
							height: 500,
							arrows: true,
							fade: true,
							buttons: false,
							waitForLayers: true,
							thumbnailWidth: 200,
							thumbnailHeight: 50,
							thumbnailPointer: true,
							autoplay: true,
							loop:true,
							autoScaleLayers: false,
							breakpoints: {
								1200: {
									thumbnailsPosition: 'bottom',
									thumbnailWidth: 80,
									thumbnailHeight: 50
								},
	//							500: {
	//								thumbnailsPosition: 'bottom',
	//								thumbnailWidth: 50,
	//								thumbnailHeight: 50
	//							}
							}
						});
					}
				});

			</script>
		</div>
		 <?php
		}
		
	?>


<?php } ?>