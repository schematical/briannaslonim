<?php
/*
Template Name: Contact Page
*/
?>
<?php

/* Contact Form Processing
================================================== */
$name_error = '';
$email_error = '';
$subject_error = '';
$message_error = '';

if (!isset($_REQUEST['c_submitted'])) {
	//If not isset -> set with dumy value 
	$_REQUEST['c_submitted'] = ""; 
	$_REQUEST['c_name'] = "";
	$_REQUEST['c_email'] = "";
	$_REQUEST['c_message'] = "";
}

if($_REQUEST['c_submitted']){

	//check name
	if(trim($_REQUEST['c_name'] == "")){
		//it's empty
		
		$name_error = __('You forgot to fill in your name', 'framework');
		$error = true;
	}else{
		//its ok
		$c_name = trim($_REQUEST['c_name']);
	}

	//check email
	if(trim($_REQUEST['c_email'] === "")){
		//it's empty
		$email_error = __('Your forgot to fill in your email address', 'framework');
		$error = true;
	}else if(!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_REQUEST['c_email']))){
		//it's wrong format
		$email_error = __('Wrong email format', 'framework');
		$error = true;
	}else{
		//it's ok
		$c_email = trim($_REQUEST['c_email']);
	}


	//check name
	if(trim($_REQUEST['c_message'] === "")){
		//it's empty
		$message_error = __('You forgot to fill in your message', 'framework');
		$error = true;
	}else{
		//it's ok
		$c_message = trim($_REQUEST['c_message']);
	}

	//if no errors occured
	if($error != true) {

		$email_to = of_get_option('of_mail_address');
		if (!isset($email_to) || ($email_to == '') ){
			$email_to = get_option('admin_email');
		}
		$c_subject = __('Contact from your site', 'framework');
		$message_body = "Name: $c_name \n\nEmail: $c_email \n\nComments: $c_message";
		$headers = 'From: '.get_bloginfo('name').' <'.$c_email.'>';

		wp_mail($email_to, $c_subject, $message_body, $headers);

		$email_sent = true;
	}

}

/* Begin Page Content
================================================== */
get_header(); 

$pageID = get_the_ID();

/* Get Page Options Defined in functions.php
================================================== */
$ag_page = ag_get_page_variables($pageID); ?>

<!-- Page Title -->
<div class="pagetitle" <?php echo ($ag_page['background_style']) ? $ag_page['background_style'] : '';?>>
    <div class="container verticalcenter">
        <div class="container_row">
        	<div class="verticalcenter cell">
                <div class="ten columns title">
                   <h1 <?php echo ($ag_page['page_title_color']) ? 'style="color: ' . $ag_page['page_title_color'] . ';"' : '' ?>><?php the_title(); ?></h1>
                    <?php if ($ag_page['page_desc']) { ?> 
                        <h2 <?php echo ($ag_page['page_desc_color']) ? 'class="colored" style="color: ' . $ag_page['page_desc_color'] . ';"' : '' ?>><?php echo strip_tags ( apply_filters('the_content', $ag_page['page_desc'])); ?></h2>
                    <?php } ?>		
                </div>
            </div>
            <div class="verticalcenter cell">
            	<div class="six columns">
				   <?php echo $ag_page['button']; ?>
           		</div>
            </div>
            <div class="clear"></div>
        </div>
      </div>
</div>
<!-- END Page Title -->

<div class="clear"></div>

<?php
// Get Any Sections
//========================================
echo get_template_part('functions/templates/sections'); ?>

<?php 
/* Loop Through The Content
================================================== */
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!-- Page Content AREA -->
<div class="pagecontent" <?php echo ($ag_page['page_content_color']) ? 'style="background:' . $ag_page['page_content_color'] . ';"' : '' ?>>
    <div class="container">
        <div class="eleven columns">
        
            <?php if(isset($email_sent) && $email_sent == true){ // If email was submitted ?>
            
                <div class="emailsuccess">
                    <h4><?php if ($sentheading = of_get_option('of_sent_heading')) { echo $sentheading; } ?></h4>
                    <p><?php if ($sentdescription = of_get_option('of_sent_description')) { echo $sentdescription; } ?></p>
                </div>
        
        	<?php } else { the_content(); } // If email isn't send, display post content ?>
        
            <!-- Contact Form -->
            <div class="contactcontent">
                <div id="contact-form">
                    <form action="<?php the_permalink(); ?>" id="contactform" method="post" class="contactsubmit">
                        <div class="formrow">
                            <div class="one_half">
                                <label for="c_name">
                                    <?php _e('Name', 'framework'); ?>
                                </label>
                                <input type="text" name="c_name" id="c_name" size="22" tabindex="1" class="required" />
                                <?php if($name_error != '') { ?>
                                <p><?php echo $name_error;?></p>
                                <?php } ?>
                            </div>
                            <div class="one_half column-last">
                                <label for="c_email">
                                    <?php _e('Email', 'framework');?>
                                </label>
                                <input type="text" name="c_email" id="c_email" size="22" tabindex="1" class="required email" />
                                <?php if($email_error != '') { ?>
                                <p><?php echo $email_error;?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="messagerow">
                            <label for="c_message">
                                <?php _e('Message', 'framework'); ?>
                            </label>
                            <textarea name="c_message" id="c_message" cols="100%" rows="8" tabindex="3" class="required"></textarea>
                            <?php if($message_error != '') { ?>
                            <p><?php echo $message_error;?></p>
                            <?php } ?>
                        </div>
                        <p>
                            <label for="c_submit"></label>
                            <input type="submit" name="c_submit" id="c_submit" class="button dark" value="<?php _e('Send Message', 'framework'); ?>"/>
                        </p>
                        <input type="hidden" name="c_submitted" id="c_submitted" value="true" />
                    </form>
                    </div>
                <div class="clear"></div>
            </div>
            <!-- END Contact Form -->  
               
            <div class="clear"></div>
        
        </div>
        <!-- END Eleven Columns -->
        
        <!-- Sidebar -->
        <div class="four columns offset-by-one">
            <div class="sidebar">
				<?php  /* Widget Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Contact Sidebar') ) ?>
            </div>
        </div>
        <!-- END Sidebar -->
        
    </div>
    <!-- END Container -->
</div>
<!-- END Page Content Area -->

<?php endwhile; endif; ?>

<?php 
/* Get Footer
================================================== */
get_footer(); ?>