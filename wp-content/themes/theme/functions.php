<?php 

if ( !function_exists( 'optionsframework_init' ) ) {

/*-----------------------------------------------------------------------------------*/
/* Options Framework Theme
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */
if ( get_stylesheet_directory() == get_template_directory() ) {
	define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
} else {
	define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
}
require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}

/*-----------------------------------------------------------------------------------*/
/* Admin Post Scripts
/*-----------------------------------------------------------------------------------*/

// Post Javascript
function ag_load_post_scripts() {
	wp_register_script('post-js', get_template_directory_uri() . '/functions/js/post-javascript.js', 'jquery');
	wp_enqueue_script( 'post-js' );
}

add_action('admin_init', 'ag_load_post_scripts');


// Add Embed Code to Footer
function ag_embed_code() {
?>
<!-- Google Analytics Code
  ================================================== -->
<?php echo of_get_option('of_google_analytics'); 
}

add_action( 'wp_footer', 'ag_embed_code', 1000 );


// Color Picker Javascript
function add_admin_scripts( $hook ) {

    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'section' === $post->post_type ) {     
            wp_enqueue_script('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'js/colorpicker.js', array('jquery'));
        }
    }
}
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );

// Admin Color Picker CSS
function add_admin_css( $hook ) {
   
			wp_enqueue_style('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'css/colorpicker.css');
 
}
add_action( 'admin_print_styles', 'add_admin_css' );

/*-----------------------------------------------------------------------------------*/
/* Add Contextual Help
/*-----------------------------------------------------------------------------------*/

function ag_contextual_help( $contextual_help, $screen_id, $screen ) {
   // echo 'Screen ID = '.$screen_id.'<br />';
    $screen = get_current_screen();
    switch( $screen_id ) {
		
		/* #Section Help Options
		================================================== */		
        case 'section' :
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/section-general-readme.html' );
		$screen->add_help_tab( array(
			'id'      => 'ag_general_help_'.$screen_id,
			'title'   => __( 'What Are Sections', 'framework'),
			// Tab content
   			'content' => $section_readme['body'],
		));
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/section-slides-readme.html' );
		$screen->add_help_tab( array(
			'id'      => 'ag_slides_help_'.$screen_id,
			'title'   => __( 'Adding Slides', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));

		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/section-video-readme.html' );
		$screen->add_help_tab( array(
			'id'      => 'ag_video_help_'.$screen_id,
			'title'   => __( 'Adding Video', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));

		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/section-layout-readme.html' );
	    $screen->add_help_tab( array(
			'id'      => 'ag_layout_help_'.$screen_id,
			'title'   => __( 'Customizing Layout', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));

		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/section-colors-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_colors_help_'.$screen_id,
			'title'   => __( 'Customizing Colors', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));

		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/section-button-readme.html' );
		$screen->add_help_tab( array(
			'id'      => 'ag_button_help_'.$screen_id,
			'title'   => __( 'Customizing The Button', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
        break;
		
		/* #Portfolio Help Options
		================================================== */
        case 'portfolio' :
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/portfolio-general-readme.html' );		
        $screen->add_help_tab( array(
			'id'      => 'ag_general_help_'.$screen_id,
			'title'   => __( 'What is a Portfolio', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/portfolio-slides-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_slides_help_'.$screen_id,
			'title'   => __( 'Portfolio Slides', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/portfolio-options-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_options_help_'.$screen_id,
			'title'   => __( 'Portfolio Options', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));

		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/page-sections-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_sections_help_'.$screen_id,
			'title'   => __( 'Adding Sections', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
        break;
		
		/* #Slide Help Options
		================================================== */
		case 'slide' :
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/slide-general-readme.html' );		
        $screen->add_help_tab( array(
			'id'      => 'ag_general_help_'.$screen_id,
			'title'   => __( 'What is a Slide', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/slide-options-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_options_help_'.$screen_id,
			'title'   => __( 'Slide Display', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/slide-colors-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_colors_help_'.$screen_id,
			'title'   => __( 'Slide Colors', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/slide-button-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_button_help_'.$screen_id,
			'title'   => __( 'Customizing The Button', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
        break;
		
		/* #Page Help Options
		================================================== */		
		case 'page' :
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/page-image-readme.html' );		
        $screen->add_help_tab( array(
			'id'      => 'ag_image_help_'.$screen_id,
			'title'   => __( 'Featured Image', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/page-sections-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_sections_help_'.$screen_id,
			'title'   => __( 'Adding Sections', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/page-button-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_button_help_'.$screen_id,
			'title'   => __( 'Customizing The Button', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
		$section_readme = wp_remote_get( get_template_directory_uri() . '/functions/help/page-options-readme.html' );		
		$screen->add_help_tab( array(
			'id'      => 'ag_options_help_'.$screen_id,
			'title'   => __( 'Page Options', 'framework' ),
			// Tab content
			'content' => $section_readme['body'],
		));
		
        break;
    }
   // return $contextual_help;
}
add_filter('contextual_help', 'ag_contextual_help', 10, 3);

/*-----------------------------------------------------------------------------------*/
/* Add Visual Editor Style
/*-----------------------------------------------------------------------------------*/
add_editor_style();
	
/*-----------------------------------------------------------------------------------*/
/* Add Theme Shortcodes
/*-----------------------------------------------------------------------------------*/
include("functions/shortcodes.php");

/*-----------------------------------------------------------------------------------*/
/* Add Multiple Thumbnail Support
/*-----------------------------------------------------------------------------------*/
include("functions/multi-post-thumbnails.php");

if (class_exists('MultiPostThumbnails')) { 

   if ( $thumbnum = of_get_option('of_thumbnail_number') ) { $thumbnum = ($thumbnum + 1); } else { $thumbnum = 7;}
   $counter1 = 2;

	while ($counter1 < ($thumbnum)) {
	
	// Add Slides in Posts	
	new MultiPostThumbnails( 
		array( 
			'label' => 'Slide ' . $counter1, 
			'id' => $counter1 . '-slide', 
			'post_type' => 'post' 
		));
	
	// Add Slides in Sections	
	new MultiPostThumbnails( 
		array( 
			'label' => 'Slide ' . $counter1, 
			'id' => $counter1 . '-slide', 
			'post_type' => 'section' 
		));	
	
	// Add Slides in Portfolio Items
	new MultiPostThumbnails( 
		array( 
			'label' => 'Slide ' . $counter1, 
			'id' => $counter1 . '-slide', 
			'post_type' => 'portfolio' 
		));	
	
	$counter1++;
	
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Add Widget Shortcode Support
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Add the Custom Fields for Sections and Pages
/*-----------------------------------------------------------------------------------*/
include("functions/customfields.php");

/*-----------------------------------------------------------------------------------*/
/*	Include Update Notifier
/*-----------------------------------------------------------------------------------*/
include("functions/update_notifier.php");

/*-----------------------------------------------------------------------------------*/
/*	Include Drag and Drop Slide Order Functionality
/*-----------------------------------------------------------------------------------*/
include('functions/drag-drop-order.php');

/*-----------------------------------------------------------------------------------*/
/*	Register and Load JS
/*-----------------------------------------------------------------------------------*/
function ag_register_js() {
	if (!is_admin()) {
		
		// Register custom javascript
		wp_register_script('custom', get_template_directory_uri() . '/js/custom.js', 'jquery', '1.2.1', true);

		// Enqueue javascript and custom js file
		wp_enqueue_script('jquery');
		wp_enqueue_script('custom');
	}
}
add_action('init', 'ag_register_js');

/*-----------------------------------------------------------------------------------*/
/*	Register Stylesheets
/*-----------------------------------------------------------------------------------*/

// CSS Options
function custom_enqueue_css() {
	wp_register_style('options', get_template_directory_uri() . '/css/custom.css', 'style');
	wp_enqueue_style( 'options');
}
add_action('wp_print_styles', 'custom_enqueue_css');

//IE CSS
function ag_register_iecss () {
	if (!is_admin()) {
		global $wp_styles;
		wp_enqueue_style(  "ie7",  get_template_directory_uri() . "/css/ie7.css", false, 'ie7', "all");
		wp_enqueue_style(  "ie8",  get_template_directory_uri() . "/css/ie8.css", false, 'ie8', "all");
		$wp_styles->add_data( "ie7", 'conditional', 'IE 7' );
		$wp_styles->add_data( "ie8", 'conditional', 'IE 8' );
	}
}
add_action('init', 'ag_register_iecss');

/*-----------------------------------------------------------------------------------*/
/* Register Navigation 
/*-----------------------------------------------------------------------------------*/
add_theme_support('menus');

if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
          'main_nav_menu' => 'Main Navigation Menu'
        )
    );

    // remove menu container div
    function my_wp_nav_menu_args( $args = '' ) {
        $args['container'] = false;
        return $args;
    } 
    add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
}

/*-----------------------------------------------------------------------------------*/
/*	Automatic Feed Links
/*-----------------------------------------------------------------------------------*/
if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
    //WP Auto Feed Links
}

/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String, Remove Automatic Periods
/*-----------------------------------------------------------------------------------*/
function ag_excerpt_more($excerpt) {
	return str_replace('[...]', '...', $excerpt); 
}
add_filter('wp_trim_excerpt', 'ag_excerpt_more');

/*-----------------------------------------------------------------------------------*/
/*	Add Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/
add_filter('body_class','ag_browser_body_class');

function ag_browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}

/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 56, 56, true ); // Normal post thumbnails tinyfeatured
	add_image_size( 'tinyfeatured', 56, 56, true ); // Tiny Square thumbnail
	add_image_size( 'sectionsmall', 514, '', true ); // Small Section thumbnail
	add_image_size( 'sectionlarge', 820, '', true ); // Large Section thumbnail
	add_image_size( 'homeslideshow', 1500, 600, true); // Homepage Slideshow
	add_image_size( 'homeslideshowfixed', 940, 545, true); // Homepage Slideshow
	add_image_size( 'homefeatured', 350, '', false); // Homepage Featured Image
	add_image_size( 'postsidebar', 420, 260, true); // Post Image Cropped
	add_image_size( 'post', 640, 375, true); // Post Image Cropped
	add_image_size( 'postnc', 640, '', false);  // Post Image No Crop
	add_image_size( 'postfull', 940, 475, true); // Post Full Cropped
	add_image_size( 'postfullnc', 940, '', false);	// Post Full No Crop
	add_image_size( 'portfolio-three', 426, 351, true);	// Portfolio Three Column
	add_image_size( 'portfolio-three-nc', 426, '', false);	// Portfolio Three Column No Crop
	add_image_size( 'portfolio-single', 640, 425, true); // Single Portfolio 
	add_image_size( 'portfolio-single-nc', 640, '', false); // Single Portfolio No Crop
}

/*-----------------------------------------------------------------------------------*/
/*	Add PrettyPhoto to WordPress Galleries
/*-----------------------------------------------------------------------------------*/
add_filter( 'wp_get_attachment_link', 'ag_prettyadd');
 
function ag_prettyadd ($content) {
	$content = preg_replace("/<a/","<a rel='prettyPhoto[slides]'",$content,1);
	return $content;
}

/*-----------------------------------------------------------------------------------*/
/*	Comment Reply Javascript Action
/*-----------------------------------------------------------------------------------*/
function ag_enqueue_comment_reply() {
    // on single blog post pages with comments open and threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
        // enqueue the javascript that performs in-link comment reply fanciness
        wp_enqueue_script( 'comment-reply' ); 
    }
}
// Hook into wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'ag_enqueue_comment_reply' );

/*-----------------------------------------------------------------------------------*/
/*	Add Widgets
/*-----------------------------------------------------------------------------------*/
// Add the News Custom Widget
include("functions/widgets/widget-news.php");
// Add the Contact Custom Widget
include("functions/widgets/widget-contact.php");
// Add the Social Counter Tabs Widget
include("functions/widgets/widget-tab.php");
// Add the Recent Projects Widget
include("functions/widgets/widget-recent-projects.php");

/*-----------------------------------------------------------------------------------*/
/* Register Widget Sidebars
/*-----------------------------------------------------------------------------------*/
if ( function_exists('register_sidebar') ) {
 register_sidebar(array(
  'name' => 'Blog Sidebar',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div><div class="clear"></div>',
  'before_title' => '<h4 class="widget-title">',
  'after_title' => '</h4>',
 ));
 register_sidebar(array(
  'name' => 'Single Post Sidebar',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div><div class="clear"></div>',
  'before_title' => '<h4 class="widget-title">',
  'after_title' => '</h4>',
 ));
 register_sidebar(array(
  'name' => 'Page Sidebar',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div><div class="clear"></div>',
  'before_title' => '<h4 class="widget-title">',
  'after_title' => '</h4>',
 ));
 register_sidebar(array(
  'name' => 'Contact Sidebar',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div><div class="clear"></div>',
  'before_title' => '<h4 class="widget-title">',
  'after_title' => '</h4>',
 ));
 register_sidebar(array( 
  'name' => 'Footer Left',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div><div class="clear"></div>',
  'before_title' => '<h3 class="widget-title">',
  'after_title' => '</h3>',
 ));
 register_sidebar(array( 
  'name' => 'Footer Left Center',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div><div class="clear"></div>',
  'before_title' => '<h3 class="widget-title">',
  'after_title' => '</h3>',
 ));
 register_sidebar(array( 
  'name' => 'Footer Right Center',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div><div class="clear"></div>',
  'before_title' => '<h3 class="widget-title">',
  'after_title' => '</h3>',
 ));
 register_sidebar(array( 
  'name' => 'Footer Right',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div><div class="clear"></div>',
  'before_title' => '<h3 class="widget-title">',
  'after_title' => '</h3>',
 ));
}

/*------------------------------------------------------------------------------*/
/*	Comments Template
/*------------------------------------------------------------------------------*/
function ag_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" class="singlecomment">
        <p class="commentsmetadata">
        	<cite><?php comment_date('F j, Y'); ?></cite>
        </p>
    	<div class="author">
            <div class="reply"><?php echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'])); ?></div>
            <div class="name"><?php comment_author_link() ?></div>
        </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <p class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></p>
      <?php endif; ?>
        <div class="commenttext">
            <?php comment_text() ?>
        </div>
	</div>
<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Load Text Domain
/*-----------------------------------------------------------------------------------*/

function theme_init(){
    load_theme_textdomain('framework', get_template_directory() . '/lang');
}
add_action ('init', 'theme_init');


/*-----------------------------------------------------------------------------------*/
/*	Add deconstructed URI as <body> classes in Admin
/*-----------------------------------------------------------------------------------*/

function add_to_admin_body_class($classes) {
	// get the global post variable
	global $post;
	// instantiate, should be overwritten
	$mode = '';
	// get the current page's URI (the part /after/ your domain name)
	$uri = $_SERVER["REQUEST_URI"];
	// get the post type from WP
	$post_type = get_post_type($post->ID);
	// set the $mode variable to reflect the editorial /list/ page...
	if (strstr($uri,'edit.php')) {
		$mode = 'edit-list-';
	}
	// or the actual editor page
	if (strstr($uri,'post.php')) {
		$mode = 'edit-page-';
	}
	// append our new mode/post_type class to any existing classes
	$classes .= $mode . $post_type;
	// and send them back to WP
	return $classes;
}
	
// add this filter to the admin_body_class hook
add_filter('admin_body_class', 'add_to_admin_body_class');

/*-----------------------------------------------------------------------------------*/
/*	Create Section Post Type
/*-----------------------------------------------------------------------------------*/

function create_section_post_types() {
	register_post_type( 'section',
		array(
			  'labels' => array(
			  'name' => __( 'Section', 'framework'),
			  'singular_name' => __( 'Section', 'framework'),
			  'add_new' => __( 'Add New', 'framework' ),
		   	  'add_new_item' => __( 'Add Section', 'framework'),
			  'edit' => __( 'Edit', 'framework' ),
	  		  'edit_item' => __( 'Edit Section', 'framework'),
	          'new_item' => __( 'New Section', 'framework'),
			  'view' => __( 'View Section', 'framework'),
			  'view_item' => __( 'View Section', 'framework'),
			  'search_items' => __( 'Search Sections', 'framework'),
	  		  'not_found' => __( 'No Sections found', 'framework'),
	  		  'not_found_in_trash' => __( 'No Section Items found in Trash', 'framework'),
			  'parent' => __( 'Parent Section', 'framework'),
			),
			'menu_icon' => get_template_directory_uri() . '/admin/images/section.png',
			'public' => true,
			'exclude_from_search' => true, // we don't want sections to show up in search
			'rewrite' => array( 'slug' => 'section'), //  Change this to change the url of your "portfolio".
			'supports' => array( 
				'title', 
				'editor',  
				'thumbnail',
				'revisions'),
		)
	);
}
add_action( 'init', 'create_section_post_types' );

/*-----------------------------------------------------------------------------------*/
/*	Create Slide Post Type
/*-----------------------------------------------------------------------------------*/

function create_slide_post_types() {
	register_post_type( 'slide',
		array(
			  'labels' => array(
			  'name' => __( 'Slide', 'framework'),
			  'singular_name' => __( 'Slide', 'framework'),
			  'add_new' => __( 'Add New', 'framework' ),
		   	  'add_new_item' => __( 'Add Slide', 'framework'),
			  'edit' => __( 'Edit', 'framework' ),
	  		  'edit_item' => __( 'Edit Slide', 'framework'),
	          'new_item' => __( 'New Slide', 'framework'),
			  'view' => __( 'View Slide', 'framework'),
			  'view_item' => __( 'View Slide', 'framework'),
			  'search_items' => __( 'Search Slides', 'framework'),
	  		  'not_found' => __( 'No Slides found', 'framework'),
	  		  'not_found_in_trash' => __( 'No Slide Items found in Trash', 'framework'),
			  'parent' => __( 'Parent Slide', 'framework'),
			),
			'menu_icon' => get_template_directory_uri() . '/admin/images/slides.png',
			'public' => true,
			'exclude_from_search' => true, // we don't want Slides to show up in search
			'rewrite' => array( 'slug' => 'slide'), //  Change this to change the url of your "portfolio".
			'supports' => array( 
				'title',   
				'thumbnail',
				'editor', // Need this for qtranslate, hiding with custom css
				'revisions'),
		)
	);
}
add_action( 'init', 'create_slide_post_types' );

/*-----------------------------------------------------------------------------------*/
/*	Add Custom Portfolio Post Type
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'create_portfolio_post_types' );

function create_portfolio_post_types() {
	register_post_type( 'portfolio',
		array(
			  'labels' => array(
			  'name' => __( 'Portfolio', 'framework'),
			  'singular_name' => __( 'Portfolio Item', 'framework'),
			  'add_new' => __( 'Add New', 'framework' ),
		   	  'add_new_item' => __( 'Add New Portfolio Item', 'framework'),
			  'edit' => __( 'Edit', 'framework' ),
	  		  'edit_item' => __( 'Edit Portfolio Item', 'framework'),
	          'new_item' => __( 'New Portfolio Item', 'framework'),
			  'view' => __( 'View Portfolio', 'framework'),
			  'view_item' => __( 'View Portfolio Item', 'framework'),
			  'search_items' => __( 'Search Portfolio Items', 'framework'),
	  		  'not_found' => __( 'No Portfolios found', 'framework'),
	  		  'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'framework'),
			  'parent' => __( 'Parent Portfolio', 'framework'),
			),
			'menu_icon' => get_template_directory_uri() . '/admin/images/portfolio.png',
			'public' => true,
			'rewrite' => array( 'slug' => 'portfolio'), //  Change this to change the url of your "portfolio".
			'supports' => array( 
				'title', 
				'editor',  
				'thumbnail',
				'revisions'),
		)
	);
}

/*-----------------------------------------------------------------------------------*/
/*	Add Custom Icons for Post Types
/*-----------------------------------------------------------------------------------*/
function custom_icon() {
	   echo '<style type="text/css">
		  #icon-edit.icon32.icon32-posts-portfolio {
			background: url('. get_template_directory_uri() . '/admin/images/portfolio-large.png) no-repeat; 
		  }
		  #icon-edit.icon32.icon32-posts-section {
			background: url('. get_template_directory_uri() . '/admin/images/section-large.png) no-repeat; 
		  }
		  #icon-edit.icon32.icon32-posts-slide {
			background: url('. get_template_directory_uri() . '/admin/images/slides-large.png) no-repeat; 
		  }
		 </style>';
}

add_action('admin_enqueue_scripts', 'custom_icon', 1);

//hook into the init action and call the taxonomy when it fires
add_action( 'init', 'ag_create_taxonomies', 0 );

//create the taxonomies function
function ag_create_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Filter', 'taxonomy general name', 'framework'),
    'singular_name' => _x( 'Filter', 'taxonomy singular name', 'framework'),
    'search_items' =>  __( 'Search Filters', 'framework'),
    'all_items' => __( 'All Filters', 'framework'),
    'parent_item' => __( 'Parent Filter', 'framework'),
    'parent_item_colon' => __( 'Parent Filter:', 'framework'),
    'edit_item' => __( 'Edit Filter', 'framework'), 
    'update_item' => __( 'Update Filter', 'framework'),
    'add_new_item' => __( 'Add New Filter', 'framework'),
    'new_item_name' => __( 'New Filter Name', 'framework'),
    'menu_name' => __( 'Filters', 'framework'),
  ); 	

  register_taxonomy('filter',array('portfolio'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'filter' ), // This is the url slug
  ));

}

add_action('filter_add_form', 'qtrans_modifyTermFormFor');
add_action('filter_edit_form', 'qtrans_modifyTermFormFor');

// Add Css for Seciton of Slide
add_action('admin_head', 'ag_admin_css');

	function ag_admin_css() {

		$getposttype = '';
		if (isset($_GET['post_type'])) $getposttype = $_GET['post_type'];
		global $post_type; 
		
		if (($getposttype == 'section') || ($post_type == 'section')) :		
			echo "<link type='text/css' rel='stylesheet' href='" . get_template_directory_uri() ."/functions/css/section-slide.css' />";
		endif;
		
		if (($getposttype == 'slide') || ($post_type == 'slide')) :	
			echo "<link type='text/css' rel='stylesheet' href='" . get_template_directory_uri() ."/functions/css/section-slide.css' />";
		endif;

}

/*-----------------------------------------------------------------------------------*/
/*	
/*   Theme Functions
/*
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Get Post Slides
/*-----------------------------------------------------------------------------------*/

function ag_post_slideshow($image_size, $id, $thumbnum, $arrows_outside, $slidelink='false') {
	
	// Add one to the thumbnail number for the loop
	$thumbnum++; 
	// Set the slideshow variable	
	$slideshow = '';
	
	// Get The Post Type
	$posttype = get_post_type( $id );
	
	// Check whether the slide should link
	if ($slidelink == 'true') {
		$permalink = get_permalink($id);
		$title = get_the_title($id);
		$permalink = '<a href="'.$permalink.'" title="'.$title.'">';
		$permalinkend = '</a>';
	} else {
		$permalink = '';
		$permalinkend = '';
	}
	
	$counter = 2; //start counter at 2			  
	
	$full = get_post_meta($id,'_thumbnail_id',false); // Get Image ID 
	
	
	/* If there's a featured image
	================================================== */
	if($full) {
	  
		$caption = get_post($full[0])->post_excerpt; 
		
		$alt = get_post_meta($full, '_wp_attachment_image_alt', true); // Alt text of image
		$full = wp_get_attachment_image_src($full[0], 'full', false);  // URL of Featured Full Image
				  
		$thumb = get_post_meta($id,'_thumbnail_id',false); 
		$thumb = wp_get_attachment_image_src($thumb[0], $image_size, false);  // URL of Featured first slide
		
		
		// Get all slides
		while ($counter < ($thumbnum)) {
			
			${"full" . $counter} = MultiPostThumbnails::get_post_thumbnail_id($posttype, $counter . '-slide', $id); // Get Image ID
			// The thumbnail caption:
			${"caption" . $counter} = get_post(${"full" . $counter})->post_excerpt;
			${"alt" . $counter} = get_post_meta(${"full" . $counter} , '_wp_attachment_image_alt', true); // Alt text of image			 
			${"full" . $counter} = wp_get_attachment_image_src(${"full" . $counter}, false); // URL of Second Slide Full Image
			
			${"thumb" . $counter} = MultiPostThumbnails::get_post_thumbnail_id($posttype, $counter . '-slide', $id); 
			${"thumb" . $counter} = wp_get_attachment_image_src(${"thumb" . $counter}, $image_size, false); // URL of next Slide 
		 
		$counter++;
		
		}
			
		// If there's a thumbnail set
			$slideshow .= '<div class="featured-image ';
			
			$slideshow .= (isset($thumb2[0]) && $thumb2[0] != '' && $arrows_outside == true) ? ' outsidearrows' : '';
			
			$slideshow .=  '">';
		
		// If there's a slide 2
		$slideshow .= (isset($thumb2[0]) && $thumb2[0] != '') ? '<ul class="bxslider"><li>' : '';
		
		// If there's a slide 2 and outside arrows are set to true
		$slideshow .= $permalink . '<img src="' . $thumb[0] .'" alt="';
		// If there's an image alt info, set it
		$slideshow .= ($alt) ? str_replace('"', "", $alt) : get_the_title();
		$slideshow .= '"';
		// If there's a caption, add it.
		$slideshow .= ($caption && $caption != '') ? ' title="' . strip_tags (apply_filters('the_content', $caption)) .'"' : ''; 
		
		$slideshow .= ' class="scale-with-grid"/>' .$permalinkend;
		
		$slideshow .= (isset($thumb2[0]) && $thumb2[0] != '') ? '</li>' : '';
		
		// Loop through thumbnails and set them
		if (isset($thumb2[0]) && $thumb2[0] != '') {	
			$tcounter = 2;
			while ($tcounter < ($thumbnum)) :
				if ( ${'thumb' . $tcounter}) : 
				   $slideshow .= '<li>' . $permalink . '<img src="' . ${'thumb' . $tcounter}[0] .'" alt="';
				   $slideshow .= (${'alt' . $tcounter}) ? str_replace('"', "", ${'alt' . $tcounter}) : get_the_title();
				   $slideshow .= '" ';
				   if (${'caption' . $tcounter} &&  ${'caption' . $tcounter} != '') { $slideshow .= ' title="' . strip_tags (apply_filters('the_content', ${'caption' . $tcounter}))  .'"'; }
				   $slideshow .= ' class="scale-with-grid" data-thumb="' . ${'thumb' . $tcounter}[0] . '"/>'. $permalinkend . '</li>';
				endif; $tcounter++;
			endwhile; 
		}
		
		// Add caption if there's no slideshow
		if (!(isset($thumb2[0]) && $thumb2[0] != '') && $caption) $slideshow .= '<div class="bx-caption"><span>' . strip_tags (apply_filters('the_content', $caption)) . '</span></div>';
		$slideshow .= (isset($thumb2[0]) && $thumb2[0] != '') ? '</ul>' : '';
		// Close slideshow divs
		$slideshow .= '</div>';
		
	} // End if $full
	  
	return $slideshow;

} 

/*-----------------------------------------------------------------------------------*/
/*	Display Post Video Function
/*-----------------------------------------------------------------------------------*/
function ag_post_video($postvideo) {
	
	  // Get Video URL that was entered
	  if ($postvideo != '') : $vendor = parse_url($postvideo); 
		  $video = '';
		  $video .= '<div class="featured-image"><div class="videocontainer">';
		
		 // If it's a legitimate url
		 if (isset($vendor['host'])) {	
			 if ($vendor['host'] == 'www.youtube.com' || $vendor['host'] == 'youtu.be' || $vendor['host'] == 'www.youtu.be' || $vendor['host'] == 'youtube.com'){ // If from Youtube.com 
				 if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $postvideo, PHP_URL_QUERY ), $my_array_of_vars );
					$video .= '<iframe width="620" height="350" src="http://www.youtube.com/embed/' . $my_array_of_vars['v']. '?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;wmode=transparent;" frameborder="0" allowfullscreen></iframe>';
				 } else { 
					$video .= '<iframe width="620" height="350" src="http://www.youtube.com/embed' . parse_url($postvideo, PHP_URL_PATH) . '?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;wmode=transparent;" frameborder="0" allowfullscreen></iframe>';
				 } 
			 } else 
			if ($vendor['host'] == 'vimeo.com'){ // If from Vimeo.com 
				$video .= '<iframe src="http://player.vimeo.com/video' . parse_url($postvideo, PHP_URL_PATH) . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="620" height="350" frameborder="0"></iframe>';
			} else {
				$video .= do_shortcode($postvideo);	
			}
		
		 // Otherwise echo shortcode content	
		 } else {
			$video .= do_shortcode($postvideo);
		 }
			
			$video .= '</div></div>';
		endif;
return $video;
}

/*-----------------------------------------------------------------------------------*/
/*	Display Slide Video Function
/*-----------------------------------------------------------------------------------*/
function ag_slide_video($slidevideo) {
	  if ($slidevideo != '') : $vendor = parse_url($slidevideo); 
		  $video = '';
		  $video .= '<div class="videocontainer">';
			
			 if ($vendor['host'] == 'www.youtube.com' || $vendor['host'] == 'youtu.be' || $vendor['host'] == 'www.youtu.be' || $vendor['host'] == 'youtube.com'){ // If from Youtube.com 
				 if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $slidevideo, PHP_URL_QUERY ), $my_array_of_vars );
					$video .= '<iframe width="620" height="350" src="http://www.youtube.com/embed/' . $my_array_of_vars['v']. '?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;wmode=transparent;" frameborder="0" allowfullscreen></iframe>';
				 } else { 
					$video .= '<iframe width="620" height="350" src="http://www.youtube.com/embed' . parse_url($slidevideo, PHP_URL_PATH) . '?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;wmode=transparent;" frameborder="0" allowfullscreen></iframe>';
				 } 
			 }
		
			if ($vendor['host'] == 'vimeo.com'){ // If from Vimeo.com 
				$video .= '<iframe src="http://player.vimeo.com/video' . parse_url($slidevideo, PHP_URL_PATH) . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="620" height="350" frameborder="0"></iframe>';
			} 
			
			$video .= '</div>';
		endif;
return $video;
}

/*-----------------------------------------------------------------------------------*/
/* WP Customizer
/*-----------------------------------------------------------------------------------*/

add_action('customize_register', 'ag_color_customizer');
function ag_color_customizer($wp_customize)
{
  $colors = array();
  
  $colors[] = array( 
  	'slug'=>'highlight_color', 
	'default' => '#00a498',
  	'label' => __( 'Theme Highlight Color', 'framework' ),
	'priority' => 20 
	);
  
  $colors[] = array( 
  	'slug'=>'content_bg_color', 
	'default' => '#ffffff',
  	'label' => __( 'Site Background Color', 'framework' ),
	'priority' => 30 
	);
  
  $colors[] = array( 
  	'slug'=>'page_bg_color', 
	'default' => '#f3f3f3',
  	'label' => __( 'Page Background Color', 'framework' ),
	'priority' => 40 
	);
  
  $colors[] = array( 
  	'slug'=>'heading_color', 
  	'default' => '#222222',
  	'label' => __( 'Site Headings and Titles Color', 'framework' ),
    'priority' => 50 
	);
  
  $colors[] = array( 
  	'slug'=>'body_color', 
	'default' => '#555555',
  	'label' => __( 'General Site Text Color', 'framework' ),
	'priority' => 60 
	);
  
  $colors[] = array( 
  	'slug'=>'content_li_color', 
	'default' => '#555555',
  	'label' => __( 'Dropdown Navigation Color', 'framework' ),
	'priority' => 70 
	); 

  $colors[] = array( 
	'slug'=>'content_li_bg_color', 
	'default' => '#fff',
	'label' => __( 'Dropdown Navigation Background Color', 'framework' ),
	'priority' => 60 
	); 
  
  foreach($colors as $color)
  {

    // SETTINGS
    $wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'],
    'type' => 'option', 'capability' => 'edit_theme_options' ));

    // CONTROLS
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
     $color['slug'], array( 'label' => $color['label'], 'section' => 'colors',
     'settings' => $color['slug'] )));
  }
  

}

function ag_background_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'ag_background', array(
        'title' => 'Background Image', // The title of section
        'description' => 'Background Image For Your Site', // The description of section
    ) );
 
  // ADD BACKGROUND IMAGE UPLOAD
  $wp_customize->add_setting( 'uploaded_image', array(
    'type' => 'option',
  ) );
  
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
  	'uploaded_image', array( 'label'   => 'Background Image', 'section' => 'ag_background',
  )));
  
  // Remove the Title Tagline Section
  $wp_customize->remove_section( 'title_tagline'); 
}
add_action( 'customize_register', 'ag_background_theme_customizer', 11 );



