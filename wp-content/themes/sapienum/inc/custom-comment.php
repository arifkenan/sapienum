<?php
echo"Hello"; 
die;
?>


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
<?php function conmment_formdata(){ ?>
<form class="ewrapper" id="commentform" method="post" action="#">
  <div class="toolbar" style="display: none;">
    <a data-wysihtml-command="bold" title="CTRL+B">B</a> |
    <a data-wysihtml-command="createLink">link</a> |
    <a data-wysihtml-command="formatBlock" data-wysihtml-command-value="h1">h1</a> |
    <a data-wysihtml-command="formatBlock" data-wysihtml-command-value="h2">h2</a> |
    <a data-wysihtml-command="foreColor" data-wysihtml-command-value="red" class="button_red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
    <a data-wysihtml-command="foreColor" data-wysihtml-command-value="green" class="button_green">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
    <a data-wysihtml-command="foreColor" data-wysihtml-command-value="yellow" class="button_yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
    <a data-wysihtml-command="foreColor" data-wysihtml-command-value="wight" class="button_white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> 
    
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

  <textarea class="editable" id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required" placeholder="Type something...." required></textarea>

  <br><input type="submit" name="submit" id="submit" class="comment_send" value="Send" onclick="submitcomment();" >
  <input type="hidden" name="action" value="new comments" />

</form>
 <?php   } ?>

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
      stylesheets:  "http://localhost/sapienum/wp-content/themes/sapienum/comment-form/css/stylesheet.css"
      //showToolbarAfterInit: false
    });
    editors.push(e);
  });
function submitcomment(){
    var comment_text = document.getElementById('comment').value;
    if(comment_text==""){
     alert("Entry must be at least one key press");
        return false;
    }
  return true;
}
</script>