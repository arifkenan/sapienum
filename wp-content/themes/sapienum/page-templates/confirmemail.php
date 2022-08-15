<?php
/*
 * Template name: Confirm email 
 */

get_header(); ?>

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
            We thank you <br>
            your message has been passed to the sour dictionary control
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
