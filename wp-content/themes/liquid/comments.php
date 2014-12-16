<?php if ( post_password_required() ) : ?>
<p class="prl-alert error nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'presslayer' ); ?></p>
<?php
	return;
endif;
?>
<?php // You can start editing here -- including this comment! ?>
<?php if ( have_comments() ) : ?>
<div id="comments" class="w-box w-box-padd tu-panel" >
    <h4><?php comments_number(__('0 Comments', 'presslayer'), __('1 Comment', 'presslayer'), __('% Comments', 'presslayer')); ?></h4>
    <ol class="prl-comment-list"><?php wp_list_comments( array( 'callback' => 'comment_list' ) );?></ol>
    <?php 
	/* Display Comment Navigation */
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <div id="comment_nav"> 
        <?php previous_comments_link( '&larr; '.__( 'Older Comments', 'presslayer' ) ); ?>
        <?php next_comments_link( __( 'Newer Comments', 'presslayer' ).' &rarr;' ); ?>
    </div>
	<?php endif; // check for comment navigation ?>
</div>
<?php endif; 
if ( comments_open() ) : 
?>
<div id="respond" class="w-box w-box-padd tu-panel">
<?php comment_form(array('comment_notes_after' => '')); ?>
</div>
<?php  endif;?>
