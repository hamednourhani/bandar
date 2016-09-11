<?php
/*
*
*/?>
		<div class="post-meta">
				
						<ul class="post-meta-list">
							
							<?php if( 'post' == get_post_type() ){
											// $cat_list =get_the_term_list( get_the_ID(), 'news_cat', '<span class="cats-title">' . __( 'News category :', 'itstar' ) . '</span> ', ', ' );
											$tag_list =get_the_term_list( get_the_ID(), 'post_tag', '', ', ' );
											?>
								
									
								
									<?php if ( $tag_list) { ?>
											


												<li class="meta-tag">
													<i class="fa fa-tags"></i>
													<?php echo $tag_list ;?>
												</li>
									<?php } ?>
									
							<?php } ?>

						
							
							<?php if( 'product' == get_post_type() ){
											// $cat_list =get_the_term_list( get_the_ID(), 'news_cat', '<span class="cats-title">' . __( 'News category :', 'itstar' ) . '</span> ', ', ' );
											$tag_list =get_the_term_list( get_the_ID(), 'product_cat', '', ', ' );

											?>
								
									
								
									<?php if ( $tag_list) { ?>


												<li class="meta-tag">
													<i class="fa fa-folder-open"></i>
													<?php echo $tag_list ;?>
												</li>
									<?php } ?>
									
							<?php } ?>

							<?php if( 'post' == get_post_type() ){
								// $cat_list =get_the_term_list( get_the_ID(), 'news_cat', '<span class="cats-title">' . __( 'News category :', 'itstar' ) . '</span> ', ', ' );
								$tag_list =get_the_term_list( get_the_ID(), 'category', '', ', ' );

								?>



								<?php if ( $tag_list) { ?>


									<li class="meta-tag">
										<i class="fa fa-folder-open" aria-hidden="true"></i>
										<?php echo $tag_list ;?>
									</li>
								<?php } ?>

							<?php } ?>




							<?php

								if ( in_array( get_post_type(), array( 'post' ) ) ) {
									$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';



									$time_string = sprintf( $time_string,
//										esc_attr( get_the_date( 'j F Y' ) ),
//										get_the_date(),
										esc_attr( get_the_modified_date( 'j F Y' ) ),
										get_the_modified_date()
									);?>

									<li class="posted-on">
										<i class="fa fa-calendar" aria-hidden="true"></i>
										<?php echo $time_string;?>
									</li>


								<?php } ?>

							
						</ul><!--.post-meta-list-->
							
						
									
		</div><!--.post-meta-->		