<?php
/*
 * Template name: Complaint
 */

get_header(); ?>
    <?php

    $postTitle = $_REQUEST['complaintID'];
   
    ?>
<section class="middleContent">
	<div class="container newcont">
        <div class="leftSidebar">             
            <?php get_template_part( 'template-parts/sidebar/left-navigation');  ?>
        </div>
		<div class="rightSec">
             <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>
			<div class="middleSec">
            <ul>
             <li> 1)  Before sending your message, check to see if the question you have asked is answered here . If your message is answered in the FAQ, we want you to know that you will not be returned.</li>

             <li> 2) your messages are not communicated to the authors .</li>   

             <li>3) complaints about the entries about the persons can only be made by the real person himself, the legal person if he is a legal person or the legal representative. complaints made by third parties will not be considered.</li> 

             <li>4) we would like to state that the messages you send us are not in private or private correspondence. If you wish, you may forward these messages to the following units, including the name, surname and e-mail address of the sender, if any, to the interested person and any other person or juridical person he / she deems necessary. the sushi dictionary may publish the text of the messages it receives partially or completely on the relevant page, specifying the sender's name and surname.</li> 

             <li>5) If you do not want your complaint to be subject to the above actions, you may not add a note to your complaint. it is not compulsory for your text to contain a text or headline complaint. complaints without text are also examined in the same way. there is no option to provide confidentiality guarantees in messaging outside of complaints.</li>       
            </ul>
             
        <h2>  contact form </h2>

        <form action="<?php echo get_permalink(219); ?>" method="post" id="contact-form" >
         <div>
          <label for="Email">
          <font style="vertical-align: inherit;">
          <font style="vertical-align: inherit;">your email adress</font>
          </font>
          </label>
          <input id="Email" name="Email" type="email" value="" required>
         </div>
         <div class="input">      
        <label class="radio">
        <input checked="checked" id="Category" name="Category" type="radio" value="Content">
         <font style="vertical-align: inherit;">
         <font style="vertical-align: inherit;"> 
          content published in the sushi dictionary</font>
          </font>
          </label>
        <label class="radio">
        <input id="Category" name="Category" type="radio" value="Other"><font style="vertical-align: inherit;">
        <font style="vertical-align: inherit;"> 
          Other topics related to sour dictionary</font>
       </font>
       </label>
      </div>
      <div>
      <label for="Subject">
      <font style="vertical-align: inherit;">
      <font style="vertical-align: inherit;">subject</font>
      </font>
      </label>
     <input  id="Subject" name="Subject" placeholder="" type="text" value="" required>
    </div>
    <div>
      <label for="Body"><font style="vertical-align: inherit;">
      <font style="vertical-align: inherit;">explanation</font>
      </font>
      </label>
      <textarea cols="50" id="Body" name="Body" rows="10" required> 
       </textarea>
    </div>
    <div class="actions" style="margin-top:10px;">
      <input type="submit" name="send" value="Send" class="primary" style="vertical-align: inherit;">
    </div>
        </form>

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

 
<?php get_footer();
