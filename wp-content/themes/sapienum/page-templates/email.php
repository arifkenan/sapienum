<?php
/*
 * Template name: email 
 */

get_header(); ?>
    <?php
    $postTitle = $_REQUEST['complaintID'];
    if(isset($_POST['send'])){
    $email = $_POST['Email'];
    $subject = $_POST['Subject'];
    $body  = $_POST['Body'];
    sendMail($email,$subject,$body);
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
            <ul>
            <h2>Contact</h2>
            approve your request
            your message has been saved. at the same time a confirmation e-mail was sent to you. the message will be forwarded to the sourcing dictionary control when you click on the link in this email within 24 hours. it sometimes takes 10-20 minutes for this email to reach you. If you do not see this e-mail in your Inbox, look in the trash (spam) directory.
            </ul>
             
        

      

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
