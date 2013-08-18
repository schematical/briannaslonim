<?php

/*******************************************************
*
*	Custom Posts and Facebook Tab Widget
*	By: Andre Gagnon
*	http://www.themewich.com
*
*******************************************************/

// Initialize widget
add_action( 'widgets_init', 'ag_tab_widgets' );

// Register widget
function ag_tab_widgets() {
	register_widget( 'AG_Tab_Widget' );
}

// Widget class
class ag_tab_widget extends WP_Widget {

/*----------------------------------------------------------*/
/*	Set up the Widget
/*----------------------------------------------------------*/
	
	function AG_Tab_Widget() {
	
		/* General widget settings */
		$widget_ops = array( 'classname' => 'ag_tab_widget', 'description' => __('A widget that displays popular posts, facebook like box.', 'framework') );

		/* Widget control settings */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ag_tab_widget' );

		/* Create widget */
		$this->WP_Widget( 'ag_tab_widget', __('Custom Posts and Facebook Tab Widget', 'framework'), $widget_ops, $control_ops );
	}

/*----------------------------------------------------------*/
/*	Display The Widget 
/*----------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Variables from settings. */
		$numposts = $instance['numposts'] ;
		$facebook = $instance['facebook'] ;
		$social = $instance['social'] ;
		$fbfooter = $instance['fbfooter'] ;
		$feed = $instance['feed'] ;
		$faces = $instance['faces'] ;
		$fburl = $instance['fburl'] ;

		/* Before widget (defined in functions.php). */
		echo $before_widget;

		/* Display The Widget */
		?>

 <?php 
/* Display the widget title & subtitle if one was input (before and after defined by themes). */
if ( $title ) echo '<h3 class="widget-title">'.$title.'</h3>' ?>

<?php if ($social == 'facebook') { $twocol = ''; } else { $twocol = 'twocol'; } ?>
		
<div class="tabswrap">

<ul class="tabs <?php echo $twocol; ?>">
	<li><a class="active" href="#tab1"><?php _e('Popular', 'framework')?></a></li>
	<li><a href="#tab2"><?php _e('Recent', 'framework')?></a></li>
	<?php if ($social == 'facebook') {  ?> <li><a href="#tab3"><?php _e('Facebook', 'framework')?></a></li> <?php } ?>
</ul>	
<div class="clear"></div>

<ul class="tabs-content">

	<!-- First Tab 
	================================================-->
	<li id="tab1" class="active">
	
