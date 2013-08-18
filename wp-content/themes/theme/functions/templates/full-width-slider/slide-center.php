<?php 
/*-----------------------------------------------------------------------------------*/
/* Centered Slide Template
/*-----------------------------------------------------------------------------------*/

// Get the Page Query 
global $query; 

// Get All Template Options Declared in functions.php
$ag_slide = ag_get_slide_variables(get_the_ID(), false); ?>

<!-- Slide -->
<li <?php echo ($ag_slide['transition']) ? 'data-transition="' . $ag_slide['transition'] .'"' : 'data-transition="fade"' ?> data-slotamount="7" <?php echo ($ag_slide['slide_link'] && $ag_slide['slide_link'] != '') ? 'data-link="' . ag_addhttp($ag_slide['slide_link']) .'"' : '' ?> class="<?php echo 'slide-' . get_the_ID(); ?>">
    
    <!-- Slide Background Image -->
    <img src="<?php echo $ag_slide['image_src']; ?>" data-fullwidthcentering="on" alt="<?php the_title(); ?>">
    
    <!-- Slide Title and Button -->
    <div class="caption sft homeheadline center vcenter" data-x="0" data-y="<?php echo $ag_slide['caption_height']; ?>" data-speed="1200" data-start="700" data-easing="easeOutCubic"><div class="clear"></div>
        <div class="homecaption vcenter <?php echo ($ag_slide['caption_bg_color'] == '') ? 'nobg' : '';?>">
            
            <?php if ($ag_slide['caption_show'] != 'No') : ?>
            <h2 <?php echo ($ag_slide['caption_color']) ? 'class="' . $ag_slide['caption_color'] .'"' : '' ?>>
            	<span <?php echo ($ag_slide['caption_bg_color']) ? ag_hex2rgba($ag_slide['caption_bg_color'], '0.5') : '';?>>
					<?php the_title(); ?>
                </span>
            </h2>
            <?php endif; ?>
			<?php echo ($ag_slide['button_show'] != 'No') ? '<a class="button" href="'.$ag_slide['button_link'].'" ' . $ag_slide['button_style'] . '>' . strip_tags ( apply_filters('the_content', $ag_slide['button_text'])) . '</a>' : ''; ?> 
            <?php echo ($ag_slide['video']) ? '<a class="button videobutton" rel="prettyPhoto" href="'.$ag_slide['video'].'">' . __('Play Video', 'framework') . '</a>' : ''; ?>
         
			<?php 
            // If there is a slide video
            if ($ag_slide['video'] && $ag_slide['video'] != '') {?>
            
            	<!-- Slide Video -->
                <div class="homeimageinner video media">
                  <?php echo ag_slide_video($ag_slide['video']); ?>
                </div>
                    
            <?php 
            // Otherwise if there's a slide thumbnail
            } else if ( has_post_thumbnail() ) { ?>
            
            	<!-- Slide Featured Image -->
                <div class="homeimageinner image media">
                    <?php the_post_thumbnail('homefeatured'); ?>
                </div>
                    
            <?php }  //endif ?>
      
        </div>
    </div>
</li>
<!-- END Slide -->