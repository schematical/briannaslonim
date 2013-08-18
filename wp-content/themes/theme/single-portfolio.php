<?php get_header(); 

/* Get Portfolio Page ID and URL
================================================== */     
$portfolio_pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-portfolio.php'
));
foreach($portfolio_pages as $page){
	$portfolio_page_id = $page->ID;
	$portfolio_page_url = get_permalink($portfolio_page_id);
}


if ( have_posts() ) : while ( have_posts() ) : the_post(); 
 
$pageID = get_the_ID();

/* Get Portfolio Options Defined in functions.php
================================================== */
$ag_portfolio = ag_get_portfolio_variables($pageID, $portfolio_page_id);

if (!($ag_post['slide_number'] = of_get_option('of_thumbnail_number '))) $ag_post['slide_number'] = '6'; ?>

<!-- Page Title -->
<div class="pagetitle" <?php echo ($ag_portfolio['background_style']) ? $ag_portfolio['background_style'] : '';?>>
    <div class="container verticalcenter">
        <div class="container_row">
        	<div class="verticalcenter cell">
                <div class="ten columns title">
                    <h1 <?php echo ($ag_portfolio['page_title_color']) ? 'style="color: ' . $ag_portfolio['page_title_color'] . ';"' : '' ?>><?php the_title(); ?></h1>
                	<?php if ($ag_portfolio['portfolio_desc']) { ?> 
                        <h2 <?php echo ($ag_portfolio['portfolio_desc_color']) ? 'class="colored" style="color: ' . $ag_portfolio['portfolio_desc_color'] . ';"' : '' ?>><?php echo strip_tags (apply_filters('the_content', $ag_portfolio['portfolio_desc'])); ?></h2>
                    <?php } ?>			
                </div>
            </div>
            <div class="verticalcenter cell">
            	<div class="six columns">
                	<?php if ($ag_portfolio['project_button'] == 'on') {
						echo '<a href="'. $portfolio_page_url .'" class="button huge alignright" style="';
						echo ($ag_portfolio['button_color']) ? 'background:' . $ag_portfolio['button_color'] . '; ' : '';
						echo ($ag_portfolio['button_text_color']) ? 'color:' . $ag_portfolio['button_text_color'] . '; ' : '';
						echo '">&larr; '. strip_tags (apply_filters('the_content', $ag_portfolio['project_button_text'])) .'</a>';
					}?>					
           		</div>
            </div>
            <div class="clear"></div>
        </div>
      </div>
</div>
<!-- END Page Title -->

<div class="clear"></div>

<!-- Page Content Area -->
<div class="pagecontent" <?php echo ($ag_portfolio['portfolio_content_color']) ? 'style="background:' . $ag_portfolio['portfolio_content_color'] . ';"' : '' ?>>
    <div class ="container  portfolio">
           <div class="eleven columns">
				<?php 
                // Get Featured Slideshow or Section Video
                if (!$ag_portfolio['video'] || $ag_portfolio['video'] == '') {
                    echo ag_post_slideshow($ag_portfolio['thumbsize'], get_the_ID(), $ag_portfolio['slide_number'], false, false);
                } else {
                    echo ag_post_video($ag_portfolio['video']);	
                }?>
            </div>
            <div class="five columns">
            	<div class="portfoliocontent">
                	<?php echo ($ag_portfolio['content_title'] && $ag_portfolio['content_title'] != '') ? '<h4>' . $ag_portfolio['content_title'] .'</h4>' : ''; ?>
					<?php the_content($pageID); ?>
                </div>
            </div>
        <div class="clear"></div>
    </div>
</div>
<!-- END Page Content Area -->

<?php
/* Get Any Sections
================================================== */
echo get_template_part('functions/templates/sections'); ?> 

<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.', 'framework'); ?></p>
<?php endif; ?>

<?php 
/* Get Footer
================================================== */
get_footer(); ?>