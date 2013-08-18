<?php
/**
 * District Theme Header
 * @package WordPress
 * @subpackage 2winFactor
 * @since 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<?php
/* Detect the Browser
================================================== */ 
global $browser;
$browser = $_SERVER['HTTP_USER_AGENT']; ?>

<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php 
/* Set The Favicon
================================================== */ 
echo ( $favicon = of_get_option('of_custom_favicon') ) ?  '<link rel="shortcut icon" href="'. $favicon.'"/>' : '' ?>

<title>
<?php 
/* Print the <title> tag based on what is being viewed
================================================== */ 
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ellipsis' ), max( $paged, $page ) );

	?>
</title>

<?php 
/* Load Google Fonts defined in functions.php
================================================== */ 
echo ag_load_fonts(); ?>

<!-- Theme Stylesheet
  ================================================== -->
<link href="<?php bloginfo( 'stylesheet_url' ); $ag_theme = wp_get_theme(); echo "?ver=" . $ag_theme->Version; ?>" rel="stylesheet" type="text/css" media="all" />

<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

<?php 
/* WordPress Header Data
================================================== */ 
wp_head(); ?>

</head>

<!-- Body
  ================================================== -->
<body <?php body_class(); ?>>

<noscript>
  <div class="alert">
    <p><?php _e('Please enable javascript to view this site.', 'framework'); ?></p>
  </div>
</noscript>

<!-- Preload Images 
	================================================== -->
<div id="preloaded-images"> 
  <?php $templatedirectory = get_template_directory_uri(); ?>
  <img src="<?php echo $templatedirectory;?>/images/arrows-555555.png" width="1" height="1" alt="Image" /> 
  <img src="<?php echo $templatedirectory;?>/images/bullet.png" width="1" height="1" alt="Image" /> 
  <img src="<?php echo $templatedirectory;?>/images/navarrows.png" width="1" height="1" alt="Image" /> 
  <img src="<?php echo $templatedirectory;?>/images/small-loading.gif" width="1" height="1" alt="Image" /> 
  <img src="<?php echo $templatedirectory;?>/images/sprites-nivo.png" width="1" height="1" alt="Image" /> 
  <img src="<?php echo $templatedirectory;?>/images/sprites-nivo-white.png" width="1" height="1" alt="Image" /> 
  <img src="<?php echo $templatedirectory;?>/images/downarrow.png" width="1" height="1" alt="Image" /> 
  <img src="<?php echo $templatedirectory;?>/images/rightarrow.png" width="1" height="1" alt="Image" /> 
  <img src="<?php echo $templatedirectory;?>/images/large_right.png" width="1" height="1" alt="Image" /> 
</div>

<!-- Begin Site
  ================================================== -->
<div class="sitecontainer">
<div class="container top-nav verticalcenter">
	<div class="container_row">
        <div class="cell verticalcenter">
        
        	<!-- Logo -->
            <div class="five columns" id="logo">
            <?php echo is_front_page() ? '<h1>' : '<h2>'; ?>
                <a href="<?php bloginfo('url'); ?>">
                    <?php if ( $logo = of_get_option('of_logo') ) { ?>
                    <img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
                    <?php } else { bloginfo( 'name' );} ?>
                    </a> 
             <?php echo is_front_page() ? '</h1>' : '</h2>'; ?> 
            </div>
            <!-- END Logo -->
            
        </div>
        <div class="cell verticalcenter">
        
        	<!-- Menu -->
            <div class="eleven columns" id="menu">
               <?php if ( has_nav_menu( 'main_nav_menu' ) ) { /* if menu location 'Main Navigation Menu' exists then use custom menu */ ?>
                   <?php wp_nav_menu( array('menu' => 'Main Navigation Menu', 'theme_location' => 'main_nav_menu', 'menu_class' => 'sf-menu')); ?>
                <?php } else { /* else use wp_list_pages */?>
                <ul class="sf-menu">
                    <?php wp_list_pages( array('title_li' => '','sort_column' => 'menu_order')); ?>
                </ul>
                <?php } ?> 
            </div>
            <!-- END Menu -->
            
        </div>
    </div>
    <div class="clear"></div>
    
    <!-- Mobile Navigation -->
    <div class="mobilenavcontainer"> 
        <?php $menutext = of_get_option('of_menu_text');
         if ($menutext == ''){ $menutext = __('Select a Page', 'framework'); } ?>
       <a id="jump" href="#mobilenav" class="scroll"><?php echo  $menutext; ?></a>
       <div class="clear"></div>
           <div class="mobilenavigation">
            <?php if ( has_nav_menu( 'main_nav_menu' ) ) { /* if menu location 'Top Navigation Menu' exists then use custom menu */ ?>
                    <?php wp_nav_menu( array('menu' => 'Main Navigation Menu', 'theme_location' => 'main_nav_menu', 'items_wrap' => '<ul id="mobilenav"><li id="back"><a href="#top" class="menutop">'. __('Hide Navigation', 'framework') . '</a></li>%3$s</ul>')); ?>
                <?php } else { /* else use wp_list_pages */?>
                    <ul class="sf-menu sf-vertical">
                        <?php wp_list_pages( array('title_li' => '','sort_column' => 'menu_order', )); ?>
                    </ul>
                <?php } ?>
            </div> 
        <div class="clear"></div>
      </div>
      <!-- END Mobile Navigation -->
</div>