function ag_customize_css()
{
    ?>
<style type="text/css">

body { 
	background-color: <?php echo ($content_bg_color = get_option('content_bg_color')) ? $content_bg_color : '#ffffff';?>; 
	background-image: <?php echo ($content_bg_image = get_option('uploaded_image')) ? 'url('.$content_bg_image.')' : 'none';?>;
}


h1, h1 a,
h2, h2 a,
h3, h3 a,
h4, h4 a,
h5, h5 a,
h6, h6 a,
.widget h1 a,
.widget h2 a,
.widget h3 a,
.widget h4 a,
.widget h5 a,
.widget h6 a,
.tabswrap .tabpost a,
.more-posts a,
ul li a.rsswidget { 
	color: <?php echo ($heading_color = get_option('heading_color')) ? $heading_color : '#222222';?>; 
} 

.sf-menu li li li li a, 
.sf-menu li li li a, 
.sf-menu li li a, 
.sf-menu li li a:visited,
.sf-menu li li li a:visited, 
.sf-menu li li li li a:visited,
.sf-menu a, .sf-menu a:visited  {
	color:<?php echo ($content_li_color = get_option('content_li_color')) ? $content_li_color : '#555555';?>; 
} 
.sf-menu ul.sub-menu,
.sf-menu li li li li a, 
.sf-menu li li li a, 
.sf-menu li li a, 
.sf-menu li li li li a:visited, 
.sf-menu li li li a:visited, 
.sf-menu li li a:visited {
	background: <?php echo ($content_li_bg_color = get_option('content_li_bg_color')) ? $content_li_bg_color : '#ffffff';?>; 
} 

.avatar-info .comment-counter,
.categories a:hover, .tagcloud a, .widget .tagcloud a, .single .categories a, .single .sidebar .categories a:hover, 
.tabswrap ul.tabs li a.active, .tabswrap ul.tabs li a:hover, #footer .tabswrap ul.tabs li a:hover, #footer .tabswrap ul.tabs li a.active, 
.pagination a.button.share:hover, #commentsubmit #submit, #cancel-comment-reply-link, ul.filter li a.active, .categories a, .widget .categories a,
ul.filter li a:hover, .button, a.button, .widget a.button, a.more-link, .widget a.more-link, #footer .button, #footer a.button, #footer a.more-link, .cancel-reply p a,
#footer .button:hover, #footer a.button:hover, #footer a.more-link:hover, .ag-pricing-table .featured .ag-pricing-header  { 
	background-color: <?php echo ($highlight_color = get_option('highlight_color')) ? $highlight_color : '#00a498';?>;  
	color:#fff; 
}

