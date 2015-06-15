<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package EnlightenedLabs Bootstrap WP
 * @since EnlightenedLabs Bootstrap WP 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php if ( comments_open() ) : ?>
<hr />

<div id="comments" class="comments-area">
	
	<?php if ( have_comments() ) : ?>

	<h3 class="comments-title">
		<?php
			printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'enlightenedlabsbootstrapwp' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-above">
      <ul class="pager">
        <h1 class="sr-only"><?php _e( 'Comment navigation', 'enlightenedlabsbootstrapwp' ); ?></h1>
        <li><?php previous_comments_link( __( '&larr; Older Comments', 'enlightenedlabsbootstrapwp' ) ); ?></li>
        <li><?php next_comments_link( __( 'Newer Comments &rarr;', 'enlightenedlabsbootstrapwp' ) ); ?></li>
      </ul>
    </nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ol class="comment-list">
		<?php wp_list_comments( array( 'callback' => 'enlightenedlabsbootstrapwp_comment', 'style' => 'ol' ) ); ?>
	</ol><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below">
      <ul class="pager">
        <h1 class="sr-only"><?php _e( 'Comment navigation', 'enlightenedlabsbootstrapwp' ); ?></h1>
        <li><?php previous_comments_link( __( '&larr; Older Comments', 'enlightenedlabsbootstrapwp' ) ); ?></li>
        <li><?php next_comments_link( __( 'Newer Comments &rarr;', 'enlightenedlabsbootstrapwp' ) ); ?></li>
      </ul>
    </nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'enlightenedlabsbootstrapwp' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
    $args = array(
	  'id_form'           => 'commentform',
	  'id_submit'         => 'submit',
	  'title_reply'       => __( 'Leave a Reply', 'enlightenedlabsbootstrapwp' ),
	  'title_reply_to'    => __( 'Leave a Reply to %s', 'enlightenedlabsbootstrapwp' ),
	  'cancel_reply_link' => __( 'Cancel Reply', 'enlightenedlabsbootstrapwp' ),
	  'label_submit'      => __( 'Post Comment', 'enlightenedlabsbootstrapwp' ),
	
	  'comment_field' =>  '<div class="form-group"><p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'enlightenedlabsbootstrapwp' ) .
		'</label><textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
		'</textarea></p></div>',
	
	  'must_log_in' => '<p class="must-log-in">' .
		sprintf(
		  __( 'You must be <a href="%s">logged in</a> to post a comment.', 'enlightenedlabsbootstrapwp' ),
		  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',
	
	  'logged_in_as' => '<p class="logged-in-as">' .
		sprintf(
		__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'enlightenedlabsbootstrapwp' ),
		  admin_url( 'profile.php' ),
		  $user_identity,
		  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		) . '</p>',
	
	  'comment_notes_before' => '<p class="comment-notes">' .
		__( 'Your email address will not be published.', 'enlightenedlabsbootstrapwp' ) .
		'</p>',
	
	  'comment_notes_after' => '<p class="form-allowed-tags">' .
		sprintf(
		  __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'enlightenedlabsbootstrapwp' ),
		  ' <code>' . allowed_tags() . '</code>'
		) . '</p>',
	
	  'fields' => apply_filters( 'comment_form_default_fields', array(
	
		'author' =>
		  '<div class="form-group"><p class="comment-form-author">' .
		  '<label for="author">' . __( 'Name', 'enlightenedlabsbootstrapwp' ) . '</label> ' .
		  ( $req ? '<span class="required">*</span>' : '' ) .
		  '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		  '" size="30" placeholder="Name" /></p></div>',
	
		'email' =>
		  '<div class="form-group"><p class="comment-form-email"><label for="email">' . __( 'Email', 'enlightenedlabsbootstrapwp' ) . '</label> ' .
		  ( $req ? '<span class="required">*</span>' : '' ) .
		  '<input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		  '" size="30" placeholder="Email" /></p></div>',
	
		'url' =>
		  '<div class="form-group"><p class="comment-form-url"><label for="url">' .
		  __( 'Website', 'enlightenedlabsbootstrapwp' ) . '</label>' .
		  '<input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		  '" size="30" placeholder="URL" /></p></div>'
		)
	  ),
	);
	//comment_form($args); ?>

</div><!-- #comments -->
<script type="text/javascript">
	  	gapi.comments.render("comments", { 
	  		href: window.location,
	  		width: '624',
	  		first_party_property: 'BLOGGER',
	  		view_type: 'FILTERED_POSTMOD'
	  	});
	  </script>
<?php endif; ?>
