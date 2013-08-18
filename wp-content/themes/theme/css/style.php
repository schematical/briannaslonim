/* CSS Document */
/***************Top Margin *******************/

.sitecontainer .container.top-nav {
	<?php echo ($toppadding = $data['of_logo_top_padding']) ? 'padding-top:' . $toppadding . 'px;' : 'padding-top:20px;'; ?>
    <?php echo ($bottompadding = $data['of_logo_bottom_padding']) ? 'padding-bottom:' . $bottompadding . 'px;' : 'padding-bottom:20px;'; ?>
}

/***************Typographic User Values *********************************/

/* Navigation Font */

.sf-menu a, .ajax-select ul.sf-menu li li a  {
<?php 
// Get nav option
if ($sffont = $data['of_nav_font']) { 
	echo 'font-family:"'.$sffont['face'].'", arial, sans-serif;'; 

	if ($sffont['style'] == 'bold italic') {
		echo 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
	} else if ($sffont['style'] == 'bold'){
		echo 'font-weight: bold;';
	} else {
		echo 'font-weight:'. $sffont['style']. ';';	
	}

	echo ($sffont['style2'] == 'Normal') ? 'text-transform:none;' : 'text-transform:uppercase;';

} ?>
font-size:13px;
}

/* Slider Caption, Page Title, and Section Title Font */

.pagetitle h1, .homecaption h2, .section h2, #logo h1 a, #logo h2 a {
<?php 
// Get heading font choices
if ( $headingfont = $data['of_heading_font'] ) { 

	echo 'font-family:"'.$headingfont['face'].'", arial, sans-serif;'; 

	if ($headingfont['style'] == 'bold italic') {
		echo 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
	} else if ($headingfont['style'] == 'bold'){
		echo 'font-weight: bold; letter-spacing:-.075em;';
	} else {
		echo 'font-weight:'. $headingfont['style']. ';';	
	}

	echo ($headingfont['style2'] == 'Normal' || $headingfont['style2'] == 'none') ? 'text-transform:none;' : 'text-transform:uppercase;';

}?>
}

/* Subtitle Font */
.pagetitle h2 {
<?php 
// Get heading font choices
if ( $subtitlefont = $data['of_page_subtitle_font'] ) { 

	echo 'font-family:"'.$subtitlefont['face'].'", arial, sans-serif;'; 

	if ($subtitlefont['style'] == 'bold italic') {
		echo 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
	} else if ($subtitlefont['style'] == 'bold'){
		echo 'font-weight: bold; letter-spacing:-.075em;';
	} else {
		echo 'font-weight:'. $subtitlefont['style']. ';';	
	}

	echo ($subtitlefont['style2'] == 'Normal' || $subtitlefont['style2'] == 'none' ) ? 'text-transform:none;' : 'text-transform:uppercase;';

}?>
}

/* Blog and Portfolio Item Font */
h2.title, h2.title a, .post .date h4.day {
<?php 
// Get subfont option
if ($secondaryfont = $data['of_secondary_font'] ) { 
	echo 'font-family:"'.$secondaryfont['face'].'", arial, sans-serif;'; 

	if ($secondaryfont['style'] == 'bold italic') {
		echo 'font-weight:bold !important; font-style:italic !important;'; // If Bold Italic, Do Separate CSS Calls
	} else if ($secondaryfont['style'] == 'bold'){
		echo 'font-weight: bold; letter-spacing:-.075em;';
	} else {
		echo 'font-weight:'. $secondaryfont['style']. ';';	
	}

	echo ($secondaryfont['style2'] == 'Normal' || $secondaryfont['style2'] == 'none') ? 'text-transform:none;' : 'text-transform:uppercase;';

}?>
}

/* Content Area Fonts */

