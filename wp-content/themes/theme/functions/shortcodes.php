<?php
/*-----------------------------------------------------------------------------------*/
/*	Theme Shortcodes
/*-----------------------------------------------------------------------------------*/

// This function will run to make sure that column shortcodes run after wp_texturize so that
// stray paragraph and line break tags aren't added.

function ag_run_shortcode( $content ) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
	
    remove_all_shortcodes();
 
	add_shortcode('one_third', 'ag_one_third');
	add_shortcode('one_third_last', 'ag_one_third_last');
	add_shortcode('two_third', 'ag_two_third');
	add_shortcode('two_third_last', 'ag_two_third_last');
	add_shortcode('one_half', 'ag_one_half');
	add_shortcode('one_half_last', 'ag_one_half_last');
	add_shortcode('one_fourth', 'ag_one_fourth');
	add_shortcode('one_fourth_last', 'ag_one_fourth_last');
	add_shortcode('three_fourth', 'ag_three_fourth');
	add_shortcode('three_fourth_last', 'ag_three_fourth_last');
	add_shortcode('one_fifth', 'ag_one_fifth');
	add_shortcode('one_fifth_last', 'ag_one_fifth_last');
	add_shortcode('two_fifth', 'ag_two_fifth');
	add_shortcode('two_fifth_last', 'ag_two_fifth_last');
	add_shortcode('three_fifth', 'ag_three_fifth');
	add_shortcode('three_fifth_last', 'ag_three_fifth_last');
	add_shortcode('four_fifth_last', 'ag_four_fifth_last');
	add_shortcode('one_sixth', 'ag_one_sixth');
	add_shortcode('one_sixth_last', 'ag_one_sixth_last');
	add_shortcode('five_sixth_last', 'ag_five_sixth_last');

    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter( 'the_content', 'ag_run_shortcode', 7 );

/*-----------------------------------------------------------------------------------*/
/*	Buttons Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'	=> '#',
    'target'	=> '',
    'color'	=> '',
    'size'	=> '',
    'background'	=> '',
    'text'=> ''
    ), $atts));

	$color = ($color != '') ? ' custom '.$color.'' : '';
	$size = ($size) ? ' '.$size : '';
	$target = ($target == 'blank') ? ' target="_blank"' : '';
	$background = ($background != '' || $text != '') ? ' style="' : '';
		$background .= ($background != '') ? 'background:'.$background.';' : '';
		$background .= ($text != '') ? ' color:'.$text.';' : '';
	$background = ($background != '' || $text != '') ? '"' : '';
	$backgroundclass = ($background != '') ? ' custom ' : '';

	$out = '<a' .$target. ' class="button'.$color.$size.$backgroundclass.' shortcode" href="' .$link. '" '.$background.'>' .do_shortcode($content). '</a>';

    return $out;
}
add_shortcode('button', 'ag_button');

/*-----------------------------------------------------------------------------------*/
/*	Lightbox Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_lightbox( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'	=> '#',
    ), $atts));

	$out = '<a rel="prettyPhoto" href="' .$link. '" class="lightboxhover">' .do_shortcode($content). '</a>';

    return $out;
}
add_shortcode('lightbox', 'ag_lightbox');


/*-----------------------------------------------------------------------------------*/
/*	Divider Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_divider( $atts, $content = null ) {
    extract(shortcode_atts(array(
    ), $atts));

	$out = '<div class="divider"><h5><span>'.do_shortcode($content).'</span></h5></div>';

    return $out;
}
add_shortcode('divider', 'ag_divider');

/*-----------------------------------------------------------------------------------*/
/*	Featured Slider Full Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_featuredfulltabs( $atts, $content = null ) {
	extract(shortcode_atts(array(
    'icon'	=> '',
    'desc'	=> '',
    ), $atts));
	
	$icon = ($icon) ? ' '.$icon : '';
	$desc = ($desc) ? ' '.$desc : '';
	
	global $tab_counter_1;
	global $tab_counter_2;
	
	$tab_counter_1++;
	$tab_counter_2++;
	
	$out = NULL;
	
	$out .= '<div class="clear"></div><ul class="tabs">';
	
	$count = 1;
	
	foreach ($atts as $tab) {
		if($count == 1){$first = 'active';}else{$first = '';}
		$out .= '<li><a class="'.$first.'" href="#'.$tab_counter_1.'">'.$tab.'</a></li>';
	
		$tab_counter_1++;
		$count++;
	}
	$out .= '</ul>';
	
	$out .= '<ul class="tabs-content">'.do_shortcode($content) .'</ul><div class="clear"></div>';
	
	return $out;
	
}
add_shortcode('tabs', 'ag_featuredfulltabs');


/*-----------------------------------------------------------------------------------*/
/*	Full Tab Panes Shortcodes
/*-----------------------------------------------------------------------------------*/

