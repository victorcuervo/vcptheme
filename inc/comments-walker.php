<?php
class origines_walker_comment extends Walker_Comment {
     
    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
    
    /** CONSTRUCTOR
     * You'll have to use this if you plan to get to the top of the comments list, as
     * start_lvl() only goes as high as 1 deep nested comments */
    function __construct() { ?>
         
        <div id="comment-list" class="media">
         
    <?php }
     
    /** START_LVL 
     * Starts the list before the CHILD elements are added. */
    function start_lvl( &$output, $depth = 0, $args = array() ) {       
        $GLOBALS['comment_depth'] = $depth + 1; ?>
      
    <?php }
 
    /** END_LVL 
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>
 
  
         
    <?php }
     
    /** START_EL */
    function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        $ocommentmail = get_comment_author_email(); ?>
        
    <div id="comment-<?php comment_ID() ?>" class="media well">
        
        <a class="pull-left" href="<?php comment_author_url(); ?>" target="_blank">
                        <?php echo origines_get_avatar( $ocommentmail, $args['avatar_size'] ); ?>
                </a>
                
                <div class="media-body">
                
                        <?php if ( $comment->comment_approved == '0' ) : ?>
                                <em class="comment-awaiting-moderation"><?php _e( 'Tu comentario está esperando a ser moderado.', 'origines' ); ?></em>
                                <br />
                        <?php endif; ?>
                        
                        <h4 class="comment-heading media-heading pull-left"><?php comment_author_link(); ?></h4>
                        
                        <div class="muted comment-meta commentmetadata pull-right">
                                <small><em><?php
                                /* translators: 1: date, 2: time */
                                printf( __( '%1$s - %2$s', 'origines' ), get_comment_date(),  get_comment_time() );
                                edit_comment_link( __( '(Edit)', 'origines' ), ' ' );
                                ?></em></small>
                        </div><!-- .comment-meta .commentmetadata -->
                        
                        <div class="clearfix"></div>
                
                        <div class="comment-body"><?php comment_text(); ?></div>
                        
                        <div class="reply">
                                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Responder', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ),$comment->comment_ID ); ?>
                        </div><!-- .reply -->
                         
    <?php }
 
    function end_el( &$output, $comment, $depth, $args, $id = 0 ) { ?>
        
                </div><!-- .media-body -->
                
        </div><!-- .media -->
         
    <?php }
    
    /** DESTRUCTOR
     * I'm just using this since we needed to use the constructor to reach the top 
     * of the comments list, just seems to balance out nicely:) */
    function __destruct() { ?>
     
    </div><!-- #comment-list -->
 
    <?php }
    
}

/* Formatear el texto de reply */ 
function origine_reply_link($link, $args, $comment, $post){
	return str_replace("class='comment-reply-link'", "class='comment-reply-link btn btn-mini'", $link);
}
add_filter('comment_reply_link', 'origine_reply_link', 420, 4);


function origines_get_avatar($email, $size) {
        $grav_url = "http://www.gravatar.com/avatar/" . 
        md5(strtolower($email)) . "?s=" . $size . "&d=mm";
        echo "<img src='$grav_url' alt='" . get_the_author() . "' class='img-circle' />";
}