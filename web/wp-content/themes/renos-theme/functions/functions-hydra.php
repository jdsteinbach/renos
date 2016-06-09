<?php

/**
 * A couple of demo functions to get you started with the Hydra plugin
 * The first one makes a simple call and has an if statement to check
 * for state pages.  The second is for adding the rel prev/next links
 * to the <head> tag.
 */

// function hydra_call() {
//   $hydra = new hydra();
//   global $post;
//   global $result;
//   $h_query['cache'] = 1;
//   if ( is_singular( 'state' ) ) {
//     $page_slug  = $post->post_name;
//     $states     = $hydra->helpers->states();
//     foreach( $states as $abbr => $state ) {
//       if( strtolower( $state ) == $page_slug ) {
//         break;
//       }
//     }
//     $h_query['states'] = $abbr;    
//     $post->state_abbr = $abbr;
//   }
//   $result = $hydra->ipeds->get( $h_query );
// }

// function hydra_rel_links() {
//   global $result;  
//   Helpers::hydra_rel_links( $result );
// }

// add_action( 'get_header',   'hydra_call' );
// add_action( 'wp_head',      'hydra_rel_links' );