function tabfullpanes( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	$out = NULL;
	
	global $tab_counter_2;
	
	if($tab_counter_2 == 1){$first_2 = 'active';}else{$first_2 = '';}
	$out .= '<li id="'.$tab_counter_2.'" class="'.$first_2.'">'. do_shortcode($content) .'</li>';
	
	$tab_counter_2++;
	
	return $out;
}
add_shortcode('tab', 'tabfullpanes');

/*-----------------------------------------------------------------------------------*/
/*	Posts Shortcode
/*-----------------------------------------------------------------------------------*/

function ag_posts( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'number'	=> '4',
    'title'	=> '',
    'category'	=> '',
    'content' => 'yes',
    'type' => 'post'
    ), $atts));

    // Set Defaults
    // =====================================================================
	$number = ($number != '') ? $number : '4'; // Set Default Posts Number
	$title = ($title != '') ? $title : ''; // Set Default Title
	$category = ($category != '') ? $category : ''; // Set Default Content
	$content = ($content != '') ? $content : 'yes'; // Set Default Posts Number
	$type = ($type != '') ? $type : 'post'; // Set Default Posts Number
	$counter = 1; // Set Initial Variable Number

	// Create HTML
	// ======================================================================
	$out = '<div class="sidepost postshortcode">';

	// Display the Posts Area Title
	if ($title != '') {
		$out .= '<h4 class="title-shortcode">' . $title . '</h4><div class="clear"></div>';
	}

	// Set taxonomy depending on post type
	$taxname = ($type == 'portfolio' || $type == 'Portfolio' || $type == 'portfolios' || $type == 'Portfolios') ? 'filter' : 'category';

	// Query the correct posts, category and number
	// ======================================================================
	if ($category && $category != '') {
		$the_query = new WP_Query(array(
			'showposts' => $number,
			'post_type' => strtolower($type),
			'tax_query' => array(
				array(
					'taxonomy' => $taxname,
					'field' => 'slug',
					'terms' => strtolower($category)
				))
		)); 
	} else {
		$the_query = new WP_Query(array(
			'showposts' => $number,
			'post_type' => strtolower($type)
		)); 
	}

	// Calculate appropriate columns and image sizes for number of posts
	// =======================================================================
	switch ($number) {
		case 1 :
		case 2 :
			$imagesize = 'postfull';
			$datavalue = $number;
		break;
		case 3:
		case 4:
			$imagesize = 'postsidebar';
			$datavalue = $number;
		break;
		default:
			$imagesize = 'postsidebar';
			$datavalue = '4';
		break;
	}


	// Output the Shortcode
	// =======================================================================
	$out .= '<div class="sidepostcontainer isotopecontainer" data-value="'. $datavalue .'">';

	// Loop Through Posts
	while ($the_query->have_posts()) : $the_query->the_post(); $postinfo =  '';

		// Get Post Thumbnail
		if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) :
			$postinfo .= '<div class="thumbnailarea featured-image">
			                  <a class="thumblink" title="'. __('Permanent Link to %s', 'framework') .  get_the_title() .'" href="'. get_permalink() .'">
			                  	'. get_the_post_thumbnail(get_the_ID(), $imagesize, array('class' => 'scale-with-grid')) .'
			                  </a>
		                  </div>';
		endif;	                
		
		// Get Post Title
		$postinfo .= '<h3>
						<a href="'. get_permalink() .'" title="'. __('Permanent Link to %s', 'framework') .  get_the_title() .'">
							'. get_the_title() .'
						</a>
					  </h3>';

		// Set Date for Posts Only
		if ($type == 'post' || $type == 'Post' || $type == 'posts' || $type == 'Posts') {
			$postinfo .= '<span class="date">' . get_the_time(get_option('date_format')) . ' | 
							<a href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">
								'. get_the_author_meta('display_name').'
							</a>
						  </span>';
		}

		// Set the content if option is selected
		if ($content == 'Yes' || $content == 'yes' || $content == 'show' ||  $content == 'Show') {
			global $more; $more=0; 
			$postinfo .= get_the_content(__('Read More', 'framework'));
		}

		// Close postinfo
		$postinfo .= '<div class="clear"></div>';

		// Set columns depending on number
		switch ($number) {
			case ('1') :
				$out .= $postinfo;
			break;
			case ('2') :
				if ($counter == 2) {
					$out .= '<div class="one_half column-last articleinner isobrick">'.$postinfo.'</div>';
				} else {
					$out .= '<div class="one_half articleinner isobrick">'.$postinfo.'</div>';
				}
			break;
			case ('3'):
				if ($counter == 3) {
					$out .= '<div class="one_third column-last articleinner isobrick">'.$postinfo.'</div>';
				} else {
					$out .= '<div class="one_third articleinner isobrick">'.$postinfo.'</div>';
				}
			break;
			default :
				if ($counter == 4) {
					$out .= '<div class="one_fourth column-last articleinner isobrick">'.$postinfo.'</div>';
				} else {
					$out .= '<div class="one_fourth articleinner isobrick">'.$postinfo.'</div>';				
				}
			break;
		}
 
 		// Increment counter
		$counter++;
	// End and reset query
	endwhile;  wp_reset_query(); 

	// Close containers
	$out .= '<div class="clear"></div></div></div>';

	// Return html string
    return $out;
}
add_shortcode('posts', 'ag_posts');

