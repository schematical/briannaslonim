<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = 'District';
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	$shortname = 'of';
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	$options_categories[''] = 'Latest Posts';
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/images/';
		
	// Set the Options Array
$options = array();
$options[] = array( "name" => __("General", "framework"),				 
					"type" => "heading");
		
$options[] = array( "name" => __("Custom Logo", "framework"),
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png).<br /><br /> Image-size should be 300px x 65px.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => __("Custom Favicon", "framework"),
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 

                                               
$options[] = array( "name" => __("Tracking Code", "framework"),
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");    					
					
$options[] = array( "name" => __("Customize", "framework"),				 
					"type" => "heading"); 			

$options[] = array( "name" => __("Maximum Number of Image Slides per Slideshow", "framework"),
					"desc" => "Keep this as low as you can for memory reasons to keep your load time fast.",
					"id" => $shortname."_thumbnail_number",
					"std" => "6",
					"type" => "text"); 

$options[] = array( "name" => __("Padding Above Logo", "framework"),
					"desc" => "Top Padding for above the Logo Section.",
					"id" => $shortname."_logo_top_padding",
					"std" => "25",
					"type" => "text"); 

$options[] = array( "name" => __("Padding Below Logo", "framework"),
					"desc" => "Top Padding for below the Logo Section",
					"id" => $shortname."_logo_bottom_padding",
					"std" => "25",
					"type" => "text"); 


$options[] = array( "name" => __("Dropdown Menu Text", "framework"),
					"desc" => "Default Text Displayed in the Mobile Dropdown Menu",
					"id" => $shortname."_menu_text",
					"std" => "Select a Page",
					"type" => "text");
					
$options[] = array( "name" => __("PrettyPhoto Skin", "framework"),
					"desc" => "Choose the skin for your PrettyPhoto popups.",
					"id" => $shortname."_prettyphoto_skin",
					"std" => "pp_default",
					"type" => "select",
					"options" => array(
					'pp_default' => 'Default',	
					'facebook' => 'Facebook',	
					'dark_rounded' => 'Dark Rounded',	
					'dark_square' => 'Dark Square',	
					'light_rounded' => 'Light Rounded',	
					'light_square' => 'Light Square'	
					));
					
$options[] = array( "name" => __("Custom CSS", "framework"),
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array( "name" => __("Homepage", "framework"),				 
					"type" => "heading");

$options[] = array( "name" => __("Height of the Homepage Slider in Pixels", "framework"),
                    "desc" => "Whole numbers only. Default is 400.",
                    "id" => $shortname."_home_slider_height",
                    "std" => "400",
                    "type" => "text");  

$options[] = array( "name" => __("Homepage Slider Autoplay", "framework"),
                    "desc" => "Choose your slideshow autoplay choice.",
                    "id" => $shortname."_home_autoplay",
                    "std" => "true",
                    "type" => "select",
                    "options" =>  array(
                        'false' => 'Autoplay',
                        'true' => "No Autoplay"
                    ));

$options[] = array( "name" => __("Homepage Slideshow Default Autoplay Speed", "framework"),
                    "desc" => "Speed of the slideshow autoplay in seconds. Whole numbers only. ",
                    "id" => $shortname."_home_autoplay_delay",
                    "std" => "7",
                    "type" => "text");  


$options[] = array( "name" => __("Posts", "framework"),				 
					"type" => "heading");


$options[] = array( "name" => __("Single Post Style", "framework"),
					"desc" => "Choose your posts style.",
					"id" => $shortname."_post_style",
					"std" => "single-full-sidebar",
					"type" => "radio",
					"options" =>  array(
						'single-sidebar' => 'Normal With Sidebar',
						'single-full-sidebar' => 'Full Width With Sidebar',
						'single-full' => 'Full Width'
						
					)); 
					
$options[] = array( "name" => __("Author Style", "framework"),
					"desc" => "Choose your post author style.",
					"id" => $shortname."_author_style",
					"std" => "date",
					"type" => "radio",
					"options" =>  array(
						'date' => 'Date',
						'avatar' => 'Avatar'
					));
					
$options[] = array( "name" => __("Post Image Crop", "framework"),
					"desc" => "Do you want to crop your post images?",
					"id" => $shortname."_post_crop",
					"std" => "post",
					"type" => "radio",
					"options" =>  array(
						'post' => 'Yes',
						'postnc' => 'No'
					));   
/*					
$options[] = array( "name" => __("Single Post Slideshow Autoplay", "framework"),
					"desc" => "Do you want your posts slideshows to automatically play on single pages.",
					"id" => $shortname."_post_autoplay",
					"std" => "no",
					"type" => "radio",
					"options" =>  array(
						'no' => 'No',
						'yes' => 'Yes'
					)); 

$options[] = array( "name" => __("Single Post Slideshow Default Autoplay Speed", "framework"),
					"desc" => "Speed of the slideshow autoplay in seconds. Whole numbers only. Autoplay is controlled on a via your edit post page.",
					"id" => $shortname."_post_autoplay_delay",
					"std" => "7",
					"type" => "text"); 
*/
					
$options[] = array( "name" => __("Portfolio", "framework"),				 
					"type" => "heading");
					
$options[] = array( "name" => __("Pagination Style", "framework"),
					"desc" => "Choose your pagination style",
					"id" => $shortname."_pagination_style",
					"std" => "infinite",
					"type" => "radio",
					"options" => array(
						'infinite' => 'Infinite Scroll',	
						'pagination' => 'WordPress Pagination'	
					));
$options[] = array( "name" => __("Posts Per Page", "framework"),
					"desc" => "Enter the number of portfolio posts you want to display per page.",
					"id" => $shortname."_portfolio_number",
					"std" => "6",
					"type" => "text"); 
					
$options[] = array( "name" => __("Portfolio Image Crop", "framework"),
					"desc" => "Do you want to crop your post images?",
					"id" => $shortname."_portfolio_crop",
					"std" => "crop",
					"type" => "radio",
					"options" =>  array(
						'crop' => 'Yes',
						'nocrop' => 'No'
					));  
					
$options[] = array( "name" => __("Back to Projects Button", "framework"),
					"desc" => "Whether you want a 'Back to Projects Button' on your single post pages.",
					"id" => $shortname."_project_button",
					"std" => "on",
					"type" => "radio",
					"options" => array(
						'on' => 'On',	
						'off' => 'Off'	
					));
$options[] = array( "name" => __("Back to Projects Button Text", "framework"),
					"desc" => "Enter the text of your 'Back to Projects' button.",
					"id" => $shortname."_project_button_text",
					"std" => "Back to Projects",
					"type" => "text"); 

$options[] = array( "name" => __("Forms", "framework"),			 
					"type" => "heading");

$options[] = array( "name" => __("Contact Email Address", "framework"),
					"desc" => "Type in the email address you want the contact and quote request forms to mail to.",
					"id" => $shortname."_mail_address",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => __("Successfully Sent Heading", "framework"),
					"desc" => "Heading for a successfully sent contact or quote form.",
					"id" => $shortname."_sent_heading",
					"std" => "Thank you for your email.",
					"type" => "text"); 

$options[] = array( "name" => __("Successfully Sent Description", "framework"),
					"desc" => "Heading for a successfully sent contact or quote form.",
					"id" => $shortname."_sent_description",
					"std" => "It will be answered as soon as possible.",
					"type" => "text"); 

$options[] = array( "name" => __("Fonts", "framework"),				 
					"type" => "heading");


$options[] = array( "name" => __("Navigation Font", "framework"),
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_nav_font",
					"std" => array('face' => 'Source Sans Pro','style' => 'bold', 'style2' => 'uppercase'),
					"type" => "typography_nosize");
					
$options[] = array( "name" => __("Page, Section and Slide Title Font", "framework"),
					"desc" => "Font setting for page titles For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_heading_font",
					"std" => array('face' => 'Source Sans Pro','style' => 'bold','style2' => 'normal'),
					"type" => "typography_nosize");
					
$options[] = array( "name" => __("Subtitle Font", "framework"),
					"desc" => "Font setting for page subtitles For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_page_subtitle_font",
					"std" => array('face' => 'Source Sans Pro','style' => 'normal','style2' => 'normal'),
					"type" => "typography_nosize");
					
$options[] = array( "name" => __("Blog and Portfolio Item Font", "framework"),
					"desc" => "Font Settings for sitewide portfolios and blogs. Blog titles and other secondary heading fonts. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_secondary_font",
					"std" => array('face' => 'Source Sans Pro','style' => 'bold', 'style2' => 'normal'),
					"type" => "typography_nosize");
					
$options[] = array( "name" => __("Content Area Heading Fonts", "framework"),
					"desc" => "Font Settings for sitewide headings in WYSIWYG areas. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_content_heading_font",
					"std" => array('face' => 'Source Sans Pro','style' => 'bold', 'style2' => 'normal'),
					"type" => "typography_nosize");
					
$options[] = array( "name" => __("Button Font", "framework"),
					"desc" => "Font Settings for sitewide buttons. Smaller portfolio titles, comment section titles and other tertiary headings. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_button_font",
					"std" => array('face' => 'Source Sans Pro','style' => 'bold', 'style2' => 'normal'),
					"type" => "typography_nosize");

$options[] = array( "name" => __("Tiny Details Font", "framework"),
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_tiny_font",
					"std" => array('face' => 'Source Sans Pro','style' => 'bold', 'style2' => 'uppercase'),
					"type" => "typography_nosize");

$options[] = array( "name" => __("Paragraph Font", "framework"),
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_p_font",
					"std" => array('size' => '12px','face' => 'Droid Sans','style' => 'normal', 'style2' => 'normal'),
					"type" => "typography_nosize");	

$options[] = array( "name" => __("Latin/Cyrillic Character Support", "framework"),
					"desc" => "Select whether you want Latin/Cyrillic characters in your fonts. Note that some Google fonts don't have these characters, so you'll need to choose ones that do.",
					"id" => $shortname."_cyrillic_chars",
					"std" => "No",
					"type" => "radio",
					"options" =>  array(
						'No' => 'No',
						'Yes' => 'Yes'
						));					
	return $options;
}