<?php get_header(); 

/* Count The Number of Views For Popular Posts
================================================== */
setPostViews(get_the_ID());

/* Get The Posts Style
================================================== */
if (!($ag_post['post_style'] = of_get_option('of_post_style'))) $ag_post['post_style'] = 'single-sidebar'; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	/* Echo The Posts Style
	================================================== */
	echo get_template_part('functions/templates/' . $ag_post['post_style']); 

endwhile; else: ?>
	<!-- Nothing Found -->
	<p><?php _e('Sorry, no posts matched your criteria.', 'framework'); ?></p>
    <!-- END Nothing Found -->
<?php endif; ?>
	
<?php 
/* Get Footer
================================================== */
get_footer(); ?>