/*-----------------------------------------------------------------------------------*/
/*	Slider Shortcode
/*-----------------------------------------------------------------------------------*/

function ag_slider( $atts, $content = null ) {
	extract(shortcode_atts(array('crop'	=> ''
    ), $atts));

    $crop = ($crop) ? ' '. $crop : '';

	global $slide_counter;
	
	$slide_counter++;
	
	$out = NULL;
	
	$out .= '<div class="clear"></div><div class="featured-image slidershortcode"><ul class="bxslider">';
	
	$count = 1;
	$firstone = 1;
	
	foreach ($atts as $slide) {

	// Find Crop Variable
	while ($firstone == 1) {

		if ($slide == 'No' || $slide == 'no') {
			$crop = 'postnc'; 
		} else {
			$crop = 'post';
		}
		$firstone++;
	}

	// If not First One, get image Src and convert to correct thumbnail size
	if (!($slide == 'Yes' || $slide == 'yes' || $slide == 'no' || $slide == 'No')) {
		
		$image_id = get_attachment_id_from_src ($slide);

		if ($image_id) {
			$caption = get_post($image_id)->post_excerpt; 
		} else {
			$caption = '';
		}

		$image_src = wp_get_attachment_image_src($image_id, $crop, false);
		if ($image_src) {
			$out .= '<li><img src="'.$image_src[0].'" title="'. strip_tags (apply_filters('the_content', $caption)) .' "/></li>';
		} else {
			$out .= '<li><img src="'.$slide.'"/></li>';
		}
	}


		$slide_counter++;
		$count++;
	}
	$out .= '</ul></div>';
	
	return $out;
	
}
add_shortcode('slider', 'ag_slider');

