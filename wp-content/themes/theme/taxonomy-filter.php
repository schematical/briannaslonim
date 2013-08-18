<?php 
get_header(); 

// Get Portfolio Page ID and URL      
$portfolio_pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-portfolio.php'
));
foreach($portfolio_pages as $page){
	$pageID = $page->ID;
	$portfolio_page_url = get_permalink($pageID);
}

/* Get Page Options Defined in functions.php
================================================== */
$ag_page = ag_get_page_variables($pageID);

/* Get Portfolio Page-Specific Options
================================================== */
$ag_page['pagination'] = of_get_option('of_pagination_style');
$ag_page['portfolio_number'] = (of_get_option('of_portfolio_number')) ? of_get_option('of_portfolio_number') : 6;
$ag_portfolio['thumbsize'] = (of_get_option('of_portfolio_crop') == 'crop') ? 'portfolio-three' : 'portfolio-three-nc';
$termDiscription = term_description( '', get_query_var( 'filter' ) ); 
$current_filter = get_query_var('filter');
$current_filter_tax = get_terms('filter', 'slug='.$current_filter); ?>

<!-- Page Title -->
<div class="pagetitle" <?php echo ($ag_page['background_style']) ? $ag_page['background_style'] : '';?>>
    <div class="container verticalcenter">
        <div class="container_row">
        	<div class="verticalcenter cell">
                <div class="ten columns title">
                    <h1 <?php echo ($ag_page['page_title_color']) ? 'style="color: ' . $ag_page['page_title_color'] . ';"' : '' ?>><?php wp_title("",true); ?></h1>
                    <?php if ($ag_page['page_desc']) { ?> 
                        <h2 <?php echo ($ag_page['page_desc_color']) ? 'class="colored" style="color: ' . $ag_page['page_desc_color'] . ';"' : '' ?>><?php echo strip_tags (apply_filters('the_content', $termDiscription)); ?> </h2>
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

<!-- Page Content Area -->
<div class="pagecontent" <?php echo ($ag_page['page_content_color']) ? 'style="background:' . $ag_page['page_content_color'] . ';"' : '' ?>>

<?php 
/* #Query The Posts
======================================================*/			
$wp_query = new WP_Query( array( 
	'post_type' => 'portfolio', // Portfolio Post Type
	'orderby' => 'menu_order', // Sorted by Drag and Drop Order
	'order' => 'ASC', // Top to Bottom
	'posts_per_page' => $ag_page['portfolio_number'], // Get Page Number From Theme Options
	'paged' => $paged, // Get Current Page
	'filter' => $current_filter // Only Posts From Current Filter
	) 
); ?>
		
<?php 
/* #Get Only The Terms From These Filtered Portfolios
======================================================*/
$term_list = array();
// Get only terms from these posts
while ($wp_query->have_posts()) : $wp_query->the_post();
	$term_list = array_merge($term_list, wp_get_post_terms($post->ID, 'filter', array("fields" => "ids")));
endwhile; 
// Remove Duplicate
$term_list = array_unique($term_list);
// Remove Current term
if(($key = array_search($current_filter_tax[0]->term_taxonomy_id, $term_list)) !== false) {
    unset($term_list[$key]);
}
$term_list = implode(',', $term_list); 
?>		
    <!-- Homepage Filter -->
    <div class="container filtercontainer">
    	<ul class="filter sixteen columns" id="filters">
            <li><a href="#" data-filter="<?php echo '.'.$current_filter; ?>" class="active"><?php echo $current_filter_tax[0]->name; ?></a></li>
             <?php if (!empty($term_list)) { wp_list_categories(array('title_li' => '', 'include' => $term_list, 'taxonomy' => 'filter', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter()));} ?>
    	</ul>        
        <div class="clear"></div>
    </div>
    <!-- END Homepage Filter -->
    
    <!-- Thumbnail Area -->
    <div class="container isowrap">
    	<div class="isocontainer">
            <div id="isotope" class="isotopecontainer" data-value="3">
            	
				<?php 
				/* #Loop through sticky posts
				======================================================*/
				while ($wp_query->have_posts()) : $wp_query->the_post();   ?>
                
                <?php $terms = get_the_terms( get_the_ID(), 'filter' ); ?>
                
                <!-- Portfolio Item -->
                <div class="isobrick thirds  <?php if ($terms) { foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->slug)). ' '; } } ?>">
                
                	<!-- Featured Image -->
                    <div class="featured-image">
                        <a class="thumblink" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail($ag_portfolio['thumbsize'], array('class' => 'scale-with-grid')); /* post thumbnail settings configured in functions.php */ ?>
                        </a>
                    </div>
                    <!-- END Featured Image -->
                    
                    <!-- Portfolio Content -->
                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="morecontent">
                    	<?php global $more; $more = 0; ?>
						<?php the_content( __('Read More', 'framework')); ?>
                    </div>
                    <!-- END Portfolio Content -->
                    
                </div>
                <!-- END Portfolio Item -->
                          
                <?php endwhile; ?>
            </div>
        </div>
        
        <div class="sixteen columns">
            
            <!-- Pagination
            ================================================== -->
            
            <?php if ($ag_page['pagination'] && $ag_page['pagination'] == 'infinite') : ?>  
            <!-- Pagination -->
            
            <p class="more-posts"><?php next_posts_link(__('Load More Posts', 'framework')); ?></p>
            <div class="clear"></div>
                   
            <?php else : ?>
              
            <div class="pagination">
                <?php
                    global $wp_query;
            
                    $big = 999999999; // need an unlikely integer
            
                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $wp_query->max_num_pages
                    ) );
                ?>   
                <div class="clear"></div>
            </div>
            
            <?php endif; wp_reset_query(); ?>
            
            <!-- END pagination --> 
        </div>
    </div>
    <!-- END Thumbnail Area -->
    
</div>
<!-- END Page Content Area -->
<?php
/* Show Any Sections
================================================== */
echo get_template_part('functions/templates/sections'); ?>

<?php 
/* Get Footer
================================================== */
get_footer(); ?>