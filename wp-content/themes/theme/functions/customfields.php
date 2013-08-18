<?php

function xxxx_add_edit_form_multipart_encoding() {

    echo ' enctype="multipart/form-data"';

}
add_action('post_edit_form_tag', 'xxxx_add_edit_form_multipart_encoding');

$prefix = 'ag_';
$url =  get_template_directory_uri() .'/admin/images/';

$tc_url = admin_url( 'customize.php' );

// Pull all the pages into an array
	$options_sections = array();  
	$options_sections_obj = get_posts(array('post_type' => 'section', 'posts_per_page'  => -1));
	$options_sections[0] = 'Select a Section:';
	foreach ($options_sections_obj as $post) {
    	$options_sections[$post->ID] = $post->ID;
	}
	
	//print_r($options_sections);

$metaboxes = array(

'page_title_box' => array(
        'title' => __('Page Options', 'framework'),
        'applicableto' => 'page',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'page_desc' => array(
                'title' => __('Optional Subtitle', 'framework'),
                'type' => 'text',
				'description' => 'Write an optional subtitle for your page.',
				'std' => '',
				'size' => 20
            ),
			$prefix . 'page_desc_color' => array(
                'title' => __('Page Subtitle Color', 'framework'),
                'type' => 'color',
                'description' => 'Optional. Leave blank to use the "Highlight" color you provided in the <a href="'.$tc_url.'">Theme Customizer.</a>',
                'size' => 20,
				'std' => ''
            ),
			$prefix . 'page_title_color' => array(
                'title' => __('Page Title Color', 'framework'),
                'type' => 'color',
                'description' => 'Optional. Choose a color for your page title. Leave blank to use the "Highlight" color you provided in the <a href="'.$tc_url.'">Theme Customizer.</a>',
                'size' => 20,
				'std' => ''
            ),
			$prefix . 'page_title_bg_color' => array(
                'title' => __('Title Area Background Color', 'framework'),
                'type' => 'color',
                'description' => 'Optional. Choose a background color for your title block.',
                'size' => 20,
				'std' => ''
            ),
			$prefix . 'page_content_bg_color' => array(
                'title' => __('Custom Content Background Color', 'framework'),
                'type' => 'color',
                'description' => 'Choose a background color for your page content area. Leave blank to use the color you provided in the <a href="'.$tc_url.'">Theme Customizer.</a>',
                'size' => 20,
				'std' => '',
            ),
			$prefix . 'section_button_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_options_help_page'
            ),

			
        )
    ),
	// Page Box
    'page_section_box' => array(
        'title' => __('Page Sections', 'framework'),
        'applicableto' => 'page',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'section' => array(
                'title' => __('Page Sections', 'framework'),
                'type' => 'repeatable',
				'display_condition' => array('post-format-audio'),
                'description' => 'Add and order your sections here.',
                'size' => 40,
				'options' => $options_sections,
            ),
			$prefix . 'section_button_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_sections_help_page'
            ),
        )
    ),
	
		// Page Box
    'page_button_box' => array(
        'title' => __('Page Button Options', 'framework'),
        'applicableto' => 'page',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'page_button_show' => array(
                'title' => __('Call to Action Button', 'framework'),
                'type' => 'radioshow',
				'description' => 'Do you want a call to action button on your page?',
				'std' => 'No',
				'options' => array('Yes','No'),
            ),
			$prefix . 'page_button_color' => array(
                'title' => __('Button Color', 'framework'),
                'type' => 'color',
                'description' => 'Choose an Optional Button Color. Leave blank to use the "Highlight" color you provided in the <a href="'.$tc_url.'">Theme Customizer.</a>',
                'size' => 20,
				'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'page_button_show'
            ),
			$prefix . 'page_button_text' => array(
                'title' => __('Button Text', 'framework'),
                'type' => 'text',
                'description' => 'Enter Text For Your Button',
                'size' => 40,
				'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'page_button_show'
            ),
			$prefix . 'page_button_text_color' => array(
                'title' => __('Button Text Color', 'framework'),
                'type' => 'color',
                'description' => 'Choose your text color. ',
                'size' => 20,
				'std' => '#ffffff',
				'hide' => 'hidden',
				'show' => $prefix . 'page_button_show'
            ),
			$prefix . 'page_button_link' => array(
                'title' => __('Button Link', 'framework'),
                'type' => 'text',
                'description' => 'Enter Link URL For Your Button',
                'size' => 40,
				'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'page_button_show'
            ),
			$prefix . 'section_button_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_button_help_page'
            ),
        )
    ),
	
	// Post Box
    'post_box' => array(
        'title' => __('Post Options', 'framework'),
        'applicableto' => 'post',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'post_video' => array(
                'title' => __('YouTube or Vimeo Video', 'framework'),
                'type' => 'text',
                'description' => 'Enter your Youtube or Vimeo URL. NOT the embed code. Overwrites featured image.',
                'size' => 40,
				'std' => '',
            )
        )
    ),
	
	
		// Portfolio Box
    'portfolio_box' => array(
        'title' => __('Portfolio Options', 'framework'),
        'applicableto' => 'portfolio',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'portfolio_desc' => array(
                'title' => __('Optional Subtitle', 'framework'),
                'type' => 'text',
				'description' => 'Write an optional subtitle for your portfolio-item.',
				'std' => '',
				'size' => 20
            ),
			$prefix . 'portfolio_content_title' => array(
                'title' => __('Optional Content Area Intro', 'framework'),
                'type' => 'text',
				'description' => 'Write an optional intro for the content area of your portfolio-item.',
				'std' => '',
				'size' => 20
            ),
			$prefix . 'portfolio_video' => array(
                'title' => __('YouTube or Vimeo Video', 'framework'),
                'type' => 'text',
                'description' => 'Enter your Youtube or Vimeo URL. NOT the embed code. Overwrites featured image.',
                'size' => 40,
				'std' => '',
            ),
			
			$prefix . 'portfolio_options_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_options_help_portfolio'
            ),
        )
    ),


    'portfolio_section_box' => array(
        'title' => __('Portfolio Sections', 'framework'),
        'applicableto' => 'portfolio',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
            $prefix . 'section' => array(
                'title' => __('Portfolio Sections', 'framework'),
                'type' => 'repeatable',
                'display_condition' => array('post-format-audio'),
                'description' => 'Add and order your sections here.',
                'size' => 40,
                'options' => $options_sections,
            ),
            $prefix . 'portfolio_button_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
                'std' => '',
                'help' => '#tab-link-ag_sections_help_portfolio'
            ),
        )
    ),
	
	'section_video_box' => array(
        'title' => __('Section Video', 'framework'),
        'applicableto' => 'section',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'section_video' => array(
                'title' => __('YouTube or Vimeo Video', 'framework'),
                'type' => 'text',
                'description' => 'Enter your Youtube or Vimeo URL. NOT the embed code. Overwrites featured image.',
                'size' => 40,
				'std' => '',
            ),
			$prefix . 'section_video_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_video_help_section'
            ),
		)
	),
	
	// Section Box
    'section_layout_box' => array(
        'title' => __('Section Layout', 'framework'),
        'applicableto' => 'section',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'section_layout' => array(
                'title' => __('Section Layout', 'framework'),
                'type' => 'radio',
				'description' => 'Choose a Layout For Your Section',
				'std' => 'Right',
				'options' => array('Right','Left','Center','Custom'),
            ),
			$prefix . 'bottom_padding' => array(
                'title' => __('Section Bottom Padding', 'framework'),
                'type' => 'radio',
                'description' => 'Drop out the bottom padding for this section?',
               	'std' => 'Normal',
				'options' => array('Normal','No Padding'),
            ),
			$prefix . 'section_layout_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_layout_help_section'
            ),
		)
	),
	
	'section_oolor_box' => array(
        'title' => __('Section Colors', 'framework'),
        'applicableto' => 'section',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'background_color' => array(
                'title' => __('Background Color', 'framework'),
                'type' => 'color',
                'description' => 'Choose a Background Color. Leave blank for a transparent background.',
                'size' => 20,
				'std' => ''
            ),
			$prefix . 'background_image' => array(
                'title' => __('Background Image', 'framework'),
                'type' => 'image',
                'description' => 'Upload a Custom Background Image',
            ),
			$prefix . 'background_repeat' => array(
                'title' => __('Background Repeat Options', 'framework'),
                'type' => 'radio',
                'description' => 'Select whether you want your background image to cover or repeat.',
               	'std' => 'Cover',
				'options' => array('Cover','Repeat'),
            ),
			$prefix . 'text_color' => array(
                'title' => __('Text Color', 'framework'),
                'type' => 'radio',
                'description' => 'Select Your Text Color',
               	'std' => 'Dark',
				'options' => array('Dark','Light'),
            ),
			$prefix . 'section_color_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_colors_help_section'
            ),
		)
	),
	
	'section_button_box' => array(
        'title' => __('Section Button', 'framework'),
        'applicableto' => 'section',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'section_button_show' => array(
                'title' => __('Call to Action Button', 'framework'),
                'type' => 'radioshow',
				'description' => 'Do you want a call to action button for your section?',
				'std' => 'No',
				'options' => array('Yes','No'),
            ),
			$prefix . 'section_button_color' => array(
                'title' => __('Button Color', 'framework'),
                'type' => 'color',
                'description' => 'Choose an Optional Button Color. Default is the Theme Button Color.',
                'size' => 20,
				'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'section_button_show',
            ),
			$prefix . 'section_button_text' => array(
                'title' => __('Button Text', 'framework'),
                'type' => 'text',
                'description' => 'Enter Text For Your Button',
                'size' => 40,
				'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'section_button_show',
            ),
			$prefix . 'section_text_color' => array(
                'title' => __('Button Text Color', 'framework'),
                'type' => 'color',
                'description' => 'Choose your text color. ',
                'size' => 20,
				'std' => '#ffffff',
				'hide' => 'hidden',
				'show' => $prefix . 'section_button_show',
            ),
			$prefix . 'section_button_link' => array(
                'title' => __('Button Link', 'framework'),
                'type' => 'text',
                'description' => 'Enter Link URL For Your Button',
                'size' => 40,
				'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'section_button_show',
            ),
			$prefix . 'section_button_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_button_help_section'
            ),
        )
    ),
			
	// Slide Box
    'slide_display_box' => array(
        'title' => __('Slide Display Options', 'framework'),
        'applicableto' => 'slide',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'slide_background_image' => array(
                'title' => __('Background Image', 'framework'),
                'type' => 'image',
                'description' => 'Upload a Custom Background Image',
            ),
			$prefix . 'slide_video' => array(
                'title' => __('YouTube or Vimeo Video', 'framework'),
                'type' => 'text',
                'description' => 'Enter your Youtube or Vimeo URL. NOT the embed code. Overwrites featured image.',
                'size' => 40,
				'std' => '',
            ),
			$prefix . 'slide_layout' => array(
                'title' => __('Slide Layout', 'framework'),
                'type' => 'radio',
				'description' => 'Choose a Layout For Your Section. Center does not use a featured image.',
				'std' => 'Left',
				'options' => array('Left','Right','Center'),
            ),			
			$prefix . 'slide_transition' => array(
                'title' => __('Slide Transition', 'framework'),
                'type' => 'select',
				'description' => 'Choose a slide Transition',
				'std' => 'fade',
				'options' => array(
					'fade',
					'random',
					'boxslide',
					'boxfade',
					'slotzoom-horizontal',
					'slotslide-horizontal',
					'slotfade-horizontal',
					'slotzoom-vertical',
					'slotslide-vertical',
					'slotfade-vertical',
					'curtain-1',
					'curtain-2',
					'curtain-3',
					'slideleft',
					'slideright',
					'slideup',
					'slidedown',
					'slidehorizontal',
					'slidevertical',
					'papercut',
					'flyin',
					'turnoff',
					'cube',
					'3dcurtain-vertical',
					'3dcurtain-horizontal',
				),
			),
			
			$prefix . 'slide_link' => array(
                'title' => __('Slide Link URL', 'framework'),
                'type' => 'text',
                'description' => 'Enter Link URL For When Your Entire Slide is clicked. Will overwrite button link.',
                'size' => 40,
				'std' => ''
            ),
			
			$prefix . 'slide_options_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_options_help_slide'
            ),
		)
	),
	
	'slide_color_box' => array(
        'title' => __('Slide Color Options', 'framework'),
        'applicableto' => 'slide',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'slide_text_show' => array(
                'title' => __('Slide Title', 'framework'),
                'type' => 'radioshow',
				'description' => 'Do you want a title for your slide?',
				'std' => 'Yes',
				'options' => array('Yes','No'),
            ),
			$prefix . 'slide_text_color' => array(
                'title' => __('Text Color', 'framework'),
                'type' => 'radio',
                'description' => 'Select Your Text Color',
               	'std' => 'Light',
				'options' => array('Light','Dark'),
				'hide' => 'hidden',
				'show' => $prefix . 'slide_text_show',
            ),

			$prefix . 'slide_text_bg_color' => array(
                'title' => __('Text Background Color', 'framework'),
                'type' => 'color',
                'description' => 'Select Your Text Background Color. Leave blank for no background.',
				'size' => 20,
               	'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'slide_text_show',
            ),
			$prefix . 'slide_colors_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_colors_help_slide'
            ),
		)
	),
   'slide_button_box' => array(
        'title' => __('Slide Button Options', 'framework'),
        'applicableto' => 'slide',
        'location' => 'normal',
        'priority' => 'high',
        'fields' => array(
			$prefix . 'slide_button_show' => array(
                'title' => __('Call to Action Button', 'framework'),
                'type' => 'radioshow',
				'description' => 'Do you want a call to action button for your section?',
				'std' => 'No',
				'options' => array('Yes','No'),
            ),
			$prefix . 'slide_button_color' => array(
                'title' => __('Button Color', 'framework'),
                'type' => 'color',
                'description' => 'Choose an Optional Button Color. Leave blank for your theme button color.',
                'size' => 20,
				'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'slide_button_show',
            ),
			$prefix . 'slide_button_text' => array(
                'title' => __('Button Text', 'framework'),
                'type' => 'text',
                'description' => 'Enter Text For Your Button',
                'size' => 40,
				'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'slide_button_show',
            ),
			$prefix . 'slide_button_text_color' => array(
                'title' => __('Button Text Color', 'framework'),
                'type' => 'color',
                'description' => 'Choose your text color. ',
                'size' => 20,
				'std' => '#ffffff',
				'hide' => 'hidden',
				'show' => $prefix . 'slide_button_show',
            ),
			$prefix . 'slide_button_link' => array(
                'title' => __('Button Link', 'framework'),
                'type' => 'text',
                'description' => 'Enter a URL for Your Button',
                'size' => 40,
				'std' => '',
				'hide' => 'hidden',
				'show' => $prefix . 'slide_button_show',
            ),
			
			$prefix . 'slide_button_help' => array(
                'title' => __('Help', 'framework'),
                'type' => 'help',
                'description' => 'Need Additional Assitance?',
                'size' => 40,
				'std' => '',
				'help' => '#tab-link-ag_button_help_slide'
            ),
        )
    )
);

