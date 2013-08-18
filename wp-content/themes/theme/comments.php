<?php // Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename
($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
$ag_post['post_content_color'] = get_post_meta($post->ID, 'ag_post_content_bg_color', true);

if ( post_password_required() ) { ?>

<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'framework'); ?></p>
    <?php
		return;
	}
?>
    <!-- You can start editing here. -->
    <?php if ( have_comments() ) : ?>
   <div class="commentsheader" id="comments">
    <h4><?php _e('Comments', 'framework'); ?></h4>
    </div>
<ol class="listcomments <?php echo ($ag_post['post_content_color'] == '#fff' || $ag_post['post_content_color'] == '#ffffff') ? 'greybackground' : ''; ?>">
    <?php wp_list_comments('type=comment&callback=ag_comment'); ?>
</ol>
<div class="navigation-comments">
    <div class="alignleft">
        <p>
            <?php previous_comments_link() ?>
        </p>
    </div>
    <div class="alignright">
        <p>
            <?php next_comments_link() ?>
        </p>
    </div>
</div>
<div class="clear"></div>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<?php else : // comments are closed ?>
<?php endif; ?>
<?php endif; ?>
<?php
/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

if ( comments_open() ) : ?>
<!-- Submit Comment Form -->
<div class="commentsform">
<h4><?php _e('Submit a Comment', 'framework'); ?></h4>
    <?php

    $comments_args = array( 'fields' => apply_filters( 'comment_form_default_fields', 
                   array(
                        'author' => '<div>
                                         <label for="author">'. __('Name', 'framework') .( $req ? '<span class="required">*</span>' : '' ) . '</label>
                                         <input type="text" name="author"  id="author" value="'.$comment_author.'" size="22" tabindex="1" '. ( $req ? 'class="required"' : '' ).'/>
                                    </div>',
                        'email'  => '<div>
                                         <label for="email">'. __('Mail', 'framework') .( $req ? '<span class="required">*</span>' : '' ) . '</label>
                                         <input type="text" name="email"  id="email" value="'.$comment_author_email.'" size="22" tabindex="2" '. ( $req ? 'class="required email"' : '' ).'/>
                                    </div>',
                        'url'    => '<label for="url">'. __('Website', 'framework') .'</label>
                                    <input type="text" name="url" id="url" value="'. $comment_author_url .'" size="44" tabindex="3" />',
                        
                        )), 
                        'comment_field' => '<label for="comment">'.__('Message', 'framework').'<span>*</span></label>'.
                                            '<textarea name="comment" id="comment" cols="58" rows="8" tabindex="4" '. ( $req ? 'class="required"' : '' ).'></textarea>',
                    
                                    
                    'must_log_in' => '',
                    'logged_in_as' => '<p>'. __("Logged in as", "framework").' <a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>. <a href="'.get_option('siteurl').'/wp-login.php?action=logout" title="Log out of this account">'.__("Logout.", "framework").' &raquo;</a></p>',
                    'id_form' => 'commentsubmit',
                    'comment_notes_before' => '',
                    'comment_notes_after' => '',
                    'id_submit' => 'submit',
                    'title_reply'          => '',
                    'title_reply_to'       => '',
                    'cancel_reply_link'    => __( 'Cancel reply', 'framework' ),
                    'label_submit'         => __( 'Post Comment', 'framework' )
                    );
    comment_form($comments_args); ?>
</div>
<?php endif; // If registration required and not logged in ?>