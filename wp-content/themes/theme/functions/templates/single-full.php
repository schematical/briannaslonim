<?php 
// Get Post Options
$pageID = get_option('page_for_posts');
$ag_page['page_content_color'] = get_post_meta($pageID, 'ag_page_content_bg_color', true);
$ag_post['video'] = get_post_meta($post->ID, 'ag_post_video', true);
$ag_post['author'] = of_get_option('of_author_style'); 
if (!($ag_post['slide_number'] = of_get_option('of_thumbnail_number '))) $ag_post['slide_number'] = '6';
$ag_post['thumbsize'] = (of_get_option('of_post_crop') == 'post') ? 'postfull' : 'postfullnc'; ?>

<!-- Page Content -->
<div class="pagecontent" <?php echo ($ag_page['page_content_color']) ? 'style="background:' . $ag_page['page_content_color'] . ';"' : '' ?>>
    <div <?php post_class(); ?>> <!-- WP Post Class -->
        <div class="container">
            <div class="sixteen columns">
				<?php 
                // Get Featured Slideshow or Section Video
                if (!$ag_post['video'] || $ag_post['video'] == '') {
                    echo ag_post_slideshow($ag_post['thumbsize'], get_the_ID(), $ag_post['slide_number'], false, false);
                } else {
                    echo ag_post_video($ag_post['video']);	
                }?>
            </div>
            <div class="clear"></div>
            <div class="sixteen columns">
                 <?php if (isset($ag_post['author']) && $ag_post['author'] == 'avatar') { ?>
                 	<div class="avatar-info">
                        <div id="avatar">
                            <?php echo get_avatar( get_the_author_meta('ID'), 70, '', get_the_author_meta('display_name') ); ?>
                        </div>
                
                        <div class="comment-counter">
                            <a href="<?php comments_link(); ?>" title="<?php _e('Comments', 'framework'); ?>"><?php comments_number('0', '1', '%'); ?> </a>
                        </div>
                        <div class="author">
                            <p><?php _e('By','framework');?> <?php the_author_posts_link(); ?> <p>
                            <p><?php the_date(); ?></p>
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
                 <div class="single-content full">
                    <div class="categories">
						<?php echo ag_get_cats(3); ?>
                    </div>
                    <div class="clear"></div>
                    <h2 class="title">
						<?php the_title(); ?>
                    </h2>
                    <div class="mobiledate">
                    	<p><?php the_time(get_option('date_format')); ?> | <?php _e('By', 'framework'); ?> <?php the_author_posts_link(); ?> | <?php if ( comments_open() ) : ?>
                        <a href="<?php comments_link(); ?>" title="<?php comments_number('No Comments', 'One Comment', '% Comments'); ?>"><?php comments_number('No Comments', 'One Comment', '% Comments'); ?></a>
                     <?php endif; ?> </p>
                    </div>
                    <div class="content">
						<?php the_content(); ?>
                    </div>
                   <!-- Tags
                     ================================================== -->                      
                    <?php the_tags('<div class="tagcloud"><h5>'.__("Tags", "framework"). '</h5>', ' ', '</div><div class="clear"></div>'); ?>                    
                    <!-- Comments -->
                    <?php comments_template('', true); // comments ?>
                 </div>
            </div>
        </div>
    </div>
</div>