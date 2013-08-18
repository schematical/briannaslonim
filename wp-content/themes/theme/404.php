<?php get_header(); 

$pageID = get_option('page_for_posts');

/* Get Page Options Defined in functions.php
================================================== */
$ag_page = ag_get_page_variables($pageID); ?>

<!-- Page Title -->
<div class="pagetitle" <?php echo ($ag_page['background_style']) ? $ag_page['background_style'] : '';?>>
    <div class="container verticalcenter">
        <div class="container_row">
        	<div class="verticalcenter cell">
                <div class="ten columns title">
                    <h1><?php _e('Page Not Found', 'framework'); ?></h1>
                    <?php if ($ag_page['page_desc']) { ?> 
                        <h2 <?php echo ($ag_page['page_desc_color']) ? 'style="color: ' . $ag_page['page_desc_color'] . ';"' : '' ?>> <?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></h2>
                    <?php } ?>	                
                </div>
            </div>
            <div class="verticalcenter cell">
            	<div class="six columns">
           		</div>
            </div>
            <div class="clear"></div>
        </div>
      </div>
</div>
<!-- END Page Title -->

<div class="clear"></div>

<!-- Page Content Area -->
<div class="pagecontent no-caption" <?php echo ($ag_page['page_content_color']) ? 'style="background:' . $ag_page['page_content_color'] . ';"' : '' ?>>
    <div class="container">
        <div class="eleven columns">
             <h4><?php _e('Try searching for it:', 'framework'); ?></h4>
             <p><?php get_search_form(true); ?></p>  
        </div>
        <div class="four columns offset-by-one">
            <div class="sidebar">
                 <?php /* Widget Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ) ?>
            </div>
		</div>
        <div class="clear"></div>
    </div>
</div>
<!-- END Page Content Area -->

<?php 
/* Get Footer
================================================== */
get_footer(); ?>