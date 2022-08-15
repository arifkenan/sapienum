<?php
/**
 * The template for displaying categoires pages
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
    <div class="container">
        <div class="leftSidebar">
            <h1>
                <?php the_field('sidebar_heading', 'option');  ?> 
                <strong class="mobile_nav"><i class="fa fa-bars"></i></strong>
                <img id="loader-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/loader-img.gif"  style="display: none;">
            </h1>
             <?php echo get_template_part( 'template-parts/sidebar/right-area');  ?>
        </div>
        <div class="rightSec">
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
                <?php get_sidebar(); ?>


                <?php get_footer();




   
