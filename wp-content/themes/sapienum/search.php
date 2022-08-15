<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage sapienum
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<style>
.wysiwyg-color-white {
  color: white;
}
.wysiwyg-color-red {
  color: red;
}
.wysiwyg-color-green {
  color: green;
}
.wysiwyg-color-yellow {
  color: yellow;
}

</style>

<section class="middleContent">
    <div class="container newcont">
        <div class="leftSidebar">
         <?php get_template_part( 'template-parts/sidebar/left-navigation');  ?>
        </div>
        <div class="rightSec">
        <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>
            <div class="middleSec">
            <header class="page-header">
            <?php
             $haystack = $_REQUEST;
             $needle = '@';
             $url =  explode('@',$_GET['s']);
             $pos = strpos($haystack,$needle);
            if ($pos !== false) {
            if(!empty($url[1])){
            $authorUrl = site_url().'/author/'.$url[1].'/';
            ?>
            <script>
            window.location.href ="<?php echo $authorUrl;  ?>";
            </script>
            <?php 
            }
            } 
         if(is_user_logged_in()){
          if ( have_posts() ) : ?>
            <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'sapienum' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        <?php else :   ?> 

            <?php  echo'<h3>'; echo $_GET['s'];  echo'</h3>';                                      ?>
             <?php if(isset($_POST['submit'])){
                 $user_id = get_current_user_id();
                 $defaults = array(
                    'post_author' => $user_id,
                    'post_content' => $_POST['comment_text'],
                    'post_title' => $_POST['title'],
                    'post_status' => 'publish',
                    'post_type' => 'post',
                    );
                   $post_id = wp_insert_post($defaults);
                   $postdata = get_post($post_id);

                   if($post_id){?>
                   <div class="commentBox">

                   <?php echo $postdata->post_content; ?>
                   </div>
                   <?php  

                        } 
                   }
                   else {
                   ?>
              <h1 class="page-title"><?php _e( 'no such thing. but could you be saying this:', 'sapienum' );?></h1> <?php } ?>

            <?php echo conmment_formdata(); ?>
        <?php endif; ?>
        <?php } else { ?>
           <h1 class="page-title"><?php _e( 'No result found for: '.$_GET['s'].'', 'sapienum' );
   } ?>
    </header><!-- .page-header -->

                                                
                 <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/post/content', get_post_format() );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

                the_post_navigation( array(
                    'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'sapienum' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'sapienum' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . sapienum_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'sapienum' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'sapienum' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . sapienum_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
                ) );

            endwhile; // End of the loop.
            ?>


<style>

.wysiwyg-color-white {
  color: white;
}
.wysiwyg-color-red {
  color: red;
}
.wysiwyg-color-green {
  color: green;
}
.wysiwyg-color-yellow {
  color: yellow;
}
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
<form class="ewrapper" method="post" action="#">
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
  <textarea class="editable" id="comment_text" name="comment_text"  placeholder="Type something...." required></textarea>
  <input type="hidden" name="title" value="<?php echo $_GET['s']; ?>">
  <br><input type="submit" name="submit" id="submit" class="comment_send" value="Send" onclick="submitcomment();" >

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
      stylesheets:  "<?php echo get_template_directory_uri(); ?>/comment-form/css/stylesheet.css"
      //showToolbarAfterInit: false
    });
    editors.push(e);
  });
function submitcomment(){
    var comment_text = document.getElementById('comment_text').value;
    if(comment_text==""){
     alert("Entry must be at least one key press");
        return false;
    }
  return true;
}
</script>


</div>
    <?php get_sidebar(); ?>
</div>
    

    <?php get_footer();

