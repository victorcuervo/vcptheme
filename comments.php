<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */


if ( post_password_required() ) {
	return;
}
?>


<div id="comments" class="comments-area">
	
	<?php if ( have_comments() ) : ?>

	<h3 class="comments-title">
		<?php
			printf( _n( 'Un comentario en &ldquo;%2$s&rdquo;', '%1$s comentarios en &ldquo;%2$s&rdquo;', get_comments_number(), 'twentyfourteen' ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'twentyfourteen' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentyfourteen' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyfourteen' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	
		<?php
			wp_list_comments( array(
				'walker'     => new origines_walker_comment,
				'short_ping' => true,
				'avatar_size'=> 48,
			) );
		?>
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'twentyfourteen' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentyfourteen' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentyfourteen' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Los comentarios están cerrados.', 'twentyfourteen' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
	
	comment_form( array(
		'title_reply'=>'¿Algo que nos quieras comentar?',
		'label_submit' => 'Enviar',
		 'fields' => apply_filters( 'comment_form_default_fields', array(

		    'author' =>
		      '<p class="comment-form-author">' .
		      '<label for="autor">' . __( 'Nombre', 'twentyfourteen' ) . '</label> ' .
		      ( $req ? '<span class="required">*</span>' : '' ) .
		      '<input id="autor" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		      '" size="30"' . $aria_req . ' /></p>',
		     'email' =>
		      '<p class="comment-form-email"><label for="correoelectronico">' . __( 'Email ', 'twentyfourteen' ) . '</label> ' .
		      ( $req ? '<span class="required">*</span>' : '' ) .
		      '<input id="correoelectronico" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		      '" size="30"' . $aria_req . ' /></p>',
		    'url' =>
		      '<p class="comment-form-url"><label for="url">' .
		      __( 'Sitio Web', 'twentyfourteen' ) . '</label>' .
		      '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		      '" size="30" /></p>'

		    )),

			'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comentario ', 'twentyfourteen' ) . '</label><textarea id="comment" class="form-control" name="comment" cols="70" rows="8" aria-required="true"></textarea></p>',
			'comment_notes_before' => '<p class="comment-notes">Déjanos tu comentario, no te preocupes que tu email no será publicado</p>',
			'comment_notes_after' => ''
		)); 
		
		?>

</div><!-- #comments -->