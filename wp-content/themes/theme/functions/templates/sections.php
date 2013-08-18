<?php  
/*-----------------------------------------------------------------------------------*/
/* Sections Template
/*-----------------------------------------------------------------------------------*/

if(!is_home()){
	// If it's not the blog page, get use the page ID.
	$sections = get_post_meta(get_the_ID(), 'ag_section', true);
} else {
	// Otherwise use the page_for_posts ID.
	$pageID = get_option('page_for_posts');
	$sections = get_post_meta($pageID, 'ag_section', true);
}

/* If There are Sections
================================================== */
if ($sections) :

	// For Each Section 
	foreach ($sections as $section) :
	
	// Get Section Options Defined in functions.php
	$ag_section = ag_get_section_variables($section);
	
	// Get section post using section ID	
	$section_post = get_post($section); 
	
		// If there is a section post	
		if ($section_post) :
		
		/* Get the Section Layout
		================================================== */
		switch ($ag_section['section_layout']) {
			case('Left') : ?>        
            
                <!-- Left Section Layout -->            
                <div class="section left-aligned <?php 
				
				// Get Section Classes from Options
				echo ($ag_section['section_text'] == 'Light') ? 'dark ' : ''; 
				echo ($ag_section['background_repeat'] == 'Repeat') ? 'repeat ' : '';
				echo ($section_post->post_content || $ag_section['section_button_show'] != 'No') ? '' : 'nocontent ';
				echo ($ag_section['sectionpadding'] == 'No Padding') ? 'nopadding ' : ''; 
                echo 'section-'. $section;
				
				?>" <?php echo ($ag_section['backgroundstyle']) ? $ag_section['backgroundstyle'] : '' ?>>
                    <div class ="container verticalcenter">
                    
                    	<div class="container_row">
                        
                    	<!-- Section Title and Content -->
                        <div class="cell verticalcenter">
                            <div class="six columns content">
                                <?php echo ($section_post->post_title) ? '<h2>' . apply_filters('the_title', $section_post->post_title) . '</h2><div class="clear"></div>' : ''; ?>
                                <?php if ($section_post->post_content || $ag_section['section_button_show'] == 'Yes') { ?>
                                    <div class="innercontent" <?php echo (!($section_post->post_content)) ? 'style="margin-top:10px;"' : ''; ?>>
                                        <?php echo apply_filters('the_content', $section_post->post_content); ?>
                                        <?php echo apply_filters('the_content', $ag_section['section_button']); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- END Section Title and Content -->
                        
                        <!-- Section Media -->
                        <div class="cell verticalcenter image">
                            <div class="nine columns offset-by-one">
                                <?php 
                                // Get Featured Slideshow or Section Video
                                if (!$ag_section['sectionvideo'] || $ag_section['sectionvideo'] == '') {
                                    echo ag_post_slideshow('sectionsmall', $section, 6, true);
                                } else {
                                    echo ag_post_video($ag_section['sectionvideo']);	
                                }?>
                            </div>
                        </div>
                        <!-- END Section Media -->
                        
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    <?php if ( is_user_logged_in() ) { ?>
                    	<!-- Edit Post Button -->
                        <a href="<?php echo get_edit_post_link( $section ); ?>" class="post-edit-link"><img src="<?php echo get_template_directory_uri(); ?>/theme/images/edit-pencil.png" alt="<?php _e('Edit Section', 'framework'); ?>"/><?php _e('Edit', 'framework'); ?></a>
                    <?php } ?> 
                </div>
                <!-- END Left Section Layout -->  	
            
                <div class="clear"></div>
			
			<?php break;
			case('Center'): ?>
            
                <!-- Center Section Layout --> 
                <div class="section center <?php 
				
				// Get Section Classes from Options
				echo ($ag_section['section_text'] == 'Light') ? 'dark ' : ''; 
				echo ($ag_section['background_repeat'] == 'Repeat') ? 'repeat ' : '';
				echo ($section_post->post_content || $ag_section['section_button_show'] != 'No') ? '' : 'nocontent ';
				echo ($ag_section['sectionpadding'] == 'No Padding') ? 'nopadding ' : ''; 
                echo 'section-'. $section;
				
				?>" <?php echo ($ag_section['backgroundstyle']) ? $ag_section['backgroundstyle'] : '' ?>>
                    <div class="container">
                    
                    	<!-- Section Content -->
                        <div class="fourteen columns offset-by-one content">
                            <?php echo ($section_post->post_title) ? '<h2>' . apply_filters('the_title', $section_post->post_title) . '</h2><div class="clear"></div>' : ''; ?>
                            <?php if ($section_post->post_content || $ag_section['section_button_show'] == 'Yes') { ?>
                                <div class="innercontent" <?php echo (!($section_post->post_content)) ? 'style="margin-top:10px;"' : ''; ?>>
                                    <?php echo apply_filters('the_content', $section_post->post_content); ?>
                                    <?php echo apply_filters('the_content', $ag_section['section_button']); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- END Section Content -->
                        <div class="clear"></div>
                        
                        <?php if ( has_post_thumbnail($section) || $ag_section['sectionvideo']) { ?>
                        
                        <!-- Section Media -->
                        <div class="fourteen columns offset-by-one fullimage">
							<?php 
                            // Get Featured Slideshow or Section Video
                            if (!$ag_section['sectionvideo'] || $ag_section['sectionvideo'] == '') {
                                echo ag_post_slideshow('sectionlarge', $section, 6, true);
                            } else {
                                echo ag_post_video($ag_section['sectionvideo']);	
                            }?>
                        </div>
                        <!-- END Section Media -->
                        <?php } ?>
                        
                        <div class="clear"></div>
                    </div>
                    <?php if ( is_user_logged_in() ) { ?>
                    	<!-- Edit Post Button -->
                        <a href="<?php echo get_edit_post_link( $section ); ?>" class="post-edit-link"><img src="<?php echo get_template_directory_uri(); ?>/theme/images/edit-pencil.png" alt="<?php _e('Edit Section', 'framework'); ?>"/><?php _e('Edit', 'framework'); ?></a>
                    <?php } ?> 
                </div>
                <!-- END Center Section Layout --> 
                
                <div class="clear"></div>
            
            <?php break;
			case('Custom'): ?>
            
                <!-- Custom Section Layout --> 
                <div class="section custom <?php 
				
				// Get Section Classes from Options
				echo ($ag_section['section_text'] == 'Light') ? 'dark ' : ''; 
				echo ($ag_section['background_repeat'] == 'Repeat') ? 'repeat ' : '';
				echo ($section_post->post_content || $ag_section['section_button_show'] != 'No') ? '' : 'nocontent ';
				echo ($ag_section['sectionpadding'] == 'No Padding') ? 'nopadding ' : ''; 
				echo ($ag_section['section_text'] == 'Light') ? 'dark ' : '';
                echo 'section-'. $section;
				 
				?>" <?php echo ($ag_section['backgroundstyle']) ? $ag_section['backgroundstyle'] : '' ?>>
                    <div class="container">
                    
                    	<!-- Section Content -->
                        <div class="sixteen columns content">
                                <?php echo apply_filters('the_content', $section_post->post_content); ?>
                        </div>
                        <!-- END Section Content -->
                        
                        <div class="clear"></div>
                    </div>
                    <?php if ( is_user_logged_in() ) { ?>
                    	<!-- Edit Post Button -->
                        <a href="<?php echo get_edit_post_link( $section ); ?>" class="post-edit-link"><img src="<?php echo get_template_directory_uri(); ?>/theme/images/edit-pencil.png" alt="<?php _e('Edit Section', 'framework'); ?>"/><?php _e('Edit', 'framework'); ?></a>
                    <?php } ?> 
                </div>
                 <!-- END Custom Section Layout --> 
                
                <div class="clear"></div>
			
			<?php break;
			default : ?>
            
                <!-- Right Section Layout --> 
                <div class="section right-aligned <?php 
				
				// Get Section Classes from Options
				echo ($ag_section['section_text'] == 'Light') ? 'dark ' : ''; 
				echo ($ag_section['background_repeat'] == 'Repeat') ? 'repeat ' : '';
				echo ($section_post->post_content || $ag_section['section_button_show'] != 'No') ? '' : 'nocontent ';
				echo ($ag_section['sectionpadding'] == 'No Padding') ? 'nopadding ' : ''; 
				echo ($ag_section['section_text'] == 'Light') ? 'dark ' : '';
                echo 'section-'. $section;
				
				?>" <?php echo ($ag_section['backgroundstyle']) ? $ag_section['backgroundstyle'] : '' ?>>
                    <div class ="container verticalcenter">
                    
                    	<div class="container_row">
                        
                    	<!-- Section Media -->
                        <div class="cell verticalcenter image">
                            <div class="nine columns">
                                <?php 
                                // Get Featured Slideshow or Section Video
                                if (!$ag_section['sectionvideo'] || $ag_section['sectionvideo'] == '') {
                                    echo ag_post_slideshow('sectionsmall', $section, 6, true);
                                } else {
                                    echo ag_post_video($ag_section['sectionvideo']);	
                                }?>
                            </div>
                        </div>
                        <!-- END Section Media -->
                        
                        <!-- Section Content -->
                        <div class="cell verticalcenter">
                            <div class="six columns offset-by-one content">
                                <?php echo ($section_post->post_title) ? '<h2>' . apply_filters('the_title', $section_post->post_title) . '</h2><div class="clear"></div>' : ''; ?>
                                <?php if ($section_post->post_content || $ag_section['section_button_show'] == 'Yes') { ?>
                                    <div class="innercontent" <?php echo (!($section_post->post_content)) ? 'style="margin-top:10px;"' : ''; ?>>
                                        <?php echo apply_filters('the_content', $section_post->post_content); ?>
                                        <?php echo ($ag_section['section_button']) ? '<span>'. apply_filters('the_content', $ag_section['section_button']) .'</span>' : ''; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- END Section Content -->
                        
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    
                    <?php if ( is_user_logged_in() ) { ?>
                    	<!-- Edit Post Button -->
                        <a href="<?php echo get_edit_post_link( $section ); ?>" class="post-edit-link"><img src="<?php echo get_template_directory_uri(); ?>/theme/images/edit-pencil.png" alt="<?php _e('Edit Section', 'framework'); ?>"/><?php _e('Edit', 'framework'); ?></a>
                    <?php } ?> 
                </div>
                <!-- END Right Section Layout --> 
                
                <div class="clear"></div>
			
			
			<?php break; 
			
		}?>
		
<?php endif; endforeach; endif; // End if section and foreach ?>