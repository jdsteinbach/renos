<?php
/**
 * Reusable cURL function
 */

if ( ! function_exists( 'custom_curl') ) {
  function custom_curl( $url ) {
    $ch  = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $output = curl_exec( $ch );
    curl_close( $ch );
    return $output;
  }
}

if ( ! function_exists( 'return_curl_contents' ) ) {
  function return_curl_contents( $url, $start_string, $end_string ) {
    $output = custom_curl( $url );

    $t_length = strlen( $start_string );
    $start    = strpos( $output, $start_string ) + $t_length;
    $end      = strpos( $output, $end_string, $start );
    $length   = $end - $start;
    $data     = substr( $output, $start, $length )
              ? substr( $output, $start, $length )
              : false;
    return $data;
  }
}