add_action( 'admin_init', 'add_post_format_metabox' );
function add_post_format_metabox() {
    global $metaboxes;
    if ( ! empty( $metaboxes ) ) {
        foreach ( $metaboxes as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
        }
    }
}

function show_metaboxes( $post, $args ) {
    global $metaboxes;
	
    $fields = $tabs = $metaboxes[$args['id']]['fields'];
    /** Nonce **/
    $output = '<style>.custom_preview_image { max-width:300px; } </style><input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';
 
	$output .= '<table class="form-table">';
 
	foreach ($fields as $id => $field) {

		// get current post meta data
		$meta = get_post_meta($post->ID, $id , true);
		if (!$meta) $meta = '';
		
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			if (isset($field['hide']) && isset($field['show'])) {
				$output .= '<tr class="' . $id . ' '. $field['hide'] .' show-' . $field['show'] . '">';
			} else {
				$output .= '<tr class="' . $id . '">';
			}
			$output .= '<th style="width:200px"><label for="'. $id . '"><strong>'. $field['title']. '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['description'].'</span></label></th>'.
					   '<td>';
			 $output .= '<input id="ag_' . $id . '" type="text" name="' . $id . '" value="' . $meta . '" size="' . $field['size'] . '" style="width:100%; margin-right: 20px; float:left; padding:10px;" />';
			
			break;
			
			//If Text		
			case 'color':
			
			if (isset($field['hide']) && isset($field['show'])) {
				$output .= '<tr class="' . $id . ' '. $field['hide'] .' show-' . $field['show'] . '">';
			} else {
				$output .= '<tr class="' . $id . '">';
			}
			if (!$meta){
				if ( isset($field['std']) ) $meta = $field['std']; 
			}
			$output .= '<th style="width:200px"><label for="'. $id . '"><strong>'. $field['title']. '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['description'].'</span></label></th>'.
					   '<td>';
			$output .= '<div id="' .  $id  . '_color_picker" class="colorSelector" style="margin-right: 6px; margin-top: 6px;"><div style="background-color:' . $meta . '"></div></div>';
			$output .= '<input class="colorbox_' . $id . '" id="ag_' . $id . '" type="text" name="' . $id . '" value="' . $meta . '" size="' . $field['size'] . '" style=" margin-right: 20px; float:left; padding:10px;" />';
			break;
			
						// image
			case 'image':
			
			if (isset($field['hide']) && isset($field['show'])) {
				$output .= '<tr class="' . $id . ' '. $field['hide'] .' show-' . $field['show'] . '">';
			} else {
				$output .= '<tr class="' . $id . '">';
			}
		
			$output .= '<th style="width:200px"><label for="'. $id . '"><strong>'. $field['title']. '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['description'].'</span></label></th>'.
					   '<td>';
				$image = get_template_directory_uri().'/images/image-upload.png';
				$output .= '<span class="custom_default_image" style="display:none">'.$image.'</span>';
				if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }
				$output .=	'<input name="'. $id .'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
							<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
								<input class="custom_upload_image_button button" type="button" value="Choose Image" />
								<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
								<br clear="all" />';
			break;

			case 'help':
			$output .= '<tr class="' . $id . '">';
			$output .= '<th style="width:200px"></th>'.
					   '<td>';	
			
			if (isset($field['help'])) {
					$output .= '<a href="#" target="_blank" class="helpbutton" rel="'.$field['help'].'" onclick="return false;">Need Help?</a>';
			}
			
			break;
			
			//If textarea		
			case 'textarea':
			
			if (isset($field['hide']) && isset($field['show'])) {
				$output .= '<tr class="' . $id . ' '. $field['hide'] .' show-' . $field['show'] . '">';
			} else {
				$output .= '<tr class="' . $id . '">';
			}
			
			$output .= '<th style="width:200px"><label for="'. $id . '"><strong>'. $field['title']. '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['description'].'</span></label></th>'.
					   '<td>';
			$output .= '<textarea id="' . $id . '" name="' . $id . '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">' . $meta . '</textarea>';
			
			break;
 
			//If Button	
			case 'button':
				$output .= '<input style="float: left;" type="button" class="button" name="'. $id . '" id="'. $id . '"value="'. $meta . '" />';
				$output .= 	'</td>'.
			'</tr>';
			
			break;
			
			
			//If Select	
			case 'select':
			
			if (isset($field['hide']) && isset($field['show'])) {
				$output .= '<tr class="' . $id . ' '. $field['hide'] .' show-' . $field['show'] . '">';
			} else {
				$output .= '<tr class="' . $id . '">';
			}
			
				$output .= '<th style="width:200px"><label for="'. $id . '"><strong>'. $field['title']. '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['description'].'</span></label></th>'.
						   '<td>';
			
				$output .='<select name="'.$id .'" style="width:300px; height:auto; padding:10px;">';
			
				foreach ($field['options'] as $option) {
					
					$output .='<option';
					if ($meta == $option ) { 
						$output .= ' selected="selected"'; 
					}
					$output .='>'. $option .'</option>';
				
				} 
				
				$output .='</select>';
			
			break;
	
			//If Radio Button
			case 'radioshow':
			
			
				$output .= '<tr class="' . $id . ' radioshow" data-url=".show-'.$id.'">';
			
			
				$output .= '<th style="width:200px"><label for="'. $id . '"><strong>'. $field['title']. '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['description'].'</span></label></th>'.
						   '<td>';
			
				foreach ($field['options'] as $option) {
					$output .='<input style= "margin-right: 10px; margin-bottom: 5px;" type="radio"';
						if ($meta == $option ) { 
							$output .= 'checked ';
						} else if (!$meta && $option == $field['std']  ) {
							$output .= 'checked ';
						}
					
					$output .= ' name="'.$id .'" value="'.$option .'">' . $option .' <br />';						
					
				} 
			
			break;
			
				
			//If Radio Button
			case 'radio':
			
			if (isset($field['hide']) && isset($field['show'])) {
				$output .= '<tr class="' . $id . ' '. $field['hide'] .' show-' . $field['show'] . '">';
			} else {
				$output .= '<tr class="' . $id . '">';
			}
			
				$output .= '<th style="width:200px"><label for="'. $id . '"><strong>'. $field['title']. '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['description'].'</span></label></th>'.
						   '<td>';
			
				foreach ($field['options'] as $option) {
					$output .='<input style= "margin-right: 10px; margin-bottom: 5px;" type="radio"';
						if ($meta == $option ) { 
							$output .= 'checked ';
						} else if (!$meta && $option == $field['std']  ) {
							$output .= 'checked ';
						}
					
					$output .= ' name="'.$id .'" value="'.$option .'">' . $option .' <br />';						
					
				} 
			
			break;
			
			// repeatable
			case 'repeatable':
			
			if (isset($field['hide']) && isset($field['show'])) {
				$output .= '<tr class="' . $id . ' '. $field['hide'] .' show-' . $field['show'] . '">';
			} else {
				$output .= '<tr class="' . $id . '">';
			}
			
				$output .= '<th style="width:200px"><label for="'. $id . '"><strong>'. $field['title']. '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['description'].'</span></label></th>'.
						   '<td>';
				
				$output .= '<ul id="' . $id . '-repeatable" class="custom_repeatable">';
										
				// uncomment to debug
				// print_r($meta);
				
				$i = 0;
				
			
				
				// If there's meta information and it has one or more values
				if ($meta && (count($meta)>=1)) {
					
					// For piece of meta information
					foreach($meta as $index => $row) {	
				
							$output .= '<li><span class="sort hndle" style="margin-right:5px;">| | |</span>
								
								<select name="'.$id.'['.$i.']" id="'.$id.'" style="width:300px; height:auto; padding:10px;">';
								
								//Print Options for Dropdown Menu
								foreach ($field['options'] as $optionindex => $option) {
									
									$title = (get_the_title($option)) ? get_the_title($option) : $option;
									
									$output .='<option';
									if ($row == $option ) { 
										$output .= ' selected="selected"'; 
										$output .=' value="'.$option.'">'. $title .'</option>';
										$selected = $option;
									} else {
										$output .=' value="'.$option.'">'. $title .'</option>';
									}
								
								} 
								
								$output .= '</select>
								<a class="repeatable-remove button" href="#">-</a>';
								if (isset($selected)) $output .= '<a class="ag_edit_link" style="font-size:10px; margin-left:10px;" href="' .  get_edit_post_link( $selected ) .'">Edit Section</a></li>';
								
							$i++;
			
					}
					
					
				// Else if the $meta information is blank
				} else { 
					$output .= '<li><span class="sort hndle" style="margin-right:5px;">| | |</span>
							
							<select name="'.$id.'['.$i.']" style="width:300px; height:auto; padding:10px;">';
			
							foreach ($field['options'] as $optionindex => $option) {
								
								$title = (get_the_title($option)) ? get_the_title($option) : $option;
								$output .='<option value="'.$option.'">'. $title .'</option>';
							
							} 
							
							$output .= '</select>
							<a class="repeatable-remove button" href="#">-</a></li>';
				}
				$output .= '</ul><a class="repeatable-add button" href="#">+ Add More</a>';
					
			break;
			
		
		}

	}
 
	$output .= '</table>';
	
   echo $output;
}

add_action( 'save_post', 'save_metaboxes' );

function save_metaboxes( $post_id ) {
    global $metaboxes;
    // verify nonce
    if ( isset( $_POST['post_format_meta_box_nonce']) && ! wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id;
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;
		
	$post_type = get_post_type();	
    // check permissions
    if ( 'page' == $post_type ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
    
    // loop through fields and save the data
    foreach ( $metaboxes as $id => $metabox ) {
        // check if metabox is applicable for current post type
        if ( $metabox['applicableto'] == $post_type ) {
            $fields = $metaboxes[$id]['fields'];
            foreach ( $fields as $id => $field ) {
                $old = get_post_meta( $post_id, $id, true );
				if (isset($_POST[$id])) {
				$new = $_POST[$id];
				} else {
				$new = '';	
				}
				if ( $new && $new != $old ) {
					update_post_meta( $post_id, $id, $new );
				}
				elseif ( '' == $new && $old || ! isset( $_POST[$id] ) ) {
					delete_post_meta( $post_id, $id, $old );
				}
            }
        }
    }
}
?>