/*-----------------------------------------------------------------------------------*/
/*	Toggle Shortcode
/*-----------------------------------------------------------------------------------*/

	function ag_toggle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => 'Toggle Title',
			'class' => '',
		), $atts ) );
		 
		// Enque scripts
		wp_enqueue_script('ag_toggle');
		
		// Display the Toggle
		return '<div class="ag-toggle '. $class .'"><h3 class="ag-toggle-trigger">'. $title .'</h3><div class="ag-toggle-container">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode('toggle', 'ag_toggle_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Accordion Shortcode
/*-----------------------------------------------------------------------------------*/

// Main

	function ag_accordion_main_shortcode( $atts, $content = null  ) {
		
		extract( shortcode_atts( array(
			'class' => ''
		), $atts ) );
		
		// Enque scripts
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('ag_accordion');
		
		// Display the accordion	
		return '<div class="ag-accordion '. $class .'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'accordion', 'ag_accordion_main_shortcode' );



// Section

	function ag_accordion_section_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'title' => 'Title',
			'class' => '',
		), $atts ) );
		  
	   return '<h3 class="ag-accordion-trigger '. $class .'"><a href="#">'. $title .'</a></h3><div>' . do_shortcode($content) . '</div>';
	}
	
	add_shortcode( 'accordion_section', 'ag_accordion_section_shortcode' );

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table Shortcode
/*-----------------------------------------------------------------------------------*/
/*main*/
	function ag_pricing_table_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'class' => ''
		), $atts ) );
		return '<div class="ag-pricing-table  clearfix '. $class .'">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
	add_shortcode( 'pricing_table', 'ag_pricing_table_shortcode' );


/*section*/
	function ag_pricing_shortcode( $atts, $content = null  ) {
		
		extract( shortcode_atts( array(
			'size' => 'one_half',
			'position' => '',
			'featured' => 'no',
			'plan' => 'Basic',
			'cost' => '$20',
			'per' => 'month',
			'button_url' => '',
			'button_text' => 'Purchase',
			'button_color' => '',
			'button_target' => 'self',
			'button_rel' => 'nofollow',
			'button_border_radius' => '',
			'class' => '',
		), $atts ) );
		
		//set variables
		$featured_pricing = ( $featured == 'yes' ) ? 'featured' : NULL;
		$border_radius_style = ( $button_border_radius ) ? 'style="border-radius:'. $button_border_radius .'"' : NULL;
		
		//start content  
		$pricing_content ='';
		$pricing_content .= '<div class="ag-pricing '. $size .' '. $featured_pricing .' column-'. $position. ' '. $class .'">';
			$pricing_content .= '<div class="ag-pricing-header">';
				$pricing_content .= '<h5>'. $plan. '</h5>';
				$pricing_content .= '<div class="ag-pricing-cost">'. $cost .'</div><div class="ag-pricing-per">'. $per .'</div>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="ag-pricing-content">';
				$pricing_content .= ''. $content. '';
			$pricing_content .= '</div>';
			if( $button_url ) {
				$pricing_content .= '<div class="ag-pricing-button"><a href="'. $button_url .'" class="button '. $button_color .'" target="_'. $button_target .'" rel="'. $button_rel .'" '. $border_radius_style .'><span class="ag-button-inner" '. $border_radius_style .'>'. $button_text .'</span></a></div>';
			}
		$pricing_content .= '</div>';  
		return $pricing_content;
	}
	
	add_shortcode( 'pricing', 'ag_pricing_shortcode' );



