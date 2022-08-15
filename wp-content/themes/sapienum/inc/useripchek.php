<?php

if ( !class_exists( 'visitors_Ipchek' ) ) {

	class visitors_Ipchek {
		
		function __construct() {
			$this->get_user_IP();
		}

		function print_array( $array ) {
			echo "<pre>";
			print_r( $array );
			echo "</pre>";
		}

     	/**
		 * Returns visitors IP address
		 *
		 * @return string $ip
		 *
		 * @since 1.0.0
		 */
		function get_user_IP() {
			$client = @$_SERVER['HTTP_CLIENT_IP'];
			$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
			$remote = $_SERVER['REMOTE_ADDR'];

			if ( filter_var( $client, FILTER_VALIDATE_IP ) ) {
				$ip = $client;
			} elseif ( filter_var( $forward, FILTER_VALIDATE_IP ) ) {
				$ip = $forward;
			} else {
				$ip = $remote;
			}

			return $ip;
		}

	}

}