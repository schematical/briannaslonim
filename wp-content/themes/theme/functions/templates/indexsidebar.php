<div class="container blog-sidebar">
	<!-- Ten Column Section -->
	<div class="eleven columns">

		<?php 
		if (!($ag_post['slide_number'] = of_get_option('of_thumbnail_number'))) $ag_post['slide_number'] = '6'; 
		
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		
		$ag_post['video'] = get_post_meta($post->ID, 'ag_post_video', true);
		$ag_post['author'] = of_get_option('of_author_style');
		
		$ag_post['thumbsize'] = (of_get_option('of_post_crop')) ? of_get_option('of_post_crop') : 'post';
		
		?>

		<div <?php post_class(); ?>> <!-- WP Post Class -->
			<!-- Featured Image Area -->
			
			<?php 
            // Get Featured Slideshow or Section Video
            if (!$ag_post['video'] || $ag_post['video'] == '') {
                echo ag_post_slideshow($ag_post['thumbsize'], get_the_ID(), $ag_post['slide_number'], false, true);
            } else {
                echo ag_post_video($ag_post['video']);	
            }?>
            
            <div class="clear"></div>
                 <?php if (isset($ag_post['author']) && $ag_post['author'] == 'avatar') { ?>
                 	<div class="avatar-info">
                        <?php echo get_avatar( get_the_author_meta('ID'), 70, '', get_the_author_meta('display_name') ); ?>
                        <div class="comment-counter">
                            <a href="<?php comments_link(); ?>" title="<?php _e('Comments', 'framework'); ?>"><?php comments_number('0', '1', '%'); ?> </a>
                        </div>
                        <div class="author">
                            <p>By <?php the_author_posts_link(); ?> <p>
                            <p><?php echo get_the_date(); ?></p>
                        </div>
                        <div class="clear"></div>
                        <div class="line"></div>
            		</div>
                 <?php } else { ?>
                 <div class="date">
                    <h4 class="day">
                        <?php the_time('d'); ?>
                        <span>
                         <?php the_time('M'); ?>
                         </span>
                    </h4>
                    <p>
                        <?php _e('By', 'framework'); ?> <?php the_author_posts_link(); ?>
                    </p>
                    <p>
                     <?php if ( comments_open() ) : ?>
                        <a href="<?php comments_link(); ?>" title="<?php comments_number('No Comments', 'One Comment', '% Comments'); ?>"><?php comments_number('No Comments', 'One Comment', '% Comments'); ?></a>
                     <?php endif; ?> 
                    </p>
                    <div class="clear"></div>
                    <div class="line"></div>
                </div>
                
                 <?php } ?>
                 
            <div class="content">
            <div class="categories"><?php echo ag_get_cats(3); ?></div>
                <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <div class="mobiledate">
                    <p><?php the_time(get_option('date_format')); ?> | <?php _e('By', 'framework'); ?> <?php the_author_posts_link(); ?> | <?php if ( comments_open() ) : ?>
                    <a href="<?php comments_link(); ?>" title="<?php comments_number('No Comments', 'One Comment', '% Comments'); ?>"><?php comments_number('No Comments', 'One Comment', '% Comments'); ?></a>
                    <?php endif; ?> </p>
                </div>
				<?php the_content( __('Read More', 'framework')); ?>
            </div>
			<div class="clear"></div>
            
		</div> <!-- END WP Post Class -->

		<?php endwhile; else: ?>
		<h4><?php _e('Sorry, no posts matched your criteria.', 'framework'); ?></h4>
		<?php endif; ?>
        
        <!-- Pagination
        ================================================== -->        
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
        <!-- End pagination --> 

	</div><!-- END Ten Column Section -->

	<div class="four columns offset-by-one">
		<div class="sidebar">
       		 <?php /* Widget Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ) ?>
    	</div>
	</div>

	<div class="clear"></div>
	
</div><!-- END Container Home -->