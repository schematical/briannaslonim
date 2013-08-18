<?php 
/* 
Template Name: Homepage
*/
get_header(); 

/* Get Page Content Color
================================================== */
$ag_page['page_content_color'] = get_post_meta(get_the_ID(), 'ag_page_content_bg_color', true); ?>

<?php 
/* Get Full Width Slider
================================================== */
echo get_template_part('functions/templates/full-width-slider/slider'); ?>
		
        
<?php
/* Get Page Content
================================================== */
$content = get_the_content();
if($content != '') { // If there's page content ?>

    <!-- Page Content -->
    <div class="pagecontent" <?php echo ($ag_page['page_content_color']) ? 'style="background:' . $ag_page['page_content_color'] . ';"' : '' ?>>
        <div class="container content">
            <div class="sixteen columns">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- END Page Content -->

<?php } ?>

<?php
/* Get Any Sections
================================================== */
echo get_template_part('functions/templates/sections'); ?> 

<?php 
/* Get Footer
================================================== */
get_footer(); ?>