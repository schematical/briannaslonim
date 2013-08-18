<?php 
get_header(); 

$pageID = get_the_ID();

/* Get Page Options Defined in functions.php
================================================== */
$ag_page = ag_get_page_variables($pageID); ?>

<!-- Page Title -->
<div class="pagetitle" <?php echo ($ag_page['background_style']) ? $ag_page['background_style'] : '';?>>
    <div class="container verticalcenter">
        <div class="container_row">
        	<div class="verticalcenter cell">
                <div class="ten columns title">
                   <h1 <?php echo ($ag_page['page_title_color']) ? 'style="color: ' . $ag_page['page_title_color'] . ';"' : '' ?>><?php the_title(); ?></h1>
                    <?php if ($ag_page['page_desc']) { ?> 
                        <h2 <?php echo ($ag_page['page_desc_color']) ? 'class="colored" style="color: ' . $ag_page['page_desc_color'] . ';"' : '' ?>><?php echo strip_tags ( apply_filters('the_content', $ag_page['page_desc'])); ?></h2>
                    <?php } ?>		
                </div>
            </div>
            <div class="verticalcenter cell">
            	<div class="six columns">
				   <?php echo $ag_page['button']; ?>
           		</div>
            </div>
            <div class="clear"></div>
        </div>
      </div>
</div>
<!-- END Page Title -->

<div class="clear"></div>

<?php
// Get Any Sections
//========================================
echo get_template_part('functions/templates/sections'); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php if (get_the_content($pageID)) : ?>

    <!-- Page Content -->
    <div class="pagecontent" <?php echo ($ag_page['page_content_color']) ? 'style="background:' . $ag_page['page_content_color'] . ';"' : '' ?>>
        <div class="container">
            <div class="eleven columns">
                <?php the_content($pageID); ?>
            </div>
            
    
            <div class="four columns offset-by-one">
                <div class="sidebar">
                    <?php  /* Widget Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) ?>
                </div>
            </div>
           
        </div>
    </div>
    <!-- END Page Content -->

<?php endif; endwhile; endif; ?>

<?php 
/* Get Footer
================================================== */
get_footer(); ?>