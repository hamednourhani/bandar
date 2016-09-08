<?php if ( is_active_sidebar( 'ad-sidebar' )) : ?>
		
		<div class="footer-widget-area">
			<section class="layout">
				 
					<div class="footer-widget-col">
						<?php dynamic_sidebar( 'footer-first' ); ?>
					</div>
					
					<div class="footer-widget-col">
						<?php dynamic_sidebar( 'footer-first-col2' ); ?>
					</div>
					
					<div class="footer-widget-col">
						<?php dynamic_sidebar( 'footer-first-col3' ); ?>
					</div>

					<div class="footer-widget-col">
						<?php dynamic_sidebar( 'footer-first-col4' ); ?>
					</div>
 

			</section>
		</div>		

		  
				
 <?php endif; ?>