p a, a, blockquote, blockquote p, .pagetitle h2, .tabswrap .tabpost a:hover, .articleinner h2 a:hover, span.date a:hover, .highlight, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, .post h2.title a:hover, #wp-calendar tbody td a,
.author p a:hover, .date p a:hover, .widget a:hover, .widget.ag_twitter_widget span a, #footer h1 a:hover, #footer h2 a:hover, #footer h3 a:hover, #footer h3 a:hover, #footer h4 a:hover, #footer h5 a:hover, a:hover, #footer a:hover, .blogpost h2 a:hover, .blogpost .smalldetails a:hover {
	 color: <?php echo ($highlight_color = get_option('highlight_color')) ? $highlight_color : '#00a498';?>;
}

.recent-project:hover,
#footer .recent-project:hover {
	border-color: <?php echo ($highlight_color = get_option('highlight_color')) ? $highlight_color : '#00a498';?>;
}
.pagecontent {
	background-color: <?php echo ($page_bg_color = get_option('page_bg_color')) ? $page_bg_color : '#f3f3f3'; ?>;	
}

<?php 
// If Page Content is White, make some corrections
if (get_option('page_bg_color') == '#fff' || get_option('page_bg_color') == '#ffffff') { ?>
.singlecomment {
	background:#f3f3f3;
	background: rgba(0,0,0,0.05);	
}
.#wp-calendar tbody td {
	background: #f3f3f3;
	border: 1px solid #ffffff;
}

