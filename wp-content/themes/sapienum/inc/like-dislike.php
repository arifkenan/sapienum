<?php
class LikeDislike extends visitors_Ipchek {

     function __construct() {
            add_action( 'wp_ajax_cld_comment_ajax_action', array( $this, 'like_dislike_action' ) );
            add_action( 'wp_ajax_nopriv_cld_comment_ajax_action', array( $this, 'like_dislike_action' ) );
        }

        function like_dislike_action() {

                $comment_id = sanitize_text_field( $_POST['comment_id'] );
                $type = sanitize_text_field( $_POST['type'] );
                $user_ip = sanitize_text_field( $_POST['user_ip'] );

                $liked_ips = get_comment_meta($comment_id,'cld_ips',true);
                if(empty($liked_ips)){
                    $liked_ips = array();
                 }

                if (! in_array( $user_ip, $liked_ips)) {
                    if($type=='like'){
            
                    $like_count = get_comment_meta( $comment_id, 'cld_like_count', true );
                    if ( empty( $like_count ) ) {
                        $like_count = 0;
                    }
                    $like_count = $like_count + 1;
                    $check = update_comment_meta( $comment_id, 'cld_like_count', $like_count );
                    
                    if ( $check ) {
                       
                        $response_array = array( 'success' => true, 'latest_count' => $like_count );
                    } else {
                        $response_array = array( 'success' => false, 'latest_count' => $like_count );
                    }
                    $liked_ips[] = $user_ip;
                    update_comment_meta( $comment_id, 'cld_ips', $liked_ips );
                   }
                } else {
                    if($type=='dislike'){
                    $dislike_count = get_comment_meta( $comment_id, 'cld_like_count', true );
                    if ( empty( $dislike_count ) ) {
                        $dislike_count = 0;
                    }
                    $dislike_count = $dislike_count - 1;
                    $check = update_comment_meta( $comment_id, 'cld_like_count', $dislike_count );
                    if ( $check ) {
                        $response_array = array( 'success' => true, 'latest_count' => $dislike_count );
                    } else {
                        $response_array = array( 'success' => false, 'latest_count' => $dislike_count );
                    }
                    //$liked_ips[] = $user_ip;
                    if (($key = array_search($user_ip, $liked_ips)) !== false) {
                        unset($liked_ips[$key]);
                    }
                    update_comment_meta( $comment_id, 'cld_ips', $liked_ips );

                 }
                 }
                
                
                echo json_encode($response_array);
                die();
          
        }

}

new LikeDislike();

?>