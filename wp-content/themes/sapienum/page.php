<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage sapienum
 * @since 1.0
 * @version 1.0
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


                  <?php
        if ( have_posts() ) : ?>
            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'template-parts/post/content', get_post_format() );

            endwhile;

            the_posts_pagination( array(
                'prev_text' => sapienum_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'sapienum' ) . '</span>',
                'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'sapienum' ) . '</span>' . sapienum_get_svg( array( 'icon' => 'arrow-right' ) ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'sapienum' ) . ' </span>',
            ) );

        else :

            get_template_part( 'template-parts/post/content', 'none' );

        endif; ?>


            </div>
               


                <?php get_footer();