<?php } ?>

body, p, ul, ol, ul.filter li a, .author p a, .date p a, .widget a, .widget_nav_menu a:hover, .widget_recent_entries a:hover,
.sf-menu a, .sf-menu a:visited {
	color: <?php echo ($body_color = get_option('body_color')) ? $body_color : '#555555'; ?>
} 

<?php
// Custom CSS Box
//==========================
echo ($customcss = of_get_option('of_custom_css')) ? "/* Custom CSS */ \n" . $customcss : ''; ?>

</style>
    <?php
}
add_action( 'wp_head', 'ag_customize_css');

/*-----------------------------------------------------------------------------------*/
/* Convert Hex to RGBA Function
/*-----------------------------------------------------------------------------------*/

function ag_hex2rgba($hex, $opacity) {
	$ohex = $hex;
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   
   $output = 'style="background:'.$ohex .'; background: rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$opacity.'); box-shadow: 20px 0 0 rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$opacity.'), -20px 0 0 rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$opacity.'); "';
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $output; // returns an array with the rgb values
}

/*-----------------------------------------------------------------------------------*/
/* Add HTTP to links function
/*-----------------------------------------------------------------------------------*/

function ag_addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

/*-----------------------------------------------------------------------------------*/
/* Get a Specific Amount of Categories
/*-----------------------------------------------------------------------------------*/

