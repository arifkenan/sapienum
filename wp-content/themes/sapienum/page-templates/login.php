<?php
/*
 * Template name: Login
 */
if (is_user_logged_in() ) {
    wp_redirect( home_url('my-account')); 
}
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
					<h2>Login</h2>
					<form method="post" id="rsUserLoginform">
<p class="status"></p>
                         <input type="hidden" name="action" value="user_login_request">
                        <?php 
                        if(isset($_SERVER['HTTP_REFERER']))
                        {
                        $http_reffer=$_SERVER['HTTP_REFERER'];
                        }
                        ?>
                        <input type="hidden" name="http_reffer" value="<?php echo $http_reffer; ?>">
                        <div id="messageResponse" class="alert-box"><p></p></div>
                        <?php
                            // to make our script safe, it's a best practice to use nonce on our form to check things out
                            if ( function_exists( 'wp_nonce_field' ) )
                            wp_nonce_field( 'rs_user_login_action', 'rs_user_login_action' );
                            ?>
						<div class="form-group">
							<label>User Name / Email Address</label>
							<input type="text" class="form-control" id="user_email" name="username">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" id="user_password" name="password">
						</div>

						<div class="form-group">
							<input type="checkbox" id="user_askthem" name="user_askthem" />
							<label for="user_askthem">do not forget to ask them</label>
						</div>
                        <input type="hidden" id="redirect_page_url" name="redirect_page_url" value="<?php echo site_url()."/my-account/" ?>">   

                          <div class="form-group">
                <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>                   
                    <a href="<?php echo home_url('forgot-password'); ?>" class="small pull-right">Forgot your password?</a>
                    &nbsp;
                </div>

						<div class="form-group">
							<input type="submit" value="Try To Login" class="btnLogin">
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
