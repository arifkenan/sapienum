<?php
/*
 * Template name: Logout
 */

get_header(); ?>

<section class="middleContent login-register">
    <div class="container">
        <div class="leftSidebar">
            <h1>
                <?php the_field('sidebar_heading', 'option');  ?> 
                <strong class="mobile_nav"><i class="fa fa-bars"></i></strong>
            </h1>
            <?php get_template_part( 'sidebar', 'sidebar' ); ?>
        </div>

        <div class="rightSec">
            <div class="middleSec">
                <div class="login">
                     <?php 
                     wp_logout();
                        ?>
                </div>


            </div>

            <?php get_footer();
