<?php 
add_action( 'wp_ajax_nopriv_user_login_request', 'rs_user_login_request_callback' );
add_action( 'wp_ajax_user_login_request', 'rs_user_login_request_callback' );
function rs_user_login_request_callback(){
    global $wpdb;
    $error = '';
    $success = '';
    $nonce = $_POST['rs_user_login_action'];

    if ( ! wp_verify_nonce( $nonce, 'rs_user_login_action' ) )
        die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
    $email = $_POST['username'];
    $password = $_POST['password'];

    if( empty( $email ) ) {
        $error = 'Email field is required.';
    }else if( empty( $password ) ) {
        $error = 'Password field is required.';  
    } 
    else
    {
        //echo '<p class="success">Redirecting Please wait ....</p>';
            // First check the nonce, if it fails the function will break
        //check_ajax_referer( 'ajax-login-nonce', 'security' );

        // Nonce is checked, get the POST data and sign user on
        $info = array();
        $info['user_login'] = $email;
        $info['user_password'] = $password;
        $info['remember'] = true;

        $user_signon = wp_signon( $info, false );

    
        if ( is_wp_error($user_signon) ){
            echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
        } else {
            echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
        }
    }
    die(0);
}
?>