function ag_get_cats($num){
	
    $t=get_the_category();
    $count=count($t); 
	
	if ($count < $num) $num = $count;
	
	$cat_string = '';
    for($i=0; $i<$num; $i++){
        $cat_string.= '<a href="'.get_category_link( $t[$i]->cat_ID  ).'">'.$t[$i]->cat_name.'</a>';
    }
	
	$cat_string .= '<div class="clear"></div>';
	
	if ($cat_string) return $cat_string;
}

/*-----------------------------------------------------------------------------------*/
/* Load Google Fonts
/*-----------------------------------------------------------------------------------*/

function ag_load_fonts() {
	
$cyrillic = of_get_option('of_cyrillic_chars');

	// Initialize Variables
	$fonts = '';
	$font_faces = array();
	$cyrillic_chars = '';
	
	// Get All Font Options
	$option_fonts = array(
		of_get_option('of_nav_font'),
		of_get_option('of_heading_font'),
		of_get_option('of_page_subtitle_font'),
		of_get_option('of_secondary_font'),
		of_get_option('of_content_heading_font'),
		of_get_option('of_button_font'),
		of_get_option('of_tiny_font'),
		of_get_option('of_p_font')
		);

	foreach ($option_fonts as $option) {
		 // Make sure the font face isn't a non-google font.
		 if (!ag_is_default($option['face'])){
			// Store all font typefaces in an array
		 	array_push($font_faces, $option['face']); 
		 };
	}
	
  // Remove duplicate values
  $font_faces = array_unique($font_faces); 

  // Check for cyrillic character option
  if ($cyrillic == 'Yes') $cyrillic_chars = '::cyrillic,latin'; 
  
  $fonts .= "
    <!-- Embed Google Web Fonts Via API -->
    <script type='text/javascript'>
          WebFontConfig = {
            google: { families: [ ";
				// Store the font list.
				$fontlist = '';
				foreach ($font_faces as $font) {
					$fontlist .= ($font) ? "'" . $font . $cyrillic_chars . "', " : "'" . 'Source Sans Pro' . $cyrillic_chars . "', ";
				}
				// Trim the last comma and space for IE and store in fonts
				$fonts .= rtrim($fontlist, ', ');
    $fonts .=  " ] }   };
          (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
          })();
    </script>";
	
	return $fonts;
}

/*-----------------------------------------------------------------------------------*/
/* Add Theme Customizer Under Appearance
/*-----------------------------------------------------------------------------------*/

add_action('admin_menu', 'add_customizer_to_appearance');
function add_customizer_to_appearance() 
{
  add_submenu_page('themes.php', 'Customizer', 'Theme Customizer', 'edit_theme_options', 'customize.php', '', '', 6);
}

/*-----------------------------------------------------------------------------------*/
/* Get Popular Posts
/*-----------------------------------------------------------------------------------*/

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "<span>0</span> Views";
    }
    return '<span>'. $count.'</span> '. __('Views', 'framework');
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
/*-----------------------------------------------------------------------------------*/
/*    New category walker for portfolio filter
/*-----------------------------------------------------------------------------------*/

class Walker_Portfolio_Filter extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {

      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_slug = $category->slug;
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      $link = '<a href="#" data-filter=".'.strtolower(preg_replace('/\s+/', '-', $cat_slug)).'" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all projects filed under %s', 'framework'), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';
      $link .= strip_tags (apply_filters('the_content', $cat_name));
      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'framework'), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }
         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class="segment-2"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}
