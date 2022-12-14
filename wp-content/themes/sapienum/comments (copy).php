<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage sapienum
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		

		<ol class="comment-list">
      <?php   $args = array(
    'post_id' => $post->ID,   // Use post_id, not post_ID
        'count'   => true // Return only the count
);
$comments_count = get_comments( $args );
echo $comments_count;
?>
			<?php wp_list_comments(); ?>
			
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => sapienum_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'sapienum' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'sapienum' ) . '</span>' . sapienum_get_svg( array( 'icon' => 'arrow-right' ) ),
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'sapienum' ); ?></p>
	<?php
	endif;
    
	?>
</div><!-- #comments -->
