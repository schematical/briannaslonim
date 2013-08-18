<?php 
get_header(); 

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
                   <h1 <?php echo ($ag_page['page_title_color']) ? 'style="color: ' . $ag_page['page_title_color'] . ';"' : '' ?>><?php wp_title("",true); ?></h1>
                <?php if (tag_description()) { ?> 
                    <h2 <?php echo ($ag_page['page_desc_color']) ? 'class="colored" style="color: ' . $ag_page['page_desc_color'] . ';"' : '' ?>><?php echo strip_tags (apply_filters('the_content', tag_description())); ?></h2>
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

<!-- Page Content -->
<div class="pagecontent no-caption" <?php echo ($ag_page['page_content_color']) ? 'style="background:' . $ag_page['page_content_color'] . ';"' : '' ?>>
	<?php echo get_template_part('functions/templates/indexsidebar'); ?>  
</div>
<!-- END Page Content -->

<?php
/* Show Any Sections
================================================== */
echo get_template_part('functions/templates/sections'); ?>

<?php 
/* Get Footer
================================================== */
get_footer(); ?>