h1, h1 a, 
h2, h2 a, 
h3, h3 a, 
h4, h4 a, 
h5, h5 a,
h6, h6 a,
.ag-pricing-cost {
<?php 
// Get subfont option
if ($contentfont = $data['of_content_heading_font'] ) { 
	echo 'font-family:"'.$contentfont['face'].'", arial, sans-serif;'; 

	if ($contentfont['style'] == 'bold italic') {
		echo 'font-weight:bold !important; font-style:italic !important;'; // If Bold Italic, Do Separate CSS Calls
	} else if ($contentfont['style'] == 'bold'){
		echo 'font-weight: bold; letter-spacing:-.075em;';
	} else {
		echo 'font-weight:'. $contentfont['style']. ';';	
	}

	($contentfont['style2'] == 'Normal' || $contentfont['style2'] == 'none') ? 'text-transform:none;' : 'text-transform:uppercase;';
}
?>
}

/* Button Fonts */

.button, a.button, a.more-link, #submit, input[type='submit'] {
<?php 
// Get subfont option
if ($buttonfont = $data['of_button_font'] ) { 
	echo 'font-family:"'.$buttonfont['face'].'", arial, sans-serif;'; 

	if ($buttonfont['style'] == 'bold italic') {
		echo 'font-weight:bold !important; font-style:italic !important;'; // If Bold Italic, Do Separate CSS Calls
	} else if ($buttonfont['style'] == 'bold'){
		echo 'font-weight: bold;';
	} else {
		echo 'font-weight:'. $buttonfont['style']. ';';	
	}

	echo ($buttonfont['style2'] == 'uppercase') ? 'text-transform:'. $buttonfont['style2']. '; letter-spacing:2px;' : 'text-transform:'. $buttonfont['style2']. ';';
}
?>
}

/* Tiny Details Font */

h5, h5 a, .widget h3, .widget h2, .widget h4, h4.widget-title, .ag-pricing-table .ag-pricing-header h5 {  
<?php 
// Get tiny font option
if ( $tinyfont = $data['of_tiny_font'] ) { 
	echo 'font-family:"'.$tinyfont['face'].'", arial, sans-serif;';  

	if ($tinyfont['style'] == 'bold italic') {
		echo 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
	} else if ($tinyfont['style'] == 'bold'){
		echo 'font-weight: bold;';
	} else {
		echo 'font-weight:'. $tinyfont['style']. ';';	
	}

	echo ($tinyfont['style2'] == 'Normal' || $tinyfont['style2'] == 'none') ? 'text-transform:none;' : 'text-transform:uppercase;';

}?>
}


/* Paragraph Font */

html, body, input, textarea, p, ul, ol, .button, .ui-tabs-vertical .ui-tabs-nav li a span.text,
.footer p, .footer ul, .footer ol, .footer.button, .credits p,
.credits ul, .credits ol, .credits.button, .footer textarea, .footer input, .testimonial p, 
.contactsubmit label, .contactsubmit input[type=text], .contactsubmit textarea, h2 span.date, .articleinner h1,
.articleinner h2, .articleinner h3, .articleinner h4, .articleinner h5, .articleinner h6, .nivo-caption h1,
.nivo-caption h2, .nivo-caption h3, .nivo-caption h4, .nivo-caption h5, .nivo-caption h6, .nivo-caption h1 a,
.nivo-caption h2 a, .nivo-caption h3 a, .nivo-caption h4 a, .nivo-caption h5 a, .nivo-caption h6 a,
#cancel-comment-reply-link {
<?php 
// Get paragraph option
if ($pfont = $data['of_p_font']) { 
	echo 'font-family:"'.$pfont['face'].'", arial, sans-serif;'; 

	if ($pfont['style'] == 'bold italic') {
		echo 'font-weight:bold; font-style:italic;'; // If Bold Italic, Do Separate CSS Calls
	} else if ($pfont['style'] == 'bold'){
		echo 'font-weight: bold;';
	} else {
		echo 'font-weight:'. $pfont['style']. ';';	
	}

	echo ($pfont['style2'] == 'Normal' || $pfont['style2'] == 'none') ? 'text-transform:none;' : 'text-transform:uppercase;';

} ?>
}