/*-----------------------------------------------------------------------------------*/
/* Remove Dimensions from Thumbnails (for responsivity) and Gallery
/*-----------------------------------------------------------------------------------*/

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_img_width_height($html) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter('wp_get_attachment_link', 'remove_img_width_height', 10, 1);

/*-----------------------------------------------------------------------------------*/
/* Remove More Link Jump
/*-----------------------------------------------------------------------------------*/

function ag_remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) { $end = strpos($link, '"',$offset); }
	if ($end) { $link = substr_replace($link, '', $offset, $end-$offset); }
	return $link;
}
add_filter('the_content_more_link', 'ag_remove_more_jump_link');

/*-----------------------------------------------------------------------------------*/
/* Get Attachment ID from the source
/*-----------------------------------------------------------------------------------*/

function get_attachment_id_from_src ($image_src) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	return $id;
}
	
/*-----------------------------------------------------------------------------------*/
/* Wrap All Read More Tags In A Span
/*-----------------------------------------------------------------------------------*/	
function wrap_readmore($more_link)
{
	return '<span class="more-link">'.$more_link.'</span>';
}
add_filter('the_content_more_link', 'wrap_readmore', 10, 1);

/*-----------------------------------------------------------------------------------*/
/* Check for a Default Font
/*-----------------------------------------------------------------------------------*/
function ag_is_default($font) {
  if ($font == 'Arial' || $font == 'Georgia' || $font == 'Tahoma' || $font == 'Verdana' || $font == 'Helvetica') {
    $font = true;
  } else {
	$font = false;  
  }
  return $font;
}

