<?php

/*******************************************************
*
*	Custom News Widget
*	By: Andre Gagnon
*	http://www.designcirc.us
*
*******************************************************/

// Initialize widget
add_action( 'widgets_init', 'ag_news_widgets' );

// Register widget
function ag_news_widgets() {
	register_widget( 'AG_News_Widget' );
}

// Widget class
class ag_news_widget extends WP_Widget {

/*----------------------------------------------------------*/
/*	Set up the Widget
/*----------------------------------------------------------*/
	
	function AG_News_Widget() {
	
		/* General widget settings */
		$widget_ops = array( 'classname' => 'ag_news_widget', 'description' => __('A widget that displays the latest post(s) from a category.', 'framework') );

		/* Widget control settings */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ag_news_widget' );

		/* Create widget */
		$this->WP_Widget( 'ag_news_widget', __('Custom News Widget', 'framework'), $widget_ops, $control_ops );
	}

/*----------------------------------------------------------*/
/*	Display The Widget 
/*----------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Variables from settings. */
		$postnum = $instance['postnum'] ;
		$category = $instance['category'] ;
		
		/* Before widget (defined in functions.php). */
		echo $before_widget;

		/* Display The Widget */
		?>
		<?php 
		// First loop to display only my single, most recent sticky post
		// Display the widget title if one was input
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
		 <?php $the_query = new WP_Query('cat='.$category.'&showposts='.$postnum); //or category_name=
		    while ($the_query->have_posts()) : $the_query->the_post();?>
		            <div class="sidepost">
		                <div class="articleinner">
		                 <div class="categories">
		                 <?php echo ag_get_cats(3); ?></div>
		                     <h3><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"><?php the_title(); ?></a></h3>
		                     <span class="date"><?php the_time(get_option('date_format')); ?> | <?php the_author_posts_link(); ?></span>
								<?php /* if the post has a WP 2.9+ Thumbnail */
		                        if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
		                        <div class="thumbnailarea">
		                         	<a class="thumblink" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('postsidebar', array('class' => 'scale-with-grid')); /* post thumbnail settings configured in functions.php */ ?>
		                            </a>
		                        </div>
		                        <?php endif; ?>
		                     <?php global $more; $more=0; 
							// echo get_the_content_unformatted_more('<span class="more-link">' . __('Read More', 'framework') . '</span>');
							the_content(__('Read More', 'framework')); ?>
		                     <div class="clear"></div>
		                </div>
		            </div>
		        
		    <?php endwhile;  wp_reset_query(); ?>

		<?php
				/* After widget (defined by themes). */
				echo $after_widget;
			}

/*----------------------------------------------------------*/
/*	Update the Widget
/*----------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Remove HTML: */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['postnum'] = strip_tags( $new_instance['postnum'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
	
		return $instance;
	}
	

/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Default widget settings */
		$defaults = array(
		'title' => '',
		'postnum' => '',
		'category' => '',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('News Title (Optional):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'postnum' ); ?>">
        <?php _e('Number of Posts:', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'postnum' ); ?>" name="<?php echo $this->get_field_name( 'postnum' ); ?>" value="<?php echo $instance['postnum']; ?>" />
</p>
<?php if ($displaycatname = $instance['category']) { echo '<p>Current Category: '.get_cat_name( $displaycatname ).'</p>'; }?> 
<p>
    <label for="<?php echo $this->get_field_id( 'category' ); ?>">
        <?php _e('Choose a Category:', 'framework'); ?>
    </label>
   <?php wp_dropdown_categories( 'name='.$this->get_field_name( 'category' ).'&id='.$this->get_field_id( 'category' ).'&show_count=1');?>                             
    <!--<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo $instance['category']; ?>" /> -->
</p>
<hr>
<?php
	}
}
?>