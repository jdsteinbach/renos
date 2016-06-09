<?php
/*
 * Create needed custom post types for this theme.
 */

if ( !function_exists( 'create_cpt_labels' ) ) :
  function create_cpt_labels( $singular, $plural = false ) {
    $plural = $plural ? $plural : $singular . 's';
    return array(
      'name'                => __( $plural, 'renos-theme' ),
      'singular_name'       => __( $singular, 'renos-theme' ),
      'add_new'             => _x( 'Add New '. $singular, 'renos-theme', 'renos-theme' ),
      'add_new_item'        => __( 'Add New '. $singular, 'renos-theme' ),
      'edit_item'           => __( 'Edit '. $singular, 'renos-theme' ),
      'new_item'            => __( 'New '. $singular, 'renos-theme' ),
      'view_item'           => __( 'View '. $singular, 'renos-theme' ),
      'search_items'        => __( 'Search ' . $plural, 'renos-theme' ),
      'not_found'           => __( 'No ' . $plural . ' found', 'renos-theme' ),
      'not_found_in_trash'  => __( 'No ' . $plural . ' found in Trash', 'renos-theme' ),
      'parent_item_colon'   => __( 'Parent '. $singular . ':', 'renos-theme' ),
      'menu_name'           => __( $plural, 'renos-theme' ),
    );
  }
endif;

include 'functions-cpt-renos.php';
?>