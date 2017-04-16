<?php
/**
 * Tni Core Authorization Helper Functions
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.0.9
 * @license    GPL-2.0+
 */

/**
 * Refresh Authorization
 *
 * @since 1.0.9
 *
 * @return $code == 200 || false
 */
function tni_core_refresh_auth() {
  $authorization = new TNI_Core_Authorization();
  $base_url = $authorization->get_base_url();
  $url = esc_url( $base_url . '/auth/refresh' );
  $headers = array( 'X-CSRF-TOKEN' => $_COOKIE['csrf_refresh_token'] );
  $cookies = array( new WP_Http_Cookie( array( 'name' => 'refresh_token_cookie', 'value' => $_COOKIE['refresh_token_cookie'] ) ) );

  $resp = wp_remote_post( $url, array( 'cookies' => $cookies, 'headers' => $headers ) );
  if( is_wp_error( $resp ) ) {
     // echo $resp->get_error_message();
     return false;
  } else {
     $code = wp_remote_retrieve_response_code( $resp );
     return $code == 200;
  }
}

/**
 * Check Authorization
 *
 * @since 1.0.9
 *
 * @return bool true || false
 */
function tni_core_check_auth() {
  $authorization = new TNI_Core_Authorization();
  $base_url = $authorization->get_base_url();
  $url = esc_url( $base_url . '/auth/ok' );
  $headers = array( 'X-CSRF-TOKEN' => $_COOKIE['csrf_access_token'] );
  $cookies = array( new WP_Http_Cookie( array( 'name' => 'access_token_cookie', 'value' => $_COOKIE['access_token_cookie'] ) ) );

  $resp = wp_remote_get( $url, array( 'cookies' => $cookies, 'headers' => $headers ) );
  if( is_wp_error( $resp ) ) {
     // echo $resp->get_error_message();
     return false;
  } else {
     $code = wp_remote_retrieve_response_code( $resp );
     if( $code == 200 ) {
         return true;
     } elseif ( $code == 401 ) {
         // try to refresh token if expired
         $data = json_decode( $resp['body'] );
         if ( $data->msg == 'Token has expired' ) {
             return tni_core_refresh_auth();
         }
     }
     return false;
  }
}
