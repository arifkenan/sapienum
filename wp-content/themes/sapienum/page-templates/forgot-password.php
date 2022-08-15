<?php
/*
 * Template name: Forgot Password
 */

get_header(); ?>

<section class="middleContent login-register">
 <div class="container newcont">
        <div class="leftSidebar">
         <?php get_template_part( 'template-parts/sidebar/left-navigation');  ?>
        </div>
        <div class="rightSec">
        <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>
            <div class="middleSec">
                <div class="login">
                    <h2>Forgot Password</h2>
                    <form id="forgotpassword" action="" method="post">
             <p class="status"></p>
             <p>Please enter your username or email address. You will receive a link to create a new password via email.</p>

                 <?php
        global $wpdb;

        $error = '';
        $success = '';

        // check if we're in reset form
        if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] )
        {
            $email = trim($_POST['user_login']);

            if( empty( $email ) ) {
                $error = 'Enter a username or e-mail address..';
            } else if( ! is_email( $email )) {
                $error = 'Invalid username or e-mail address.';
            } else if( ! email_exists( $email ) ) {
                $error = 'There is no user registered with that email address.';
            } else {

                $random_password = wp_generate_password( 12, false );
                $user = get_user_by( 'email', $email );

                $update_user = wp_update_user( array (
                        'ID' => $user->ID,
                        'user_pass' => $random_password
                    )
                );

                // if  update user return true then lets send user an email containing the new password
                if( $update_user ) {

                    $to = $email;
                    $admin_email = get_option( 'admin_email' );
                    $subject = 'Your new password';
                    $sender = get_option('name');

                    $message = 'Your new password is: '.$random_password;

                    $headers[] = 'MIME-Version: 1.0' . "\r\n";
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers[] = "X-Mailer: PHP \r\n";
                    $headers[] = 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";

                    $mail = wp_mail( $to, $subject, $message, $headers );
                    if( $mail )
                        $success = 'Check your email address for you new password.';

                } else {
                    $error = 'Oops something went wrong updaing your account.';
                }

            }

            if( ! empty( $error ) )
                echo '<div class="message"><p class="error"><strong>ERROR:</strong> '. $error .'</p></div>';

            if( ! empty( $success ) )
                echo '<div class="error_login"><p class="success">'. $success .'</p></div>';
        }
    ?>

               <div class="form-group">
                    <input id="user_login" type="text" name="user_login" class="form-control" placeholder="Email">
                </div>                                        
                <div class="form-group">
                <input type="hidden" name="action" value="reset" />                      
                <input class="submit_button btn btnInviaFull" type="submit" value="Get New Password" name="submit">
                </div>

                <div class="form-group">                
                <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                    <a href="<?php echo home_url('login'); ?>" class="small ">Back to Login</a>
                </div>

                 </form>
                </div>
          <div class="footer" >

        <?php wp_nav_menu( array(
            'theme_location' => 'footer',
            'menu_id'        => 'footer-menu',
            ) ); ?>
        </div><!-- #colophon -->

            </div>

            <?php get_footer();
