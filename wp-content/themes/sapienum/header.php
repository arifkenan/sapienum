<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage sapienum
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes();?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/styles.css">

	<?php wp_head();?>
</head>

<body <?php body_class();?>>
	<header>
		<div class="container">
			<div class="nabar">
				<?php get_template_part('template-parts/header/header', 'image');?>

				<div class="searchHeader">
					<?php get_search_form();?>
				</div>
				<div class="loginMenu">
					<?php
if (is_user_logged_in()) {
    ?>

                        <ul id="login-menu" class="menu">
                            <li class="fa fa-user-o menu-item">
                                 <a href="<?php echo home_url('my-account'); ?>">My Account</a>
                            </li>
                            <li>
                                <a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
                            </li>
</ul>



                        <?php
} else {
    wp_nav_menu(array(
        'theme_location' => 'login',
        'menu_id' => 'login-menu',
    ));
}

?>

				</div>
				</div>
			</div>
			<!--navigations-->
			<?php if (has_nav_menu('main')): ?>
				<div class="navigation top-header-menu">
					<div class="container">
						<?php get_template_part('template-parts/navigation/navigation', 'top');?>
					</div>
				</div><!-- .navigation-top -->
			<?php endif;?>

		</header><!-- #masthead -->



