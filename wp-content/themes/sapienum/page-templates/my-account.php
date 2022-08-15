<?php
/*
 * Template name: My Account
 */

if (!is_user_logged_in()) {
    wp_redirect(home_url('login'));
}

get_header();?>

<section class="middleContent login-register">
    <div class="container">

        <div class="leftSidebar">
              <?php get_template_part('template-parts/sidebar/left-navigation');?>
        </div>

        <div class="rightSec">
      <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>

            <h2>My Account</h2>

            <?php
$user_id = get_current_user_id();
global $current_user;
$user_email = $current_user->user_email;
$user_name = $current_user->nickname;
$single = true;
$key = 'date_of_birth';
$date_of_birth = get_user_meta($user_id, $key, $single);
$key = 'gender';
$gender = get_user_meta($user_id, $key, $single);
// $key = 'phone_number';
// $phone_number = get_user_meta( $user_id, $key, $single );

?>
            <div class="row">
            <div class="col-md-4">
                Name: <?php echo $user_name; ?>
            </div>
            <div class="col-md-4">
                Email: <?php echo $user_email; ?>
            </div>
            <!-- <div class="col-md-6">
                Date of Birth:  <?php echo date('d/m/Y', $date_of_birth); ?>
            </div> -->
            <div class="col-md-4">
                Gender: <?php
if ($gender == '0') {
    echo "Woman";
}
if ($gender == '1') {
    echo "Male";
}
if ($gender == '2') {
    echo "Another";
}
if ($gender == '3') {
    echo "Never mind";
}
?>
            </div>
             <div class="col-md-4">
                <a href="<?php echo site_url(); ?>/private-message">Inbox</a>
             </br>
            <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-default">Click to Logout</a>
            </div>
        </div>

     </div>
     <div class="footer" style="text-align:center;">

    <?php wp_nav_menu(array(
    'theme_location' => 'footer',
    'menu_id' => 'footer-menu',
));?>
    </div><!-- #colophon -->
</div>

</section>

<?php get_footer();
