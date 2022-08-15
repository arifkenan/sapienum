<?php
/*
 * Template name: edit comments
 */

get_header(); 
if(!is_user_logged_in()){
    wp_redirect(home_url()); 
    exit;
}

?>
    <?php 
    $postTitle = $_REQUEST['id'];
    $url = get_the_permalink($postTitle);

     if(isset($_POST['submit'])){
        $commentarr = array();
        $commentarr['comment_ID'] = $_REQUEST['topicid'];
        $contentData = str_replace( array( '"\"','', '\"' ), ' ',$_POST['comment']);
        update_comment_postData($contentData,$_REQUEST['topicid']);

         if($update){
            //wp_redirect(); 
            
            wp_redirect($url);
            //echo "<script>document.location = ".$url.";</script>";

           $message = "Topic updated successfully";
           //echo $message;
           //exit;
         }
      }
    ?>

<section class="middleContent">
	<div class="container newcont">
        <div class="leftSidebar">             
            <?php get_template_part( 'template-parts/sidebar/left-navigation');  ?>
        </div>
		<div class="rightSec">
             <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>
			<div class="middleSec">
            
            <h2> <?php echo get_the_title($postTitle); ?>
            </h2>
            <?php if(!empty($message)){
                 echo'<div style="color:green; text-align:center;">';echo $message; echo'</div>';
                } ?>
            <?php if ( is_user_logged_in() ) {
                echo'<div class="row post_box">';
                    echo  conmment_formdata(); 
                    echo'</div>';
                   } 
            ?>

        <div class="footer" >

        <?php wp_nav_menu( array(
            'theme_location' => 'footer',
            'menu_id'        => 'footer-menu',
            ) ); ?>
        </div><!-- #colophon -->
			</div>
     
			<div class="GoogleAddSec">
				 <?php get_sidebar(); ?>
			</div>
        
            </div>

<?php function conmment_formdata(){ ?>
<form class="ewrapper" id="commentform" method="post" >
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
 <?php  $postData = get_comment($_REQUEST['topicid']);
        // echo'<pre>';
        // print_r($postData);
        // echo'</pre>'; 
   ?>
  <textarea class="editable" id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required" placeholder="Type something...." required ><?php echo $postData->comment_content; ?></textarea>
  <br><input type="submit" name="submit" id="submit" class="comment_send" value="Save"><span id="msg" style="color:red; display:none; margin-left:10px;">Entry must be at least one key press</span>
  </form>
 <?php   } ?>
<style>
  
  #toolbar [data-wysihtml-action] {
    float: right;
  }
  
  #toolbar,
  textarea {
    width: 920px;
    padding: 5px;
    -webkit-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  
  textarea {
    height: 280px;
    border: 2px solid green;

  }
  
  textarea:focus {
    color: black;
    border: 2px solid black;
  }
  
  .wysihtml-command-active {
    font-weight: bold;
  }
  
  [data-wysihtml-dialog] {
    margin: 5px 0 0;
    padding: 5px;
    border: 1px solid #666;
  }
  
  a[data-wysihtml-command-value="red"] {
    color: red;
  }
  
  a[data-wysihtml-command-value="green"] {
    color: green;
  }
  
  a[data-wysihtml-command-value="yellow"] {
    color: yellow;
  }
  a[data-wysihtml-command-value="wight"] {
    color: wight;
  }
  div.editable {
    border: 1px dashed gray;
    padding: 10px;
  }
  .editable wysihtml-editor h2{font-size:15px !important; font-family: "Open Sans",sans-serif !important;}

</style>
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

</script>
<script>
function ConfirmDelete(DeleteID)
{
 var x = confirm("Are you sure you want to delete?");
  if(x){
   var ajaxurl   = "<?php echo admin_url('admin-ajax.php'); ?>";
    jQuery.ajax({
        type: "POST",
        url : ajaxurl,
        data: { action:'comment_delete_action', DeleteID: DeleteID },
    }).done(function( result ) {
        alert("Topic deleted successfully");
        location.reload();
    });
} else {
     return false;
}
}
</script>  
<?php get_footer();