/*-----------------------------------------------------------------------------------*/
/* Function to Get Slide Options
/*-----------------------------------------------------------------------------------*/
function ag_get_slide_variables($id, $fixed) {
	// Get Slide Variables
	$ag_slide = array();
	
	// Slide Background Image
	$ag_slide['image_id'] = get_post_meta($id, 'ag_slide_background_image', true);
	
	if ($fixed == true) {
		$ag_slide['image'] = wp_get_attachment_image_src( $ag_slide['image_id'], 'homeslideshowfixed');
	} else {
		$ag_slide['image'] = wp_get_attachment_image_src( $ag_slide['image_id'], 'homeslideshow');
	}
	$ag_slide['image_src'] = $ag_slide['image'][0];
	
	// Slide Text
	$ag_slide['caption_show'] = get_post_meta($id, 'ag_slide_text_show', true);
	$ag_slide['caption_color'] = get_post_meta($id, 'ag_slide_text_color', true);
	$ag_slide['caption_bg_color'] = get_post_meta($id, 'ag_slide_text_bg_color', true);
	
	
	// Slide Button
	$ag_slide['button_show'] = get_post_meta($id, 'ag_slide_button_show', true);
	$ag_slide['button_color'] = get_post_meta($id, 'ag_slide_button_color', true);
	$ag_slide['button_text_color'] = get_post_meta($id, 'ag_slide_button_text_color', true);
	$ag_slide['button_text'] = get_post_meta($id, 'ag_slide_button_text', true);
	$ag_slide['button_link'] = get_post_meta($id, 'ag_slide_button_link', true); 
	
	// Slide Transition
	$ag_slide['transition'] = get_post_meta($id, 'ag_slide_transition', true);
	
	// Set Button Style
	$ag_slide['button_style'] = 'style="';
	$ag_slide['button_style'] .= ($ag_slide['button_color']) ? 'background-color: ' . $ag_slide['button_color'] . ';  ' : '';
	$ag_slide['button_style'] .= ($ag_slide['button_text_color']) ? 'color: ' . $ag_slide['button_text_color'] . ';  ' : '';
	$ag_slide['button_style'] .= '"';
	
	// Slide Link
	$ag_slide['slide_link'] = get_post_meta($id, 'ag_slide_link', true);
	
	// Video URL
	$ag_slide['video'] = get_post_meta($id, 'ag_slide_video', true);
	
	// Slider Height
	if (!($ag_slide['caption_height'] = (of_get_option('of_home_slider_height'))/2)) $ag_slide['caption_height'] = '275';
	
	return $ag_slide;
}

/*-----------------------------------------------------------------------------------*/
/* Function to Get Section Options
/*-----------------------------------------------------------------------------------*/
function ag_get_section_variables($id) {
	
		$sq = "'";
		$ag_section = array();
		
		// Get Section Options
		$ag_section['section_layout'] = get_post_meta($id, 'ag_section_layout', true);
		$ag_section['background_color'] = get_post_meta($id, 'ag_background_color', true);
		$ag_section['background_image'] = get_post_meta($id, 'ag_background_image', true); $ag_section['background_image'] = wp_get_attachment_image_src( $ag_section['background_image'], 'full');
		$ag_section['section_text'] = get_post_meta($id, 'ag_text_color', true);
		$ag_section['section_button_show'] = get_post_meta($id, 'ag_section_button_show', true); 
		$ag_section['background_repeat'] = get_post_meta($id, 'ag_background_repeat', true);
		
		// Create Background Style
		$ag_section['backgroundstyle'] = 'style="';
		$ag_section['backgroundstyle'] .= ($ag_section['background_color']) ? 'background-color: ' . $ag_section['background_color'] . ';  ' : '';
		$ag_section['backgroundstyle'] .= ($ag_section['background_image']) ? 'background-image: url(' . $ag_section['background_image'][0] . ');  background-position:center;' : '';
		$ag_section['backgroundstyle'] .= '"';
		
		//Get Button Options
		if ($ag_section['section_button_show'] == 'Yes') {
			$ag_section['section_button_color'] = get_post_meta($id, 'ag_section_button_color', true);
				$ag_section['section_button_color'] = ($ag_section['section_button_color']) ? 'background:' . $ag_section['section_button_color'] .';' : '';
			$ag_section['section_button_text'] = get_post_meta($id, 'ag_section_button_text', true);
			$ag_section['section_text_color'] = get_post_meta($id, 'ag_section_text_color', true);
			$ag_section['section_button_link'] = get_post_meta($id, 'ag_section_button_link', true);
			
			$ag_section['section_button'] = '<a href="' . $ag_section['section_button_link'] . '" class="button" style="' . $ag_section['section_button_color'] .' color: ' . $ag_section['section_text_color'] . ';">' . $ag_section['section_button_text'] . '</a>';
		} else {
			$ag_section['section_button'] = '';	
		}
		
		
		$ag_section['sectionvideo'] = get_post_meta($id, 'ag_section_video', true);
		
		$ag_section['sectionpadding'] = get_post_meta($id, 'ag_bottom_padding', true);
		
		$ag_section['background_repeat'] = get_post_meta($id, 'ag_background_repeat', true);
		
		
		return $ag_section;
	
}