/*-----------------------------------------------------------------------------------*/
/*	Social Shortcode
/*-----------------------------------------------------------------------------------*/

	function ag_social_shortcode( $atts ){   
		extract( shortcode_atts( array(
			'icon' => 'twitter',
			'url' => 'http://www.twitter.com/username',
			'title' => 'Follow Us',
			'target' => 'self',
			'rel' => '',
			'class' => '',
		), $atts ) );
		
		return '<a href="' . $url . '" class="ag-social-icon '. $class .'" target="_'.$target.'" title="'. $title .'" rel="'. $rel .'"
><img src="'. get_template_directory_uri() .'/images/icons/'. $icon .'.png" alt="'. $icon .'" /></a>';
	}
	add_shortcode('social', 'ag_social_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Shortcode Linebreak Fix
/*-----------------------------------------------------------------------------------*/
	function ag_fix_shortcodes($content){   
		$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
	add_filter('the_content', 'ag_fix_shortcodes');
	
	

/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'ag_one_third');

function ag_one_third_last( $atts, $content = null ) {
   return '<div class="one_third column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'ag_one_third_last');

function ag_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'ag_two_third');

function ag_two_third_last( $atts, $content = null ) {
   return '<div class="two_third column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'ag_two_third_last');

function ag_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'ag_one_half');

function ag_one_half_last( $atts, $content = null ) {
   return '<div class="one_half column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'ag_one_half_last');

function ag_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'ag_one_fourth');

function ag_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'ag_one_fourth_last');

function ag_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'ag_three_fourth');

function ag_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'ag_three_fourth_last');

function ag_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'ag_one_fifth');

function ag_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'ag_one_fifth_last');

function ag_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'ag_two_fifth');

function ag_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'ag_two_fifth_last');

function ag_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'ag_three_fifth');

function ag_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'ag_three_fifth_last');

function ag_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'ag_four_fifth');

function ag_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'ag_four_fifth_last');

function ag_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'ag_one_sixth');

function ag_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'ag_one_sixth_last');

function ag_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'ag_five_sixth');

function ag_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'ag_five_sixth_last');


/*-----------------------------------------------------------------------------------*/
/*	Add Shortcode Buttons to WYSIWIG
/*-----------------------------------------------------------------------------------*/

add_action('init', 'add_ag_shortcodes');  

