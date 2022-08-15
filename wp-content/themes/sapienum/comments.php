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
if (post_password_required()) {
    return;
}
?>


	<?php
// You can start editing here -- including this comment!
if (have_comments()): ?>
		
			<?php
$comments_number = get_comments_number();
if ('1' === $comments_number) {
    /* translators: %s: post title */
    printf(_x('One Reply to &ldquo;%s&rdquo;', 'comments title', 'sapienum'), get_the_title());
}
?>
		<ol class="comment-list">

            <?php
            if($_GET['like']){
        $postid = $post->ID;
           $args1 =array(
            'post_id' => $post->ID,
            'order' => 'DESC', 
            'orderby' => 'meta_value_num',
            'meta_key' => 'cld_like_count',            
            'posts_per_page' => -1,
            
        );

    $comments = get_comments($args1);
        if ($comments) {
        foreach ($comments as $commentext) {
            $title = urlencode(get_the_title());
            $url = urlencode(get_the_permalink());
            $summary = urlencode($commentext->comment_content);
            $image = urlencode('');
            $authorUrl = get_author_posts_url($commentext->user_id, $commentext->$author_nicename);
            $like_count = get_comment_meta($commentext->comment_ID, 'cld_like_count', true);
            $comment_id = $commentext->comment_ID;

            ?>
                    <div class="commentBox">
                   <p><?php echo $commentext->comment_content; ?></p>

                    <div class="listDetail cld-like-wrap  cld-common-wrap">
                           <ul class="socialLike">
                            <li>
                             <a onClick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[summary]=<?php echo $summary; ?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="https://www.twitter.com/share?url=<?php echo $url; ?>" target="_blank" data-toggle="tooltip" ><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <?php if (is_user_logged_in()) {?>
                                        <li>
                                            <a href="javascript:void(0);" data-comment-id="<?php echo $commentext->comment_ID; ?>" class="cld-like-trigger cld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset($_COOKIE['cld_' . $comment_id])) ? 'cld-prevent' : ''; ?> " data-restriction="ip" data-trigger-type="like" data-user-ip="<?php echo $user_ip; ?>" data-ip-check="<?php echo $user_ip_check; ?>"><i class="fa fa-chevron-up"></i></a>
                                            <a href="javascript:void(0);" data-trigger-type="dislike" data-restriction="ip"  data-comment-id="<?php echo $commentext->comment_ID; ?>" class="cld-like-trigger cld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset($_COOKIE['cld_' . $comment_id])) ? 'cld-prevent' : ''; ?> "  data-user-ip="<?php echo $user_ip; ?>" data-ip-check="<?php echo $user_ip_check; ?>"><i class="fa fa-chevron-down"></i></a>

                                         <span class="cld-like-count-wrap cld-count-wrap"><?php echo (empty($like_count)) ? 0 : number_format($like_count); ?></span>
                                        </li>
                                    <?php }?>
                                    </ul>
                                    <ul class="dateTime">
                                        <li><?php echo $commentext->comment_date; ?></li>
                                        <li><a href="<?php echo $authorUrl; ?>"><?php echo $commentext->comment_author; ?></a></li>
                                        <li>
                                           <figure>
                                            <div class="dropdown">
                                              <button class="dropbtn"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dot.png"  alt="dot" ></button>
                                              <div class="dropdown-content">
                                              <?php if ($commentext->user_id == $current_user->ID): ?>
                                                <a href="<?php echo get_permalink(222); ?>?topicid=<?php echo $comment_id; ?>&id=<?php echo $postid; ?>">Correct</a>
                                               <?php endif?>
                                   <?php if ($commentext->user_id != $current_user->ID): ?>
                                    <a href="<?php echo get_permalink(217); ?>?complaintID=<?php echo $comment_id; ?>">Complaint</a>
                                    <?php endif?>
                                    <?php if ($commentext->user_id == $current_user->ID): ?>
                                    <a href="javascript:void(0)" onclick="return ConfirmDelete('<?php echo $comment_id; ?>');">Delete</a>
                                    <?php endif?>
                                  </div>
                                </div>
                                </figure>
                            </li>
                        </ul>
                    </div>
                    </div>
                    <?php }} }
                    else
                    {




    
    //print_r($args);


            wp_list_comments('type=comment&callback=mycustom_comment_pagination');
            }
            ?>
            
		</ol>

		<?php 
        if($_GET['like']==""){ 
        the_comments_pagination(array(
    'prev_text' => sapienum_get_svg(array('icon' => 'arrow-left')) . '<span class="screen-reader-text">' . __('Previous', 'sapienum') . '</span>',
    'next_text' => '<span class="screen-reader-text">' . __('Next', 'sapienum') . '</span>' . sapienum_get_svg(array('icon' => 'arrow-right')),
));
}
endif; // Check for have_comments().

// If comments are closed and there are comments, let's leave a little note, shall we?
if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>

		<p class="no-comments"><?php _e('Comments are closed.', 'sapienum');?></p>
	<?php
endif;

//comment_form();
?>

