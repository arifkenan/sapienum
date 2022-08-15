<section class="middleContent">
    <div class="container newcont">
        <div class="leftSidebar">            
            <?php get_template_part( 'template-parts/sidebar/left-navigation');  ?>
           <!--  <div class="col-md-6 col-sm-6 col-xs-6 leftheadin">
                <span>Last</span>
            </div>
            
            <div class="col-md-6 col-sm-6 col-xs-6 leftheadin">
                <span>Top</span>
            </div>
            <div class="left-sidebar-area">
                <ul class="leftbar_ul">
                    <li><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> The standard Lorem Ipsum passage, used since the 1500s</li>
                     <li><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Treacherous officer in Greek intelligence</li>
                      <li><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> They will be told the chance to call the world for 30 seconds</li>
                       <li><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> The standard Lorem Ipsum passage, used since the 1500s</li> 
                       <li><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> they will be told the chance to call the world for 30 seconds</li>
                       <li><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> treacherous officer in Greek intelligence</li>
                       <li><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> The standard Lorem Ipsum passage, used since the 1500s</li>
                </ul>
            </div> -->
        </div>
        <div class="rightSec">
            <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>
            <div class="middleSec">


                 <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/post/content', get_post_format() );

                
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                   
                    comments_template();

                endif;

            endwhile; // End of the loop.
            ?>

             <div class="row post_box">
                    <div class="title_box">
                        look: (title)
                    </div>
                    <div class="title_box_link">
                        link: (http://)
                    </div>
                    <div class="color_palet">
                         <input type="button" name="btn_red" id="btn_red"  class="button_red btn_first_red" onclick="change_color('red')">
                        <input type="button" name="btn_green" id="btn_green"  class="button_green" onclick="change_color('green')">
                       <input type="button" name="btn_yellow" id="btn_yellow"  class="button_yellow"onclick="change_color('yellow')">                        
                        <input type="button" name="btn_white" id="btn_white"  class="button_white" onclick="change_color('white')">
                    </div>
                    <div class="row comment_textarea_box">
                        <textarea rows="8" placeholder="type something...." id="text_comment"></textarea>
                    </div>
                    <div class="send_btn_box">
                        <input type="button" name="comment_send" value="Send" id="comment_send" class="btn_comment_send">
                    </div>


                </div>

<div class="footer">

    <?php wp_nav_menu( array(
        'theme_location' => 'footer',
        'menu_id'        => 'footer-menu',
        ) ); ?>
    </div><!-- #colophon -->



            </div>
                <?php get_sidebar(); ?>
            </div>


                <?php get_footer();
