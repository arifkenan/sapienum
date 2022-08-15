<?php
/*
 * Template name: Private Message
 */

if (!is_user_logged_in()) {
    wp_redirect(home_url('login'));
}

get_header();?>

<section class="middleContent">
    <div class="container">

        <div class="leftSidebar">
              <?php get_template_part('template-parts/sidebar/left-navigation');?>
        </div>

        <div class="rightSec">
             <div class="middleSec">
            <h2><i class="fa fa-envelope-o"></i> Private Message</h2>
            <?php

$user_id = $_GET['pm_recipient'];
$user_info = get_userdata($user_id);

$current_url = $_SERVER['REQUEST_URI'];
?>
            <div id="tabs_pm">
  <ul>
    
    <li><a href="#tabs-2">Inbox</a></li>
    <li><a href="#tabs-3">Sent</a></li>
    <li><a href="#tabs-1">Compose</a></li>
  </ul>
  <div id="tabs-1">
    <h2>
New Message </h2>
<form class="ewrapper" id="message_form" method="post" action="#">
  <div class="form-group">


    <span id="message_html"></span>

    <div class="col-sm-10">
      <input type="email" class="form-control" name="to_email" id="to_email" placeholder="To : " value="<?php echo $user_info->user_email; ?>" >
       <input type="hidden" class="form-control" name="to_email_hidden" id="to_email_hidden" value="<?php echo $user_info->user_email; ?>">
        <input type="hidden" class="form-control" name="to_email_ID" id="to_email_ID" value="<?php echo $user_id; ?>">
        <input type="hidden" name="current_url" value="<?php echo $current_url ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject :" value="New Message Send">
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <div class="row post_box">
      <?php echo comment_formdata(); ?>
    </div>
    </div>
  </div>
 <div class="form-group">
 </div>


</form>


  </div>
  <div id="tabs-2" style="color: #fff;">
<table class="table" id="private_message_inbox">
    <thead>
      <tr>
        <th>Message content</th>
        <th>Sender Info</th>
        <th>Date</th>
        <th></th>
      </tr>
      <?php
global $wpdb;
$table_private_message = $wpdb->prefix . 'private_message_custom';
$current_user = wp_get_current_user();
$senderid = $current_user->ID;
$sql = "SELECT * FROM `$table_private_message` where recipient_ID=$senderid order by ID desc";
//echo $sql;
$results = $wpdb->get_results($sql);
?>
    </thead>
    <tbody>
        <?php
if (!empty($results)) {
    foreach ($results as $res) {
        $message_content = substr($res->message_content, 0, 100);
        ?>
 <tr>

        <td><?php echo $res->message_subject ?></br>
           <?php echo $message_content ?> ..<br/>
           <a class="" href="<?php echo site_url() ?>/private-message/reply-message/?pm=<?php echo $res->ID; ?>" style="color:#fff;">
      <i class="fa fa-envelope"></i> View Detail
    </a>
       </td>
           <td><?php echo $res->sender_email_ID ?></td>
        <td><?php echo $res->created_date ?></td>
        <td><a class="" href="<?php echo site_url() ?>/private-message/reply-message/?pm=<?php echo $res->ID; ?>" style="color:#fff;">
      <i class="fa fa-reply"></i> Reply
    </a></td>
      </tr>
    <?php
}
} else {
    ?>
    <tr>
        <td colspan="2">
        <?php echo "No message found!"; ?>
        </td>
</tr><?php
}
?>

    </tbody>
  </table>
  </div>
  <div id="tabs-3" style="color: #fff;">
    <table class="table" id="pm_send_items">
    <thead>
      <tr>
        <th>Message content</th>
         <th>Recipient Email</th>
        <th>Date</th>
      </tr>
      <?php
global $wpdb;
$table_private_message = $wpdb->prefix . 'private_message_custom';
$current_user = wp_get_current_user();
$senderid = $current_user->ID;
$sql = "SELECT * FROM `$table_private_message` where sender_ID=$senderid order by ID desc";
//echo $sql;
$results = $wpdb->get_results($sql);

?>
    </thead>

    <tbody>
        <?php
if (!empty($results)) {
    foreach ($results as $res) {

        $message_content = substr($res->message_content, 0, 100);
        ?>
 <tr>

        <td><?php echo $res->message_subject ?></br><?php echo $message_content ?> ..</td>
        <td><?php echo $res->recipient_email_ID ?></td>
        <td><?php echo $res->created_date ?></td>
      </tr>
    <?php
}
} else {
    ?>
    <tr>
        <td colspan="2">
        <?php echo "No message found!"; ?>
        </td>
</tr><?php
}
?>

    </tbody>
  </table>

  </div>
</div>
<div class="footer">
    <?php wp_nav_menu(array(
    'theme_location' => 'footer',
    'menu_id' => 'footer-menu',
));?>

</div><!-- #colophon -->
</div>
</div>

</section>
<?php function comment_formdata()
{?>
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

  <textarea class="editable" id="comment_value" name="comment_value" cols="45" rows="8" maxlength="65525" aria-required="true" required="required" placeholder="Type something...." required ></textarea>

  <br>
  <input type="button" name="submit" id="submit" class="comment_send" value="Send" onclick="submitmessage();"><span id="msg" style="color:red; display:none; margin-left:10px;">Entry must be at least one key press</span>
  <input type="hidden" name="action" value="send_private_message_action" />

 <?php }?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/comment-form/dist/wysihtml.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/comment-form/dist/wysihtml.all-commands.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/comment-form/dist/wysihtml.table_editing.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/comment-form/dist/wysihtml.toolbar.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/comment-form/parser_rules/advanced_unwrap.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.dataTables.min.js"></script>

<script>
    jQuery(document).ready(function($) {

    $('#private_message_inbox, #pm_send_items').dataTable();
});
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
    var comment_text = document.getElementById('comment_value').value;
    if(comment_text==""){
     $('#msg').show();
      return false;
    }
  return true;
}

</script>


<?php get_footer();