	<?php query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&ignore_sticky_posts=1&posts_per_page='. $numposts ); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="tabpost">
        <div class="featuredimagewidget thumbnailarea">
            <?php 
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.?>
                <a class="thumblink" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('tinyfeatured'); ?>
                </a>
            <?php } ?>
        </div>

		<p><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></p>
		<p class="views"><?php echo getPostViews(get_the_ID()); ?></p>
		<div class="clear"></div>
	</div>

	<?php 
	endwhile; 
	endif; 
	wp_reset_query(); ?>

	</li>

	<!-- Second Tab 
	================================================-->
	<li id="tab2">

	<?php
		query_posts('ignore_sticky_posts=1&posts_per_page='. $numposts);
		if (have_posts()) : while (have_posts()) : the_post(); 
	?>

	<div class="tabpost">
		
        <div class="featuredimagewidget thumbnailarea">
            <?php 
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.?>
                <a class="thumblink" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('tinyfeatured'); ?>
                </a>
            <?php } ?>
        </div>

		<p><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></p>
		<p class="views"><?php the_time(get_option('date_format')); ?></p>
		<div class="clear"></div>
	</div>
	<?php endwhile; endif; wp_reset_query(); ?>
	
	</li>

	<?php if ($social == 'facebook') {  ?>

	<!-- Third Tab 
	================================================-->
	<li id="tab3">
		<div id="fb-root"></div>
		<script type="text/javascript">(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<div class="fb-like-box" data-href="<?php echo $fburl ?>" data-width="260" data-colorscheme="<?php echo ($fbfooter == 'yes') ? 'dark' : 'light'; ?>" data-show-faces="<?php echo $faces; ?>" data-border-color="<?php echo ($fbfooter == 'yes') ? '#222' : '#fff'; ?>" data-stream="<?php echo $feed; ?>" data-header="false"></div>	
	</li>
	<?php } ?>
</ul>
	<div class="clear"></div>
</div>


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
		$instance['numposts'] = strip_tags( $new_instance['numposts'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['social'] = strip_tags( $new_instance['social'] );
		$instance['fbfooter'] = strip_tags( $new_instance['fbfooter'] );	
		$instance['feed'] = strip_tags( $new_instance['feed'] );
		$instance['faces'] = strip_tags( $new_instance['faces'] );	
		$instance['fburl'] = $new_instance['fburl'];
	
		return $instance;
	}
	

/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Default widget settings */
		$defaults = array(
		'title' => '',
		'numposts' => '6',
		'facebook' => '',
		'social' => 'none',
		'fbfooter' => 'no',
		'feed' => 'none',
		'faces' => 'none',
		'fburl' => ''
		
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('Tabs Title (Optional):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_id( 'numposts' ); ?>">
        <?php _e('Number of Posts', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'numposts' ); ?>" name="<?php echo $this->get_field_name( 'numposts' ); ?>" value="<?php echo $instance['numposts']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'social' ); ?>">
    <?php _e('Social Media Tab: ', 'framework') ?>
</label>
<select id="<?php echo $this->get_field_id( 'social' ); ?>" name="<?php echo $this->get_field_name( 'social' ); ?>"  selected="<?php echo $instance['social']; ?>">
	<option class="level-0" value="none" <?php if ($instance['social'] == 'none') echo 'selected="selected"';?> >Don't Show</option>
	<option class="level-1" value="facebook" <?php if ($instance['social'] == 'facebook') echo 'selected="selected"';?> >Show</option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'fbfooter' ); ?>">
    <?php _e('Is This Widget in the Footer? ', 'framework') ?>
</label>
<select id="<?php echo $this->get_field_id( 'fbfooter' ); ?>" name="<?php echo $this->get_field_name( 'fbfooter' ); ?>"  selected="<?php echo $instance['fbfooter']; ?>">
	<option class="level-0" value="yes" <?php if ($instance['fbfooter'] == 'yes') echo 'selected="selected"';?> >Yes</option>
	<option class="level-1" value="no" <?php if ($instance['fbfooter'] == 'no') echo 'selected="selected"';?> >No</option>
</select>
</p>

<p>
  <label for="<?php echo $this->get_field_id( 'fburl' ); ?>">
        <?php _e('Facebook URL (Optional):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'fburl' ); ?>" name="<?php echo $this->get_field_name( 'fburl' ); ?>" value="<?php echo $instance['fburl']; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'feed' ); ?>">
    <?php _e('Feed', 'framework') ?>
</label>
<select id="<?php echo $this->get_field_id( 'feed' ); ?>" name="<?php echo $this->get_field_name( 'feed' ); ?>" selected="<?php echo $instance['feed']; ?>">
	<option class="level-0" value="false" <?php if ($instance['feed'] == 'false') echo 'selected="selected"';?> >Don't Show Feed</option>
	<option class="level-1" value="true" <?php if ($instance['feed'] == 'true') echo 'selected="selected"';?> >Show Feed</option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'faces' ); ?>">
    <?php _e('Faces', 'framework') ?>
</label>
<select id="<?php echo $this->get_field_id( 'faces' ); ?>" name="<?php echo $this->get_field_name( 'faces' ); ?>" selected="<?php echo $instance['faces']; ?>">
	<option class="level-0" value="false" <?php if ($instance['faces'] == 'false') echo 'selected="selected"';?>>Don't Show Faces</option>
	<option class="level-1" value="true" <?php if ($instance['faces'] == 'true') echo 'selected="selected"';?>>Show Faces</option>
</select>
</p>

<?php
	}
}
?>