/*-----------------------------------------------------------------------------------*/
/* Function to Get Page Options
/*-----------------------------------------------------------------------------------*/

function ag_get_page_variables($pageID) {
	
	$ag_page = array();
	
	$ag_page['button_show'] =  get_post_meta($pageID, 'ag_page_button_show', true);
	$ag_page['button_text'] = get_post_meta($pageID, 'ag_page_button_text', true);
	
	// Get Page Description
	$ag_page['page_desc'] = get_post_meta($pageID, 'ag_page_desc', true);
	$ag_page['page_desc_color'] = get_post_meta($pageID, 'ag_page_desc_color', true);
	
	//Get Button Options
	if ($ag_page['button_show'] == 'Yes' && $ag_page['button_text'] != '') {
		$ag_page['button_color'] = get_post_meta($pageID, 'ag_page_button_color', true);
		$ag_page['button_text_color'] = get_post_meta($pageID, 'ag_page_button_text_color', true);
		$ag_page['button_link'] = get_post_meta($pageID, 'ag_page_button_link', true);
		
		$ag_page['button'] = '<a href="' . $ag_page['button_link'] . '" class="button huge alignright" style="';
		$ag_page['button'] .= ($ag_page['button_color']) ? 'background:' . $ag_page['button_color'] .'; ' : '';
		$ag_page['button'] .= ($ag_page['button_text_color']) ? 'color: ' . $ag_page['button_text_color'] .'; ' : '';
		$ag_page['button'] .= '">' . strip_tags (apply_filters('the_content', $ag_page['button_text'])) . '</a>';
	} else {
		$ag_page['button'] = '';	
	}
	
	// Get Page Content Color
	$ag_page['page_title_bg_color'] = get_post_meta($pageID, 'ag_page_title_bg_color', true); 
	$ag_page['page_title_color'] = get_post_meta($pageID, 'ag_page_title_color', true);
	$ag_page['page_content_color'] = get_post_meta($pageID, 'ag_page_content_bg_color', true);
	$ag_page['thumb'] = wp_get_attachment_image_src( get_post_thumbnail_id($pageID), 'homeslideshow' );
	$ag_page['thumburl'] = $ag_page['thumb']['0'];
	
	// Create Background Style
	if ($ag_page['thumburl'] || $ag_page['page_title_bg_color']){
	$ag_page['background_style'] = 'style="';
	$ag_page['background_style'] .= ($ag_page['page_title_bg_color']) ? 'background-color: ' . $ag_page['page_title_bg_color'] . '; padding-top:35px;' : '';
	$ag_page['background_style'] .= ($ag_page['thumburl']) ? 'background-image: url(' . $ag_page['thumburl'] . ');  background-position:center; padding-top:35px;' : '';
	$ag_page['background_style'] .= '"';
	} else {
		$ag_page['background_style'] = '';	
	}
	
	return $ag_page;

}

/*-----------------------------------------------------------------------------------*/
/* Function to Get Portfolio Options
/*-----------------------------------------------------------------------------------*/

function ag_get_portfolio_variables($pageID, $portfolio_page_id) {
	
	// Set Up Array
	$ag_portfolio = array();
	
	// Get Page Description
	$ag_portfolio['portfolio_desc'] = get_post_meta($pageID, 'ag_portfolio_desc', true);
	$ag_portfolio['portfolio_desc_color'] =  get_post_meta($portfolio_page_id, 'ag_page_desc_color', true);
	
	// Get Page Content Color
	$ag_portfolio['page_title_bg_color'] = get_post_meta($portfolio_page_id, 'ag_page_title_bg_color', true); 
	$ag_portfolio['page_title_color'] = get_post_meta($portfolio_page_id, 'ag_page_title_color', true);
	$ag_portfolio['page_content_color'] = get_post_meta($portfolio_page_id, 'ag_page_content_bg_color', true);
	$ag_portfolio['thumb'] = wp_get_attachment_image_src( get_post_thumbnail_id($portfolio_page_id), 'homeslideshow' );
	$ag_portfolio['thumburl'] = $ag_portfolio['thumb']['0'];
	
	// Create Background Style
	if ($ag_portfolio['thumburl'] || $ag_portfolio['page_title_bg_color']){
	$ag_portfolio['background_style'] = 'style="';
	$ag_portfolio['background_style'] .= ($ag_portfolio['page_title_bg_color']) ? 'background-color: ' . $ag_portfolio['page_title_bg_color'] . '; padding-top:35px;' : '';
	$ag_portfolio['background_style'] .= ($ag_portfolio['thumburl']) ? 'background-image: url(' . $ag_portfolio['thumburl'] . ');  background-position:center; padding-top:35px;' : '';
	$ag_portfolio['background_style'] .= '"';
	} else {
		$ag_portfolio['background_style'] = '';	
	}
	
	// Get Portfolio Page Button Options
	$ag_portfolio['button_color'] = get_post_meta($portfolio_page_id, 'ag_page_button_color', true);
	$ag_portfolio['button_text_color'] = get_post_meta($portfolio_page_id, 'ag_page_button_text_color', true);
	
	// Get Page Content Color
	$ag_portfolio['portfolio_content_color'] = get_post_meta($portfolio_page_id, 'ag_page_content_bg_color', true);
	$ag_portfolio['video'] = get_post_meta($pageID, 'ag_portfolio_video', true);
	$ag_portfolio['content_title'] = get_post_meta($pageID, 'ag_portfolio_content_title', true);
	
	$ag_portfolio['project_button'] = (of_get_option('of_project_button')) ? of_get_option('of_project_button') : 'on';
	$ag_portfolio['project_button_text'] = (of_get_option('of_project_button_text')) ? of_get_option('of_project_button_text') : 'Back To Projects';
	
	$ag_portfolio['thumbsize'] = (of_get_option('of_portfolio_crop') == 'crop') ? 'portfolio-single' : 'portfolio-single-nc';
	$ag_portfolio['slide_number'] = (of_get_option('of_thumbnail_number')) ? of_get_option('of_thumbnail_number') : '6';
	
	return $ag_portfolio;
	
}
?>