function add_ag_shortcodes() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
   
   	 //Add "button" button
     add_filter('mce_external_plugins', 'add_plugin_button');  
     add_filter('mce_buttons', 'register_button');  
	 
     //Add "divider" button
     add_filter('mce_external_plugins', 'add_plugin_divider');  
     add_filter('mce_buttons', 'register_divider'); 

     //Add "slider" button
     add_filter('mce_external_plugins', 'add_plugin_slider');  
     add_filter('mce_buttons', 'register_slider');  
     
	 //Add "tabs" button
     add_filter('mce_external_plugins', 'add_plugin_featuredfulltabs');  
     add_filter('mce_buttons', 'register_featuredfulltabs');   
	 
	 //Add "lightbox" button
     add_filter('mce_external_plugins', 'add_plugin_lightbox');  
     add_filter('mce_buttons', 'register_lightbox');  

     //Add "Posts" button
     add_filter('mce_external_plugins', 'add_plugin_posts');  
     add_filter('mce_buttons', 'register_posts');  

     //Add Toggle button
     add_filter('mce_external_plugins', 'add_plugin_toggle');  
     add_filter('mce_buttons', 'register_toggle'); 

     //Add Accordion button
     add_filter('mce_external_plugins', 'add_plugin_accordion');  
     add_filter('mce_buttons', 'register_accordion'); 

     //Add Pricing button
     add_filter('mce_external_plugins', 'add_plugin_pricing');  
     add_filter('mce_buttons', 'register_pricing'); 

     //Add Social button
     add_filter('mce_external_plugins', 'add_plugin_social');  
     add_filter('mce_buttons', 'register_social'); 
	 
	 //Add "shortcodes" buttons - 3rd row
	 
	 add_filter('mce_external_plugins', 'add_plugin_onehalf');  
     add_filter('mce_buttons_3', 'register_onehalf'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onehalflast');  
     add_filter('mce_buttons_3', 'register_onehalflast'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onethird');  
     add_filter('mce_buttons_3', 'register_onethird'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onethirdlast');  
     add_filter('mce_buttons_3', 'register_onethirdlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_twothird');  
     add_filter('mce_buttons_3', 'register_twothird'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_twothirdlast');  
     add_filter('mce_buttons_3', 'register_twothirdlast'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onefourth');  
     add_filter('mce_buttons_3', 'register_onefourth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onefourthlast');  
     add_filter('mce_buttons_3', 'register_onefourthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_threefourth');  
     add_filter('mce_buttons_3', 'register_threefourth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_threefourthlast');  
     add_filter('mce_buttons_3', 'register_threefourthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_onefifth');  
     add_filter('mce_buttons_3', 'register_onefifth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onefifthlast');  
     add_filter('mce_buttons_3', 'register_onefifthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_twofifth');  
     add_filter('mce_buttons_3', 'register_twofifth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_twofifthlast');  
     add_filter('mce_buttons_3', 'register_twofifthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_threefifth');  
     add_filter('mce_buttons_3', 'register_threefifth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_threefifthlast');  
     add_filter('mce_buttons_3', 'register_threefifthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_fourfifth');  
     add_filter('mce_buttons_3', 'register_fourfifth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_fourfifthlast');  
     add_filter('mce_buttons_3', 'register_fourfifthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_onesixth');  
     add_filter('mce_buttons_3', 'register_onesixth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onesixthlast');  
     add_filter('mce_buttons_3', 'register_onesixthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_fivesixth');  
     add_filter('mce_buttons_3', 'register_fivesixth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_fivesixthlast');  
     add_filter('mce_buttons_3', 'register_fivesixthlast');
	 
   }  
}  

function register_button($buttons) {  
   array_push($buttons, "button");  
   return $buttons;  
} 
function add_plugin_button($plugin_array) {  
   $plugin_array['button'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}  
function register_divider($buttons) {  
   array_push($buttons, "divider");  
   return $buttons;  
}
function add_plugin_divider($plugin_array) {  
   $plugin_array['divider'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_slider($buttons) {  
   array_push($buttons, "slider");  
   return $buttons;  
}
function add_plugin_slider($plugin_array) {  
   $plugin_array['slider'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_posts($buttons) {  
   array_push($buttons, "posts");  
   return $buttons;  
}
function add_plugin_posts($plugin_array) {  
   $plugin_array['posts'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_featuredfulltabs($buttons) {  
   array_push($buttons, "featuredfulltabs");  
   return $buttons;  
}
function add_plugin_featuredfulltabs($plugin_array) {  
   $plugin_array['featuredfulltabs'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_lightbox($buttons) {  
   array_push($buttons, "lightbox");  
   return $buttons;  
}
function add_plugin_lightbox($plugin_array) {  
   $plugin_array['lightbox'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_accordion($buttons) {  
   array_push($buttons, "accordion");  
   return $buttons;  
}
function add_plugin_accordion($plugin_array) {  
   $plugin_array['accordion'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_toggle($buttons) {  
   array_push($buttons, "toggle");  
   return $buttons;  
}
function add_plugin_toggle($plugin_array) {  
   $plugin_array['toggle'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_pricing($buttons) {  
   array_push($buttons, "pricing");  
   return $buttons;  
}
function add_plugin_pricing($plugin_array) {  
   $plugin_array['pricing'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_social($buttons) {  
   array_push($buttons, "social");  
   return $buttons;  
}
function add_plugin_social($plugin_array) {  
   $plugin_array['social'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_onehalf($buttons) {  
   array_push($buttons, "onehalf");  
   return $buttons;  
}
function add_plugin_onehalf($plugin_array) {  
   $plugin_array['onehalf'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onehalflast($buttons) {  
   array_push($buttons, "onehalflast");  
   return $buttons;  
}
function add_plugin_onehalflast($plugin_array) {  
   $plugin_array['onehalflast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onethird($buttons) {  
   array_push($buttons, "onethird");  
   return $buttons;  
}
function add_plugin_onethird($plugin_array) {  
   $plugin_array['onethird'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onethirdlast($buttons) {  
   array_push($buttons, "onethirdlast");  
   return $buttons;  
}
function add_plugin_onethirdlast($plugin_array) {  
   $plugin_array['onethirdlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_twothird($buttons) {  
   array_push($buttons, "twothird");  
   return $buttons;  
}
function add_plugin_twothird($plugin_array) {  
   $plugin_array['twothird'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_twothirdlast($buttons) {  
   array_push($buttons, "twothirdlast");  
   return $buttons;  
}
function add_plugin_twothirdlast($plugin_array) {  
   $plugin_array['twothirdlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// one fourth buttons

function register_onefourth($buttons) {  
   array_push($buttons, "onefourth");  
   return $buttons;  
}
function add_plugin_onefourth($plugin_array) {  
   $plugin_array['onefourth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onefourthlast($buttons) {  
   array_push($buttons, "onefourthlast");  
   return $buttons;  
}
function add_plugin_onefourthlast($plugin_array) {  
   $plugin_array['onefourthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}


// three fourth buttons

function register_threefourth($buttons) {  
   array_push($buttons, "threefourth");  
   return $buttons;  
}
function add_plugin_threefourth($plugin_array) {  
   $plugin_array['threefourth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_threefourthlast($buttons) {  
   array_push($buttons, "threefourthlast");  
   return $buttons;  
}
function add_plugin_threefourthlast($plugin_array) {  
   $plugin_array['threefourthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// one fifth buttons

function register_onefifth($buttons) {  
   array_push($buttons, "onefifth");  
   return $buttons;  
}
function add_plugin_onefifth($plugin_array) {  
   $plugin_array['onefifth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onefifthlast($buttons) {  
   array_push($buttons, "onefifthlast");  
   return $buttons;  
}
function add_plugin_onefifthlast($plugin_array) {  
   $plugin_array['onefifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// two fifth buttons

function register_twofifth($buttons) {  
   array_push($buttons, "twofifth");  
   return $buttons;  
}
function add_plugin_twofifth($plugin_array) {  
   $plugin_array['twofifth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_twofifthlast($buttons) {  
   array_push($buttons, "twofifthlast");  
   return $buttons;  
}
function add_plugin_twofifthlast($plugin_array) {  
   $plugin_array['twofifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// three fifth buttons

function register_threefifth($buttons) {  
   array_push($buttons, "threefifth");  
   return $buttons;  
}
function add_plugin_threefifth($plugin_array) {  
   $plugin_array['threefifth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_threefifthlast($buttons) {  
   array_push($buttons, "threefifthlast");  
   return $buttons;  
}
function add_plugin_threefifthlast($plugin_array) {  
   $plugin_array['threefifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// four fifth buttons

function register_fourfifth($buttons) {  
   array_push($buttons, "fourfifth");  
   return $buttons;  
}
function add_plugin_fourfifth($plugin_array) {  
   $plugin_array['fourfifth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_fourfifthlast($buttons) {  
   array_push($buttons, "fourfifthlast");  
   return $buttons;  
}
function add_plugin_fourfifthlast($plugin_array) {  
   $plugin_array['fourfifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// one sixth buttons

function register_onesixth($buttons) {  
   array_push($buttons, "onesixth");  
   return $buttons;  
}
function add_plugin_onesixth($plugin_array) {  
   $plugin_array['onesixth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onesixthlast($buttons) {  
   array_push($buttons, "onesixthlast");  
   return $buttons;  
}
function add_plugin_onesixthlast($plugin_array) {  
   $plugin_array['onesixthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// five sixth buttons

function register_fivesixth($buttons) {  
   array_push($buttons, "fivesixth");  
   return $buttons;  
}
function add_plugin_fivesixth($plugin_array) {  
   $plugin_array['fivesixth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_fivesixthlast($buttons) {  
   array_push($buttons, "fivesixthlast");  
   return $buttons;  
}
function add_plugin_fivesixthlast($plugin_array) {  
   $plugin_array['fivesixthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}


function parse_shortcode_content( $content ) {

    /* Parse nested shortcodes and add formatting. */
    $content = trim( wpautop( do_shortcode( $content ) ) );

    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );

    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );

    return $content;
}
?>