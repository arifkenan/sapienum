<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage sapienum
 * @since 1.0
 * @version 1.0
 */

get_header();?>

 <?php
if (isset($_POST['submit']) && !empty($_POST)) {
    add_comment($post->ID, $_POST['comment']);

}?>
<section class="middleContent">
    <div class="container newcont">
        <div class="leftSidebar">
            <?php get_template_part('template-parts/sidebar/left-navigation-single-page');?>
        </div>
        <div class="rightSec">
            <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>
            <div class="middleSec">
                <input type="hidden" name="current_sapienum_post_id" id="current_sapienum_post_id" value="<?php echo $post->ID ?>">


                 <?php
/* Start the Loop */
while (have_posts()): the_post();

    get_template_part('template-parts/post/content', get_post_format());

    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()):

        comments_template();

    endif;

endwhile; // End of the loop.
?>


             <?php if (is_user_logged_in()) {
    echo "<h3>Leave a Comment</h3>";
    //echo 'You must be  <a href=' . site_url('login') . '>logged</a> in to post a comment.';
    echo '<div class="row post_box">';
    echo conmment_formdata();
    echo '</div>';
} else {
    echo "<h3>Leave a Comment</h3>";
    echo 'You must be  <a href=' . site_url('login') . '>logged</a> in to post a comment.';
}
?>


<div class="footer">

    <?php wp_nav_menu(array(
    'theme_location' => 'footer',
    'menu_id' => 'footer-menu',
));?>
    </div><!-- #colophon -->


</div>
    <?php get_sidebar();?>
</div>

<style>


</style>
<?php function conmment_formdata()
{?>
<form class="ewrapper" id="commentform" method="post" action="#">
  <div class="toolbar" style="display: none;">
    <a data-wysihtml-command="bold" title="CTRL+B">B</a> |
    <a data-wysihtml-command="createLink">link</a>
    <div style="float:right">
    <a data-wysihtml-command="foreColor" data-wysihtml-command-value="red" class="button_red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    <a data-wysihtml-command="foreColor" data-wysihtml-command-value="green" class="button_green">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    <a data-wysihtml-command="foreColor" data-wysihtml-command-value="yellow" class="button_yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    <a data-wysihtml-command="foreColor" data-wysihtml-command-value="wight" class="button_white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    </div>

    <div data-wysihtml-dialog="createLink" style="display: none;">
      <label>
        Link:
        <input data-wysihtml-dialog-field="href" value="http://">
      </label>
      <a data-wysihtml-dialog-action="save">OK</a>&nbsp;<a data-wysihtml-dialog-action="cancel">Cancel</a>
    </div>

    <div data-wysihtml-dialog="insertImage" style="display: none;">
      <label>
        Image:
        <input data-wysihtml-dialog-field="src" value="http://">
      </label>
      <label>
        Align:
        <select data-wysihtml-dialog-field="className">
          <option value="">default</option>
          <option value="wysiwyg-float-left">left</option>
          <option value="wysiwyg-float-right">right</option>
        </select>
      </label>
      <a data-wysihtml-dialog-action="save">OK</a>&nbsp;<a data-wysihtml-dialog-action="cancel">Cancel</a>
    </div>

  </div>
  <br>

  <textarea class="editable" id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required" placeholder="Type something...." required ></textarea>

  <br><input type="submit" name="submit" id="submit" class="comment_send" value="Send" onclick="submitcomment();"><span id="msg" style="color:red; display:none; margin-left:10px;">Entry must be at least one key press</span>
  <input type="hidden" name="action" value="new comments" />

</form>
 <?php }?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/comment-form/dist/wysihtml.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/comment-form/dist/wysihtml.all-commands.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/comment-form/dist/wysihtml.table_editing.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/comment-form/dist/wysihtml.toolbar.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/comment-form/parser_rules/advanced_unwrap.js"></script>

<script>
var editors = [];
 var syleurl = "<?php echo get_template_directory_uri(); ?>";
  $('.ewrapper').each(function(idx, wrapper) {
    var e = new wysihtml.Editor($(wrapper).find('.editable').get(0), {
      toolbar:        $(wrapper).find('.toolbar').get(0),
      parserRules:    wysihtmlParserRules,
      stylesheets:  "<?php echo get_template_directory_uri(); ?>/comment-form/css/stylesheet.css"
      //showToolbarAfterInit: false
    });
    editors.push(e);
  });
function submitcomment(){
    var comment_text = document.getElementById('comment').value;
    if(comment_text==""){
     $('#msg').show();
      return false;
    }
    get_post_order_single('a');
  return true;
}

</script>

<?php get_footer();
