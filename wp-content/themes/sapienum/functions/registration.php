<?php 
add_action( 'wp_ajax_nopriv_user_registration', 'rs_user_registration_callback' );
add_action( 'wp_ajax_user_registration', 'rs_user_registration_callback' );

/*
 *  @desc   Register user
 */
function rs_user_registration_callback() {
    global $wpdb;

    $error = '';
    $success = '';
    $nonce = $_POST['rs_user_registration_nonce'];

    if ( ! wp_verify_nonce( $nonce, 'rs_user_registration_action' ) )
        die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['user_password'];
    $user_confrm_password = $_POST['user_confrm_password'];
    $user_dob=$_POST['date'];
    $gender_choice = $_POST['radio-choice'];
    
    if( empty( $email ) ) {
        $error = 'Email field is required.';
    } else if( empty( $name ) ) {
        $error = 'Name field is required.'; 
    } else if( empty( $password ) ) {
        $error = 'Password field is required.';  
    }
    else if( empty( $password )) {
        $error = 'Password field is required.';  
    }
    else if( empty( $user_confrm_password )) {
        $error = 'Confirm field is required.';  
    }
    // else if( empty( $user_confrm_password ) == empty( $password ) ) {
    //     $error = 'Password and Confirm are not same.';  
    // }  
    else {
        //$pwd=wp_generate_password( 8, false );
        $pwd=$password;
        $user_params = array (
            'user_login'    => apply_filters( 'pre_user_user_login', $name ),
            'user_email'    => apply_filters( 'pre_user_user_email', $email ),
            'user_pass'     => apply_filters( 'pre_user_user_pass', $pwd ),
            'role'          => 'subscriber'
        );
        $user_id = wp_insert_user( $user_params );

        if( is_wp_error( $user_id ) ) {
            $error = $user_id->get_error_message();
        } else {

            update_user_meta( $user_id, 'date_of_birth', $user_dob );

            update_user_meta( $user_id, 'gender', $gender_choice );

            do_action( 'user_register', $user_id );
            $success = 1;
        }

    }
    if( ! empty( $error ) )
        echo '<p class="error">'. $error .'</p>';

    if( ! empty( $success ) )

        //$data=array('status'=>'success', 'data'=>'$success'); 
        ///$email= $log;
        $to = $email;
        $admin_email = get_option( 'admin_email' );
        $subject = 'New User registration';
        $sender = get_option('name');
        $message .= ' Thanks for register your login details are : <br>';
        $message .= ' Email ID. : '.$email.'<br>';
        $message .= ' Password. :'. $pwd.'<br>';
        $headers[] = 'MIME-Version: 1.0' . "\r\n";
        $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers[] = "X-Mailer: PHP \r\n";
        $headers[] = 'From: '.$sender.' < '.$admin_email.'>' . "\r\n";
        $mail = wp_mail( $to, $subject, $message, $headers );

        $info = array();
        $info['user_login'] = $email;
        $info['user_password'] = $pwd;
        $info['remember'] = true;
        $user_signon = wp_signon( $info, false );
       ?>
       <script type="text/javascript">
           window.location.href = "<?php echo $_POST['http_reffer']; ?>" 
       </script>
       <?php 
        $successMSg="Thanks for registering with us.";
        echo '<p class="success">'. $successMSg .'</p>';
    // return proper result
    die();
}