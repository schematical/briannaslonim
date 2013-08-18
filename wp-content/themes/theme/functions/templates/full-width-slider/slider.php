<?php
/*-----------------------------------------------------------------------------------*/
/* Full Width Slider Template
/*-----------------------------------------------------------------------------------*/

/* Set Variables
================================================== */

// Get Slider Height
if (!($ag_slide['height'] =  of_get_option('of_home_slider_height'))) $ag_slide['height'] = '500';

/* Query Posts and Order
================================================== */
$query = new WP_Query( array( 
				'post_type' => 'slide', 
				'orderby' => 'menu_order', 
				'order' => 'ASC',
				'posts_per_page'=> -1 
				) 
			);
if ( $query->have_posts() ) : ?>

<div class="fullwidthbanner-container" <?php echo ($ag_slide['height']) ? 'style="max-height:'.$ag_slide['height'].'px !important;"' : ''; ?>>
    <div class="fullwidthbanner">
        <ul>
			<?php while ( $query->have_posts() ) : $query->the_post(); 
                
				/* Get Slide Layout and Use Correct Template
				================================================== */
				$ag_slide['layout'] = get_post_meta(get_the_ID(), 'ag_slide_layout', true);
				
				switch ($ag_slide['layout']) {
					case 'Center':
						echo get_template_part('functions/templates/full-width-slider/slide-center'); 
					break;
				
					case 'Right':
						echo get_template_part('functions/templates/full-width-slider/slide-right'); 
					break;
					
					default :
						echo get_template_part('functions/templates/full-width-slider/slide-left'); 
					break;	
				}
            
			// End Query           
            endwhile; wp_reset_postdata(); ?>
        </ul>
    </div>
</div>
<div class="clear"></div>

<?php 
// end if have_posts();
endif; ?>